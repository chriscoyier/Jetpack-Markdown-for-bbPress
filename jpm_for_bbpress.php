<?php
/**
 * @wordpress-plugin
 * Plugin Name:       Jetpack Markdown Support for bbPress
 * Plugin URI:        https://github.com/jawittdesigns/Jetpack-Markdown-for-bbPress
 * Description:       Enable Markdown Support for BBPress
 * Version:           1.3.0
 * Author:            Jason Witt
 * Author URI:        http://jawittdesigns.com
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       jpm_bbp
 * Domain Path:       /languages
 * GitHub Plugin URI: https://github.com/jawittdesigns/Jetpack-Markdown-for-bbPress
 * GitHub Branch:     master
 */

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
  die;
}

class JPM_BBP {

    public $jetpack_check;

    /**
     * Initialize the class and set its properties.
     */
    public function __construct() {
        $this->includes();
        add_action( 'plugins_loaded', array( $this, 'init' ) );
    }

    public function includes() {
        require_once plugin_dir_path( __FILE__ ) . 'lib/jetpack-check.php';
        // remove when Jetpack adds fix for pre tag
        require_once plugin_dir_path( __FILE__ ) . 'lib/allowed-tags-comments.php';
        require_once plugin_dir_path( __FILE__ ) . 'lib/allowed-tags-bbpress.php';
        // remove when bbPress fixes markdown conflict
        require_once plugin_dir_path( __FILE__ ) . 'lib/remove-filters.php';
        require_once plugin_dir_path( __FILE__ ) . 'lib/add_markdown_support_bbpress.php';
        // remove when bbPress fixes markdown conflict
        require_once plugin_dir_path( __FILE__ ) . 'lib/custom-formating.php';
    }

    public function init() {
        $this->jetpack_check = new Jetpack_Check( 'markdown' );
        // remove when Jetpack adds fix for pre tag
        $allowed_tags_comments = new Allowed_Tags_Comments();
        $allowed_tags_bbpress = new Allowed_Tags_BbPress();
        // remove when bbPress fixes markdown conflict
        $remove_filters = new Remove_Filters();
        // remove when bbPress fixes markdown conflict
        $custom_formating = new Custom_Formating();
    }
}
$jpm_bbp = new JPM_BBP();