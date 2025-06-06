<?php
/**
 * Plugin Name: MATE Recently Viewed Products – Cache Compatible for WooCommerce
 * Description: AJAX-powered recently viewed products for WooCommerce. Works with caching. Includes shortcode and block.
 * Version:     1.0.3
 * Author:      Alfonso Catrón
 * Author URI:  https://alfonsocatron.com
 * License:     GPLv2 or later
 * License URI: https://www.gnu.org/licenses/gpl-2.0.html
 * Text Domain: mate-recently-viewed-products
 * Domain Path: /languages
 */

if ( ! defined( 'ABSPATH' ) ) exit;

define( 'MRVP_PLUGIN_DIR', plugin_dir_path( __FILE__ ) );
define( 'MRVP_VERSION', '1.0.3' );

require_once MRVP_PLUGIN_DIR . 'includes/settings.php';
require_once MRVP_PLUGIN_DIR . 'includes/ajax.php';


add_action( 'enqueue_block_editor_assets', function() {
    wp_enqueue_script(
        'mrvp-block',
        plugins_url( 'assets/js/mrvp-block.js', __FILE__ ),
        [ 'wp-blocks', 'wp-element', 'wp-editor', 'wp-components', 'wp-i18n', 'wp-block-editor' ],
        MRVP_VERSION,
        true
    );
});

add_action( 'init', function() {
    register_block_type( 'mrvp/recently-viewed', [
        'render_callback' => 'mrvp_render_block', 
        'attributes' => [
            'title' => [ 'type' => 'string', 'default' => '' ],
            'count' => [ 'type' => 'number', 'default' => 5 ],
            'showImage' => [ 'type' => 'boolean', 'default' => true ],
            'showPrice' => [ 'type' => 'boolean', 'default' => false ],
            'showExcerpt' => [ 'type' => 'boolean', 'default' => false ],
        ],  
        'supports' => [
            'inserter' => true,
        ]
    ]);
});

function mrvp_render_block( $attributes ) {
    $title  = $attributes['title'] ?? '';
    $count  = $attributes['count'] ?? 5;
    $show_image = isset( $attributes['showImage'] ) ? (bool) $attributes['showImage'] : true;
    $show_price = isset( $attributes['showPrice'] ) ? (bool) $attributes['showPrice'] : false;
    $show_excerpt = isset( $attributes['showExcerpt'] ) ? (bool) $attributes['showExcerpt'] : false;

    return do_shortcode(
        '[mrvp_recent_products title="' . esc_attr( $title ) . '" count="' . $count . '" show_image="' . ( $show_image ? '1' : '0' ) . '" show_price="' . ( $show_price ? '1' : '0' ) . '"  show_excerpt="' . ( $show_excerpt ? '1' : '0' ) . '"]'
    );
    

}
add_action( 'wp_enqueue_scripts', 'mrvp_enqueue_inline_product_id' );

function mrvp_enqueue_inline_product_id() {
    if ( function_exists( 'is_product' ) && is_product() ) {
        wp_enqueue_script(
            'mrvp-product-id-js',
            plugins_url( 'assets/js/mrvp-product-id.js', __FILE__ ),
            [],
            MRVP_VERSION,
            true
        );

        wp_add_inline_script(
            'mrvp-product-id-js',
            'document.body.dataset.productId = "' . esc_js( get_the_ID() ) . '";'
        );
    }
}


add_action( 'wp_enqueue_scripts', 'mrvp_enqueue_frontend_css' );

function mrvp_enqueue_frontend_css() {
    wp_enqueue_style(
        'mrvp-frontend',
        plugins_url( 'assets/css/frontend.css', __FILE__ ),
        [],
        MRVP_VERSION
    );
}


add_action( 'wp_enqueue_scripts', 'mrvp_enqueue_tracker_script' );

function mrvp_enqueue_tracker_script() {
    if ( function_exists( 'is_product' ) && is_product() ) {
        wp_enqueue_script(
            'mrvp-tracker',
            plugins_url( 'assets/js/mrvp-tracker.js', __FILE__ ),
            [ 'jquery' ],
            MRVP_VERSION,
            true
        );

        // Pass max count if needed by JS
        wp_localize_script( 'mrvp-tracker', 'mrvp_ajax', [
            'max_count' => get_option( 'mrvp_number_of_products', 5 ),
        ] );

        // Output product ID into body dataset
        add_action( 'wp_footer', 'mrvp_output_product_id_script', 5 );
    }
}

function mrvp_output_product_id_script() {
    if ( get_the_ID() ) {
        echo '<script>document.body.dataset.productId = "' . esc_attr( get_the_ID() ) . '";</script>';
    }
}


