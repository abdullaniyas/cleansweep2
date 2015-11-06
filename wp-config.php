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
define('DB_NAME', 'cleansweep');
//define('DB_NAME', 'exteriom_');
/** MySQL database username */
define('DB_USER', 'root');
//define('DB_USER', 'exteriom');
/** MySQL database password */
define('DB_PASSWORD', '');
//define('DB_PASSWORD', 'daakini986');
/** MySQL hostname */
define('DB_HOST', 'localhost');
//define('DB_HOST', '182.50.133.81:3306');
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
define('AUTH_KEY',         ';e|V$uNRA| XNbR^|89<5[u~0%@mzGL{qC`d>QX=6]iE^R5Y>.Mq-=/fU3NO9{q~');
define('SECURE_AUTH_KEY',  ':A@6}RGeO8LZ.Y7rv.xf(8s$;{p6-6/Bszo7TMUaLtGR-IB#f@dY--n:bS`7gGz:');
define('LOGGED_IN_KEY',    'M|dM_`3)g<UVA+D:BK-,z?%AQAupGSWH?2F]U?JaT;f-uw0,Qsh/?t8~D/8N+eEI');
define('NONCE_KEY',        '^FStt;{5|;KL9*kd4/4mAbU_+/sWlWQA:IgDW#ffSzm%d-YI>b!r$JnyZN?I+jbw');
define('AUTH_SALT',        '/$x|/treq8nE!<W9zK#=`Pmiz^?/>bhv9usws>0B`<?k2Q_TE($I]xyX%k96h+2u');
define('SECURE_AUTH_SALT', ' h>MC4cv~O46 Q?/g;&u*p_xG|76XJOv<E@CX%nhh&U7NZX{p>?K{R+o>!2gMp<U');
define('LOGGED_IN_SALT',   '(gi}pA9tdt.M?wo$sTY?R2>`[cdzR/yP]0g pTJ@|qks+o1<dQZhd3[Bru>M,{AN');
define('NONCE_SALT',       'Owb2uE$v%M+pX`8`gvTGOK]i- @ilG@ 8b/b9M1$dUrLz,M`&Zq,X`JJ54ag,;u{');

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
