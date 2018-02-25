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
define('DB_NAME', 'fun');

/** MySQL database username */
define('DB_USER', 'root');

/** MySQL database password */
define('DB_PASSWORD', '');

/** MySQL hostname */
define('DB_HOST', 'localhost');

/** Database Charset to use in creating database tables. */
define('DB_CHARSET', 'utf8mb4');

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
define('AUTH_KEY',         '>_n%m=Mw2|KQ>xj/6?<FF<IyZmgU,&%n9iu(1xV*3m2e3HxrAmJ+XI{cNu6au%Du');
define('SECURE_AUTH_KEY',  '`2m8`Vb&`WTo^%m#FJ{2 ^49*$-Ng6[i/,7h5P{~{D%lXV9BJB[F{UNy}(.jf+8]');
define('LOGGED_IN_KEY',    'A#:GRD*d4s!5|J:D4dO_j!uT83M0LHU^eo*B,u_6hvdzn&M|]|K&EWZ(#lHb=s7M');
define('NONCE_KEY',        'KE%V(Zj+&%)y042hb}R:Y v!,?!Rq&?Ii z-I@S!p/4v,dxD;tP}z^C|mi1V%(o:');
define('AUTH_SALT',        '{RR%#8Dw?bFGpA,;(eRXb3QDg<45QGp_e`LsIm_H(K<`:-6ctb)YA+UI]W~gv6i&');
define('SECURE_AUTH_SALT', 'C@QuUD0~?ZDPj(GaColAg _UX#E_dkc@%uM1vWvpg(&}h=`S~[K_Ets^iWRGPn[U');
define('LOGGED_IN_SALT',   'wZ~E/hN%HKTG|^H4N8]<4}U{xb^/Uv`x|Y#L4&F]Gz[ZOv/GIkJlJr*]|AhIA*BB');
define('NONCE_SALT',       'tZ?<w,Z,(*`K(5MqQg+.b[O[PR$9x[ki%aV{PNr<|5|(c5UHO|q+K2tV[.0{Pa/)');

/**#@-*/

/**
 * WordPress Database Table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
 */
$table_prefix  = 'wp_';

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
define('WP_DEBUG', false);

/* That's all, stop editing! Happy blogging. */

/** Absolute path to the WordPress directory. */
if ( !defined('ABSPATH') )
	define('ABSPATH', dirname(__FILE__) . '/');

/** Sets up WordPress vars and included files. */
require_once(ABSPATH . 'wp-settings.php');
