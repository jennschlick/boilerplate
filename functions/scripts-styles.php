<?php
/*-----------------------------------------------------------------------------------*/
/* Scripts and styles
/*-----------------------------------------------------------------------------------*/

/*-----------------------------------------------------------------------------------*/
/* Enqueue theme scripts and styles
/*-----------------------------------------------------------------------------------*/

function boilerplate_styles_scripts() {
	// Enqueue jQuery
	// wp_enqueue_script( 'jquery', '//cdnjs.cloudflare.com/ajax/libs/jquery/3.6.4/jquery.min.js' );

	// Enqueue scripts
	wp_enqueue_script( 'scripts', get_template_directory_uri() . '/js/scripts.js' );

	// Enqueue styles
	wp_enqueue_style( 'styles', get_template_directory_uri() . '/css/styles.css' );
}

add_action( 'wp_enqueue_scripts', 'boilerplate_styles_scripts' );

/*-----------------------------------------------------------------------------------*/
/* Disable emojis
/* Source: https://kinsta.com/knowledgebase/disable-emojis-wordpress
/*-----------------------------------------------------------------------------------*/

function boilerplate_disable_emojis() {
	remove_action( 'wp_head', 'print_emoji_detection_script', 7 );
	remove_action( 'admin_print_scripts', 'print_emoji_detection_script' );
	remove_action( 'wp_print_styles', 'print_emoji_styles' );
	remove_action( 'admin_print_styles', 'print_emoji_styles' ); 
	remove_filter( 'the_content_feed', 'wp_staticize_emoji' );
	remove_filter( 'comment_text_rss', 'wp_staticize_emoji' ); 
	remove_filter( 'wp_mail', 'wp_staticize_emoji_for_email' );
	add_filter( 'tiny_mce_plugins', 'disable_emojis_tinymce' );
	add_filter( 'wp_resource_hints', 'disable_emojis_remove_dns_prefetch', 10, 2 );
}

add_action( 'init', 'boilerplate_disable_emojis' );

function disable_emojis_tinymce( $plugins ) {
	if ( is_array( $plugins ) ) {
		return array_diff( $plugins, array( 'wpemoji' ) );
	} else {
		return array();
	}
}

function disable_emojis_remove_dns_prefetch( $urls, $relation_type ) {
	if ( 'dns-prefetch' == $relation_type ) {
		/** This filter is documented in wp-includes/formatting.php */
		$emoji_svg_url = apply_filters( 'emoji_svg_url', 'https://s.w.org/images/core/emoji/2/svg/' );

		$urls = array_diff( $urls, array( $emoji_svg_url ) );
	}
	return $urls;
}

/*-----------------------------------------------------------------------------------*/
/* Disable oEmbed
/* Source: https://kinsta.com/knowledgebase/disable-embeds-wordpress
/*-----------------------------------------------------------------------------------*/

function boilerplate_disable_embeds_code_init() {

 // Remove the REST API endpoint
	remove_action( 'rest_api_init', 'wp_oembed_register_route' );

 // Turn off oEmbed auto discovery
	add_filter( 'embed_oembed_discover', '__return_false' );

 // Don't filter oEmbed results
	remove_filter( 'oembed_dataparse', 'wp_filter_oembed_result', 10 );

 // Remove oEmbed discovery links
	remove_action( 'wp_head', 'wp_oembed_add_discovery_links' );

 // Remove oEmbed-specific JavaScript from the front-end and back-end
	remove_action( 'wp_head', 'wp_oembed_add_host_js' );
	add_filter( 'tiny_mce_plugins', 'boilerplate_disable_embeds_tiny_mce_plugin' );

 // Remove all embeds rewrite rules
	add_filter( 'rewrite_rules_array', 'boilerplate_disable_embeds_rewrites' );

 // Remove filter of the oEmbed result before any HTTP requests are made
	remove_filter( 'pre_oembed_result', 'wp_filter_pre_oembed_result', 10 );
}

add_action( 'init', 'boilerplate_disable_embeds_code_init', 9999 );

function boilerplate_disable_embeds_tiny_mce_plugin($plugins) {
	return array_diff($plugins, array('wpembed'));
}

function boilerplate_disable_embeds_rewrites($rules) {
	foreach($rules as $rule => $rewrite) {
		if(false !== strpos($rewrite, 'embed=true')) {
			unset($rules[$rule]);
		}
	}
	return $rules;
}

/*-----------------------------------------------------------------------------------*/
/* wp_head() cleaner
/* Source: https://wordpress.org/plugins/wp-head-cleaner
/* Version: 2.0.2
/*-----------------------------------------------------------------------------------*/

// Canonical link
// remove_action( 'wp_head', 'rel_canonical', 10, 0 );

// Links for the posts and comments feeds
remove_action( 'wp_head', 'feed_links', 2, 1 );

// Links to other feeds, e.g. categories
remove_action( 'wp_head', 'feed_links_extra', 3, 1 );

// Post short links
remove_action( 'wp_head', 'wp_shortlink_wp_head', 10, 0 );

// Really Simple Discovery
remove_action( 'wp_head', 'rsd_link', 10, 1 ); 

// Relational link for the first post
remove_action( 'wp_head', 'start_post_rel_link', 10, 1 );

// Relational link for the site index
remove_action( 'wp_head', 'index_rel_link', 10, 1 );

