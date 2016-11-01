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
  $staff_facebook = esc_html(get_post_meta( $rbm_staff->ID, 'rbm_facebook', true));
  $staff_twitter = esc_html(get_post_meta( $rbm_staff->ID, 'rbm_twitter', true));
  $staff_email = esc_html(get_post_meta( $rbm_staff->ID, 'rbm_email', true));
  $staff_linkedin = esc_html(get_post_meta( $rbm_staff->ID, 'rbm_linkedin', true));
  $staff_skills = esc_html(get_post_meta( $rbm_staff->ID, 'rbm_skillset', true));
  $skills_array = explode(',', $staff_skills);
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
        <td>Expertise</td>
        <td>
          <input type="checkbox" name="rbm_skillset[]" value="mkt-plan" <?php if (in_array('mkt-plan', $skills_array)) { echo "checked";} ?>>Marketing Planning &amp; Tactics<br>
          <input type="checkbox" name="rbm_skillset[]" value="branding" <?php if (in_array('branding', $skills_array)) { echo "checked";} ?>>Branding &amp; Logo Design<br>
          <input type="checkbox" name="rbm_skillset[]" value="web-dev" <?php if (in_array('web-dev', $skills_array)) { echo "checked";} ?>>Website Design &amp; Development<br>
          <input type="checkbox" name="rbm_skillset[]" value="sem" <?php if (in_array('sem', $skills_array)) { echo "checked";} ?>>Search Engine Marketing<br>
          <input type="checkbox" name="rbm_skillset[]" value="photo-video" <?php if (in_array('photo-video', $skills_array)) { echo "checked";} ?>>Photography &amp; Video Production<br>
          <input type="checkbox" name="rbm_skillset[]" value="social" <?php if (in_array('social', $skills_array)) { echo "checked";} ?>>Social Media &amp; Reputation Management<br>
          <input type="checkbox" name="rbm_skillset[]" value="copy" <?php if (in_array('copy', $skills_array)) { echo "checked";} ?>>Copywriting &amp; Content Development<br>
          <input type="checkbox" name="rbm_skillset[]" value="print" <?php if (in_array('print', $skills_array)) { echo "checked";} ?>>Print Design<br>
          <input type="checkbox" name="rbm_skillset[]" value="ads" <?php if (in_array('ads', $skills_array)) { echo "checked";} ?>>Media Buying &amp; Local Advertising<br>
        </td>
      </tr>
      <tr>
        <td colspan="2"><hr></td>
      </tr>
      <tr>
        <td>Facebook</td>
        <td><input type="text" placeholder="www.facebook.com" name="rbm_facebook" value="<?php echo $staff_facebook; ?>"></td>
      </tr>
      <tr>
        <td>Twitter</td>
        <td><input type="text" placeholder="www.twitter.com" name="rbm_twitter" value="<?php echo $staff_twitter; ?>"></td>
      </tr>
      <tr>
        <td>Email</td>
        <td><input type="text" placeholder="name@email.com" name="rbm_email" value="<?php echo $staff_email; ?>"></td>
      </tr>
      <tr>
        <td>LinkedIn</td>
        <td><input type="text" placeholder="www.linkedin.com" name="rbm_linkedin" value="<?php echo $staff_linkedin; ?>"></td>
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
    // Save Title
    if( isset( $_POST['rbm_staff_title'] ) && $_POST['rbm_staff_title'] != '' ) {
      update_post_meta($staff_id, 'rbm_staff_title', $_POST['rbm_staff_title']);
    }
    // Save Secondary Image
    if( isset( $_POST['rbm_staff_img'] ) && $_POST['rbm_staff_img'] != '') {
      update_post_meta($staff_id, 'rbm_secondary_img', $_POST['rbm_staff_img']);
    }
    // Save Fun Fact
    if( isset( $_POST['rbm_staff_fact'] ) && $_POST['rbm_staff_fact'] != '' ) {
      update_post_meta($staff_id, 'rbm_staff_fact', $_POST['rbm_staff_fact']);
    }
    //Save Fun Fact Image
    if( isset( $_POST['rbm_fun_img'] ) && $_POST['rbm_fun_img'] != '') {
      update_post_meta($staff_id, 'rbm_fun_img', $_POST['rbm_fun_img']);
    }
    //Save Facebook
    if( isset( $_POST['rbm_facebook'] ) && $_POST['rbm_facebook'] != '') {
      update_post_meta($staff_id, 'rbm_facebook', $_POST['rbm_facebook']);
    }
    //Save Twitter
    if( isset( $_POST['rbm_twitter'] ) && $_POST['rbm_twitter'] != '') {
      update_post_meta($staff_id, 'rbm_twitter', $_POST['rbm_twitter']);
    }
    //Save Email
    if( isset( $_POST['rbm_email'] ) && $_POST['rbm_email'] != '') {
      update_post_meta($staff_id, 'rbm_email', $_POST['rbm_email']);
    }
    //Save Linkedin
    if( isset( $_POST['rbm_linkedin'] ) && $_POST['rbm_linkedin'] != '') {
      update_post_meta($staff_id, 'rbm_linkedin', $_POST['rbm_linkedin']);
    }
    //Save Skills array
    $skills = $_POST['rbm_skillset'];
    if(!empty($skills)){
      $skill_string = implode(',', $skills);
      update_post_meta($staff_id, 'rbm_skillset', $skill_string);
    }
  }
}
