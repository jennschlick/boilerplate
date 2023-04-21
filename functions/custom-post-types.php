<?php
/*-----------------------------------------------------------------------------------*/
/* Custom Post Types
/*-----------------------------------------------------------------------------------*/

function boilerplate_custom_post_types() {

	// Example
	// $labels = array(
	// 	'name' => __('Example'),
	// 	'singular_name' => __('Example'),
	// 	'add_new' => __('Add New'),
	// 	'add_new_item' => __('Add'),
	// 	'edit_item' => __('Edit'),
	// 	'new_item' => __('Add'),
	// 	'view_item' => __('View'),
	// 	'search_items' => __('Search'),
	// 	'not_found' =>  __('Nothing found'),
	// 	'not_found_in_trash' => __('Nothing found'),
	// 	'parent_item_colon' => ''
	// );
	// $args = array(
	// 	'labels' => $labels,
	// 	'public' => false,
	// 	'publicly_queryable' => true,
	// 	'menu_icon' => 'dashicons-admin-page',
	// 	'show_ui' => true,
	// 	'query_var' => false,
	// 	'rewrite' => array('slug' => 'project'),
	// 	'capability_type' => 'post',
	// 	'hierarchical' => false,
	// 	'show_in_rest' => true,
	// 	'supports' => array('title','editor','thumbnail','revisions'),
	// 	'has_archive' => false
	// );
	// register_post_type('example', $args);

}

add_action('init', 'boilerplate_custom_post_types');