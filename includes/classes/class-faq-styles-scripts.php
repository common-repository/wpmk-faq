<?php

/**
 * @package WPMK FAQ
 * 
 * Here we define plugin stylesheet and scripts
 * that we use for run faq
 * 
 */

if ( ! defined( 'ABSPATH' ) ) exit;

if(!class_exists('WPMK_FAQ_STYLES_SCRIPTS')){
  
    class WPMK_FAQ_STYLES_SCRIPTS{
        
        public function __construct() {
            $this->wpmk_faq_styles_scripts_init();
        }
        
        /**
         * 
         *  Here is faq style and script init
         * 
         */
        public function wpmk_faq_styles_scripts_init(){
            add_action( 'init', array( $this, 'wpmk_faq_stylesheets'), 1001 );
            add_action( 'wp_footer', array( $this, 'wpmk_faq_scripts') );
            add_action( 'admin_enqueue_scripts', array( $this, 'wpmk_faq_admin_scripts'), 1001 );
        }
        
        /**
         * 
         *  Here is faq enqueue style
         * 
         */
        public function wpmk_faq_stylesheets(){
            wp_register_style( 'wpmk-faq-default', WPMK_FAQ_ASSETS . 'css/wpmk-default.css', null, null, 'screen' );
            wp_register_style( 'wpmk-faq-font-awesome', WPMK_FAQ_ASSETS . 'css/font-awesome.min.css', null, null, 'screen' );
            wp_enqueue_style( 'wpmk-faq-font-awesome' );
            wp_enqueue_style( 'wpmk-faq-default' );
        }
        
        /**
         * 
         *  Here is faq enqueue script
         * 
         */
        public function wpmk_faq_scripts(){
            wp_register_script( 'wpmk-faq-script', WPMK_FAQ_ASSETS . 'js/wpmk-script.js', array(), WPMK_FAQ_VERSION, false );
            wp_enqueue_script( 'jquery' );
            wp_enqueue_script( 'wpmk-faq-script' );
        }
        
        /**
         * 
         *  Here is faq enqueue script
         * 
         */
        public function wpmk_faq_admin_scripts(){
            wp_register_style( 'wpmk-faq', WPMK_FAQ_ASSETS . 'css/wpmk-admin.css', null, null, 'screen' );
            wp_enqueue_style( 'wpmk-faq' );
            wp_enqueue_style( 'wp-color-picker' );
            wp_enqueue_script( 'wpmk-faq-admin-script', WPMK_FAQ_ASSETS . 'js/wpmk-admin-script.js', array( 'jquery', 'wp-color-picker' ), false, true );
        }
    }
    new WPMK_FAQ_STYLES_SCRIPTS();
}
?>