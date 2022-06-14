<?php
/**
 * The base configuration for WordPress
 *
 * The wp-config.php creation script uses this file during the installation.
 * You don't have to use the web site, you can copy this file to "wp-config.php"
 * and fill in the values.
 *
 * This file contains the following configurations:
 *
 * * MySQL settings
 * * Secret keys
 * * Database table prefix
 * * ABSPATH
 *
 * @link https://wordpress.org/support/article/editing-wp-config-php/
 *
 * @package WordPress
 */

// ** MySQL settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define( 'DB_NAME', 'education' );

/** MySQL database username */
define( 'DB_USER', 'root' );

/** MySQL database password */
define( 'DB_PASSWORD', '' );

/** MySQL hostname */
define( 'DB_HOST', 'localhost' );

/** Database charset to use in creating database tables. */
define( 'DB_CHARSET', 'utf8mb4' );

/** The database collate type. Don't change this if in doubt. */
define( 'DB_COLLATE', '' );

/**#@+
 * Authentication unique keys and salts.
 *
 * Change these to different unique phrases! You can generate these using
 * the {@link https://api.wordpress.org/secret-key/1.1/salt/ WordPress.org secret-key service}.
 *
 * You can change these at any point in time to invalidate all existing cookies.
 * This will force all users to have to log in again.
 *
 * @since 2.6.0
 */
define( 'AUTH_KEY',         'K%3Q%Ie?mrE|3r.M0|>8qS+uPkRM7JAVI5Sc]!dsbc)V iPA-uZ;`tR.r+F 1]>S' );
define( 'SECURE_AUTH_KEY',  'a8<C:b>e8bNJT0{2kw?vg[RsK?kl(RJ|kq,eF7h8h6gcGH,(7J@xh|3xq0K,Ddbo' );
define( 'LOGGED_IN_KEY',    's?n%loxv;@_?]$$yW6Q_7H+`*:GHCW +}YOpm-D~k~shA/HI*8VFGO-bPz#gw<?F' );
define( 'NONCE_KEY',        'bEFcU,ooZ-)LL-MS_x8PVs%HJXRi&VLk?(a+H%FjkL??J~]#y%pcKY8QK};i41{?' );
define( 'AUTH_SALT',        'UKHTd8(#>1Y6dx 6 ez!a7q#`r RQu@=rBiA/14t!V<{33>|.&cr>h_^,_KgBL^7' );
define( 'SECURE_AUTH_SALT', 'L{ AmLI3W(C6E?C<HGxXCKIV/O>/3hNDHVG<^jE#?k=2:%p]mwm{0ryJN`Oh7-_n' );
define( 'LOGGED_IN_SALT',   'CRW+JlZUWJ:Jx!+VD-3q=)c =(|bUS?F{%5PC&Ayc~${L8j1Dzkq3%aHd,B5S_fG' );
define( 'NONCE_SALT',       ')i%u+^V:$BFZL%.+ Znu9_L+`=iqF/2~eo|l,0@?P)Q^:PrGTMZ|aT8iwI6wP[YY' );

/**#@-*/

/**
 * WordPress database table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
 */
$table_prefix = 'wp_';

/**
 * For developers: WordPress debugging mode.
 *
 * Change this to true to enable the display of notices during development.
 * It is strongly recommended that plugin and theme developers use WP_DEBUG
 * in their development environments.
 *
 * For information on other constants that can be used for debugging,
 * visit the documentation.
 *
 * @link https://wordpress.org/support/article/debugging-in-wordpress/
 */
define( 'WP_DEBUG', false );

/* Add any custom values between this line and the "stop editing" line. */



/* That's all, stop editing! Happy publishing. */

/** Absolute path to the WordPress directory. */
if ( ! defined( 'ABSPATH' ) ) {
	define( 'ABSPATH', __DIR__ . '/' );
}

/** Sets up WordPress vars and included files. */
require_once ABSPATH . 'wp-settings.php';
