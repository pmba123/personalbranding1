<?php
/**
 * The base configuration for WordPress
 *
 * The wp-config.php creation script uses this file during the
 * installation. You don't have to use the web site, you can
 * copy this file to "wp-config.php" and fill in the values.
 *
 * This file contains the following configurations:
 *
 * * MySQL settings
 * * Secret keys
 * * Database table prefix
 * * ABSPATH
 *
 * @link https://codex.wordpress.org/Editing_wp-config.php
 *
 * @package WordPress
 */

// ** MySQL settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define( 'DB_NAME', 'pmba_dk_db' );

/** MySQL database username */
define( 'DB_USER', 'pmba_dk' );

/** MySQL database password */
define( 'DB_PASSWORD', 'Jegersej123' );

/** MySQL hostname */
define( 'DB_HOST', 'mysql91.unoeuro.com' );

/** Database Charset to use in creating database tables. */
define( 'DB_CHARSET', 'utf8' );

/** The Database Collate type. Don't change this if in doubt. */
define( 'DB_COLLATE', '' );

/**#@+
 * Authentication Unique Keys and Salts.
 *
 * Change these to different unique phrases!
 * You can generate these using the {@link https://api.wordpress.org/secret-key/1.1/salt/ WordPress.org secret-key service}
 * You can change these at any point in time to invalidate all existing cookies. This will force all users to have to log in again.
 *
 * @since 2.6.0
 */
define('AUTH_KEY',         'j[D1YX5E^Lfg:oE+Cp]Rb]#0aFsU21uF6{1/,<#/[eVv4|/oKq%RAu-06b8)D-Du');
define('SECURE_AUTH_KEY',  'Qzs^DvzoT5&<W6N-<[>IF,Hc-23=bHrLfcu:&.z-q`?BwRF2B[V|4/n]-svT;rV ');
define('LOGGED_IN_KEY',    'p^<H_:q-2F4;?l9VCO#mEe+@Mf{8X5q!Zc#O}+t>4E)CN|[#!<P)|cIu(vhC)^/x');
define('NONCE_KEY',        'eU*<x?j8Fb~~1G(jA*3Q#<h(6t5OM8<!It#:-/|zR:Y<gA,>8Z.+Be1J7A4~?%)k');
define('AUTH_SALT',        'LOO`wWe]Q-Qb+v<5EZY6j/Y[1u}&+#X-O=KW7=YN}Z1_6Qe2liTV)%eBC`N>:]i3');
define('SECURE_AUTH_SALT', 'XjAurO_RXXsuK?tq%aXF%H~f([FLH2W9EV9X~3[%718g 9W|9*yVh@:%<<d9G4>P');
define('LOGGED_IN_SALT',   '!,ATRwZaLn}VUM#$w=_R?+@`;<db>%kn5-.Y  ffX<];j#jTb4jUHg-4.<hw{MO>');
define('NONCE_SALT',       ',gQ^7e->lT,4.-x3Fjy2IVF|+^Vh[u4t/g7^HP8)5 QPV;|AO,Ku{*jXSL&U9-NJ');

/**#@-*/

/**
 * WordPress Database Table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
 */
$table_prefix = 'personalbrandingwp_';

/**
 * For developers: WordPress debugging mode.
 *
 * Change this to true to enable the display of notices during development.
 * It is strongly recommended that plugin and theme developers use WP_DEBUG
 * in their development environments.
 *
 * For information on other constants that can be used for debugging,
 * visit the Codex.
 *
 * @link https://codex.wordpress.org/Debugging_in_WordPress
 */
define( 'WP_DEBUG', false );

/* That's all, stop editing! Happy publishing. */

/** Absolute path to the WordPress directory. */
if ( ! defined( 'ABSPATH' ) ) {
	define( 'ABSPATH', dirname( __FILE__ ) . '/' );
}

/** Sets up WordPress vars and included files. */
require_once( ABSPATH . 'wp-settings.php' );
