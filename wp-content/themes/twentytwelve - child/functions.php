<?php

function child_scripts_styles() {
	// register child theme main style sheet
	wp_register_style('child-main', get_template_directory_uri().'/style.css'), array(), '', 'screen');

	wp_enqueue_style('child-main');
}

add_action( 'wp_enqueue_scripts', 'child_scripts_styles');

?>