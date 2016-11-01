<?php
/*
 * This file holds the information for creating the RBM Staff custom post type
 */

add_action('init', 'create_rbm_staff');

register_deactivation_hook( __FILE__, 'flush_rewrite_rules' );
register_activation_hook(__FILE__, 'create_rbm_staff');

function create_rbm_staff() {
  register_post_type( 'rbm_staff',
    array(
      'labels' => array(
        'name' => 'RBM Staff',
        'singular_name' => 'RBM Staff',
        'add_new' => 'Add New',
        'add_new_item' => 'Add New Staff Member',
        'edit' => 'Edit',
        'edit_item' => 'Edit Staff Member',
        'new_item' => 'New Staff Member',
        'view' => 'View',
        'view_item' => 'View Staff Member',
        'search_items' => 'Search Staff Member',
        'not_found' => 'No Staff Members found',
        'not_found_in_trash' => 'No Staff Members found in Trash',
        'parent' => 'Parent Staff Member',
      ),
      'rewrite' => array(
        'slug' => 'staff',
        'with_front' => false
      ),
      'public' => true,
      'menu_position' => 15,
      'supports' => array(
        'title',
        'editor',
        'thumbnail',
        'custom-fields',
        'excerpt'
      ),
      'taxonomies' => array(''),
      'menu_icon' => 'dashicons-arrow-up-alt2',
      'has_archive' => true
    )
  );
  flush_rewrite_rules();
}
