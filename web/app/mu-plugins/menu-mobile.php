<?php
add_action('wp_ajax_nopriv_ajax_submenu_mobile', 'ajax_submenu_mobile');
add_action('wp_ajax_ajax_submenu_mobile', 'ajax_submenu_mobile');

function ajax_submenu_mobile()
{
  $parent = $_REQUEST["parent"];
  echo '<div id="menu-mobile-data">';
  echo '<div class="wrapper-title d-flex justify-content-between"><a href="#" class="reset"><i class="fa fa-angle-left"></i></a><span>' .  $parent . '</span><div></div></div>';
  if (has_nav_menu('primary_mobile_navigation')) :
    wp_nav_menu([
      'theme_location' => 'primary_mobile_navigation',
      'container_id' => 'navbarSupportedContent',
      'level' => 2,
      'child_of' => $parent,
      'container_class' => 'navbar-collapse navbar-mobile',
      'menu_class' => 'nav navbar-nav',
    ]);
  endif;
  echo "</div>";
  die();
}

add_action('wp_ajax_nopriv_ajax_submenu_mobile_reset', 'ajax_submenu_mobile_reset');
add_action('wp_ajax_ajax_submenu_mobile_reset', 'ajax_submenu_mobile_reset');

function ajax_submenu_mobile_reset()
{
  echo '<div id="menu-mobile-data">';
  if (has_nav_menu('primary_mobile_navigation')) :
    wp_nav_menu([
      'theme_location' => 'primary_mobile_navigation',
      'container_id' => 'navbarSupportedContent',
      'container_class' => 'navbar-collapse navbar-mobile',
      'menu_class' => 'nav navbar-nav',
      'level' => 1,
    ]);
  endif;
  echo "</div>";
  die();
}
