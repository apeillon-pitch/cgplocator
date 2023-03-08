<?php
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
  $num = 4;
  $paged = $_POST['page'] + 1;
  $args = array(
    'post_type' => 'cgp',
    'post_status' => 'publish',
    'posts_per_page' => $num,
    'paged' => $paged
  );
  $query = new WP_Query($args);
  if ($query->have_posts()):
    while ($query->have_posts()):
      $query->the_post();
      $article = getCgpData();
      include(locate_template('resources/views/partials/template-parts/cards/cgp/card-cgp.php', '', '', ['article' => $article]));
    endwhile;
  else:
    echo 0;
  endif;
  wp_reset_postdata();
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