<?php

/**
 * Plugin Name: My Plugin
 * Plugin URI: http://URI_Of_Page_Describing_Plugin_and_Updates
 * Description: This is my plugin
 * Version:1.0
 * Author: Multimedijalni Sistemi
 * Author URI: http://URI_Of_The_Plugin_Author
 * License: GPL2
 */

require_once plugin_dir_path(__FILE__) . 'inc/shortcodeForm.php';
require_once plugin_dir_path(__FILE__) . 'inc/ajaxFormHandler.php';

function add_myplugin_styles_scripts() {
    $plugin_url = plugin_dir_url(__FILE__);
    wp_enqueue_style('myplugin_styles', $plugin_url . 'css/style.css');
    wp_enqueue_script('myplugin_form_handler', $plugin_url . 'js/formHandler.js', array('jquery'), '1.0', true);

    // Correctly localize the AJAX URL
    wp_localize_script('myplugin_form_handler', 'ajaxurl', admin_url('admin-ajax.php'));
}
add_action('wp_enqueue_scripts', 'add_myplugin_styles_scripts');
?>


