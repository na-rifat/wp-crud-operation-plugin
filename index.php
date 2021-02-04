<?php

/**
 * Plugin Name:       Content management portal
 * Plugin URI:        https://rafalotech.com/plugins/wp/comparrot
 * Description:       Manage your contents.
 * Version:           1.0.0
 * Requires at least: 5.2
 * Requires PHP:      7.2
 * Author:            Rafalo tech
 * Author URI:        https://rafalotech.com
 * License:           GPL v2 or later
 * License URI:       https://www.gnu.org/licenses/gpl-2.0.html
 * Text Domain:       comparrot
 */
namespace cmp;

use cmp\Manager\Manager;

// use cmp\Assets;

require_once "vendor/autoload.php";

/**
 * Handles the plugin
 */
class cmp {
    const version     = '1.0';
    const plugin_name = 'Content management portal';
    /**
     * Usefull variables and class objects
     */

    /**
     * Builds the class
     */
    function __construct() {
        $this->define_constants();

        add_action( 'plugins_loaded', [$this, 'init'] );

        register_activation_hook( __FILE__, [$this, 'activate'] );
    }

    /**
     * Creates the plugin class
     *
     * @return void
     */
    public static function create() {
        $is_created = false;

        if ( ! $is_created ) {
            $is_created = new self();
        }
        return $is_created;
    }

    /**
     * Initializes the class
     *
     * @return void
     */
    public function init() {
        // Variable creation
        $manager = new Manager();
        $assets  = new Assets();
        $assets->manager= $manager;

        if ( empty( get_option( 'cmp_last_id', '' ) ) ) {
            update_option( 'cmp_last_id', 1 );
        }
        // Variable assign

        // Initialization part

    }

    /**
     * Defines the constatns
     *
     * @return void
     */
    public function define_constants() {
        define( 'CMP_NAME', self::plugin_name );
        define( 'CMP_VERSION', self::version );

        define( 'CMP_PATH', __DIR__ );
        define( 'CMP_FILE', __FILE__ );
        define( 'CMP_PLUGIN_PATH', plugins_url( '', CMP_FILE ) );
        define( 'CMP_ASSETS', CMP_PLUGIN_PATH . '/assets' );
        define( 'CMP_JS', CMP_ASSETS . '/js' );
        define( 'CMP_CSS', CMP_ASSETS . '/css' );
        define( 'CMP_IMAGES', CMP_ASSETS . '/img' );
        define( 'CMP_FUNCTIONS', __DIR__ . '/includes/functions.php' );
    }

    /**
     * Processes installation
     *
     * @return void
     */
    public function activate() {
        $installer = new Installer();
        $installer->run();
    }
}

function create() {
    cmp::create();
}

create();