// Relational links for the posts adjacent to the current post
remove_action( 'wp_head', 'adjacent_posts_rel_link_wp_head', 10, 0 );

// REST API link
// remove_action( 'wp_head', 'rest_output_link_wp_head', 10, 0 );

// Scripts for emoji support
// (Duplicated above)
// remove_action( 'wp_head', 'print_emoji_detection_script', 7, 1 );

// Scripts for the oEmbed discover mechanism
// (Duplicated above)
// remove_action( 'wp_head', 'wp_oembed_add_host_js', 10, 1 );

// Styles for emoji support
// (Duplicated above)
// remove_action( 'wp_print_styles', 'print_emoji_styles', 10, 1 );

// Tags for browser pre-fetching, pre-rendering, and pre-connecting hints
// remove_action( 'wp_head', 'wp_resource_hints', 2, 1 );

// Tags for the oEmbed discover mechanism
// (Duplicated above)
// remove_action( 'wp_head', 'wp_oembed_add_discovery_links', 10, 1 );

// Tags for web robots image preview directive
// remove_action( 'wp_robots', 'wp_robots_max_image_preview_large', 10, 1 );

// Windows Live Writer
remove_action( 'wp_head', 'wlwmanifest_link', 10, 1 );

// WordPress version
remove_action( 'wp_head', 'wp_generator', 10, 1 );

/*-----------------------------------------------------------------------------------*/
/* wp-head-clean.php
/* Source: https://gist.github.com/blacksaildivision/d74b3f92faf7f8a8b3a7d88cf7cd713e
/*-----------------------------------------------------------------------------------*/

// Alter dns-prefetch links in <head>
add_filter('wp_resource_hints', function (array $urls, string $relation): array {
    // If the relation is different than dns-prefetch, leave the URLs intact
	if ($relation !== 'dns-prefetch') {
		return $urls;
	}

    // Remove s.w.org entry
	$urls = array_filter($urls, function (string $url): bool {
		return strpos($url, 's.w.org') === false;
	});

    // List of domains to prefetch
	$dnsPrefetchUrls = [];
	return array_merge($urls, $dnsPrefetchUrls);
}, 10, 2);

// Disable RSS feeds by redirecting their URLs to homepage
foreach (['do_feed_rss2', 'do_feed_rss2_comments'] as $feedAction) {
	add_action($feedAction, function (): void {
        // Redirect permanently to homepage
		wp_redirect(home_url(), 301);
		exit;
	}, 1);
}

// Remove the feed links from <head>
// (Duplicated above)
// remove_action('wp_head', 'feed_links', 2);

// Remove emoji script and styles from <head>
// // (Duplicated above)
// remove_action( 'wp_head', 'print_emoji_detection_script', 7 );
// remove_action( 'wp_print_styles', 'print_emoji_styles' );

// Disable REST-API for all users except of admin
add_filter('rest_authentication_errors', function ($access) {
	if (!current_user_can('administrator')) {
		return new WP_Error('rest_cannot_access', 'Only authenticated users can access the REST API.', ['status' => rest_authorization_required_code()]);
	}
	return $access;
});

// Remove REST-AI link from <head>
// (Duplicated above)
// remove_action( 'wp_head', 'rest_output_link_wp_head' );

// Disable XML-RPC
add_filter( 'xmlrpc_enabled', function (): bool {
	return false;
});

// Remove XML-RPC link from <head>
// (Duplicated above)
// remove_action('wp_head', 'rsd_link');

// Remove Windows Live Writer manifest from <head>
// (Duplicated above)
// remove_action('wp_head', 'wlwmanifest_link');

// Remove info about WordPress version from <head>
// (Duplicated above)
// remove_action('wp_head', 'wp_generator');

// Remove Gutenberg default styles
// add_action('wp_print_styles', function (): void {
// 	wp_dequeue_style( 'wp-block-library' );
// 	wp_dequeue_style( 'wp-block-library-theme' );
// });

// Remove unnecessary attributes from style tags
add_filter('style_loader_tag', function (string $tag, string $handle): string {
    // Remove ID attribute
	$tag = str_replace("id='${handle}-css'", '', $tag);

    // Remove type attribute
	$tag = str_replace(" type='text/css'", '', $tag);

    // Change ' to " in attributes:
	$tag = str_replace('\'', '"', $tag);

    // Remove trailing slash
	$tag = str_replace(' />', '>', $tag);

    // Remove double spaces
	return str_replace('  ', '', $tag);
}, 10, 2 );

/*-----------------------------------------------------------------------------------*/
/* Remove classic theme styles
/* Source: https://stackoverflow.com/questions/74341664/how-to-remove-wp-includes-css-classic-themes-min-css
/*-----------------------------------------------------------------------------------*/

// function boilerplate_deregister_classic_theme_styles() {
// 	wp_dequeue_style( 'classic-theme-styles' );
// }
// add_action( 'wp_enqueue_scripts', 'boilerplate_deregister_classic_theme_styles' );

/*-----------------------------------------------------------------------------------*/
/* Remove global styles
/* Source: https://wordpress.org/support/topic/how-to-disable-inline-styling-style-idglobal-styles-inline-css
/*-----------------------------------------------------------------------------------*/

// function boilerplate_deregister_global_styles() {
// 	wp_dequeue_style( 'global-styles' );
// }
// add_action( 'wp_enqueue_scripts', 'boilerplate_deregister_global_styles' );