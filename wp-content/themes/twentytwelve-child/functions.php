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

?>