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
		'rbm_skills',
		__( 'Staff Skills', 'wordpress' ),
		'rbm_skills_render',
		'pluginPage',
		'rbm_pluginPage_section'
	);
}


function rbm_skills_render(  ) {

	$options = get_option( 'rbm_settings' );
	$i = 0;
	echo '<div id="skill-cell">';
	foreach($options[rbm_skills] as $key => $value) { ?>
		<input type='text' name='rbm_settings[rbm_skills][<?php echo $i; ?>][]' value='<?php echo $options['rbm_skills'][$i][0]; ?>'>
		<input type='text' name='rbm_settings[rbm_skills][<?php echo $i; ?>][]' value='<?php echo $options['rbm_skills'][$i][1]; ?>'>
		<br>
	<?php  $i++;  }  echo "</div>";?>

<?php
}

function rbm_settings_section_callback(  ) {
	echo __( '', 'wordpress' );
}


function rbm_options_page(  ) {

	?>
	<form action='options.php' method='post'>

		<h2>RBM Staff Settings</h2>

		<?php
		settings_fields( 'pluginPage' );
		do_settings_sections( 'pluginPage' );
		echo '<button id="new-skill" class="button">Add New Skill</button>';
		submit_button();
		?>

	</form>
	<script>
		jQuery(document).ready(function($) {
			var newSkillIndex = <?php $options = get_option( 'rbm_settings' );  $i = count($options[rbm_skills]); $i--; echo $i; ?>;
			$('#new-skill').click(function(event) {
				event.preventDefault();
				var cellHTML = "";
				newSkillIndex += 1;
				cellHTML += "<input type='text' name='rbm_settings[rbm_skills]["+newSkillIndex+"][]' value=''> ";
				cellHTML += "<input type='text' name='rbm_settings[rbm_skills]["+newSkillIndex+"][]' value=''>";
				$("#skill-cell").append(cellHTML);
			});
		});
	</script>
	<?php

}

?>
