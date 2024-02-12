<?php

use NortiaCGPLocator\Geolocator\GeolocatorComponent;

function my_acf_init()
{
  acf_update_setting('google_api_key', 'AIzaSyCcO_gEq7lWm1Sdu12YB2u2v3Mr-qKiz44');
}

add_action('acf/init', 'my_acf_init');

function ajax_script_load_more_cgp($args)
{
  $ajax = false;
  if (!empty($_SERVER['HTTP_X_REQUESTED_WITH']) &&
    strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest') {
    $ajax = true;
  }
  $num = 10;
  $paged = $_POST['page'] + 1;

  if (!isset($_POST['lat']) or !isset($_POST['lng'])) {
    $query = get_posts(array(
      'post_type' => 'cgp',
      'posts_per_page' => $num,
      'offset' => $num * $_POST['page'],
      'post_status' => 'publish',
    ));
  }

  $query = (new GeolocatorComponent())->get_posts_by_latlng(array(
    'lat' => (float) $_POST["lat"],
    'lng' => (float) $_POST["lng"],
    'distance' => $_POST["distance"] ?? -1,
    'numberposts' => $num,
    'offset' => $num * $_POST['page'],
  ));

  foreach ($query as $article) {
    $id = $article->ID;
    $permalink = get_permalink($article->ID);
    $title = $article->post_title;
    $address = get_field('address', $article->ID, true);
    $post = array(
      'id' => $id,
      'permalink' => $permalink,
      'title' => $title,
      'address' => $address,
      'pagination' => (get_query_var('paged')) ? get_query_var('paged') : 1,
    );
    print view('partials.template-parts.cards.cgp.card-cgp', ['post' => $post])->render();
  }
  if (isset($_POST['lat']) or isset($_POST['lng'])) {
    print view('partials.template-parts.cards.cgp.markers', ['posts' => (new \App\View\Composers\CgpMap)->jsonList($query)])->render();
  }
  if ($ajax) die();
}

add_action('wp_ajax_nopriv_ajax_script_load_more_cgp', 'ajax_script_load_more_cgp');
add_action('wp_ajax_ajax_script_load_more_cgp', 'ajax_script_load_more_cgp');

function getCgpData()
{
  $id = get_the_ID();
  $permalink = get_the_permalink();
  $title = get_the_title();
  $address = get_field('address');
  $article = array(
    'id' => $id,
    'permalink' => $permalink,
    'title' => $title,
    'address' => $address,
    'pagination' => (get_query_var('paged')) ? get_query_var('paged') : 1,
  );

  return $article;
}