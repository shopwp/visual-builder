<?php
/**
 * Plugin Name:  WP Shopify Visual Builder
 * Description:  A Gutenberg powered Visual Builder for WP Shopify
 * Version:      0.0.1
 * Plugin URI:   https://wpshop.io
 * Author:       WP Shopify
 * Author URI:   https://wpshop.io
 * Text Domain:  query-monitor
 * Domain Path:  /languages/
 * Requires PHP: 5.3.6
 */

defined( 'ABSPATH' ) || die();


function wp_shopify_visual_builder_register_post_type() {
error_log('----- wp_shopify_visual_builder_register_post_type 1 -----');
   // if (!is_admin()) {
   //    error_log('----- wp_shopify_visual_builder_register_post_type 2 -----');
   //    exit;
   // }

   if (post_type_exists('wp_shopify_visual_builder')) {
      return;
   }

   register_post_type(
      'wps_visual_builder',
      [
         'label' => __('Shopify Visual Builder', 'wpshopify'),
         'description' => __('CPT to enable the WP Shopify Visual Builder', 'wpshopify'),
         'supports' => [
               'editor'
         ],
         'hierarchical' => false,
         'public' => true,
         'show_ui' => true,
         'show_in_menu' => true,
         'menu_position' => 100,
         'menu_icon' => 'dashicons-megaphone',
         'show_in_admin_bar' => true,
         'show_in_nav_menus' => true,
         'can_export' => false,
         'has_archive' => false,
         'exclude_from_search' => false,
         'publicly_queryable' => false,
         'capability_type' => 'post',
         'rewrite' => false,
         'show_in_rest' => true
      ]
   );
}



function wp_shopify_visual_builder_scripts() {
   wp_enqueue_script(
                'wpshopify-visual-builder-js',
                plugins_url( 'index.js' , __FILE__ ),
                [
                    'wp-blocks',
                    'wp-element',
                    'wp-editor',
                    'wp-components',
                    'wp-i18n',
                ],
                '',
                true
            );
}

function wp_shopify_visual_builder_styles() {
   wp_enqueue_style('wpshopify-visual-builder-css', plugins_url( 'style.css' , __FILE__ ), []);
}


 
function wp_shopify_visual_builder_allowed_block_types( $allowed_blocks ) {
 
	return [
		'wpshopify/single-product',
		'wpshopify/products',
      'wpshopify/buy-button'
   ];
 
}

function Bootstrap() {

   add_action('init', 'wp_shopify_visual_builder_register_post_type' );
   add_action('admin_enqueue_scripts', 'wp_shopify_visual_builder_scripts');
   add_action('admin_enqueue_scripts', 'wp_shopify_visual_builder_styles');
   add_filter('allowed_block_types', 'wp_shopify_visual_builder_allowed_block_types' );

}

Bootstrap();