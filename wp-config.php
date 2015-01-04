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

if (file_exists(dirname(__FILE__) . '/wp-config-local.php')) {
    define('WP_ENV', 'local');
    include( dirname(__FILE__) . '/wp-config-local.php' );
} else {

// ** MySQL settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define('DB_NAME', 'bds_digital_portfolio');

/** MySQL database username */
define('DB_USER', 'bds-portfolio');

/** MySQL database password */
define('DB_PASSWORD', 'hsjjdhheui)oa');

/** MySQL hostname */
define('DB_HOST', 'localhost');

/** Database Charset to use in creating database tables. */
define('DB_CHARSET', 'utf8');

/** The Database Collate type. Don't change this if in doubt. */
define('DB_COLLATE', '');

define('WP_HOME', 'http://www.bryan-slop.nl');
define('WP_SITEURL', 'http://www.bryan-slop.nl/wp'); // Please don't forget the /wp at the end!
}


// ========================
// Custom Content Directory
// ========================
define('WP_CONTENT_DIR', dirname(__FILE__) . '/content');
define('WP_CONTENT_URL', 'http://' . $_SERVER['HTTP_HOST'] . '/content');

/**#@+
 * Authentication Unique Keys and Salts.
 *
 * Change these to different unique phrases!
 * You can generate these using the {@link https://api.wordpress.org/secret-key/1.1/salt/ WordPress.org secret-key service}
 * You can change these at any point in time to invalidate all existing cookies. This will force all users to have to log in again.
 *
 * @since 2.6.0
 */
define('AUTH_KEY',         'uN7/zU/rptSc~pJ22`3s+=>;wh-XPT1d]+Q$6g=>ImrV({ceyX>)gwL*}e1beQuw');
define('SECURE_AUTH_KEY',  'ou$P*bE Ttx*> 0(hjv,x#Mb~y(5}8I@8l+8Cy_`/xZ|:Dq1l!]04DV<~)0;O|:i');
define('LOGGED_IN_KEY',    'f(@:ef_P||xz@$aQkVsA,+nG^BfSHi,HLoa+a[D9/kMB 5]1(&|bI*4Q]r4fyYg;');
define('NONCE_KEY',        'P#tLN;[!tT7Y-o(ox8)e><n;*`N9b>C na6Fn=dmN`M7IWA{I9c8t`}Ek|#=R /B');
define('AUTH_SALT',        '1n;h..5eq-V}Vlf^9FuWXaB{OiHfb`)z@o2|0pYH|7Z`!2;>uys}fPmI>M[v6Rsq');
define('SECURE_AUTH_SALT', 'F5R]mbV5t/a2HqZDWd~F|V[}V2ZQce(V-aFYF@weWYlPG;w-$0C?a6zY@_h,R(,f');
define('LOGGED_IN_SALT',   '}T)0s,x6D$6V/hhs*Nl4~x1m;GG0B<-oX+hFZ$OuQ3n9Ql}F<9rs`sB&s}a[P7nL');
define('NONCE_SALT',       '!-E+#K%Y&D1IZ(N.PMztF03i^BY@QOj_xf||wbY:M?CR^-V0?qo$Cf}TQuIHSWG|');

/**#@-*/

/**
 * WordPress Database Table prefix.
 *
 * You can have multiple installations in one database if you give each a unique
 * prefix. Only numbers, letters, and underscores please!
 */
$table_prefix  = 'dp_';

/**
 * WordPress Localized Language, defaults to English.
 *
 * Change this to localize WordPress. A corresponding MO file for the chosen
 * language must be installed to wp-content/languages. For example, install
 * de_DE.mo to wp-content/languages and set WPLANG to 'de_DE' to enable German
 * language support.
 */
define('WPLANG', 'nl_NL');

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
	define('ABSPATH', dirname(__FILE__) . '/wp');

/** Sets up WordPress vars and included files. */
require_once(ABSPATH . 'wp-settings.php');