<?php

/**
 * @package WPMK FAQ
 * 
 * Here we define plugin Post Type
 * it will add faq Post Type
 * 
 */

if ( ! defined( 'ABSPATH' ) ) exit;
 
if(!class_exists('WPMK_FAQ_POST_TYPE')){
    
    class WPMK_FAQ_POST_TYPE{
        
        public function __construct() {
            $this->wpmk_faq_post_type_init();
        }
        
        /**
         * 
         *  Here is faq post type init
         * 
         */
        public function wpmk_faq_post_type_init(){
            add_action( 'init', array( $this, 'wpmk_faq_post_type' ) );
            add_action( 'init', array( $this, 'wpmk_faq_post_taxonomy' ), 0  );
            add_action( 'init', array( $this, 'wpmk_faq_post_tag' ), 0  );
            add_action( 'add_meta_boxes', array( $this, 'wpmk_faq_add_meta_box' ) );
            add_filter( 'manage_wpmk-faq_posts_columns' , array( $this, 'wpmk_faq_order_column' ) );
            add_action( 'manage_wpmk-faq_posts_custom_column' , array( $this, 'wpmk_faq_order_value' ) , 10 , 2 );
            //add_action( 'pre_get_posts', array( $this, 'wpmk_faq_post_order_sort' ) );
            add_action( 'save_post', array( $this, 'wpmk_faq_save_sort_order' ), 10, 2 );
            //add_action( 'admin_menu', array( $this, 'wpmk_faq_register_setting_page' ) );
        }
        
        /**
         * 
         * Here We are setting faq post type
         * 
         */
        function wpmk_faq_post_type(){
            
            $labels = array(
                'name' => __('WPMK FAQ ( All FAQ List )', 'wpmk'),
                'singular_name' => __('All FAQ', 'wpmk'),
                'add_new' => __('Add New FAQ', 'wpmk'),
                'add_new_item' => __('WPMK FAQ - Add New FAQ', 'wpmk'),
                'edit_item' => __('Edit FAQ', 'wpmk'),
                'new_item' => __('New FAQ', 'wpmk'),
                'view_item' => __('View FAQ', 'wpmk'),
                'search_items' => __('Search FAQ', 'wpmk'),
                'not_found' => __('No faq found', 'wpmk'),
                'not_found_in_trash' => __('No faq found in trash', 'wpmk'),
                'parent_item_colon' => '',
                'menu_name' => __('WPMK FAQ', 'wpmk')
            );
            $args = array(
                'labels'             => $labels,
        		'public'             => true,
        		'publicly_queryable' => true,
        		'show_ui'            => true,
        		'show_in_menu'       => true,
        		'query_var'          => true,
        		'rewrite'            => array( 'slug' => 'wpmk-faq' ),
        		'capability_type'    => 'post',
        		'has_archive'        => true,
        		'hierarchical'       => true,
        		'menu_position'      => null,
                'menu_icon'          => 'dashicons-id-alt',
        		'supports'           => array( 'title', 'editor', 'thumbnail' )
            );
            
            register_post_type( 'wpmk-faq' , $args);
        }
        
        /**
         * 
         * Here We are setting faq taxonomy
         * 
         */
        public function wpmk_faq_post_taxonomy(){
        
        	$labels = array(
        		'name'              => _x( 'Categorys', 'wpmk' ),
        		'singular_name'     => _x( 'Category', 'wpmk' ),
        		'search_items'      => __( 'Search Categorys', 'wpmk' ),
        		'all_items'         => __( 'All Categorys', 'wpmk' ),
        		'parent_item'       => __( 'Parent Category', 'wpmk' ),
        		'parent_item_colon' => __( 'Parent Category:', 'wpmk' ),
        		'edit_item'         => __( 'Edit Category', 'wpmk' ),
        		'update_item'       => __( 'Update Category', 'wpmk' ),
        		'add_new_item'      => __( 'Add New Category', 'wpmk' ),
        		'new_item_name'     => __( 'New Category Name', 'wpmk' ),
        		'menu_name'         => __( 'Category', 'wpmk' ),
        	);
        
        	$args = array(
        		'hierarchical'      => true,
        		'labels'            => $labels,
        		'show_ui'           => true,
        		'show_admin_column' => true,
        		'query_var'         => true,
        		'rewrite'           => array( 'slug' => 'wpmk-faq-category' ),
        	);
        
        	register_taxonomy( 'wpmk-faq-category', array( 'wpmk-faq' ), $args );
        }
        
        /**
         * 
         * Here We are setting faq tags
         * 
         */
        public function wpmk_faq_post_tag(){
            $labels = array(
        		'name'                       => _x( 'Tags', 'wpmk' ),
        		'singular_name'              => _x( 'Tag', 'wpmk' ),
        		'search_items'               => __( 'Search Tags', 'wpmk' ),
        		'popular_items'              => __( 'Popular Tags', 'wpmk' ),
        		'all_items'                  => __( 'All Tags', 'wpmk' ),
        		'parent_item'                => null,
        		'parent_item_colon'          => null,
        		'edit_item'                  => __( 'Edit Tag', 'wpmk' ),
        		'update_item'                => __( 'Update Tag', 'wpmk' ),
        		'add_new_item'               => __( 'Add New Tag', 'wpmk' ),
        		'new_item_name'              => __( 'New Tag Name', 'wpmk' ),
        		'separate_items_with_commas' => __( 'Separate tags with commas', 'wpmk' ),
        		'add_or_remove_items'        => __( 'Add or remove tags', 'wpmk' ),
        		'choose_from_most_used'      => __( 'Choose from the most used tags', 'wpmk' ),
        		'not_found'                  => __( 'No tags found.', 'wpmk' ),
        		'menu_name'                  => __( 'Tags', 'wpmk' ),
        	);
        
        	$args = array(
        		'hierarchical'          => false,
        		'labels'                => $labels,
        		'show_ui'               => true,
        		'show_admin_column'     => true,
        		'update_count_callback' => '_update_post_term_count',
        		'query_var'             => true,
        		'rewrite'               => array( 'slug' => 'wpmk-faq-tag' ),
        	);
        
        	register_taxonomy( 'wpmk-faq-tag', 'wpmk-faq', $args );
        }

        /**
         * 
         * Here We are add meta box in faq
         * post type for project url
         * 
         */
        public function wpmk_faq_add_meta_box(){
            add_meta_box(
                'wpmk_faq_sort',
                esc_html__( 'Please Enter Your FAQ Sort Order', 'wpmk' ),
                array( $this, 'wpmk_faq_sort_order' ),
                'wpmk-faq',
                'side',
                'default'
            );
        }
        
        /**
         * 
         * Here We are meta box callback
         * function for faq
         * 
         */
        public function wpmk_faq_sort_order(){
            
            global $post;
        	
            wp_nonce_field( 'wpmk_faq_sort_order', 'wpmk_faq_sort_nonce' );
       	    
            $wpmk_faq_sort = get_post_meta( $post->ID, 'wpmk_faq_sort', true );
            echo '<p>Enter the position at which you would like the faq to appear. For exampe, faq "1" will appear first, faq "2" second, and so forth.</p>';
            echo '<input type="text" name="wpmk_faq_sort" value="' .  sanitize_text_field( $wpmk_faq_sort )  . '" class="widefat">';
        }
        
        /**
         * 
         * Here We are setting meta box
         * value in post columan
         * 
         */
        public function wpmk_faq_order_column( $columns ){
            $columns['wpmk_faq_sort'] = __( 'Position', 'wpmk' );
            return $columns;
        }
        
        /**
         * 
         * Here We are showing meta box
         * value in post columan
         * 
         */
        public function wpmk_faq_order_value( $column, $post_id ){
            switch ( $column ) {
                case 'wpmk_faq_sort' :
                    $metaData = get_post_meta( $post_id , 'wpmk_faq_sort' , true ); 
                    echo $metaData;
                    break;
            }
        }

        /**
         * 
         * Sort faq on the according to the
         * custom sort order
         * 
         */
        public function wpmk_faq_post_order_sort( $query ){
            if ( ! is_admin() && $query->is_main_query() ){
                $query->set( 'post_type', 'wpmk-faq' );
                $query->set( 'meta_key', 'wpmk_faq_sort' );
                $query->set( 'orderby', 'meta_value_num' );
                $query->set( 'order' , 'ASC' );
            }
            return $query;
        }
        
        /**
         * 
         * Here We are saving meta box project
         * url for faq
         * 
         */
        public function wpmk_faq_save_sort_order( $post_id, $post ) {
            
            if ( ! isset( $_POST['wpmk_faq_sort_nonce'] ) ) {
              return;
            }
            
            $wpmk_faq_sort_nonce = $_POST['wpmk_faq_sort_nonce'];
            
            if ( ! wp_verify_nonce( $wpmk_faq_sort_nonce, 'wpmk_faq_sort_order' ) ) {
                return;
            }
            
            if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
                return;
            }
            
            if ( ! current_user_can( 'edit_post', $post_id ) ) {
                return $post_id;
            }
            
            if ( 'revision' === $post->post_type ) {
                return;
            }
            
            if(empty($_POST['wpmk_faq_sort']))
                return;
            
            if ( isset( $_REQUEST['wpmk_faq_sort'] ) ) {
                update_post_meta( $post_id, 'wpmk_faq_sort', sanitize_text_field( $_POST['wpmk_faq_sort'] ) );
            }
        }
        
        /**
         * 
         * Here We are register faq setting page
         * 
         */
        public function wpmk_faq_register_setting_page(){
            add_submenu_page( 'edit.php?post_type=wpmk-faq', __( 'FAQ Settings', 'wpmk' ), __( 'FAQ Settings', 'wpmk' ), 'manage_options', 'wpmk-faq', array( $this, 'wpmk_faq_setting_page' ) );
        }
        
        /**
         * 
         * Here We are setting faq setting page
         * where user handel there faq view
         * 
         */
        public function wpmk_faq_setting_page(){
            //include_once( WPMK_FAQ_INCLUDES . 'settings/wpmk-faq-save-setting-page.php' );
            //include_once( WPMK_FAQ_INCLUDES . 'settings/wpmk-faq-setting-page.php' );
        }
    }
    new WPMK_FAQ_POST_TYPE();
}
?>