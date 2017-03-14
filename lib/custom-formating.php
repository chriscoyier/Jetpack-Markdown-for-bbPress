<?php
/**
 * Format the save data when displaying on the bbPress forum
 * to allow for proper HTML markup
 */
class Custom_Formating {

    /**
     * Initialize the class and set its properties.
     */
    public function __construct() {
        add_filter( 'bbp_get_reply_content', array( $this, 'custom_con_char' ), 6 );
        add_filter( 'bbp_get_topic_content',  array( $this, 'custom_con_char' ), 6 );
    }
     /**
     * Replace instances of &amp;lt; and &amp;gt;
     * with < and >
     * 
     * @param  string $content the content stored in the database
     * @return string          the formated content
     */
    public function custom_con_char( $content = '' ) {
        $content = str_replace( '&amp;lt;', '&lt;' , $content );
        $content = str_replace( '&amp;gt;', '&gt;' , $content );
        return $content;
    }
}