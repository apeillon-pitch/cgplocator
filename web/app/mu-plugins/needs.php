<?php
function getNeeds()
{
  $paged = (get_query_var('paged')) ? absint(get_query_var('paged')) : 1;
  $args = array(
    'post_type' => 'need',
    'posts_per_page' => -1,
    'orderby' => 'date',
    'order' => 'DESC',
    'paged' => $paged,
  );

  $data = getNeedsContentList($args);

  return $data;
}

function getNeedById($id)
{
  $paged = (get_query_var('paged')) ? absint(get_query_var('paged')) : 1;
  $args = array(
    'post_type' => 'need',
    'page_id' => $id,
    'posts_per_page' => 1,
    'paged' => $paged,
  );

  $data = getNeedsContentList($args);

  return $data;
}

function getNeedsContentList($args)
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
      $data[] = array(
        'query' => $query,
        'id' => $id,
        'permalink' => $permalink,
        'title' => $title,
        'short-title' => $short_title,
        'thumbnail' => $thumbnail,
        'pagination' => (get_query_var('paged')) ? get_query_var('paged') : 1,
      );
      $i++;
    }
    wp_reset_postdata();
    return $data;
  }
}
