<?php
/*
Plugin Name: WordPress Version Number in Footer
Plugin URI: http://wordpress.org
Description: Show current WordPress Version Number in Admin Footer
Author: alpipego
Version: beta
Author URI: http://alpipego.com/
*/

add_filter( 'update_footer', 'version_in_footer', 11 );

function version_in_footer() {
	$update     = core_update_footer();
	$wp_version = strpos( $update, '<strong>' ) === 0 ? get_bloginfo( 'version' ) . ' (' . $update . ')' : get_bloginfo( 'version' );

	$mysqli       = new mysqli( DB_HOST, DB_USER, DB_PASSWORD );
	$mysql_server = explode( '-', mysqli_get_server_info( $mysqli ) );
	$mysqli->close();

	return sprintf( 'You are running WordPress %s  | PHP %s | %s | MySQL %s', $wp_version, phpversion(), $_SERVER['SERVER_SOFTWARE'], $mysql_server[0] );
}
