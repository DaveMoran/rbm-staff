<?php
add_action( 'admin_menu', 'rbm_add_admin_menu' );
add_action( 'admin_init', 'rbm_settings_init' );

function rbm_add_admin_menu(  ) {
	add_submenu_page( 'edit.php?post_type=rbm_staff', 'RBM Staff', 'Settings', 'edit_posts', basename(__FILE__), 'rbm_options_page' );
}

function rbm_settings_init(  ) {

	register_setting( 'pluginPage', 'rbm_settings' );

	add_settings_section(
		'rbm_pluginPage_section',
		__( 'Settings page for the RBM Staff plugin', 'wordpress' ),
		'rbm_settings_section_callback',
		'pluginPage'
	);

	add_settings_field(
		'rbm_text_field_0',
		__( 'Add/Remove Skills', 'wordpress' ),
		'rbm_text_field_0_render',
		'pluginPage',
		'rbm_pluginPage_section'
	);
}


function rbm_text_field_0_render(  ) {

	$options = get_option( 'rbm_settings' );
	?>
	<input type='text' name='rbm_settings[rbm_text_field_0]' value='<?php echo $options['rbm_text_field_0']; ?>'>
	<?php

}

function rbm_settings_section_callback(  ) {
	echo __( 'Skills', 'wordpress' );
}


function rbm_options_page(  ) {

	?>
	<form action='options.php' method='post'>

		<h2>RBM Staff Settings</h2>

		<?php
		settings_fields( 'pluginPage' );
		do_settings_sections( 'pluginPage' );
		submit_button();
		?>

	</form>
	<?php

}

?>
