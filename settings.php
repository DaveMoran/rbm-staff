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
	if($options) {
		foreach($options[rbm_skills] as $key => $value) { ?>
			<div class="skills">
				<label>Skill Name:
				<input type='text' name='rbm_settings[rbm_skills][<?php echo $i; ?>][]' value='<?php echo $options['rbm_skills'][$i][0]; ?>'></label><br>
				<label>Skill Image:
				<input type='text' name='rbm_settings[rbm_skills][<?php echo $i; ?>][]' value='<?php echo $options['rbm_skills'][$i][1]; ?>'></label><br>
				<label>Skill Link: &nbsp;&nbsp;
				<input type='text' name='rbm_settings[rbm_skills][<?php echo $i; ?>][]' value='<?php echo $options['rbm_skills'][$i][2]; ?>'></label>
				<button id="remove-<?php echo $i; ?>" data-index="<?php echo $i; ?>" class="remove-skill button">Remove Skill</button>
				<hr>
			</div>
		<?php  $i++;  }  echo "</div>"; } else {
			echo "Add a new skill to get started";
		};

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
			var newSkillIndex = <?php
			 	$options = get_option( 'rbm_settings' );
				if($options) {
					$i = count($options[rbm_skills]);
					$i--;
					echo $i;
				} else {
					echo 0;
				} ?>;
			$('#new-skill').click(function(event) {
				event.preventDefault();
				var cellHTML = "<div class='skills'>";
				newSkillIndex += 1;
				cellHTML += "<label>Skill Name: <input type='text' name='rbm_settings[rbm_skills]["+newSkillIndex+"][]' value=''></label><br>";
				cellHTML += "<label>Skill Image: <input type='text' name='rbm_settings[rbm_skills]["+newSkillIndex+"][]' value=''></label><br>";
				cellHTML += "<label>Skill Link: &nbsp;&nbsp; <input type='text' name='rbm_settings[rbm_skills]["+newSkillIndex+"][]' value=''></label>";
				cellHTML += "<button id='remove-" +newSkillIndex+ "' data-index='" +newSkillIndex + "' class='remove-skill button'>Remove Skill</button>";
				cellHTML += "<hr></div>";
				$("#skill-cell").append(cellHTML);
			});

			$('.remove-skill').click(function(event) {
				event.preventDefault();
				//Step 1, save existing array
				var currentSkills = <?php
					$options = get_option( 'rbm_settings' );
					if ($options) {
						echo json_encode($options['rbm_skills']);
					} else {
						echo 0;
					} ?>;
				newSkillIndex--;

				//Step 2, get array index from button
				var skillId = $(this).data("index");
				var newArray = new Array();

				//Step 3, Create a loop to form a new array
				for(var i = 0; i < currentSkills.length; i++){
					//Step 4, When on the index skip the push
					if(i != skillId) {
						newArray.push(currentSkills[i]);
					}
				}

				//Step 5, Delete everything inside of skill-cell
				$("#skill-cell").empty();

				//Step 6, Begin new loop, replace divs with new
				for(var i = 0; i < newArray.length; i++) {
					var cellHTML = "";
					cellHTML += "<div class='skills'>"
					cellHTML += "<label>Skill Name: <input type='text' name='rbm_settings[rbm_skills]["+i+"][]' value='"+ newArray[i][0] +"'></label><br>";
					cellHTML += "<label>Skill Image: <input type='text' name='rbm_settings[rbm_skills]["+i+"][]' value='"+ newArray[i][1] +"'></label><br>";
					cellHTML += "<label>Skill Link: &nbsp;&nbsp; <input type='text' name='rbm_settings[rbm_skills]["+i+"][]' value='"+ newArray[i][2] +"'></label>";
					cellHTML += '<button id="remove-'+ i +'" data-index="'+i+'" class="remove-skill button">Remove Skill</button>';
					cellHTML += "<hr></div>"
					$("#skill-cell").append(cellHTML);
				}
			});
		});
	</script>
	<?php

}
