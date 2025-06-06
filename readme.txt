=== MATE Recently Viewed Products – Cache Compatible for WooCommerce ===
Contributors: alfonso100  
Tags: woocommerce, recently viewed, cache, products, block  
Requires at least: 5.0  
Tested up to: 6.8  
Requires PHP: 7.2  
Stable tag: 1.0.3  
License: GPLv2 or later  
License URI: https://www.gnu.org/licenses/gpl-2.0.html  

Display recently viewed WooCommerce products via AJAX and cookies. Works with caching. Includes a customizable block and shortcode.

== Description ==

MATE Recently Viewed Products lets you show WooCommerce products the customer recently visited — even when full-page caching is active.

It uses cookies to store visited products and loads the display using AJAX, so it's fully compatible with caching plugins like WP Rocket, W3 Total Cache, and others.

You can display products anywhere using a shortcode or a Gutenberg block. Both the block and shortcode allow you to override global settings on a per-instance basis.

== Features ==

- Cookie-based product tracking
- Fully AJAX-loaded: works with full-page cache
- Gutenberg block and classic shortcode
- Settings page to configure global defaults
- Per-block customization (title, number, image, price, excerpt, spinner)
- Layout-friendly and responsive design
- Works with all WooCommerce themes

== Installation ==

1. Upload the plugin folder to `/wp-content/plugins/`
2. Activate the plugin via WP Admin > Plugins
3. Go to **Settings > MATE – Recently Viewed Products** to configure global defaults
4. Use the `[mrvp_recent_products]` shortcode or insert the **MATE Recently Viewed Products** block in the block editor

== Shortcode ==

You can use the `[mrvp_recent_products]` shortcode anywhere. Optional attributes:

[mrvp_recent_products
	count="5"
	title="Recently Viewed"
	show_price="1"
	show_excerpt="0"
	show_image="1"
	show_spinner="1"
	show_widgettitle="1"
]

== Block ==

The MATE Recently Viewed Products block includes these settings:

- Title
- Number of products
- Show product image (checkbox)
- Show price (checkbox)
- Show excerpt (checkbox)
- Show spinner while loading (checkbox)
- Show block title (checkbox)
- Each block instance can override global settings.

== Frequently Asked Questions ==

= Is it Free? =
Yes. This plugin is free, all the features are included in the free version, it doesn't require a pro subscription or membership.

= Does it work with caching plugins? =
Yes. Since product lists are loaded via AJAX using a cookie, this plugin works even when full-page caching is enabled.

= Can I use it multiple times on the same page? =
Yes! Each instance will load and behave independently with its own settings.

= Where are the products stored? =
They’re stored in a browser cookie (mrvp_recently_viewed) and loaded dynamically using JavaScript.

== Changelog ==

= 1.0.3 =
- Changed the tracking logic so the products can be tracked even on pages where the widget is not present

= 1.0.2 =
- Added a fix to check if is_product() is defined, to avoid an error if WooCommerce is not installed

= 1.0.1 =
- Moved inline JavaScript and CSS to properly enqueued files
- Improved WordPress.org compliance for plugin review
- Added direct access protection to PHP files

= 1.0.0 =
Initial release: includes shortcode, Gutenberg block, and global settings page.


== Screenshots ==

1. Recently viewed products displayed using the block.
2. Block settings in the Gutenberg editor.
3. Global plugin settings page.