<?php
/**
 * Adds additional html tags to WordPress comments
 */
class Allowed_Tags_Comments {

    /**
     * Initialize the class and set its properties.
     */
    public function __construct() {
        add_action( 'init', array($this, 'my_allowed_tags' ) );
    }
    /**
     * Call the global $allowedtags
     * Add pre and code tags if not 
     * in the $allowedtags array
     * 
     * @return array the updated $allowedtags array
     */
    public function my_allowed_tags() {
        global $allowedtags;
        if( !array_key_exists( 'pre', $allowedtags ) ) {
            $allowedtags['pre'] = array();
        }
    }
}