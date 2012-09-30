<?php
/*
Plugin Name: Raffles Member Listing
Plugin URL: http://tridnguyen.com
Description: A simple shortcode to list Raffles Alumni Members. This is modeled after the Simple User Listing Plugin by Cristian Antohe, http://cozmoslabs.com
Author: Tri Nguyen
Version: 0.1
Author URL: http://tridnguyen.com
*/

function raffles_member_listing($atts, $content = null) {
	
	extract(shortcode_atts(array (
		"role" => 'alumni'
		),$atts));
	
	$role = sanitize_text_field($role);
	
	ob_start();
	
	$alumni = get_users (
		array (
			'role' => 'alumni'
		)
	);
	
	// Add administrators and contributors to list of alumni to be printed out
	$contributors = get_users (array('role'=>'contributor'));
	$admins = get_users(array('role'=>'administrator'));
	$alumni = array_merge($contributors, $admins, $alumni);
	
	?>
	<div class="member-listing">
		<table class="table member-table table-striped table-bordered">
			<thead>
				<tr>
					<th>Index</th>
					<th>Last Name</th>
					<th>First Name</th>
					<th>College / University</th>
					<th>Where the school is located</th>
					<th>ZIP Code</th>
					<th>Year of Graduation</th>
					<th>Majors</th>
					<th>Nearby Location</th>
					<th>Year graduated from Raffles</th>
					<th>House</th>
				</tr>
			</thead>
			<tbody>
				<?php foreach ($alumni as $alumnus) :
					$alumnus_info = get_userdata($alumnus->ID);?>
					<tr>
						<td></td>
						<td><?php echo $alumnus_info->last_name; ?></td>
						<td><?php echo $alumnus_info->first_name; ?></td>
						<td><?php echo $alumnus_info->college; ?></td>
						<td><?php echo $alumnus_info->location; ?></td>
						<td><?php echo $alumnus_info->zip; ?></td>
						<td><?php echo $alumnus_info->class_year; ?></td>
						<td><?php echo $alumnus_info->majors; ?></td>
						<td><?php echo $alumnus_info->nearby_location; ?></td>
						<td><?php echo $alumnus_info->year_raffles; ?></td>
						<td><?php if ($alumnus_info->house == '--Select One--'): 
									echo '';
								else:
									echo $alumnus_info->house;
								endif;?></td>
					</tr>
				<?php endforeach; ?>
			</tbody>
		</table>
	</div>
	<?php
	$output = ob_get_contents();
	ob_end_clean();
	
	// Return only if inside a page
	if (is_page()) return $output;
	
}
	
// Add shortcode to Wordpress
add_shortcode('list-members','raffles_member_listing');
?>