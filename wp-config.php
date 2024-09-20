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
 * * Database settings
 * * Secret keys
 * * Database table prefix
 * * ABSPATH
 *
 * @link https://wordpress.org/documentation/article/editing-wp-config-php/
 *
 * @package WordPress
 */

// ** Database settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define( 'DB_NAME', 'safwa' );

/** Database username */
define( 'DB_USER', 'root' );

/** Database password */
define( 'DB_PASSWORD', '' );

/** Database hostname */
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
define( 'AUTH_KEY',         '?:WMiB<WS*yZ]QDuq|Qz)r@70h[aY=Cn_I{%<>r}7*)_zH8CS<u!9Fi%f%ncaC#2' );
define( 'SECURE_AUTH_KEY',  '!.&%KL%8BIGG0x.ZVDyB*;T:^9Gl/@7,pk_v7~ulA3Au^F+u+t*%m>mX>7y`KboN' );
define( 'LOGGED_IN_KEY',    'cyPF$a6HC^xI6VFvE{Mv}zwNZ8&?L1G$qEA(DKvcy?ipBan<:TVb85-fDVk+beL9' );
define( 'NONCE_KEY',        'v2U:b,Se^&5Ff6#0jlTk0Bw;M:9k@bp7mBh[UM7?&MI2ay1[44Ko=}{wft3LWnrc' );
define( 'AUTH_SALT',        '@_DbZzZtr xQeWH.cLqp )]C6Z@}bHTD}8jw?u!LDtb97ZM.Ff9Y,9Z!`mN0I[YW' );
define( 'SECURE_AUTH_SALT', '&F@ZiEoKsH;!1j/f;#h>J XwMSz^?X4C%P|:2{r;S^quP8+-U|}+7nOFdmu4WSp<' );
define( 'LOGGED_IN_SALT',   'ypK[z%%$TQu>P KO8YGWU#Ma;U)Z3Qu_M|M$K{L3/]T|nXk&T(%P[S`7qRY6gCYT' );
define( 'NONCE_SALT',       'RDe+F20&i~bX- W1~]eV3CD-nNZ<<qECEyVvPr~zn.Szpa<+Yvtyr6+?f]eyd,~H' );

/**#@-*/

/**
 * WordPress database table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
 */
$table_prefix = 'saw_';

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
 * @link https://wordpress.org/documentation/article/debugging-in-wordpress/
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
