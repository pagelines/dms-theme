<?php
/*
 *	Tell DMS we are in a subfolder and fire up the flux capacitors!
**/
if( ! defined( 'DMS_CORE' ) )
	define( 'DMS_CORE', true );

require_once( 'dms/functions.php' );

// Lets suggest a few plugins..
dms_suggest_plugin( 'Contact Form 7', 'contact-form-7', 'Contact Form 7 can manage multiple contact forms, plus you can customize the form and the mail contents flexibly with simple markup.<br />The form supports Ajax-powered submitting, CAPTCHA, Akismet spam filtering and so on.' );

dms_suggest_plugin( 'WordPress SEO', 'wordpress-seo', 'Improve your WordPress SEO: Write better content and have a fully optimized WordPress site using the WordPress SEO plugin by Yoast.' );

dms_suggest_plugin( 'WooCommerce - excelling eCommerce', 'woocommerce', 'WooCommerce is a powerful, extendable eCommerce plugin that helps you sell anything. Beautifully.' );


/**
 * Fix uploader issues with DMS2 and WP 4.3 jQuery temporary patch
 */
add_action( 'wp_enqueue_scripts', 'fix_jquery_for_dms_theme' );
function fix_jquery_for_dms_theme() {
	if( ! is_admin() && function_exists( 'pl_draft_mode' ) && pl_draft_mode() ){
		wp_deregister_script('jquery');
		wp_register_script('jquery', ("http://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.js"), false, '1.11.2');
		wp_enqueue_script('jquery');
	}
}
