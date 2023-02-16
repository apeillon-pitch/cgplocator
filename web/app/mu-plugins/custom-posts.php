<?php // Register Custom Post Type
function custom_post_type_needs() {

  $labels = array(
    'name'                  => _x( 'Besoins', 'Post Type General Name', 'nortia' ),
    'singular_name'         => _x( 'Besoin', 'Post Type Singular Name', 'nortia' ),
    'menu_name'             => __( 'Besoins', 'nortia' ),
    'name_admin_bar'        => __( 'Besoins', 'nortia' ),
    'archives'              => __( 'Item Archives', 'nortia' ),
    'attributes'            => __( 'Item Attributes', 'nortia' ),
    'parent_item_colon'     => __( 'Parent Item:', 'nortia' ),
    'all_items'             => __( 'All Items', 'nortia' ),
    'add_new_item'          => __( 'Add New Item', 'nortia' ),
    'add_new'               => __( 'Add New', 'nortia' ),
    'new_item'              => __( 'New Item', 'nortia' ),
    'edit_item'             => __( 'Edit Item', 'nortia' ),
    'update_item'           => __( 'Update Item', 'nortia' ),
    'view_item'             => __( 'View Item', 'nortia' ),
    'view_items'            => __( 'View Items', 'nortia' ),
    'search_items'          => __( 'Search Item', 'nortia' ),
    'not_found'             => __( 'Not found', 'nortia' ),
    'not_found_in_trash'    => __( 'Not found in Trash', 'nortia' ),
    'featured_image'        => __( 'Featured Image', 'nortia' ),
    'set_featured_image'    => __( 'Set featured image', 'nortia' ),
    'remove_featured_image' => __( 'Remove featured image', 'nortia' ),
    'use_featured_image'    => __( 'Use as featured image', 'nortia' ),
    'insert_into_item'      => __( 'Insert into item', 'nortia' ),
    'uploaded_to_this_item' => __( 'Uploaded to this item', 'nortia' ),
    'items_list'            => __( 'Items list', 'nortia' ),
    'items_list_navigation' => __( 'Items list navigation', 'nortia' ),
    'filter_items_list'     => __( 'Filter items list', 'nortia' ),
  );
  $rewrite = array(
    'slug'                  => 'besoins',
    'with_front'            => true,
    'pages'                 => true,
    'feeds'                 => true,
  );
  $args = array(
    'label'                 => __( 'Besoins', 'nortia' ),
    'description'           => __( 'Post Type Description', 'nortia' ),
    'labels'                => $labels,
    'supports'              => array( 'title' ),
    'taxonomies'            => array( 'category', 'post_tag' ),
    'hierarchical'          => false,
    'public'                => true,
    'show_ui'               => true,
    'show_in_menu'          => true,
    'menu_position'         => 5,
    'show_in_admin_bar'     => true,
    'show_in_nav_menus'     => true,
    'can_export'            => true,
    'has_archive'           => false,
    'exclude_from_search'   => true,
    'publicly_queryable'    => true,
    'rewrite'               => $rewrite,
    'capability_type'       => 'page',
  );
  register_post_type( 'need', $args );

}
add_action( 'init', 'custom_post_type_needs', 0 );

