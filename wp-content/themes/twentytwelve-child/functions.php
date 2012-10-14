<?php

function child_scripts_styles() {
	// register child theme informational style sheet
	wp_register_style('child-theme', get_stylesheet_directory_uri().'/style.css', array(), '', 'screen');
	// register child theme main style sheet
	wp_register_style('child-main', get_stylesheet_directory_uri().'/css/style.css', array(), '', 'screen');

	// enqueue 'em all!
	wp_enqueue_style('child-theme');
	wp_enqueue_style('child-main');

}

add_action( 'wp_enqueue_scripts', 'child_scripts_styles');
// Add user meta data fields for Rafflesians

function extra_profile_fields ($user) { ?>
	<h3> Extra Profile Information </h3>
		<table class="form-table">
			<tbody>
				<tr>
					<th>
						<label for="college"> College / University </label>
					</th>
					<td>
						<input type="text" name="college" id="college" value="<?php echo esc_attr( get_the_author_meta('college', $user -> ID ) ); ?>" class="regular-text" />
						<span class="description"></span>
					</td>
				</tr>
				<tr>
					<th>
						<label for="location"> School Location </label>
					</th>
					<td>
						<input type="text" name="location" id="location" value="<?php echo esc_attr( get_the_author_meta('location', $user -> ID ) ); ?>" class="regular-text" />
						<span class="description">City/Town, State (eg. 'Norton, MA')</span>
					</td>
				</tr>
				<tr>
					<th>
						<label for="zip"> ZIP Code </label>
					</th>
					<td>
						<input type="text" name="zip" id="zip" value="<?php echo esc_attr( get_the_author_meta('zip', $user -> ID ) ); ?>" class="regular-text" />
						<span class="description">eg. 02766</span>
					</td>
				</tr>
				<tr>
					<th>
						<label for="class_year"> Year of Graduation </label>
					</th>
					<td>
						<input type="text" name="class_year" id="class-year" value="<?php echo esc_attr( get_the_author_meta('class_year', $user -> ID ) ); ?>" class="regular-text" />
						<span class="description">Class Year (eg. 2014)</span>
					</td>
				</tr>
				<tr>
					<th>
						<label for="majors"> Your (intended) Majors</label>
					</th>
					<td>
						<input type="text" name="majors" id="majors" value="<?php echo esc_attr( get_the_author_meta('majors', $user -> ID ) ); ?>" class="regular-text" />
						<span class="description">(eg. Economics, Computer Science)</span>
					</td>
				</tr>
				<tr>
					<th>
						<label for="nearby_location"> Nearby Location </label>
					</th>
					<td>
						<input type="text" name="nearby_location" id="nearby-location" value="<?php echo esc_attr( get_the_author_meta('nearby_location', $user -> ID ) ); ?>" class="regular-text" />
						<span class="description">Nearby town, city (eg. Boston)</span>
					</td>
				</tr>
				<tr>
					<th>
						<label for="cell"> Cell Phone Number</label>
					</th>
					<td>
						<input type="text" name="cell" id="cell" value="<?php echo esc_attr( get_the_author_meta('cell', $user -> ID ) ); ?>" class="regular-text" />
						<span class="description">(eg. xxx-xxx-xxxx) *Will not be displayed</span>
					</td>
				</tr>
				<tr>
					<th>
						<label for="year_raffles"> Year graduated from Raffes </label>
					</th>
					<td>
						<input type="text" name="year_raffles" id="year-raffles" value="<?php echo esc_attr( get_the_author_meta('year_raffles', $user -> ID ) ); ?>" class="regular-text" />
						<span class="description">(eg. 2009)</span>
					</td>
				</tr>
				<tr>
					<th>
						<label for="house"> Which house were you in at Raffles? </label>
					</th>
					<td>
						<select id="house" name="house" class="regular-text">
							<?php 
							$selected = get_the_author_meta('house', $user->ID); 
							$houses = ['Buckle-Buckley', 'Bayley-Waddle', 'Hadley-Hullet','Moor-Tarbet', 'Morrison-Richardson']; 
								foreach ($houses as $house) {
									echo '<option value="', $house, $selected == $house ? '" selected="selected"' : '" ','>',$house,'</option>';
								}
							?>
						</select>
						<span class="description"></span>
					</td>
				</tr>
			</tbody>
		</table>

<?php }

add_action ( 'show_user_profile' , 'extra_profile_fields' );
add_action ( 'edit_user_profile' , 'extra_profile_fields' );

function save_profile_fields ($user_id) {
	if ( !current_user_can ( 'edit_user', $user_id ))
		return false;
	update_user_meta ($user_id, 'college', $_POST['college']);
	update_user_meta ($user_id, 'location', $_POST['location']);
	update_user_meta ($user_id, 'zip', $_POST['zip']);
	update_user_meta ($user_id, 'class_year', $_POST['class_year']);
	update_user_meta ($user_id, 'majors', $_POST['majors']);
	update_user_meta ($user_id, 'nearby_location', $_POST['nearby_location']);
	update_user_meta ($user_id, 'cell', $_POST['cell']);
	update_user_meta ($user_id, 'year_raffles', $_POST['year_raffles']);
	update_user_meta ($user_id, 'house', $_POST['house']);
}

add_action ( 'personal_options_update' , 'save_profile_fields' );
add_action ( 'edit_user_profile_update' , 'save_profile_fields' );
?>