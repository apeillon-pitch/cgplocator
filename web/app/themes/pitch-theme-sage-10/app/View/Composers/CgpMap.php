<?php

namespace App\View\Composers;

use Roots\Acorn\View\Composer;
use NortiaCGPLocator\Geolocator\GeolocatorComponent;
use function get_posts;
use function var_dump;

class CgpMap extends Composer
{
    /**
     * List of views served by this composer.
     *
     * @var array
     */
    protected static $views = [
        'partials.content-page-locator',
    ];

    /**
     * Data to be passed to view before rendering, but after merging.
     *
     * @return array
     */
    public function override()
    {

        return [
            'posts' => $this->getCgp(),
            'json' => $this->jsonList(),
        ];
    }

    public function getCgp()
    {
        $lat = 0.0;
        $long = 0.0;
        $distance = 1000;

        if (isset($_POST["lat"])) { $lat = $_POST["lat"]; }
        if (isset($_POST["lng"])) { $long = $_POST["lng"]; }
        if (isset($_POST["distance"])) { $distance = $_POST["distance"]; }

        if (empty($lat) OR empty($long)) {
            return get_posts(array(
                'post_type' => 'cgp',
                'posts_per_page' => 4,
                'post_status' => 'publish',
            ));
        }

        return (new GeolocatorComponent())->get_posts_by_latlng(array(
            'lat' => (float) $lat,
            'lng' => (float) $long,
            'distance' => (int) $distance,
            'numberposts' => 10,
            'offset' => 0,
            ));
    }

    public function jsonList() {
        $posts = $this->getCgp();

        $json = array();

        foreach ($posts as $post) {
            $json[] = array(
                'title' => $post->post_title,
                'lat' => get_post_meta($post->ID, '_latitude', true),
                'lng' => get_post_meta($post->ID, '_longitude', true),
                'address' => get_field('address', $post->ID, true)['address'],
                'email' => get_post_meta($post->ID, 'cgp_email', true),
                'link' => get_permalink($post->ID),
            );
        }

        return $json;
    }
}
