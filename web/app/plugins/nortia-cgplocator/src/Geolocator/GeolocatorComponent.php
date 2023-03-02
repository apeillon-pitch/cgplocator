<?php

namespace NortiaCGPLocator\Geolocator;

class GeolocatorComponent
{
    public function __construct()
    {
    }

    public static function get_posts_by_latlng($args = [
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

        function get_post_ids($nearbyLocations)
        {
            $ids = array();
            foreach ($nearbyLocations as $key => $location) {
                $ids[] = $location->ID;
            }
            return $ids;
        }

        if (!empty($nearbyLocations)) {
            $results = get_posts(array(
                'post_type' => 'cgp',
                'include' => get_post_ids($nearbyLocations),
            ));

            foreach ($results as $key => $result) {
                $ids = array_column($nearbyLocations, 'ID');
                $result->distance = round($nearbyLocations[array_search($key, $ids)]->distance, 2);
                $result->meta = get_fields($result->ID);
            }
        }

        return $results;
    }
}
