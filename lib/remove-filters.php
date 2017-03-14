<?php
/**
 * Remove the bb_code_trick filter to allow proper
 * encoding of Markdown Extra
 */
class Remove_Filters {

    /**
     * Initialize the class and set its properties.
     */
    public function __construct() {
        add_action( 'init', array($this, 'remove_filters' ) );
    }

    /**
     * Remove the filters
     */
    public function remove_filters() {
        remove_filter( 'bbp_new_reply_pre_content',  'bbp_code_trick',  20 );
        remove_filter( 'bbp_new_topic_pre_content',  'bbp_code_trick',  20 );
        remove_filter( 'bbp_new_forum_pre_content',  'bbp_code_trick',  20 );
        remove_filter( 'bbp_edit_reply_pre_content',  'bbp_code_trick',  20 );
        remove_filter( 'bbp_edit_topic_pre_content',  'bbp_code_trick',  20 );
        remove_filter( 'bbp_edit_forum_pre_content',  'bbp_code_trick',  20 );
    }
}
