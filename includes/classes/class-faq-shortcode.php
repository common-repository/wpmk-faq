<?php

/**
 * @package WPMK FAQ
 * 
 * Here we define plugin configreation
 * this class hold templates and also 
 * shortcode, and will handel theme too.
 * 
 */

if ( ! defined( 'ABSPATH' ) ) exit;
 
if(!class_exists('WPMK_FAQ_SHORTCODE')){
    
    class WPMK_FAQ_SHORTCODE{
        
        public function __construct() {
            $this->wpmk_faq_shortcode_init();
        }
        
        /**
         * 
         *  Here is faq style and script init
         * 
         */
        public function wpmk_faq_shortcode_init(){
            add_shortcode( 'wpmk-faq', array( $this, 'wpmk_faq_shortcode' ) );
        }
        
        /**
         * 
         *  Here is faq shortcode
         * 
         */
        public function wpmk_faq_shortcode( $atts ){
            ob_start();
                
                extract(shortcode_atts(array(
                  'skin' => '',
                  'icon' => '',                                    
                ), $atts));
                
                $wpmk_faq_args = array('post_type' => array ('wpmk-faq' => 'wpmk-faq'));
                $wpmk_cat_post = new WP_Query( $wpmk_faq_args );
                echo '<div id="wpmk-faq-container">';
                while ($wpmk_cat_post->have_posts()) : $wpmk_cat_post->the_post();
                    echo '<div class="wpmk-faq-box wpmk-'. $skin .'"><div class="wpmk-faq-title wpmk-'. $skin .'"><i class="fa '. $icon .'" aria-hidden="true"></i> ';
                        the_title();
                    echo '</div><div class="wpmk-faq-content wpmk-'. $skin .'">';
                        the_content();
                    echo '</div></div>';
                endwhile;
                
            return ob_get_clean();
        }
        
    }
    new WPMK_FAQ_SHORTCODE();
}
?>