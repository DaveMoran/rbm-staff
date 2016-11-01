<?php
/*
 * This file contains the functions for the following custom meta
 * * Title
 * * Expertise
 * * Second Thumbnail
 */

add_action('admin_init', 'rbm_admin');

function rbm_admin() {
  add_meta_box( 'staff_info_meta_box',
    'Staff Info',
    'display_staff_info_meta_box',
    'rbm_staff',
    'normal',
    'high'
  );
}

function display_staff_info_meta_box( $rbm_staff ) {
  //Get the current title based on the staff ID
  $staff_title = esc_html(get_post_meta( $rbm_staff->ID, 'rbm_staff_title', true));
  $staff_fact = esc_html(get_post_meta( $rbm_staff->ID, 'rbm_staff_fact', true));
  $staff_thumbnail_src = esc_html(get_post_meta( $rbm_staff->ID, 'rbm_secondary_img', true));
  $staff_thumbnail_fun_src = esc_html(get_post_meta( $rbm_staff->ID, 'rbm_fun_img', true));
  ?>
  <table id="rbm_metabox" style="width: 100%">
    <tbody>
      <tr>
        <td>Title: </td>
        <td><input type="text" placeholder="Title" value="<?php echo $staff_title; ?>" name="rbm_staff_title"></td>
      </tr>
      <tr>
        <td>Secondary Image: </td>
        <td>
          <div class="uploader">
          	<input id="rbm_staff_img" name="rbm_staff_img" type="text" value="<?php echo $staff_thumbnail_src; ?>" />
          	<input id="rbm_staff_img_button" class="button" name="rbm_staff_img_button" type="text" value="Upload" />
          </div>
        </td>
      </tr>
      <tr>
        <td colspan="2"><hr></td>
      </tr>
      <tr>
        <td>Fun Fact: </td>
        <td><input type="text" placeholder="Fun Fact" value="<?php echo $staff_fact; ?>" name="rbm_staff_fact"></td>
      </tr>
      <tr>
        <td>Fun Photo: </td>
        <td>
          <div class="uploader">
          	<input id="rbm_fun_img" name="rbm_fun_img" type="text" value="<?php echo $staff_thumbnail_fun_src; ?>" />
          	<input id="rbm_fun_img_button" class="button" name="rbm_fun_img_button" type="text" value="Upload" />
          </div>
        </td>
      </tr>
      <tr>
        <td colspan="2"><hr></td>
      </tr>
      <tr>
        <td>Facebook</td>
        <td><input type="text" placeholder="www.facebook.com"></td>
      </tr>
      <tr>
        <td>Twitter</td>
        <td><input type="text" placeholder="www.twitter.com"></td>
      </tr>
      <tr>
        <td>Email</td>
        <td><input type="text" placeholder="name@email.com"></td>
      </tr>
      <tr>
        <td>LinkedIn</td>
        <td><input type="text" placeholder="www.linkedin.com"></td>
      </tr>
    </tbody>
  </table>

  <script>
  // Script to run for the media uploader
  jQuery(document).ready(function($) {
    var custom_media = true,
    orig_send_attachment = wp.media.editor.send.attachment;

    $('#rbm_metabox .button').click(function(e) {
      var send_attachment_bkp = wp.media.editor.send.attachment;
      var button = $(this);
      var id = button.attr('id').replace('_button', '');
      custom_media = true;

      wp.media.editor.send.attachment = function(props, attachment) {
        if(custom_media) {
          $("#" + id).val(attachment.url);
        } else {
          return orig_send_attachment.apply( this, [props, attachment] );
        }
      }

      wp.media.editor.open(button);
      return false
    });

    $('.add_media').on('click', function() {
      custom_media = false;
    });
  });
  </script>
<?php }

add_action('save_post', 'add_staff_title', 10, 2);
function add_staff_title($staff_id, $rbm_staff) {
  if($rbm_staff->post_type == 'rbm_staff') {
    if( isset( $_POST['rbm_staff_title'] ) && $_POST['rbm_staff_title'] != '' ) {
      update_post_meta($staff_id, 'rbm_staff_title', $_POST['rbm_staff_title']);
    }
    if( isset( $_POST['rbm_staff_img'] ) && $_POST['rbm_staff_img'] != '') {
      update_post_meta($staff_id, 'rbm_secondary_img', $_POST['rbm_staff_img']);
    }
    if( isset( $_POST['rbm_staff_fact'] ) && $_POST['rbm_staff_fact'] != '' ) {
      update_post_meta($staff_id, 'rbm_staff_fact', $_POST['rbm_staff_fact']);
    }
    if( isset( $_POST['rbm_fun_img'] ) && $_POST['rbm_fun_img'] != '') {
      update_post_meta($staff_id, 'rbm_fun_img', $_POST['rbm_fun_img']);
    }
  }
}
