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
	return sprintf('You are running WordPress %s and <a href="%s">PHP %s</a> | %s', get_bloginfo('version'), get_bloginfo('url') . '/info.php', phpversion(), $_SERVER['SERVER_SOFTWARE']);
}
