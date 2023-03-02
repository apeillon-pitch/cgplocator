<?php

namespace NortiaCGPLocator\ImportJobQueue;

use WP_Queue\Job;
use NortiaCGPLocator\Admin\Settings;
use Monolog\Logger;
use Monolog\Handler\StreamHandler;
use Monolog\Formatter\LineFormatter;

class ImportJob extends Job
{

    public $data;
    protected $logger;

    public function __construct($data)
    {
        $this->data = $data;
        $dateformat = "H:i:s";
        $output = wp_date(get_option( 'date_format' )) . " %datetime% - (%level_name%) %message% %context.entry% %context.code%\n";
        $formatter = new LineFormatter($output, $dateformat, true, true);
        $this->logger = new Logger('import');
        $this->logger->setTimezone(wp_timezone());
        $handler = new StreamHandler(
            wp_upload_dir()['basedir'] . '/nortia-cgplocator/import.log',
            Logger::INFO
        );
        $handler->setFormatter($formatter);
        $this->logger->pushHandler(
            $handler
        );
    }

    public function __destruct()
    {
        $this->logger->reset();
    }

    protected function geoCodeAddress($address)
    {
        $address = urlencode($address);
        $google_api_key = acf_get_setting('google_api_key');
        $google_api_url =
            "https://maps.googleapis.com/maps/api/geocode/json?address=$address&key=$google_api_key";
        
        $response = wp_remote_get(esc_url_raw($google_api_url));

        if (is_wp_error($response)) {
            $this->logger->error($response->get_error_message(), ['code' => $response->get_error_code()]);
            return false;
        }

        return json_decode(wp_remote_retrieve_body($response), true);
    }

    private function array_recursive_search_key_map($needle, $haystack)
    {
        foreach ($haystack as $first_level_key => $value) {
            if ($needle === $value) {
                return array($first_level_key);
            } elseif (is_array($value)) {
                $callback = $this->array_recursive_search_key_map($needle, $value);
                if ($callback) {
                    return array_merge(array($first_level_key), $callback);
                }
            }
        }
        return false;
    }

    private function get_value_from_geocode($geocodeJson, $key, $long = true)
    {
        if ($this->array_recursive_search_key_map($key, $geocodeJson['results'][0]['address_components']) === false) {
            return '';
        } elseif ($long) {
            return $geocodeJson['results'][0]['address_components'][$this->array_recursive_search_key_map($key, $geocodeJson['results'][0]['address_components'])[0]]['long_name'];
        }
        return $geocodeJson['results'][0]['address_components'][$this->array_recursive_search_key_map($key, $geocodeJson['results'][0]['address_components'])[0]]['short_name'];
    }

    protected function prepareAddress($geocodeJson)
    {
        $address = array(
            'address' => wp_kses($this->data[4] . ', ' . $this->data[6] . ' ' . $this->data[5] . ', ' . $this->data[7], 'cgp'),
            'lat' => $geocodeJson['results'][0]['geometry']['location']['lat'],
            'lng' => $geocodeJson['results'][0]['geometry']['location']['lng'],
            'zoom' => 14,
            'place_id' => $geocodeJson['results'][0]['place_id'],
            'name' => $this->get_value_from_geocode($geocodeJson, 'street_number') . ' ' . $this->get_value_from_geocode($geocodeJson, 'route'),
            'street_number' => $this->get_value_from_geocode($geocodeJson, 'street_number'),
            'street_name' => $this->get_value_from_geocode($geocodeJson, 'route'),
            'city' => $this->get_value_from_geocode($geocodeJson, 'locality'),
            'state' => $this->get_value_from_geocode($geocodeJson, 'administrative_area_level_1'),
            'state_short' => $this->get_value_from_geocode($geocodeJson, 'administrative_area_level_1', false),
            'country' => $this->get_value_from_geocode($geocodeJson, 'country'),
            'country_short' => $this->get_value_from_geocode($geocodeJson, 'country', false),
            'postal_code' => $this->get_value_from_geocode($geocodeJson, 'postal_code'),
        );

        return $address;
    }

    public function handle()
    {
        if ('Type de hiérarchie' === $this->data[0]) {
            return;
        }

        $settings = Settings::get();
        $settings->set(['is_importing' => true]);
        $total_rows = (int) $settings->all()['total_rows'];
        $current_row = (int) $settings->all()['current_row'];
        $current_row++;
        $settings->set(['current_row' => $current_row]);

        $address = $this->data[4] . ", " . $this->data[6] . " " . $this->data[5] . ", " . $this->data[7];
        $geocode = $this->geoCodeAddress($address);

        if ($geocode['status'] !== 'OK') {
            $this->logger->error('Erreur lors du géocodage : ' . $geocode['status'], ['address' => $address, 'entry' => $this->data[3]]);
        }

        if (isset($geocode['results'][0]['geometry']['partial_match'])) {
            $this->logger->error('L\'adresse n\'est pas assez précise.', ['address' => $address, 'entry' => $this->data[3]]);
        }

        // Check if the post already exists
        $searchArgs = [
            'post_type' => 'cgp',
            'posts_per_page' => 1,
            'meta_query' => [
                [
                    'key' => 'AccountLongId',
                    'value' => $this->data[2],
                    'compare' => '=',
                ],
            ],
        ];
        $existingPost = get_posts($searchArgs);

        if (!empty($existingPost)) {
            if (false === get_field('is_locked', $existingPost[0]->ID)) {
                $post = [
                    'ID' => $existingPost[0]->ID,
                    'post_title' => $this->data[3],
                ];
                wp_update_post($post);

                update_field('address', $this->prepareAddress($geocode), $existingPost[0]->ID);
                update_field('email', $this->data[8], $existingPost[0]->ID);
                update_post_meta($existingPost[0]->ID, '_latitude', $geocode['results'][0]['geometry']['location']['lat']);
                update_post_meta($existingPost[0]->ID, '_longitude', $geocode['results'][0]['geometry']['location']['lng']);
                // Write import log to file
                $this->logger->info('CGP mis à jour : ', ['entry' => $this->data[3]]);
            } else {
                // Write import log to file
                $this->logger->notice('CGP ignoré car verrouillé : ', ['entry' => $this->data[3]]);

            }
        } else {
            // Create new post with the data
            $post = [
                'post_title' => $this->data[3],
                'post_type' => 'cgp',
                'post_status' => 'publish',
            ];
            $postId = wp_insert_post($post);
            // Insert ACF data
            update_field('AccountLongId', $this->data[2], $postId);
            update_field('address', $this->prepareAddress($geocode), $postId);
            update_field('email', $this->data[8], $postId);
            update_field('is_locked', false, $postId);
            update_post_meta($postId, '_latitude', $geocode['results'][0]['geometry']['location']['lat']);
            update_post_meta($postId, '_longitude', $geocode['results'][0]['geometry']['location']['lng']);
            // Write import log to file
            $this->logger->info('CGP créé : ', ['entry' => $this->data[3]]);

        }
        // If we are at the end of the import, stop importing and output an end notice to the log file
        if ($current_row === $total_rows) {
            $settings->set(['is_importing' => false]);
            $this->logger->info('Import terminé.');
        }
    }
}
