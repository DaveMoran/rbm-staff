<?php
/*
 Plugin Name: RBM Staff
 Plugin URI: http://reachbeyondmarketing.com
 Description: A plugin to display the Reach Beyond Marketing staff in an easier manner
 Version: 0.1
 Author: Dave M
 Author URI: https://dmoran.co
 License: GPL2
 */

add_action('init', 'create_rbm_staff');

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
        'parent' => 'Parent Staff Member'
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
}
