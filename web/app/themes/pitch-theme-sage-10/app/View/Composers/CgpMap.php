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
        ];
    }

    public function getCgp()
    {
        $lat = "";
        $long = "";
        $distance = "";

        if (isset($_GET["lat"])) { $lat = $_GET["lat"]; }
        if (isset($_GET["long"])) { $long = $_GET["long"]; }
        if (isset($_GET["distance"])) { $distance = $_GET["distance"]; }

        if (empty($lat) OR empty($long) OR empty($distance)) {
            $posts = get_posts(array(
                'post_type' => 'cgp',
                'posts_per_page' => 4,
                'post_status' => 'publish',
            ));

            return $posts;
        }

        $cgp = new GeolocatorComponent();
        $posts = $cgp->get_posts_by_latlng($lat, $long, $distance, 10, 0);

        return $posts;
    }
}
