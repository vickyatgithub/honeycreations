<?php
/**
 * The base configurations of the WordPress.
 *
 * This file has the following configurations: MySQL settings, Table Prefix,
 * Secret Keys, WordPress Language, and ABSPATH. You can find more information
 * by visiting {@link http://codex.wordpress.org/Editing_wp-config.php Editing
 * wp-config.php} Codex page. You can get the MySQL settings from your web host.
 *
 * This file is used by the wp-config.php creation script during the
 * installation. You don't have to use the web site, you can just copy this file
 * to "wp-config.php" and fill in the values.
 *
 * @package WordPress
 */

// ** MySQL settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define('DB_NAME', 'honeycreations');

/** MySQL database username */
define('DB_USER', 'root');

/** MySQL database password */
define('DB_PASSWORD', 'root#123');

/** MySQL hostname */
define('DB_HOST', '127.0.0.1');

/** Database Charset to use in creating database tables. */
define('DB_CHARSET', 'utf8');

/** The Database Collate type. Don't change this if in doubt. */
define('DB_COLLATE', '');

/**#@+
 * Authentication Unique Keys and Salts.
 *
 * Change these to different unique phrases!
 * You can generate these using the {@link https://api.wordpress.org/secret-key/1.1/salt/ WordPress.org secret-key service}
 * You can change these at any point in time to invalidate all existing cookies. This will force all users to have to log in again.
 *
 * @since 2.6.0
 */
define('AUTH_KEY',         '[Bqi6.m|al`m:0gh-ZEaIL:|J8XW*U;J|%nmY$=7>0^h&H7s{73ek>/`cWaO)r66');
define('SECURE_AUTH_KEY',  'c3BfkkZ?k!H!Pr}D21x)AG[7?0BtzDx~DHL|sD8FJtl#FL!KH]&Sce@du~V3OMRE');
define('LOGGED_IN_KEY',    'w5/ Zw88xou`G(3b.{9#aeMb9fUC,({l72I]v?{ZyJJXX%F-2Sk.W}a</b*RdkF=');
define('NONCE_KEY',        ')^e-K6,UQ&}:4n-u}-dMOi]5D#,GFSb/}j1[^^<hLk?0FJCg&d.w9w@2$y]JT!(n');
define('AUTH_SALT',        '|.J#J!e{$$KtFI>suBnXhRwwY7QoFCF~m-z%Y!Go#ri0Yeq9ox9bG,_4%FG2T{tM');
define('SECURE_AUTH_SALT', 'MP*kmc-jMoS._MS|$yK3GA>9j5kR:>f>|!hVsX%&YU+o*e/0#<!HZG)Kn|uOBV5r');
define('LOGGED_IN_SALT',   'Zr`^lmC-=O4%y|{3^y$-~{*&jus^{.imL,D)dnL_+B]Z,6zrP8j*^8xS;fHVr52G');
define('NONCE_SALT',       '<9<xnsKSB%T(38TW+6?9=ZzT?215o[D/?pj=mpJ44*Axd9$Vbg,(Xv{VKmITkjE>');

/**#@-*/

/**
 * WordPress Database Table prefix.
 *
 * You can have multiple installations in one database if you give each a unique
 * prefix. Only numbers, letters, and underscores please!
 */
$table_prefix  = 'wp_';

/**
 * WordPress Localized Language, defaults to English.
 *
 * Change this to localize WordPress. A corresponding MO file for the chosen
 * language must be installed to wp-content/languages. For example, install
 * de_DE.mo to wp-content/languages and set WPLANG to 'de_DE' to enable German
 * language support.
 */
define('WPLANG', '');

/**
 * For developers: WordPress debugging mode.
 *
 * Change this to true to enable the display of notices during development.
 * It is strongly recommended that plugin and theme developers use WP_DEBUG
 * in their development environments.
 */
define('WP_DEBUG', false);

/* That's all, stop editing! Happy blogging. */

/** Absolute path to the WordPress directory. */
if ( !defined('ABSPATH') )
	define('ABSPATH', dirname(__FILE__) . '/');

/** Sets up WordPress vars and included files. */
require_once(ABSPATH . 'wp-settings.php');
