<?php
/**
 * Add additional html tag for the bbPress Forums
 */
class Allowed_Tags_BbPress {

    /**
     * Initialize the class and set its properties.
     */
    public function __construct() {
        add_filter( 'bbp_kses_allowed_tags', array( $this, 'allowed_tags_bbpress'), 999, 1);
    }

    /**
     * Add custom allowed tags
     * 
     * @param  string $input the content to be saved
     */
    public function allowed_tags_bbpress( $input ){
        return array_merge( $input, array(
              // paragraphs
              'p' => array(
                'style'     => array()
              ),
              'span' => array(
                'style'     => array()
              ),
              'div' => array(
                'style'     => array()
              ),

              // Links
              'a' => array(
                'href'     => array(),
                'title'    => array(),
                'rel'      => array()
              )
         ));
      }
}