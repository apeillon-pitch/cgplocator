<?php
function getCaseStudies()
{
  $paged = (get_query_var('paged')) ? absint(get_query_var('paged')) : 1;
  $args = array(
    'post_type' => 'case_study',
    'posts_per_page' => -1,
    'orderby' => 'date',
    'order' => 'DESC',
    'paged' => $paged,
  );

  $data = getCaseStudyContentList($args);

  return $data;
}

function getCaseStudiesBlogList()
{
  if (isset($_COOKIE["study-case-category"][0])) {
    $category = json_decode(stripslashes($_COOKIE["study-case-category"]));
    if ($category == 'all') {
      $category = [];
      $terms = get_terms(array(
        'taxonomy' => 'study-case-category',
        'hide_empty' => false,
      ));
      foreach ($terms as $term) {
        $category[] = $term->term_id;
      }
    }
  } else {
    $category = [];
    $terms = get_terms(array(
      'taxonomy' => 'study-case-category',
      'hide_empty' => false,
    ));
    foreach ($terms as $term) {
      $category[] = $term->term_id;
    }
  }

  if (isset($_COOKIE["study-case-month"][0])) {
    $month = json_decode(stripslashes($_COOKIE["study-case-month"]));
    if ($month === 'all') {
      $month = null;
    }
  } else {
    $month = null;
  }

  if (isset($_COOKIE["study-case-year"][0])) {
    $year = json_decode(stripslashes($_COOKIE["study-case-year"]));
    if ($year === 'all') {
      $year = null;
    }
  } else {
    $year = null;
  }

  $paged = (get_query_var('paged')) ? absint(get_query_var('paged')) : 1;
  $args = array(
    'post_type' => 'case_study',
    'orderby' => 'date',
    'order' => 'DESC',
    'date_query' => array(
      array(
        'year' => $year,
        'month' => $month,
      ),
    ),
    'posts_per_page' => 11,
    'tax_query' => array(
      array(
        'taxonomy' => 'study-case-category',
        'field' => 'term_id',
        'terms' => $category,
      ),
    ),
    'paged' => get_query_var('paged'),
  );

  $data = getCaseStudyContentList($args);

  return $data;
}

function getCaseStudiesByCategory($post_per_page, $category, $id)
{
  $paged = (get_query_var('paged')) ? absint(get_query_var('paged')) : 1;
  $args = array(
    'post_type' => 'case_study',
    'post__not_in' => array($id),
    'posts_per_page' => $post_per_page,
    'paged' => $paged,
    'tax_query' => array(
      array(
        'taxonomy' => 'study-case-category',
        'field' => 'slug',
        'terms' => $category->slug,
      ),
    ),
  );

  $data = getCaseStudyContentList($args);

  return $data;
}


function getCaseStudyById($id)
{
  $paged = (get_query_var('paged')) ? absint(get_query_var('paged')) : 1;
  $args = array(
    'post_type' => 'case_study',
    'page_id' => $id,
    'posts_per_page' => 1,
    'paged' => $paged,
  );

  $data = getCaseStudyContentList($args);

  return $data;
}

function getCaseStudyContentList($args)
{
  $query = new WP_Query($args);
  if ($query->have_posts()) {
    $i = 0;
    while ($query->have_posts()) {
      $query->the_post();
      $id = get_the_ID();
      $post_type = 'case_study';
      $permalink = get_the_permalink();
      $title = get_the_title();
      $date = get_the_date();
      $category = get_field('category');
      $type = get_field('type');
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
        'type' => $type,
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

add_action('wp_ajax_nopriv_ajax_case_studies_load', 'ajax_case_studies_load');
add_action('wp_ajax_ajax_case_studies_load', 'ajax_case_studies_load');

// Fonction liée à aux filtres ajax
function ajax_case_studies_load()
{
  $url = $_POST["pageurl"];
  $category = $_POST["category"];
  $month = $_POST["month"];
  $year = $_POST["year"];

  if ($category === 'all') {
    $category = [];
    $terms = get_terms(array(
      'taxonomy' => 'study-case-category',
      'hide_empty' => false,
    ));
    foreach ($terms as $term) {
      $category[] = $term->term_id;
    }
  }

  if ($month === 'all') {
    $month = null;
  }

  if ($year === 'all') {
    $year = null;
  }

  $args = array(
    'post_type' => 'case_study',
    'orderby' => 'date',
    'order' => 'DESC',
    'date_query' => array(
      array(
        'year' => $year,
        'month' => $month,
      ),
    ),
    'tax_query' => array(
      array(
        'taxonomy' => 'study-case-category',
        'field' => 'term_id',
        'terms' => $category,
      ),
    ),
    'posts_per_page' => 11,
    'paged' => get_query_var('paged'),
  );
  $query = new WP_Query($args);
  $options_data['blog'] = get_field('blog_group', 'options');
  echo '<div id="results" class="row">';
  if ($query->have_posts()) {
    $index = 0;
    while ($query->have_posts()) {
      $query->the_post();
      $article[$index] = getCaseStudyData($query);
      if ($index == 0) {
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
      } elseif ($index > 4) {
        echo '<div class="col-12 col-md-6 col-lg-4 mb-4">';
        $article = $article[$index][0];
        include(locate_template('resources/views/partials/template-parts/cards/article-php/style-one.php', '', '',   ['article' => $article]));
        echo '</div>';
      }

      $index++;
    }
  } else {
    echo '<p>Aucun contenu ne correspond à votre recherche</p>';
    echo '<input id="pagination" hidden value="' . $article[$index]['pagination'] . '">';
  }

  echo '<div class="col-12 mt-5"><div class="d-flex flex-row justify-content-center align-items-center">';
  echo '<span class="mb-4">' . $query->found_posts . ' articles disponibles</span>';
  pagination_case_study_simple($query, $url);
  echo '</div></div>';
  wp_die();
}

function getCaseStudyData($query)
{
  $id = get_the_ID();
  $post_type = 'case-study';
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

add_action('wp_ajax_nopriv_ajax_case_studies_title_load', 'ajax_case_studies_title_load');
add_action('wp_ajax_ajax_case_studies_title_load', 'ajax_case_studies_title_load');

// Fonction liée à aux filtres ajax
function ajax_case_studies_title_load()
{
  $category = $_POST["category"];

  if ($category === 'all') {
    $category_name = 'Les dernières actualités';
  } else {
    $term = get_term_by('id', $category, 'study-case-category');
    $category_name = $term->name;
  }

  echo ' <strong id="title" class="mb-4 mb-lg-0">' . $category_name . '</strong>';
  wp_die();
}

function pagination_case_study_simple($query, $url)
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

