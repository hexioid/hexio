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
define( 'WP_HOME', 'http://hexio.id/landing' );
define( 'WP_SITEURL', 'http://hexio.id/landing' );
define( 'WP_CONTENT_URL', 'http://hexio.id/landing/wp-content');

// ** MySQL settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define('DB_NAME', 'wp_hexio');

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
define('AUTH_KEY',         '0=nRyF[X<#soj:[,Qeaxu![6Ol5_L9:/Hay,w9(HBum6CVOvG5v(T hP!yW><_,i');
define('SECURE_AUTH_KEY',  ' TJ3!at~O1M[*to{fF&nmo.&ST{rUj]QZqk]c1M#kWskgKK[&|fLmr+C.XBuzI)u');
define('LOGGED_IN_KEY',    'FHZHy2ks]+3H|.!Fc`Z,I#^/H!vybDqMo35PMw-??/S5U.vzy*|r>$)r{m&7mWZu');
define('NONCE_KEY',        'bxfwo<lBMY@/c9/jts0hd(Q(|Sp|oADNv@Ws.f6ex<JhM{RDqK.R6z?uLsZitxV:');
define('AUTH_SALT',        '@x)lN66/BTOMwEOpEw]<G}rMvV|[,9k?R>E7im3G{n*-x>wI._^@{_8@0ln1bV<1');
define('SECURE_AUTH_SALT', ':`6ZcXBav>sAzkKo$/TNx92r;6ERzBdXBM6lctl:(w;@dNH7TC3D#.z[-o#+HHqT');
define('LOGGED_IN_SALT',   '&y2?)ME^>nU/bJ`bKteAjKmK*sU;Rt^)B0Rr^}=0N1Vw;;/XTOA}g9_DS&=zmzF-');
define('NONCE_SALT',       'n*@PABg yd6r>$tL`sgEi8G_N^ff+5a#u1J#aUiVi ty0JPaEMx-:Z7 ppUd_9sP');

/**#@-*/

/**
 * WordPress Database Table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
 */
$table_prefix  = 'wpportfolio_';

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
