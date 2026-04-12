<?php
function wpc_mime_types($mimes)
{
  $mimes['svg'] = 'image/svg+xml';
  return $mimes;
}

add_filter('upload_mimes', 'wpc_mime_types');

function wpc_boutons_tinymce($buttons)
{
  $buttons[] = 'superscript';
  $buttons[] = 'subscript';
  return $buttons;
}

/* Hover Module Effect */
function pagination_simple($query, $url)
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