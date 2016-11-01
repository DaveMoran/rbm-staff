<?php

add_filter('template_include', 'include_template_function', 1);

function include_template_function( $template_path ) {
  if( get_post_type() == 'rbm_staff' ) {
    if( is_single() ) {
      // Checks to see if there is a file int he theme first
      // Otherwise serve the plugin default
      if ( $theme_file = locate_template( array ( 'single-rbm_staff.php' ) ) ) {
        $template_path = $theme_file;
      } else {
        $template_path = plugin_dir_path(__FILE__) . '/single-rbm_staff.php';
      }
    }
  }
  return $template_path;
}
