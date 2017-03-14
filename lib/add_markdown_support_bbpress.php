<?php
/**
 * Adds suport for the Jetpack Markdowm module for bbPress
 */
class CSS_Tricks_Markdown_bbPress {

    /**
     * Single instance of the class
     * @var object
     */
    private static $instance;

    /**
     * Creates a instance of the class
     * @return object a instance of the class
     */
    public static function get_instance() {

        if ( ! isset( self::$instance ) ) {
            self::$instance = new CSS_Tricks_Markdown_bbPress;
            self::$instance->setup_actions();
        }
        return self::$instance;
    }

    /**
     * Initialize the class and set its properties.
     */
    private function __construct() { /** Silence is golden **/ }

    /**
     * Run when class is instantiated
     */
    private function setup_actions() {
        if ( has_action( 'admin_init', 'jetpack_markdown_posting_always_on' ) ) {
            remove_action( 'admin_init', 'jetpack_markdown_posting_always_on', 11 );
        }

        if ( self::is_markdown_available() ) {
            self::a( 'init', 'add_bbpress_support', 6 );
        }
    }

    /**
     * Call a method
     * @param  string  $tag      the WordPress action
     * @param  string  $method   the method callback
     * @param  integer $priority priotity of the action
     * @param  integer $args     the argument amount
     * @return void            
     */
    private function a( $tag, $method, $priority = 10, $args = 1 ) {
        return add_action( $tag, array( __CLASS__, $method ), $priority, $args );
    }

    /**
     * Check if Jetpack is enabled and Markdown module is not
     * @return boolean If Jetpack is enabled and Markdown module is not
     */
    public function is_markdown_available() {
        return class_exists( 'Jetpack' ) || ( class_exists( 'Jetpack' ) && ! Jetpack::is_module_active( 'markdown' ) );
    }

    /**
     * Add Post Type Support for Markdown
     */
    public function add_bbpress_support() {
        if( class_exists( 'Jetpack' ) && Jetpack::is_module_active( 'markdown' ) ) {
            add_post_type_support(  bbp_get_topic_post_type(), WPCom_Markdown::POST_TYPE_SUPPORT );
            add_post_type_support(  bbp_get_reply_post_type(), WPCom_Markdown::POST_TYPE_SUPPORT );
        }
    }

}
add_action( 'plugins_loaded', array( 'CSS_Tricks_Markdown_bbPress', 'get_instance' ) );