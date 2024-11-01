<?php
/**
 * @package WPMK FAQ
 */
/*
Plugin Name: WPMK FAQ
Plugin URI: https://wpmk.org/plugins/wpmk-faq
Description: This Plugin will add faq in your website, it will work with jquery so it is work will all themes and also lightweight and you will have full control on faq. this will easy to style with ant theme with there style admin panel.
Version: 1.0.1
Author: Mubeen Khan
Author URI: https://wpmk.org/
License: GPLv2 or later
Text Domain: wpmk
*/

/*
This program is free software; you can redistribute it and/or
modify it under the terms of the GNU General Public License
as published by the Free Software Foundation; either version 2
of the License, or (at your option) any later version.

This program is distributed in the hope that it will be useful,
but WITHOUT ANY WARRANTY; without even the implied warranty of
MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
GNU General Public License for more details.

You should have received a copy of the GNU General Public License
along with this program; if not, write to the Free Software
Foundation, Inc., 51 Franklin Street, Fifth Floor, Boston, MA  02110-1301, USA.

Copyright 2005-2015 Automattic, Inc.
*/

if ( ! defined( 'ABSPATH' ) ) exit;

// Define Plugin Version and compatibility.
define( 'WPMK_FAQ_VERSION', '1.0.0' );
define( 'WPMK_FAQ_MINIMUM_WP_VERSION', '4.9.8' );
// Define Plugin Url.
define( 'WPMK_FAQ_URL', plugin_dir_url(__FILE__));
define( 'WPMK_FAQ_ASSETS', WPMK_FAQ_URL . "assets/");
// Define Plugin Dir Paht.
define( 'WPMK_FAQ_DIR', dirname(__FILE__) . '/' );
define( 'WPMK_FAQ_INCLUDES', WPMK_FAQ_DIR . "includes/");
define( 'WPMK_FAQ_CLASSES', WPMK_FAQ_INCLUDES . "classes/");
// Define Current Theme Dir Paht.
define( 'WPMK_FAQ_CURRENT_THEME', get_template_directory() . '/' );

/**
 * 
 * Here we define plugin action hook
 * it will add link in plugin action bar
 * 
 */
function wpmk_faq_plugin_action_bar( $actions, $plugin_file ){
    static $plugin;
    if (!isset($plugin))
    $plugin = plugin_basename(__FILE__);
        if ( $plugin == $plugin_file ) {
            $wpmk_settings = array('settings' => '<a href="'.admin_url( 'admin.php?page=wpmk-faq' ).'">' . __('Settings', 'wpmk') . '</a>');
            $wpmk_support = array('support' => '<a href="https://wpmk.org/support" target="_blank">' . __('Support', 'wpmk') . '</a>');
            $actions = array_merge( $wpmk_support, $actions );
            $actions = array_merge( $wpmk_settings, $actions );
        }
    return $actions;
}
add_filter( 'plugin_action_links', 'wpmk_faq_plugin_action_bar', 10, 5 );

/**
 * 
 * Here we define plugin action hook
 * it will add link in plugin action bar
 * 
 */ 
function wpmk_faq_plugin_row( $links, $file ) {    
    
    if ( plugin_basename( __FILE__ ) == $file ) {
        $row_settings = array('settings' => '<a href="'.admin_url('admin.php?page=wpmk-faq').'" aria-label="'.esc_attr__('Plugin Additional Links Settings', 'wpmk').'">'.esc_html__('Settings', 'wpmk').'</a>');
        $row_documentation = array('documentation' => '<a href="'.esc_url('https://wpmk.org/plugins/wpmk-faq/documentation') . '" target="_blank" aria-label="'.esc_attr__('Plugin Additional Links Documentation', 'wpmk').'" style="color:green;">'.esc_html__('Documentation', 'wpmk').'</a>');
        $row_developer = array('developer' => '<a href="'.esc_url('http://mubeenkhan.com/') . '" target="_blank" aria-label="'.esc_attr__('Plugin Additional Links Developer', 'wpmk').'">'.esc_html__('Develop By Mubeen Khan', 'wpmk').'</a>');
        
        $links = array_merge( $links, $row_settings );
        $links = array_merge( $links, $row_documentation );
        $links = array_merge( $links, $row_developer );
    }
    return $links;
}
add_filter( 'plugin_row_meta', 'wpmk_faq_plugin_row', 10, 2 );

/**
 * 
 * Here faq base class that hold
 * all the classes and plugin functions and
 * etc that plugin can do. this class as treat
 * as auto-run.
 * 
 */
include_once( WPMK_FAQ_CLASSES . 'class-faq-base.php' );
$WPMK_FAQ_BASE = new WPMK_FAQ_BASE();
/**
 * 
 * Here we define plugin activation hook
 * 
 */
register_activation_hook(__FILE__, array($WPMK_FAQ_BASE, 'wpmk_faq_install'));

 /**
 * 
 * Here we define plugin de-activation hook
 * 
 */
register_deactivation_hook(__FILE__, array($WPMK_FAQ_BASE,'wpmk_faq_uninstall'));




?>