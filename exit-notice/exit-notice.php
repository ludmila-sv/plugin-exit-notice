<?php
/**
 * Exit Notice
 *
 * @package       EXITNOTICE
 * @author        Ludmila Sviridova
 * @version       1.1.0
 *
 * @wordpress-plugin
 * Plugin Name:   Exit Notice
 * Plugin URI:    https://pressfoundry.com
 * Description:   Shows a custom exit notice when a user clicks an external link.
 * Version:       1.1.0
 * Author:        Ludmila Sviridova
 * Text Domain:   exit-notice
 */

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
// Plugin name
define( 'EXITNOTICE_NAME', 'Exit Notice' );

// Plugin version
define( 'EXITNOTICE_VERSION', '1.1.0' );

// Plugin Root File
define( 'EXITNOTICE_PLUGIN_FILE', __FILE__ );

// Plugin Folder Path
define( 'EXITNOTICE_PLUGIN_DIR', plugin_dir_path( EXITNOTICE_PLUGIN_FILE ) );

// Plugin Folder URL
define( 'EXITNOTICE_PLUGIN_URL', plugin_dir_url( EXITNOTICE_PLUGIN_FILE ) );

/**
 * Load the main class for the core functionality
 */
require_once EXITNOTICE_PLUGIN_DIR . 'classes/class-exit-notice.php';

Exit_Notice::init();
