<?php
/**
 * Uninstall Githuber MD plugin.
 *
 * @author Terry Lin
 * @link https://terryl.in/githuber
 *
 * @package Githuber
 * @since 1.0.0
 * @version 1.0.1
 */

// if uninstall.php is not called by WordPress, die.
if ( ! defined( 'WP_UNINSTALL_PLUGIN' ) ) {
	die;
}
 
$options_names = array(
	'gihuber_markdown',
	'githuber_modules',
	'githuber_options',
);

foreach ( $options_names as $option_name ) {
	delete_option( $option_name );
	delete_site_option( $option_name );
}

$post_meta_keys = array(
	'_is_githuber_markdown',
	'_githuber_prismjs',
	'_is_githuber_sequence',
	'_is_githuber_flow_chart',
	'_is_githuber_katex',
);

// Remove all post_meta generated by Githuber MD.
foreach ( $post_meta_keys as $meta_key ) {
	delete_post_meta_by_key( $meta_key );
}

// enable rich text.
add_filter( 'user_can_richedit', '__return_true' );

// drop a custom database table
// global $wpdb;
//$wpdb->query("DROP TABLE IF EXISTS {$wpdb->prefix}mytable");