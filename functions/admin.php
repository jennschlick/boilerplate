<?php
/*-----------------------------------------------------------------------------------*/
/* Admin functions
/*-----------------------------------------------------------------------------------*/

/*-----------------------------------------------------------------------------------*/
/* Customize the login page
/*-----------------------------------------------------------------------------------*/

function boilerplate_login_logo() { ?>
<style type="text/css">
#login h1 a,
.login h1 a {
	background-image: url(<?php echo get_stylesheet_directory_uri(); ?>/img/logo.svg);
	height: 80px;
	width: 100%;
	background-size: contain;
	background-repeat: no-repeat;
	padding-bottom: 30px;
}
</style> <?php } 

add_action( 'login_enqueue_scripts', 'boilerplate_login_logo' );

function boilerplate_login_logo_url() {
  return home_url();
}

add_filter( 'login_headerurl', 'boilerplate_login_logo_url' );

/*-----------------------------------------------------------------------------------*/
/* Remove dashboard widgets
/*-----------------------------------------------------------------------------------*/

function boilerplate_remove_dashboard_widgets() {
	remove_meta_box( 'dashboard_activity', 'dashboard', 'normal');
	remove_meta_box( 'dashboard_incoming_links', 'dashboard', 'normal' );
	remove_meta_box( 'dashboard_plugins', 'dashboard', 'normal' );
	remove_meta_box( 'dashboard_primary', 'dashboard', 'side' );
	remove_meta_box( 'dashboard_secondary', 'dashboard', 'normal' );
	remove_meta_box( 'dashboard_quick_press', 'dashboard', 'side' );
	remove_meta_box( 'dashboard_recent_drafts', 'dashboard', 'side' );
	remove_meta_box( 'dashboard_recent_comments', 'dashboard', 'normal' );
	remove_meta_box( 'dashboard_right_now', 'dashboard', 'normal' );
	remove_meta_box( 'dashboard_site_health', 'dashboard', 'normal');
	remove_meta_box( 'semperplugins-rss-feed', 'dashboard', 'normal');
}

add_action( 'admin_init', 'boilerplate_remove_dashboard_widgets' );

/*-----------------------------------------------------------------------------------*/
/* Remove admin columns
/*-----------------------------------------------------------------------------------*/

function boilerplate_remove_columns( $columns ) {
	unset($columns['author']);
	unset($columns['categories']);
	unset($columns['comments']);
	unset($columns['date']);
  // unset($columns['seodesc']);
  // unset($columns['seokeywords']);
  // unset($columns['seotitle']);
	unset($columns['tags']);
	return $columns;
}

function remove_column_init() {
	add_filter( 'manage_posts_columns' , 'boilerplate_remove_columns' );
	add_filter( 'manage_pages_columns' , 'boilerplate_remove_columns' );
}

add_action( 'admin_init' , 'remove_column_init' );

/*-----------------------------------------------------------------------------------*/
/* Increase number of pages and posts shown per page
/*-----------------------------------------------------------------------------------*/

function boilerplate_per_page( $result, $option, $user ) {
	return 100;
}

add_filter( 'get_user_option_edit_page_per_page', 'boilerplate_per_page', 10, 3 );
add_filter( 'get_user_option_edit_post_per_page', 'boilerplate_per_page', 10, 3 );

/*-----------------------------------------------------------------------------------*/
/* Remove comment support
/*-----------------------------------------------------------------------------------*/

function boilerplate_remove_comment_support() {
	remove_post_type_support( 'post', 'comments' );
	remove_post_type_support( 'page', 'comments' );
}

add_action( 'init', 'boilerplate_remove_comment_support', 100 );

/*-----------------------------------------------------------------------------------*/
/* Replace admin bar greeting
/*-----------------------------------------------------------------------------------*/

function boilerplate_replace_howdy_greeting( $wp_admin_bar ) {
	$my_account=$wp_admin_bar->get_node('my-account');
	$newtitle = str_replace( 'Howdy, ', '', $my_account->title );
	$wp_admin_bar->add_node( array(
		'id' => 'my-account',
		'title' => $newtitle,
	) );
}

add_filter( 'admin_bar_menu', 'boilerplate_replace_howdy_greeting', 12 );

/*-----------------------------------------------------------------------------------*/
/* Remove admin bar links
/*-----------------------------------------------------------------------------------*/

function boilerplate_admin_bar_render() {
	global $wp_admin_bar;
	$wp_admin_bar->remove_menu( 'about' );
	$wp_admin_bar->remove_menu( 'comments' );
	$wp_admin_bar->remove_menu( 'customize' );
	$wp_admin_bar->remove_menu( 'documentation' );
	$wp_admin_bar->remove_menu( 'feedback' );
	$wp_admin_bar->remove_menu( 'menus' );
	$wp_admin_bar->remove_menu( 'new-content' );
	$wp_admin_bar->remove_menu( 'search' );
	$wp_admin_bar->remove_menu( 'support-forums' );
	$wp_admin_bar->remove_menu( 'themes' );
	$wp_admin_bar->remove_menu( 'wp-logo' );
	$wp_admin_bar->remove_menu( 'wporg' );
}

add_action( 'wp_before_admin_bar_render', 'boilerplate_admin_bar_render' );

/*-----------------------------------------------------------------------------------*/
/* Remove admin menu links
/*-----------------------------------------------------------------------------------*/

function boilerplate_remove_admin_menus() {
	remove_menu_page( 'edit-comments.php' );
	remove_menu_page( 'edit.php' );
}

add_action( 'admin_menu', 'boilerplate_remove_admin_menus' );

/*-----------------------------------------------------------------------------------*/
/* Remove help tabs
/*-----------------------------------------------------------------------------------*/

function boilerplate_remove_help_tabs() {
	$screen = get_current_screen();
	$screen->remove_help_tabs();
}

add_action('admin_head', 'boilerplate_remove_help_tabs');

/*-----------------------------------------------------------------------------------*/
/* Add custom colors
/*-----------------------------------------------------------------------------------*/

// function boilerplate_colors() {
// 	add_theme_support(
// 		'editor-color-palette', array(
// 			array(
// 				'name'  => esc_html__( 'Black', '@@textdomain' ),
// 				'slug' => 'black',
// 				'color' => '#000000',
// 			),
// 			array(
// 				'name'  => esc_html__( 'White', '@@textdomain' ),
// 				'slug' => 'white',
// 				'color' => '#FFFFFF',
// 			),
// 		)
// 	);
// }

// add_action( 'after_setup_theme', 'boilerplate_colors' );

/*-----------------------------------------------------------------------------------*/
/* Add custom font sizes
/*-----------------------------------------------------------------------------------*/

// function boilerplate_font_sizes() {
// 	add_theme_support('disable-custom-font-sizes');
// 	add_theme_support( 'editor-font-sizes', array(
// 		array(
// 			'name' => __( 'Small'),
// 			'size' => 16,
// 			'slug' => 'small'
// 		),
// 		array(
// 			'name' => __( 'Normal'),
// 			'size' => 18,
// 			'slug' => 'normal'
// 		),
// 		array(
// 			'name' => __( 'Large'),
// 			'size' => 20,
// 			'slug' => 'large'
// 		),
// 		array(
// 			'name' => __( 'Huge'),
// 			'size' => 40,
// 			'slug' => 'huge'
// 		)
// 	) );
// }

// add_action( 'after_setup_theme', 'boilerplate_font_sizes' );