function custom_post_type_case_studies() {

  $labels = array(
    'name'                  => _x( 'Analyses d’experts', 'Post Type General Name', 'nortia' ),
    'singular_name'         => _x( 'Analyse d’experts', 'Post Type Singular Name', 'nortia' ),
    'menu_name'             => __( 'Analyses d’experts', 'nortia' ),
    'name_admin_bar'        => __( 'Analyses d’experts', 'nortia' ),
    'archives'              => __( 'Item Archives', 'nortia' ),
    'attributes'            => __( 'Item Attributes', 'nortia' ),
    'parent_item_colon'     => __( 'Parent Item:', 'nortia' ),
    'all_items'             => __( 'All Items', 'nortia' ),
    'add_new_item'          => __( 'Add New Item', 'nortia' ),
    'add_new'               => __( 'Add New', 'nortia' ),
    'new_item'              => __( 'New Item', 'nortia' ),
    'edit_item'             => __( 'Edit Item', 'nortia' ),
    'update_item'           => __( 'Update Item', 'nortia' ),
    'view_item'             => __( 'View Item', 'nortia' ),
    'view_items'            => __( 'View Items', 'nortia' ),
    'search_items'          => __( 'Search Item', 'nortia' ),
    'not_found'             => __( 'Not found', 'nortia' ),
    'not_found_in_trash'    => __( 'Not found in Trash', 'nortia' ),
    'featured_image'        => __( 'Featured Image', 'nortia' ),
    'set_featured_image'    => __( 'Set featured image', 'nortia' ),
    'remove_featured_image' => __( 'Remove featured image', 'nortia' ),
    'use_featured_image'    => __( 'Use as featured image', 'nortia' ),
    'insert_into_item'      => __( 'Insert into item', 'nortia' ),
    'uploaded_to_this_item' => __( 'Uploaded to this item', 'nortia' ),
    'items_list'            => __( 'Items list', 'nortia' ),
    'items_list_navigation' => __( 'Items list navigation', 'nortia' ),
    'filter_items_list'     => __( 'Filter items list', 'nortia' ),
  );
  $rewrite = array(
    'slug'                  => 'analyses-experts',
    'with_front'            => true,
    'pages'                 => true,
    'feeds'                 => true,
  );
  $args = array(
    'label'                 => __( 'Analyses d’experts', 'nortia' ),
    'description'           => __( 'Post Type Description', 'nortia' ),
    'labels'                => $labels,
    'supports'              => array( 'title' ),
    'taxonomies'            => array( 'post_tag' ),
    'hierarchical'          => false,
    'public'                => true,
    'show_ui'               => true,
    'show_in_menu'          => true,
    'menu_position'         => 5,
    'show_in_admin_bar'     => true,
    'show_in_nav_menus'     => true,
    'can_export'            => true,
    'has_archive'           => true,
    'has_archive'           => 'expertises',
    'exclude_from_search'   => true,
    'publicly_queryable'    => true,
    'rewrite'               => $rewrite,
    'capability_type'       => 'page',
  );
  register_post_type( 'case_study', $args );

}
add_action( 'init', 'custom_post_type_case_studies', 0 );

function custom_post_type_products() {

  $labels = array(
    'name'                  => _x( 'Solutions', 'Post Type General Name', 'nortia' ),
    'singular_name'         => _x( 'Solution', 'Post Type Singular Name', 'nortia' ),
    'menu_name'             => __( 'Solutions', 'nortia' ),
    'name_admin_bar'        => __( 'Solutions', 'nortia' ),
    'archives'              => __( 'Item Archives', 'nortia' ),
    'attributes'            => __( 'Item Attributes', 'nortia' ),
    'parent_item_colon'     => __( 'Parent Item:', 'nortia' ),
    'all_items'             => __( 'All Items', 'nortia' ),
    'add_new_item'          => __( 'Add New Item', 'nortia' ),
    'add_new'               => __( 'Add New', 'nortia' ),
    'new_item'              => __( 'New Item', 'nortia' ),
    'edit_item'             => __( 'Edit Item', 'nortia' ),
    'update_item'           => __( 'Update Item', 'nortia' ),
    'view_item'             => __( 'View Item', 'nortia' ),
    'view_items'            => __( 'View Items', 'nortia' ),
    'search_items'          => __( 'Search Item', 'nortia' ),
    'not_found'             => __( 'Not found', 'nortia' ),
    'not_found_in_trash'    => __( 'Not found in Trash', 'nortia' ),
    'featured_image'        => __( 'Featured Image', 'nortia' ),
    'set_featured_image'    => __( 'Set featured image', 'nortia' ),
    'remove_featured_image' => __( 'Remove featured image', 'nortia' ),
    'use_featured_image'    => __( 'Use as featured image', 'nortia' ),
    'insert_into_item'      => __( 'Insert into item', 'nortia' ),
    'uploaded_to_this_item' => __( 'Uploaded to this item', 'nortia' ),
    'items_list'            => __( 'Items list', 'nortia' ),
    'items_list_navigation' => __( 'Items list navigation', 'nortia' ),
    'filter_items_list'     => __( 'Filter items list', 'nortia' ),
  );
  $rewrite = array(
    'slug'                  => 'solutions',
    'with_front'            => true,
    'pages'                 => true,
    'feeds'                 => true,
  );
  $args = array(
    'label'                 => __( 'Solutions', 'nortia' ),
    'description'           => __( 'Post Type Description', 'nortia' ),
    'labels'                => $labels,
    'supports'              => array( 'title' ),
    'taxonomies'            => array( 'category', 'post_tag' ),
    'hierarchical'          => false,
    'public'                => true,
    'show_ui'               => true,
    'show_in_menu'          => true,
    'menu_position'         => 5,
    'show_in_admin_bar'     => true,
    'show_in_nav_menus'     => true,
    'can_export'            => true,
    'has_archive'           => false,
    'exclude_from_search'   => true,
    'publicly_queryable'    => true,
    'rewrite'               => $rewrite,
    'capability_type'       => 'page',
  );
  register_post_type( 'product', $args );

}
add_action( 'init', 'custom_post_type_products', 0 );

