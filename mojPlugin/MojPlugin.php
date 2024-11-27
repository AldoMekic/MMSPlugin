<?php

/**
 * Plugin Name: Multimedijalni Sistemi
 * Plugin URI: http://URI_Of_Page_Describing_Plugin_and_Updates
 * Description: Kada se u post doda SHORTCODE [shortcodeBrojac] onda se uneta vrenost cuva i moze se menjati
 * Version:1.0
 * Author: Multimedijalni Sistemi
 * Author URI: http://URI_Of_The_Plugin_Author
 * License: GPL2
 */

require_once plugin_dir_path( __FILE__ ) . '/inc/ajaxPhp.php';
require_once plugin_dir_path( __FILE__ ) . '/inc/shortCodeBrojac.php';
require_once plugin_dir_path( __FILE__ ) . '/inc/shortCodeText.php';
    
function add_style_scripts() {
    global $post;
    $post_id=$post->ID;
    $plugin_url = plugin_dir_url( __FILE__ );
    wp_enqueue_style( 'style',  $plugin_url . "/css/style.css");
    wp_enqueue_script( 'brojac_js', $plugin_url . '/js/brojac.js' , array(), '1.0', true );

    $jsarray = array(
        'post_id'       => $post_id,
        'broj_input'    => get_post_meta($post_id, 'broj_input', true)
    );
    wp_localize_script( 'brojac_js', 'php_vars', $jsarray ); 
}
add_action( 'wp_enqueue_scripts', 'add_style_scripts' );