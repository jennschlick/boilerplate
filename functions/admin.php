<?php
/*-----------------------------------------------------------------------------------*/
/* Admin functions
/*-----------------------------------------------------------------------------------*/

// Remove dashboard welcome panel and widgets
remove_action('welcome_panel', 'wp_welcome_panel');

function basetheme_remove_dashboard_widgets() {
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
add_action( 'admin_init', 'basetheme_remove_dashboard_widgets' );

// Remove admin columns
function basetheme_remove_columns( $columns ) {
  unset($columns['author']);
  unset($columns['categories']);
  unset($columns['comments']);
  unset($columns['date']);
  unset($columns['seodesc']);
  unset($columns['seokeywords']);
  unset($columns['seotitle']);
  unset($columns['tags']);
  return $columns;
}
function remove_column_init() {
  add_filter( 'manage_posts_columns' , 'basetheme_remove_columns' );
  add_filter( 'manage_pages_columns' , 'basetheme_remove_columns' );
}
add_action( 'admin_init' , 'remove_column_init' );

// Increase number of pages and posts shown per page
function basetheme_per_page( $result, $option, $user ) {
  return 100;
}
add_filter( 'get_user_option_edit_page_per_page', 'basetheme_per_page', 10, 3 );
add_filter( 'get_user_option_edit_post_per_page', 'basetheme_per_page', 10, 3 );

// Remove comment support
function basetheme_remove_comment_support() {
  remove_post_type_support( 'post', 'comments' );
  remove_post_type_support( 'page', 'comments' );
}
add_action( 'init', 'basetheme_remove_comment_support', 100 );

// Replace admin bar greeting
function basetheme_replace_howdy_greeting( $wp_admin_bar ) {
  $my_account=$wp_admin_bar->get_node('my-account');
  $newtitle = str_replace( 'Howdy, ', '', $my_account->title );
  $wp_admin_bar->add_node( array(
    'id' => 'my-account',
    'title' => $newtitle,
  ) );
}
add_filter( 'admin_bar_menu', 'basetheme_replace_howdy_greeting', 12 );

// Remove admin bar links
function basetheme_admin_bar_render() {
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
add_action( 'wp_before_admin_bar_render', 'basetheme_admin_bar_render' );

// Remove admin menu links
function basetheme_remove_admin_menus() {
  remove_menu_page( 'edit-comments.php' );
  // remove_menu_page( 'edit.php' );
}
add_action( 'admin_menu', 'basetheme_remove_admin_menus' );

// Remove help tabs
function basetheme_remove_help_tabs() {
  $screen = get_current_screen();
  $screen->remove_help_tabs();
}
add_action('admin_head', 'basetheme_remove_help_tabs');

// Remove Gutenberg editor
add_filter('use_block_editor_for_post', '__return_false', 10);
