<?php

namespace App\View\Composers;

use Roots\Acorn\View\Composer;
use NortiaCGPLocator\Geolocator\GeolocatorComponent;
use function get_posts;

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
            'json' => $this->jsonList(null),
        ];
    }

    public function getCgp()
    {
        if (!isset($_POST['lat']) or !isset($_POST['lng'])) {
            return get_posts(array(
                'post_type' => 'cgp',
                'posts_per_page' => 10,
                'post_status' => 'publish',
            ));
        }

        return (new GeolocatorComponent())->get_posts_by_latlng(array(
            'lat' => (float) $_POST["lat"],
            'lng' => (float) $_POST["lng"],
            'distance' => $_POST["distance"] ?? -1,
            'numberposts' => 10,
            'offset' => 0,
        ));
    }

    public function jsonList($posts)
    {
        $posts = $posts ?? $this->getCgp();

        $json = array();

        foreach ($posts as $post) {
            $json[] = array(
                'title' => $post->post_title,
                'lat' => $this->fuzz((float)get_post_meta($post->ID, '_latitude', true)),
                'lng' => $this->fuzz((float)get_post_meta($post->ID, '_longitude', true)),
                'address' => get_field('address', $post->ID, true)['address'],
                'email' => get_post_meta($post->ID, 'cgp_email', true),
                'link' => get_permalink($post->ID),
                'distance' => $post->distance,
                'tooltip' => "<div class=\"nortia-tooltip\">\n" . view('partials.template-parts.cards.cgp.card-cgp', array('post' => $post))->render() . "\n</div>",
            );
        }

        return $json;
    }

    /** Value fuzzer
     *  Fuzzes GPS coordinates to allow overlapping markers to be uniquely displayed
     *  @param $value float
     *  @return float
     */
    private function fuzz($value)
    {
        $offset = (mt_rand(-500, 500) / 10000000);
        return $value + $offset;
    }
}
