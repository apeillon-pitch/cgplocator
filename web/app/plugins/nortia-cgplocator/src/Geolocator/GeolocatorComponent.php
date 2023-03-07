<?php

namespace NortiaCGPLocator\Geolocator;

class GeolocatorComponent
{
    public function __construct()
    {
    }

    protected function get_post_ids($nearbyLocations)
    {
        $ids = array();
        foreach ($nearbyLocations as $key => $location) {
            $ids[] = $location->ID;
        }
        return $ids;
    }

    public function get_posts_by_latlng($args = [
        'lat' => 0.0,
        'lng' => 0.0,
        'distance' => 0.0,
        'numberposts' => -1,
        'offset' => 0,
    ])
    {

        global $wpdb;

        $earth_radius = 3959;

        $sql = $wpdb->prepare(
            "SELECT DISTINCT
            p.ID,
            ( %d * acos(
            cos( radians( %s ) )
            * cos( radians( latitude.meta_value ) )
            * cos( radians( longitude.meta_value ) - radians( %s ) )
            + sin( radians( %s ) )
            * sin( radians( latitude.meta_value ) )
            ) )
            AS distance
            FROM $wpdb->posts p
            INNER JOIN $wpdb->postmeta latitude ON p.ID = latitude.post_id
            INNER JOIN $wpdb->postmeta longitude ON p.ID = longitude.post_id
            WHERE 1 = 1
            AND p.post_type = 'cgp'
            AND p.post_status = 'publish'
            AND latitude.meta_key = '_latitude'
            AND longitude.meta_key = '_longitude'
            HAVING distance < %s
            ORDER BY distance ASC",
            $earth_radius,
            $args['lat'],
            $args['lng'],
            $args['lat'],
            $args['distance'],
        );

        $nearbyLocations = $wpdb->get_results($sql);

        $results = false;

        if (!empty($nearbyLocations)) {
            $results = array();

            if($args['numberposts'] > 0) {
                $postsToFetch = array_slice($nearbyLocations, $args['offset'], $args['numberposts']);
            } else {
                $postsToFetch = $nearbyLocations;
            }

            foreach ($postsToFetch as $key => $post) {
                $results[] = get_post($post->ID);
                // Add distance to post object
                $results[$key]->distance = $post->distance;
            }
        }

        return $results;
    }
}
