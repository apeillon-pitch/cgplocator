<?php // Register Custom Taxonomy
function custom_taxonomy_study_case_category() {

  $labels = array(
    'name'                       => _x( 'Catégories', 'Taxonomy General Name', 'nortia' ),
    'singular_name'              => _x( 'Catégorie', 'Taxonomy Singular Name', 'nortia' ),
    'menu_name'                  => __( 'Catégories', 'nortia' ),
    'all_items'                  => __( 'All Items', 'nortia' ),
    'parent_item'                => __( 'Parent Item', 'nortia' ),
    'parent_item_colon'          => __( 'Parent Item:', 'nortia' ),
    'new_item_name'              => __( 'New Item Name', 'nortia' ),
    'add_new_item'               => __( 'Add New Item', 'nortia' ),
    'edit_item'                  => __( 'Edit Item', 'nortia' ),
    'update_item'                => __( 'Update Item', 'nortia' ),
    'view_item'                  => __( 'View Item', 'nortia' ),
    'separate_items_with_commas' => __( 'Separate items with commas', 'nortia' ),
    'add_or_remove_items'        => __( 'Add or remove items', 'nortia' ),
    'choose_from_most_used'      => __( 'Choose from the most used', 'nortia' ),
    'popular_items'              => __( 'Popular Items', 'nortia' ),
    'search_items'               => __( 'Search Items', 'nortia' ),
    'not_found'                  => __( 'Not Found', 'nortia' ),
    'no_terms'                   => __( 'No items', 'nortia' ),
    'items_list'                 => __( 'Items list', 'nortia' ),
    'items_list_navigation'      => __( 'Items list navigation', 'nortia' ),
  );
  $args = array(
    'labels'                     => $labels,
    'hierarchical'               => false,
    'public'                     => true,
    'show_ui'                    => true,
    'show_admin_column'          => true,
    'show_in_nav_menus'          => true,
    'show_tagcloud'              => true,
  );
  register_taxonomy( 'study-case-category', array( 'case_study' ), $args );

}
add_action( 'init', 'custom_taxonomy_study_case_category', 0 );

function custom_taxonomy_study_case_type() {

  $labels = array(
    'name'                       => _x( 'Types', 'Taxonomy General Name', 'nortia' ),
    'singular_name'              => _x( 'Type', 'Taxonomy Singular Name', 'nortia' ),
    'menu_name'                  => __( 'Types', 'nortia' ),
    'all_items'                  => __( 'All Items', 'nortia' ),
    'parent_item'                => __( 'Parent Item', 'nortia' ),
    'parent_item_colon'          => __( 'Parent Item:', 'nortia' ),
    'new_item_name'              => __( 'New Item Name', 'nortia' ),
    'add_new_item'               => __( 'Add New Item', 'nortia' ),
    'edit_item'                  => __( 'Edit Item', 'nortia' ),
    'update_item'                => __( 'Update Item', 'nortia' ),
    'view_item'                  => __( 'View Item', 'nortia' ),
    'separate_items_with_commas' => __( 'Separate items with commas', 'nortia' ),
    'add_or_remove_items'        => __( 'Add or remove items', 'nortia' ),
    'choose_from_most_used'      => __( 'Choose from the most used', 'nortia' ),
    'popular_items'              => __( 'Popular Items', 'nortia' ),
    'search_items'               => __( 'Search Items', 'nortia' ),
    'not_found'                  => __( 'Not Found', 'nortia' ),
    'no_terms'                   => __( 'No items', 'nortia' ),
    'items_list'                 => __( 'Items list', 'nortia' ),
    'items_list_navigation'      => __( 'Items list navigation', 'nortia' ),
  );
  $args = array(
    'labels'                     => $labels,
    'hierarchical'               => false,
    'public'                     => true,
    'show_ui'                    => true,
    'show_admin_column'          => true,
    'show_in_nav_menus'          => true,
    'show_tagcloud'              => true,
  );
  register_taxonomy( 'study-case-type', array( 'case_study' ), $args );

}
add_action( 'init', 'custom_taxonomy_study_case_type', 0 );