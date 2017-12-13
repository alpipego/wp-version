<?php

$conf = array_merge(
	json_decode( file_get_contents( dirname( __FILE__ ) . '/config/default.json' ), true ),
	json_decode( file_get_contents( dirname( __FILE__ ) . '/config/env.json' ), true )
);

if ( defined( 'E_DEPRECATED' ) ) {
	error_reporting( E_ALL ^ E_DEPRECATED );
} else {
	error_reporting( - 1 );
}

/**
 * DB Settings
 */
define( 'DB_NAME', $conf['connection']['wp']['db'] );
define( 'DB_USER', $conf['connection']['wp']['user'] );
define( 'DB_PASSWORD', $conf['connection']['wp']['password'] );
define( 'DB_HOST', $conf['connection']['wp']['host'] );
define( 'DB_CHARSET', $conf['connection']['wp']['charset'] );
define( 'DB_COLLATE', $conf['connection']['wp']['collate'] );
$table_prefix = $conf['connection']['wp']['tablePrefix'];

/**
 * Authentication Unique Keys and Salts.
 */
define( 'AUTH_KEY', 'YA_r<.mqr;BCufQjOI|kN&F)oi>[M>1]jl%-(ut;A?m,tExsTHI*52-|pF~X&pb+' );
define( 'SECURE_AUTH_KEY', 'fymsS#t1m[l;+d&+y4-K<xKl^X+nAu!OMLBebwZ2M7Ks1U_b|A*#C|j(-`lZ_ Kf' );
define( 'LOGGED_IN_KEY', 'YgQa[-{|,zMZ`#0hZnah*BC}L];j^UNNW*IMdvcyxD)fYc&SpT!=6Sd{rzYb/)gh' );
define( 'NONCE_KEY', 'JOB_krQ^Pq3%w/!87rb-w=IW8T<otZm $0n3D*tVFjN}+h*@94%g4<^a)Hn<[S>b' );
define( 'AUTH_SALT', '7`p@OI)6t49]$,h|,+?4EpnjZ!SDm46h tB`u,fy,L_Wn)Xl}@ba!nE&UJ!C@~`V' );
define( 'SECURE_AUTH_SALT', 'f8FK@BF3km;7xBKsh7r80`<O2Z(rg*KwRfpb&`h+/]:UBP||+FQU31AM #23U&MN' );
define( 'LOGGED_IN_SALT', 'u_K/psCX}-d}hmD{)]ts(lRfrsB+^+^dFxVdg0^g(mpc/,?-jCqP>r;Iv46?7(,{' );
define( 'NONCE_SALT', 'fi1wZ6 *P#XH|wa1^%[~Mk26H(d%hdf):fZ<w-Sz-[&@re!Y}e+>q-,$@K.F%XDS' );

/**
 * WordPress debugging mode.
 */
define( 'WP_DEBUG', true );
define( 'SAVEQUERIES', true );
define( 'WP_DEBUG_DISPLAY', true );
define( 'DISABLE_CACHE', true );
ini_set( 'error_log', dirname(__FILE__) . '/log/wp.log' ); // instead of WP_DEBUG_LOG constant to change path

/**
 * Folder Structure
 */
if ( ! defined( 'ABSPATH' ) ) {
	define( 'ABSPATH', dirname(__FILE__) . '/' );
}

define( 'WP_SITEURL', $conf['url'] . 'wordpress/' );
define( 'WP_HOME', $conf['url'] );

define( 'WP_CONTENT_FOLDERNAME', 'wp-content' );
define( 'WP_CONTENT_DIR', ABSPATH . '../' . WP_CONTENT_FOLDERNAME );
define( 'WP_CONTENT_URL', WP_HOME . WP_CONTENT_FOLDERNAME );

