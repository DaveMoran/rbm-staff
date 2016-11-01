<?php
/*
 * This file contains the functions for the following custom meta
 * * Title
 * * Expertise
 * * Second Thumbnail
 */

add_action('admin_init', 'rbm_admin');

function rbm_admin() {
  add_meta_box( 'staff_title_meta_box',
    'Staff Title',
    'display_staff_title_meta_box',
    'rbm_staff',
    'normal',
    'high'
  );
}

function display_staff_title_meta_box( $rbm_staff ) {
  //Get the current title based on the staff ID
  $staff_title = esc_html(get_post_meta( $rbm_staff->ID, 'rbm_staff_title', true));
  ?>
  <table>
    <tbody>
      <tr>
        <td>Title:</td>
        <td><input type="text" placeholder="Example: Marketing Director" value="<?php echo $staff_title; ?>" name="rbm_staff_title"></td>
      </tr>
    </tbody>
  </table>
<?php }

add_action('save_post', 'add_staff_title', 10, 2);
function add_staff_title($staff_id, $rbm_staff) {
  if($rbm_staff->post_type == 'rbm_staff') {
    if( isset( $_POST['rbm_staff_title'] ) && $_POST['rbm_staff_title'] != '' ) {
      update_post_meta($staff_id, 'rbm_staff_title', $_POST['rbm_staff_title']);
    }
  }
}
