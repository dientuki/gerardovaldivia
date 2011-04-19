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
define('DB_NAME', 'dientuki_gerardo');

/** MySQL database username */
define('DB_USER', 'dientuki');

/** MySQL database password */
define('DB_PASSWORD', 'magoya');

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
define('AUTH_KEY',         'mb`HB{+(Jeir]T6/5nvWqV-M?Ji#,|xd{r2t)mq:um,:Em-c$/H=t6|}B#F0mZ|z');
define('SECURE_AUTH_KEY',  '}ei/|PWn|-=v;|g>g&W:]7T|+$9k!CwdJYEED<TZWRTcZsnZ1EPmgX|!PV6zpq@%');
define('LOGGED_IN_KEY',    'J&bX1*ZKk|vc+lfE?*X3t*uJ|eq8/O@!-Fh tRxlIgIBDUmXkA|`$B:JT`FE:as4');
define('NONCE_KEY',        '^d2/yeTB 5:Y(@hcz9XQV3y&7c6e[d8mE_H8_3}ln_MRFjQS7[|Jew`<[+{yhvvP');
define('AUTH_SALT',        '44P,&8mO2`_8yn3*DqSJ(]QWz=97YUO. 6_Gi,rIuwlNR#~5auT[-?*V]5B%wm(F');
define('SECURE_AUTH_SALT', 'UGE+7J/X3>e1`+c9.3q,M9p<1FJiLDrT~@k$Xu4,^+|Bg6|OL[-{#PdO@NEaKJ*a');
define('LOGGED_IN_SALT',   't6{FJS!X$Ry-Z[O^<~I2V]]<.3_m@Zk]Y=7gnjifW7|+&Ym]`W7aT|K;Q@fMM)+o');
define('NONCE_SALT',       '% tM_]1pktBPX6t-s86uGC $D7%aloVHi?+nLcqvK,>%(Jl:+|@8(EK![D(?)hx^');

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
define ('WPLANG', '');

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
