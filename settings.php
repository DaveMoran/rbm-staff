<?php

add_action( 'admin_menu', 'rbm_staff_menu');

function rbm_staff_menu() {
  add_submenu_page(
    'edit.php?post_type=rbm_staff',
    'RBM Staff',
    'Settings',
    'edit_posts',
    basename(__FILE__),
    'rbm_staff_options'
  );
}

function rbm_staff_options() {
  if (!current_user_can('manage_options') ) {
    wp_die( __( 'You do not have sufficient permissions to access this page.') );
  }
  echo '<div class="wrap">';
  echo '<p>Here is where the form would go if I actually had options.</p>';
  echo '</div>';
}
