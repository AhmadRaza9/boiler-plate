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
define( 'DB_NAME', 'boiler-plate' );

/** MySQL database username */
define( 'DB_USER', 'root' );

/** MySQL database password */
define( 'DB_PASSWORD', 'root' );

/** MySQL hostname */
define( 'DB_HOST', 'localhost' );

/** Database charset to use in creating database tables. */
define( 'DB_CHARSET', 'utf8' );

/** The database collate type. Don't change this if in doubt. */
define( 'DB_COLLATE', '' );

if ( !defined('WP_CLI') ) {
    define( 'WP_SITEURL', $_SERVER['REQUEST_SCHEME'] . '://' . $_SERVER['HTTP_HOST'] );
    define( 'WP_HOME',    $_SERVER['REQUEST_SCHEME'] . '://' . $_SERVER['HTTP_HOST'] );
}



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
define( 'AUTH_KEY',         'OsFwFyHCH0Jy0Pytx7VgeNhPtcrkXb2TRu9245JzV4ueMFcRbdZWma82CAFgsGJ3' );
define( 'SECURE_AUTH_KEY',  'SHBh49oDlbgwSTFZQluKyeQHzJ0gyvnX6vUJRXow7yvrNMLoeVhX1dD6p83zXHcB' );
define( 'LOGGED_IN_KEY',    '0c1htx1nEPYBmtWUSpdZcOGavRkIPK4UYoBxLldtd9vmpMqUQpm8RcXj5RV7hD1t' );
define( 'NONCE_KEY',        'y2LzuwZYb6g5VW0jI8aHrTS56wDuVNoKwd7qgvOUl9AzGPAUdh3amD2WIkhNltnR' );
define( 'AUTH_SALT',        '8ZecvKcCYCwvluxQNRSgql1fwRR0hS6d9sCSJmmWtVgD3I9vgoXAqTxlAXKsQVFn' );
define( 'SECURE_AUTH_SALT', 'lnSkTy7GTW2sVDOtl9dAt9vos6sY0cMVqUpavWZvFdTH9E6D2muZCKvbBFdHLy57' );
define( 'LOGGED_IN_SALT',   '6SkD4nlkIqbxBw5IykWc1N27dClEKYPWJCGeZuS8TAmskBVMHL3tkMb4OIdnmu4u' );
define( 'NONCE_SALT',       'cuxIBiQh99GaLNTPJZLTa41dPEOGjYdWzEbYQnT50Szw7XpgHvJa5NqOHx3KvmhO' );

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
