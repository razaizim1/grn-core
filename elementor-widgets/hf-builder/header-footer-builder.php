<?php
if (!defined('ABSPATH')) {
	exit; // Exit if accessed directly
}

function grownex_register_header_footer_custom_post()
{

	// Register Footer Builder Post Type
	register_post_type(
		'grownex_header',
		array(
			'labels'       => array(
				'name'                  => esc_html__('Grownex Header', 'grownexcore'),
				'singular_name'         => esc_html__('Header', 'grownexcore'),
				'add_new_item'          => esc_html__('Add New Header', 'grownexcore'),
				'all_items'             => esc_html__('All Headers', 'grownexcore'),
				'add_new'               => esc_html__('Add New', 'grownexcore'),
				'edit_item'             => esc_html__('Edit Header', 'grownexcore'),
			),
			'rewrite'      => array(
				'slug'       => 'header',
				'with_front' => true,
			),
			'hierarchical' => true,
			'public' => true,
			'show_ui' => true,
			'exclude_from_search' => true,
			'publicly_queryable' => true,
			'query_var'          => true,
			'has_archive'        => true,
			'menu_icon'    => 'dashicons-editor-kitchensink',
			'show_in_rest'    => false,
			'supports'     => array('title', 'thumbnail'),
		)
	);

	// Register Footer Builder Post Type
	register_post_type(
		'grownex_footer',
		array(
			'labels'       => array(
				'name'                  => esc_html__('Grownex Footer', 'grownexcore'),
				'singular_name'         => esc_html__('Footer', 'grownexcore'),
				'add_new_item'          => esc_html__('Add New Footer', 'grownexcore'),
				'all_items'             => esc_html__('All Footers', 'grownexcore'),
				'add_new'               => esc_html__('Add New', 'grownexcore'),
				'edit_item'             => esc_html__('Edit Footer', 'grownexcore'),
			),
			'rewrite'      => array(
				'slug'       => 'footer',
				'with_front' => true,
			),
			'hierarchical' => true,
			'public' => true,
			'show_ui' => true,
			'exclude_from_search' => true,
			'publicly_queryable' => true,
			'query_var'          => true,
			'has_archive'        => true,
			'menu_icon'    => 'dashicons-editor-kitchensink',
			'show_in_rest'    => false,
			'supports'     => array('title', 'thumbnail'),
		)
	);
}

add_action('init', 'grownex_register_header_footer_custom_post');


/**
 *  Footer Canvas
 */
function grownex_header_footer_builder_canvas()
{
	global $post;

	// Check if its a correct post type/types to apply template
	if (!in_array($post->post_type, ['grownex_footer', 'grownex_header']) || !did_action('elementor/loaded')) {
		return;
	}
	// Check that a template is not set already
	if ('' !== $post->page_template) {
		return;
	}
	// Make sure its not a page for posts
	if (get_option('page_for_posts') === $post->ID) {
		return;
	}

	//Finally set the page template
	$post->page_template = 'elementor_canvas';
	update_post_meta($post->ID, '_wp_page_template', 'elementor_canvas');
}

add_action('add_meta_boxes', 'grownex_header_footer_builder_canvas', 10);


add_action('elementor/init', function () {
	// Register the 'grownex_header' custom post type
	register_post_type('grownex_header', array(
		'labels' => array(
			'name' => __('Grownex Headers', 'elementor'),
			'singular_name' => __('Grownex Header', 'elementor'),
		),
		'public' => true,
		'has_archive' => true,
		'supports' => array('title'),
	));
	// Add Elementor support to the 'grownex_header' custom post type
	add_post_type_support('grownex_header', 'elementor');

	// Register the 'grownex_footer' custom post type
	register_post_type('grownex_footer', array(
		'labels' => array(
			'name' => __('Grownex Footers', 'elementor'),
			'singular_name' => __('Grownex Footer', 'elementor'),
		),
		'public' => true,
		'has_archive' => true,
		'supports' => array('title'),
	));
	// Add Elementor support to the 'grownex_footer' custom post type
	add_post_type_support('grownex_footer', 'elementor');
});
