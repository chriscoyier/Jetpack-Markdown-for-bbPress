<?php
/**
 * Check to see if Jetpack and Jetpack modules are activated
 */
class Jetpack_Check{

    /**
     * The module to check if active
     * @var string
     */
    public $module;
    /**
     * Initialize the class and set its properties.
     */
    public function __construct( $module = '' ) {
        add_action( 'plugins_loaded', array( $this, 'init' ) );
        $this->module = $module;
    }

    /**
     * Initialize the checks
     */
    public function init() {
        if( !$this->check_for_jetpack() ){
            add_action( 'admin_notices', array( $this, 'jetpack_error' ) );
        }
        if( !$this->check_for_module() ) {
            add_action( 'admin_notices', array( $this, 'module_error' ) );
        }
    }

    /**
     * Check if Jetpack is activated
     * @return bool Check if Jetpack is activated
     */
    public function check_for_jetpack() {
        $result = true;
        if( !class_exists( 'Jetpack' ) ) {
            $result = false;
        }
        return $result;
    }

    /**
     * The error to display if Jetpack isn't activated
     */
    public function jetpack_error() {
        ob_start();
        $html = '<div id="notice" class="error"><p>';
        $html .= __( 'It appears that you have enabled a plugin that requires Jetpack, but you have either not activated the Jetpack plugin.' );
        $html .= '</p></div>';
        echo $html;
    }
    /**
     * Check if modules are active
     * @return bool Check if modules are active
     */
    public function check_for_module() {
        $result = true;
        if( !empty( $this->module ) && class_exists( 'Jetpack' ) && !Jetpack::is_module_active( $this->module ) ) {
            $result = false;
        }
        return $result;
    }

    /**
     * The error to display if modules are not active
     */
    public function module_error() {
        global $hook_suffix;
        if( class_exists( 'Jetpack' ) && Jetpack::is_active() ) {

            $html = '<div id="notice" class="error"><p>';
            $html .= __( 'It appears that you have enabled a plugin that requires Jetpack\'s ' . ucfirst( $this->module ) . ' module, but you have not enabled the ' . ucfirst( $this->module ) . ' module.' );
            if( $hook_suffix != 'jetpack_page_jetpack_modules' ) {
                $html .= '<p>';
                $html .= __( 'You can enable it <a href="' . admin_url() . 'admin.php?page=jetpack_modules" />here</a>' );
                $html .= '</p>';
            }
            $html .= '</p></div>';
            echo $html;
            
        } else {
            $html = '<div id="notice" class="error"><p>';
            $html .= __( 'It appears that you have enabled a plugin that requires Jetpack\'s ' . ucfirst( $this->module ) . ' module, but you have not enabled the ' . ucfirst( $this->module ) . ' module.' );
            $html .= '</p></div>';
            echo $html;
        }
    }
}
