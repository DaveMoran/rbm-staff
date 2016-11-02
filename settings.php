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
		<label>Skill Name:
		<input type='text' name='rbm_settings[rbm_skills][<?php echo $i; ?>][]' value='<?php echo $options['rbm_skills'][$i][0]; ?>'></label><br>
		<label>Skill Image:
		<input type='text' name='rbm_settings[rbm_skills][<?php echo $i; ?>][]' value='<?php echo $options['rbm_skills'][$i][1]; ?>'></label><br>
		<label>Skill Link: &nbsp;&nbsp;
		<input type='text' name='rbm_settings[rbm_skills][<?php echo $i; ?>][]' value='<?php echo $options['rbm_skills'][$i][2]; ?>'></label><br>
		<hr>
	<?php  $i++;  }  echo "</div>";?>

<?php
}

function rbm_settings_section_callback(  ) {
	echo __( '', 'wordpress' );
}


function rbm_options_page(  ) {

	?>
	<style>
		input {
	    margin: 0;
	    max-width: 100%;
	    -webkit-box-flex: 1;
	    -webkit-flex: 1 0 auto;
	    -ms-flex: 1 0 auto;
	    flex: 1 0 auto;
	    outline: 0;
	    -webkit-tap-highlight-color: rgba(255,255,255,0);
	    text-align: left;
	    line-height: 1.2142em;
	    font-family: Lato,'Helvetica Neue',Arial,Helvetica,sans-serif;
	    padding: .67861429em 1em;
	    background: #FFF;
	    border: 1px solid rgba(34,36,38,.15);
	    color: rgba(0,0,0,.87);
	    border-radius: .28571429rem;
	    -webkit-transition: box-shadow .1s ease,border-color .1s ease;
	    transition: box-shadow .1s ease,border-color .1s ease;
	    box-shadow: none;
		}
	</style>
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
				cellHTML += "<label>Skill Name: <input type='text' name='rbm_settings[rbm_skills]["+newSkillIndex+"][]' value=''></label><br>";
				cellHTML += "<label>Skill Image: <input type='text' name='rbm_settings[rbm_skills]["+newSkillIndex+"][]' value=''></label><br>";
				cellHTML += "<label>Skill Link: &nbsp;&nbsp; <input type='text' name='rbm_settings[rbm_skills]["+newSkillIndex+"][]' value=''></label><hr>";
				$("#skill-cell").append(cellHTML);
			});
		});
	</script>
	<?php

}

?>