function custom_post_type_cgp() {

  $labels = array(
    'name'                  => _x( 'CGP', 'Post Type General Name', 'nortia' ),
    'singular_name'         => _x( 'CGP', 'Post Type Singular Name', 'nortia' ),
    'menu_name'             => __( 'CGP', 'nortia' ),
    'name_admin_bar'        => __( 'CGP', 'nortia' ),
    'archives'              => __( 'Item Archives', 'nortia' ),
    'attributes'            => __( 'Item Attributes', 'nortia' ),
    'parent_item_colon'     => __( 'Parent Item:', 'nortia' ),
    'all_items'             => __( 'All Items', 'nortia' ),
    'add_new_item'          => __( 'Add New Item', 'nortia' ),
    'add_new'               => __( 'Add New', 'nortia' ),
    'new_item'              => __( 'New Item', 'nortia' ),
    'edit_item'             => __( 'Edit Item', 'nortia' ),
    'update_item'           => __( 'Update Item', 'nortia' ),
    'view_item'             => __( 'View Item', 'nortia' ),
    'view_items'            => __( 'View Items', 'nortia' ),
    'search_items'          => __( 'Search Item', 'nortia' ),
    'not_found'             => __( 'Not found', 'nortia' ),
    'not_found_in_trash'    => __( 'Not found in Trash', 'nortia' ),
    'featured_image'        => __( 'Featured Image', 'nortia' ),
    'set_featured_image'    => __( 'Set featured image', 'nortia' ),
    'remove_featured_image' => __( 'Remove featured image', 'nortia' ),
    'use_featured_image'    => __( 'Use as featured image', 'nortia' ),
    'insert_into_item'      => __( 'Insert into item', 'nortia' ),
    'uploaded_to_this_item' => __( 'Uploaded to this item', 'nortia' ),
    'items_list'            => __( 'Items list', 'nortia' ),
    'items_list_navigation' => __( 'Items list navigation', 'nortia' ),
    'filter_items_list'     => __( 'Filter items list', 'nortia' ),
  );
  $rewrite = array(
    'slug'                  => 'conseiller-gestion-patrimoine',
    'with_front'            => true,
    'pages'                 => true,
    'feeds'                 => true,
  );
  $args = array(
    'label'                 => __( 'CGP', 'nortia' ),
    'description'           => __( 'Post Type Description', 'nortia' ),
    'labels'                => $labels,
    'supports'              => array( 'title' ),
    'taxonomies'            => array( ),
    'hierarchical'          => false,
    'public'                => true,
    'show_ui'               => true,
    'show_in_menu'          => true,
    'menu_position'         => 5,
    'show_in_admin_bar'     => true,
    'show_in_nav_menus'     => true,
    'can_export'            => true,
    'has_archive'           => false,
    'exclude_from_search'   => true,
    'publicly_queryable'    => true,
    'rewrite'               => $rewrite,
    'capability_type'       => 'page',
  );
  register_post_type( 'cgp', $args );

}
add_action( 'init', 'custom_post_type_cgp', 0 );