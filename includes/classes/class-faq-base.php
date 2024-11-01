<?php

/**
 * @package WPMK FAQ
 * 
 * Here we define plugin action hook
 * it will add link in plugin action bar
 * 
 */

if ( ! defined( 'ABSPATH' ) ) exit;

if(!class_exists('WPMK_FAQ_BASE')){
    
    class WPMK_FAQ_BASE{
        
        public function __construct() {
            $this->wpmk_faq_init();
        }
        
        /**
         * 
         *  Here is faq init
         * 
         */
        public function wpmk_faq_init(){
            add_action( 'init', array( $this, 'wpmk_faq_load_textdomain' ) );
            $this->wpmk_faq_include_classes();
        }
        
        /**
         * 
         * Here we are installing plugin options
         * and also plugin require data
         * 
         */
        static function wpmk_faq_install(){
            add_option('wpmk_faq_skin');
        }
        
        /**
         * 
         * Here we are uninstalling plugin options
         * and also plugin setup data
         * 
         */
        static function wpmk_faq_uninstall(){
            delete_option('wpmk_faq_skin');
        }
        
        /**
         * 
         * Here We are setting faq text domain
         * 
         */
        public function wpmk_faq_load_textdomain() {
            load_plugin_textdomain( 'wpmk', false, WPMK_FAQ_DIR . 'languages' ); 
        }
        
        /**
         * 
         * Here We are setting faq classes
         * 
         */
        public function wpmk_faq_include_classes(){
            include_once( WPMK_FAQ_CLASSES . 'class-faq-styles-scripts.php' );
            include_once( WPMK_FAQ_CLASSES . 'class-faq-post-type.php' );
            include_once( WPMK_FAQ_CLASSES . 'class-faq-shortcode.php' );
        }
    }
}
?>