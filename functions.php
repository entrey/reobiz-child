<?php

function reobiz_child_enqueue_scripts()
{
	wp_enqueue_style( 'reobiz-child', get_template_directory_uri() . '/style.css' );
}

add_action('wp_enqueue_scripts', 'reobiz_child_enqueue_scripts', 11);
