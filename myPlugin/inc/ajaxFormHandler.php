<?php
/**
 * AJAX Handler for Written Work Form Submission.
 *
 * @copyright  Copyright (c) 2023, Multimedijalni Sistemi
 * @license    http://opensource.org/licenses/gpl-2.0.php GNU Public License
 */

add_action('wp_ajax_submit_written_work', 'handle_written_work_submission');
add_action('wp_ajax_nopriv_submit_written_work', 'handle_written_work_submission');

function handle_written_work_submission() {
    // Verify nonce for security
    if ( !isset($_POST['myplugin_nonce']) || !wp_verify_nonce($_POST['myplugin_nonce'], 'myplugin_nonce_action') ) {
        wp_send_json_error('Nonce verification failed.');
    }

    // Validate required fields
    if (empty($_POST['title']) || empty($_POST['content'])) {
        wp_send_json_error('Title and Content are required.');
    }

    $title = sanitize_text_field($_POST['title']);
    $content = sanitize_textarea_field($_POST['content']);
    $categories = isset($_POST['categories']) ? $_POST['categories'] : []; // Names of categories
    $tags = isset($_POST['tags']) ? $_POST['tags'] : []; // Names of tags
    $reading_time = isset($_POST['reading_time']) ? intval($_POST['reading_time']) : '';

    // Create the Written Work post
    $post_id = wp_insert_post([
        'post_title' => $title,
        'post_content' => $content,
        'post_status' => 'publish',
        'post_type' => 'written_work',
    ]);

    if (is_wp_error($post_id)) {
        wp_send_json_error('Failed to create Written Work.');
    }

    // Handle Categories (search by name)
    if ($categories) {
        $category_ids = [];
        foreach ($categories as $category_name) {
            // Search for category by name
            $term = get_term_by('name', $category_name, 'written_work_category');
            if ($term) {
                $category_ids[] = $term->term_id;
            }
        }

        if ($category_ids) {
            wp_set_object_terms($post_id, $category_ids, 'written_work_category');
        }
    }

    // Handle Tags (search by name)
    if ($tags) {
        $tag_ids = [];
        foreach ($tags as $tag_name) {
            // Search for tag by name
            $term = get_term_by('name', $tag_name, 'written_work_tag');
            if ($term) {
                $tag_ids[] = $term->term_id;
            }
        }

        if ($tag_ids) {
            wp_set_object_terms($post_id, $tag_ids, 'written_work_tag');
        }
    }

    // Handle Reading Time
    if ($reading_time) {
        update_post_meta($post_id, '_reading_time', $reading_time);
    }

    wp_send_json_success('Written Work created successfully.');
}