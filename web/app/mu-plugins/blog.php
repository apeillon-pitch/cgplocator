<?php
/*function add_rewrite_rules( $wp_rewrite )
{
  $new_rules = array(
    'actualites-nortia/(.+?)/?$' => 'index.php?post_type=post&name='. $wp_rewrite->preg_index(1),
  );

  $wp_rewrite->rules = $new_rules + $wp_rewrite->rules;
}
add_action('generate_rewrite_rules', 'add_rewrite_rules');

function change_blog_links($post_link, $id=0){

  $post = get_post($id);

  if( is_object($post) && $post->post_type == 'post'){
    return home_url('/actualites-nortia/'. $post->post_name.'/');
  }

  return $post_link;
}
add_filter('post_link', 'change_blog_links', 1, 3);*/

use function Roots\view;

function getNews($post_per_page)
{
  $paged = (get_query_var('paged')) ? absint(get_query_var('paged')) : 1;
  $args = array(
    'post_type' => 'post',
    'posts_per_page' => $post_per_page,
    'orderby' => 'date',
    'order' => 'DESC',
    'paged' => $paged,
  );

  $data = getPostContentList($args);

  return $data;
}

function getNewsBlogList()
{
  if (isset($_COOKIE["category"][0] )) {
    $category = json_decode(stripslashes($_COOKIE["category"]));
    if ($category == 'all') {
      $category = null;
    }
  } else {
    $category = null;
  }

  if (isset($_COOKIE["month"][0] )) {
    $month = json_decode(stripslashes($_COOKIE["month"]));
    if ($month === 'all') {
      $month = null;
    }
  } else {
    $month = null;
  }

  if (isset($_COOKIE["year"][0] )) {
    $year = json_decode(stripslashes($_COOKIE["year"]));
    if ($year === 'all') {
      $year = null;
    }
  } else {
    $year = null;
  }

  $paged = (get_query_var('paged')) ? absint(get_query_var('paged')) : 1;
  $args = array(
    'post_type' => 'post',
    'category__in' => $category,
    'orderby' => 'date',
    'order' => 'DESC',
    'date_query' => array(
      array(
        'year' => $year,
        'month' => $month,
      ),
    ),
    'posts_per_page' => 11,
    'paged' => get_query_var('paged'),
  );

  $data = getPostContentList($args);

  return $data;
}

function getNewsById($id)
{
  $paged = (get_query_var('paged')) ? absint(get_query_var('paged')) : 1;
  $args = array(
    'post_type' => 'post',
    'page_id' => $id,
    'posts_per_page' => 1,
    'paged' => $paged,
  );

  $data = getPostContentList($args);

  return $data;
}

function getNewsByCategory($post_per_page, $category)
{
  $paged = (get_query_var('paged')) ? absint(get_query_var('paged')) : 1;
  $args = array(
    'post_type' => 'post',
    'cat' => $category->term_id,
    'posts_per_page' => $post_per_page,
    'paged' => $paged,
  );

  $data = getPostContentList($args);

  return $data;
}

function getNewsRelated($post_per_page, $category, $id)
{
  $paged = (get_query_var('paged')) ? absint(get_query_var('paged')) : 1;
  $args = array(
    'post_type' => 'post',
    'cat' => $category->term_id,
    'post__not_in' => array($id),
    'posts_per_page' => $post_per_page,
    'paged' => $paged,
  );

  $data = getPostContentList($args);

  return $data;
}

function getPostContentList($args)
{
  $query = new WP_Query($args);
  if ($query->have_posts()) {
    $i = 0;
    while ($query->have_posts()) {
      $query->the_post();
      $id = get_the_ID();
      $post_type = 'post';
      $permalink = get_the_permalink();
      $title = get_the_title();
      $date = get_the_date();
      $category = get_field('category');
      $thumbnail = get_field('thumbnail');
      $excerpt = get_field('excerpt');
      $data[] = array(
        'query' => $query,
        'id' => $id,
        'post-type' => $post_type,
        'permalink' => $permalink,
        'title' => $title,
        'date' => $date,
        'category' => $category,
        'thumbnail' => $thumbnail,
        'excerpt' => $excerpt,
        'pagination' => (get_query_var('paged')) ? get_query_var('paged') : 1,
      );
      $i++;
    }
    wp_reset_postdata();
    return $data;
  }
}


add_action('wp_ajax_nopriv_ajax_posts_load', 'ajax_posts_load');
add_action('wp_ajax_ajax_posts_load', 'ajax_posts_load');

