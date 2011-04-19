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
define('DB_NAME', 'gvaldivia_blog');

/** MySQL database username */
define('DB_USER', 'gvaldivia');

/** MySQL database password */
define('DB_PASSWORD', 'gerardo');

/** MySQL hostname */
define('DB_HOST', 'localhost');

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
define('AUTH_KEY',         '@&]:js+92cVeVLyoqwc blFWZ[zt!Wj@]O#cwaz7f{N]3oleq%}[:|ZHUK(FZ2K&');
define('SECURE_AUTH_KEY',  '?`N.l}-HY+ (Yp0qC,R}(#i>^xoWjs .dYA7HCB!zerb^A0yJvRg>8>xzJB`U3T:');
define('LOGGED_IN_KEY',    'xD`@k*{X,mY~)DjPm <daMO5W+ 5NKv)o{)DAm?Ro|ACr?~1-S6l?rY>bQb1q3A^');
define('NONCE_KEY',        '&?BB--dE?si-v ^-,p|lu[^Jw+)!*Y5@FJrl4?eeN+#TbV=]t08mO?Jf6OG)$/=+');
define('AUTH_SALT',        'e,-I+vSDCOc@lc09E9-86,~|?e~gx+]^=A5zvd+*rdw;fU5Zq&I6TI~R/0h^:i<Y');
define('SECURE_AUTH_SALT', '$Zo>G3/f;HP-wYsfWf`M9O-24A>k<@UO3Bt;|nM|Ih0|:w+dLQiyCXFZIJu;;&N(');
define('LOGGED_IN_SALT',   '^eoN_BP+#CDq97=D13%@ <]r!2)*qU?3r-^0b1e-nT>bZZcc4%kgTg:t-O._j&1|');
define('NONCE_SALT',       '^e<8q<yx-yhxjZf){^+RBB.Km^hL{t/45>g9NTP?hIv[Cx(GciGBoP9c+^oU_|#v');

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
 * Change this to localize WordPress.  A corresponding MO file for the chosen
 * language must be installed to wp-content/languages. For example, install
 * de.mo to wp-content/languages and set WPLANG to 'de' to enable German
 * language support.
 */
define ('WPLANG', 'es_ES');

/**
 * For developers: WordPress debugging mode.
 *
 * Change this to true to enable the display of notices during development.
 * It is strongly recommended that plugin and theme developers use WP_DEBUG
 * in their development environments.
 */
define('WP_DEBUG', false);
define("WP_CACHE", true);


/* That's all, stop editing! Happy blogging. */

/** Absolute path to the WordPress directory. */
if ( !defined('ABSPATH') )
	define('ABSPATH', dirname(__FILE__) . '/');

/** Sets up WordPress vars and included files. */
require_once(ABSPATH . 'wp-settings.php');

