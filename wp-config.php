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
define('DB_NAME', 'reliakfq_dbr');

/** MySQL database username */
define('DB_USER', 'reliakfq_usr');

/** MySQL database password */
define('DB_PASSWORD', 'GiW4*R6^H');

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
define('AUTH_KEY',         '(dqDxLogf?~5QE<2G*>qp<xanz=Ayhdz&Wq$yZLB_Z5=2_m(p$68JpDJ5E;!RTF]');
define('SECURE_AUTH_KEY',  'd)y:X%m[3{h-z]tXR,/Ka>bHr6RrOYXD`QiSgkJXRgTzmecuV1eAZG]/L2i%aA;a');
define('LOGGED_IN_KEY',    'tesd<aEkuF64?G:AtUx3M9or||L+^yg$UY,M~Z22z>9P~1-RYBwfanD#EqPO=Q[q');
define('NONCE_KEY',        'Y(XPO`(msQl4?Qgtvno(({kZw>rca/XN8s<Y.Q,HqrZ|d)hcH~A]$J/y}$tQ$lgf');
define('AUTH_SALT',        'naI?I@fwu-bc0?*@TdA_<9]#7ud9s*T>tm|)F2Gken,7K]P[XwtR{;SL=O(FE*Ck');
define('SECURE_AUTH_SALT', '6o 2th3k*nqZqZt&dW*I@o^KPCY2b9^^:C[wz<q4om=W1,{5Rv)*4fs$Z>)<ORWA');
define('LOGGED_IN_SALT',   '<0-KIr^QDev_%rc)9w90[(y$@C5]MEta9SB@PKOy:Y-m,S5uY^1$~[7,{Go:v2*1');
define('NONCE_SALT',       'GOXEfa%Octc33#cw[^L]8egh7MyOIrL`<ZUYIFE-{fJsU0$6L2!u].h5=yv:n)pM');

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