// Fonction liée à aux filtres ajax
function ajax_posts_load()
{
  $url = $_POST["pageurl"];
  $category = $_POST["category"];
  $month = $_POST["month"];
  $year = $_POST["year"];

  if ($category === 'all') {
    $category = null;
  }

  if ($month === 'all') {
    $month = null;
  }

  if ($year === 'all') {
    $year = null;
  }

  $args = array(
    'post_type' => 'post',
    'category__in' => $category,
    'orderby' => 'date',
    'order' => 'DESC',
    'date_query' => array(
      array(
        'year' => $year,
        'month' => $month,
      ),
    ),
    'posts_per_page' => 11,
    'paged' => get_query_var('paged'),
  );
  $query = new WP_Query($args);
  $options_data['blog'] =  get_field('blog_group', 'options');
  echo '<div id="results" class="row justify-content-center justify-content-md-start">';
  if ($query->have_posts()) {
    $index = 0;
    while ($query->have_posts()) {
      $query->the_post();
      $article[$index] = getBlogData($query);
      if($index == 0) {
        $article = $article[$index][0];
        echo '<div class="d-none d-lg-block col-lg-12 mb-4">';
        include(locate_template('resources/views/partials/template-parts/cards/article-php/style-two.php', '' , '', ['article' => $article, 'options_data' => $options_data['blog'] ]));
        echo '</div>';
        echo '<div class="col-12 d-lg-none mb-4">';
        include(locate_template('resources/views/partials/template-parts/cards/article-php/style-one.php', '', '',  ['article' => $article, 'options_data' => $options_data['blog'] ]));
        echo '</div>';
      } elseif ($index >= 1 && $index <= 4) {
        echo '<div class="col-12 col-md-6 mb-4">';
        $article = $article[$index][0];
        include(locate_template('resources/views/partials/template-parts/cards/article-php/style-one.php', '', '',   ['article' => $article]));
        echo '</div>';
      } elseif($index > 4) {
        echo '<div class="col-12 col-md-6 col-lg-4 mb-4">';
        $article = $article[$index][0];
        include(locate_template('resources/views/partials/template-parts/cards/article-php/style-one.php', '', '',   ['article' => $article]));
        echo '</div>';
      }

      $index++;
    }
  } else {
    echo '<p>Aucun contenu ne correspond à votre recherche</p>';
  }

  echo '<div class="col-12 mt-5"><div class="d-flex flex-column justify-content-center align-items-center">';
  echo '<span class="mb-4">' . $query->found_posts . ' articles disponibles</span>';
  pagination_simple($query, $url);
  echo '</div></div>';
  wp_die();
}

add_action('wp_ajax_nopriv_ajax_posts_title_load', 'ajax_posts_title_load');
add_action('wp_ajax_ajax_posts_title_load', 'ajax_posts_title_load');

// Fonction liée à aux filtres ajax
function ajax_posts_title_load()
{
  $category = $_POST["category"];

  if ($category === 'all') {
    $category_name = 'Les dernières actualités';
  } else {
    $term = get_term_by('id', $category, 'category');
    $category_name = $term->name;
  }

  echo ' <strong id="title" class="mb-4 mb-lg-0">' . $category_name . '</strong>';
  wp_die();
}

function getBlogData($query)
{
  $id = get_the_ID();
  $post_type = 'post';
  $permalink = get_the_permalink();
  $title = get_the_title();
  $date = get_the_date();
  $category = get_field('category');
  $thumbnail = get_field('thumbnail');
  $excerpt = get_field('excerpt');
  $article[] = array(
    'query' => $query,
    'id' => $id,
    'post-type' => $post_type,
    'permalink' => $permalink,
    'title' => $title,
    'date' => $date,
    'category' => $category,
    'thumbnail' => $thumbnail,
    'excerpt' => $excerpt,
    'pagination' => (get_query_var('paged')) ? get_query_var('paged') : 1,
  );

  return $article;
}

function pagination_blog_simple($query, $url)
{
  $total_pages = $query->max_num_pages;
  if ($total_pages > 1) {
    $base = trailingslashit($url) . "page/%#%/";
    $big = 999999999; // need an unlikely integer
    $current_page = max(1, get_query_var('paged'));
    echo '<nav class="pagination"><div class="nav-links">';
    echo paginate_links(array(
      'base' => $base,
      'format' => '?paged=%#%',
      'current' => $current_page,
      'total' => $total_pages,
      'prev_text' => __('&lt;'),
      'next_text' => __('&gt;'),
    ));
    echo '</div></nav>';
  }
}