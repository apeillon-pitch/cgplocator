<?php
function getProducts()
{
  $paged = (get_query_var('paged')) ? absint(get_query_var('paged')) : 1;
  $args = array(
    'post_type' => 'product',
    'posts_per_page' => -1,
    'orderby' => 'date',
    'order' => 'DESC',
    'paged' => $paged,
  );

  $data = getPoductsContentList($args);

  return $data;
}

function getProductById($id)
{
  $paged = (get_query_var('paged')) ? absint(get_query_var('paged')) : 1;
  $args = array(
    'post_type' => 'product',
    'page_id' => $id,
    'posts_per_page' => 1,
    'paged' => $paged,
  );

  $data = getPoductsContentList($args);

  return $data;
}

function getPoductsContentList($args)
{
  $query = new WP_Query($args);
  if ($query->have_posts()) {
    $i = 0;
    while ($query->have_posts()) {
      $query->the_post();
      $id = get_the_ID();
      $permalink = get_the_permalink();
      $title = get_the_title();
      $thumbnail = get_field('thumbnail');
      $short_title =  get_field('short_title');
      $color = get_field('color');
      $logo_white = get_field('logo_white');
      $data[] = array(
        'query' => $query,
        'id' => $id,
        'permalink' => $permalink,
        'title' => $title,
        'short-title' => $short_title,
        'thumbnail' => $thumbnail,
        'color' => $color,
        'logo-white' => $logo_white,
        'pagination' => (get_query_var('paged')) ? get_query_var('paged') : 1,
      );
      $i++;
    }
    wp_reset_postdata();
    return $data;
  }
}
