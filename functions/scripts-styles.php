<?php
/*-----------------------------------------------------------------------------------*/
/* Script and style functions
/*-----------------------------------------------------------------------------------*/

function basetheme_styles_scripts() {
	// Deregister scripts
	wp_deregister_script( 'wp-embed' );

	// Dequeue styles
	wp_dequeue_style( 'wp-block-library' );

	// Enqueue scripts
  wp_enqueue_script( 'scripts', get_template_directory_uri() . '/js/scripts.js' );

	// Enqueue styles
	wp_enqueue_style( 'styles', get_template_directory_uri() . '/css/styles.css' );
}
add_action( 'wp_enqueue_scripts', 'basetheme_styles_scripts' );

// Disable emojis
function basetheme_disable_emojis() {
	remove_action( 'wp_head', 'print_emoji_detection_script', 7 );
	remove_action( 'admin_print_scripts', 'print_emoji_detection_script' );
	remove_action( 'wp_print_styles', 'print_emoji_styles' );
	remove_action( 'admin_print_styles', 'print_emoji_styles' );
	remove_filter( 'the_content_feed', 'wp_staticize_emoji' );
	remove_filter( 'comment_text_rss', 'wp_staticize_emoji' );
	remove_filter( 'wp_mail', 'wp_staticize_emoji_for_email' );
	add_filter( 'tiny_mce_plugins', 'disable_emojis_tinymce' );
}
add_action( 'init', 'basetheme_disable_emojis' );

function disable_emojis_tinymce( $plugins ) {
	if ( is_array( $plugins ) ) {
		return array_diff( $plugins, array( 'wpemoji' ) );
	} else {
		return array();
	}
}

// Disable oEmbed
function basetheme_disable_embeds_code_init() {
 remove_action( 'rest_api_init', 'wp_oembed_register_route' );
 add_filter( 'embed_oembed_discover', '__return_false' );
 remove_filter( 'oembed_dataparse', 'wp_filter_oembed_result', 10 );
 remove_action( 'wp_head', 'wp_oembed_add_discovery_links' );
 remove_action( 'wp_head', 'wp_oembed_add_host_js' );
 add_filter( 'tiny_mce_plugins', 'disable_embeds_tiny_mce_plugin' );
 add_filter( 'rewrite_rules_array', 'disable_embeds_rewrites' );
 remove_filter( 'pre_oembed_result', 'wp_filter_pre_oembed_result', 10 );
}
add_action( 'init', 'basetheme_disable_embeds_code_init', 9999 );

function disable_embeds_tiny_mce_plugin($plugins) {
  return array_diff($plugins, array('wpembed'));
}

function disable_embeds_rewrites($rules) {
	foreach($rules as $rule => $rewrite) {
		if(false !== strpos($rewrite, 'embed=true')) {
			unset($rules[$rule]);
		}
	}
	return $rules;
}

// Remove from <head>
remove_action( 'wp_head', 'rest_output_link_wp_head' );
remove_action( 'wp_head', 'rsd_link' );
remove_action( 'wp_head', 'wlwmanifest_link' );
remove_action( 'wp_head', 'wp_generator' );
