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
  //must check that the user has the required capability
  if (!current_user_can('manage_options')) {
    wp_die( __('You do not have sufficient permissions to access this page.') );
  }

  // variables for the field and option names
  $skills = (object) [];
  $hidden_field_name = 'mt_submit_hidden';
  $data_field_name = 'mt_favorite_color';

    // Read in existing option value from database
    $opt_val = get_option( $skills );

    // See if the user has posted us some information
    // If they did, this hidden field will be set to 'Y'
    if( isset($_POST[ $hidden_field_name ]) && $_POST[ $hidden_field_name ] == 'Y' ) {
    // Read their posted value
        $opt_val = $_POST[ $data_field_name ];

        // Save the posted value in the database
        update_option( $opt_name, $opt_val );

        // Put a "settings saved" message on the screen

?>
    <div class="updated"><p><strong><?php _e('settings saved.', 'menu-test' ); ?></strong></p></div>
    <?php }
    echo '<div class="wrap">';
    // header
    echo "<h2>" . __( 'Menu Test Plugin Settings', 'menu-test' ) . "</h2>";
    ?>

    <form name="form1" method="post" action="">
      <input type="hidden" name="<?php echo $hidden_field_name; ?>" value="Y">
      <table class="form-table">
        <tbody>
          <tr>
            <th scope="row">
              <label>Available Skills</label>
            </th>
            <td>
              <a href="#" class="button">Add New Skill</a>
            </td>
          </tr>
        </tbody>
      </table>
      <hr />

      <p class="submit">
        <input type="submit" name="Submit" class="button-primary" value="<?php esc_attr_e('Save Changes') ?>" />
      </p>
    </form>
  </div>
<?php }
