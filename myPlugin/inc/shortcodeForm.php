<?php
/**
 * Shortcode Form for Adding Written Works.
 *
 * @copyright  Copyright (c) 2023, Multimedijalni Sistemi
 * @license    http://opensource.org/licenses/gpl-2.0.php GNU Public License
 */

 function written_work_form_shortcode() {
    // Fetch existing categories and tags
    $categories = get_terms(['taxonomy' => 'written_work_category', 'hide_empty' => false]);
    $tags = get_terms(['taxonomy' => 'written_work_tag', 'hide_empty' => false]);

    ob_start(); ?>
    
    <form id="written-work-form">
        <?php wp_nonce_field('myplugin_nonce_action', 'myplugin_nonce'); ?>

        <label for="title">Title:</label>
        <input type="text" id="title" name="title" required>
        
        <label for="content">Content:</label>
        <textarea id="content" name="content" required></textarea>
        
        <label for="categories">Categories:</label>
        <div id="categories">
            <?php if (!empty($categories) && !is_wp_error($categories)) : ?>
                <?php foreach ($categories as $category) : ?>
                    <div>
                        <input type="checkbox" id="category-<?php echo esc_attr($category->term_id); ?>" name="categories[]" value="<?php echo esc_attr($category->name); ?>"> <!-- Use name instead of ID -->
                        <label for="category-<?php echo esc_attr($category->term_id); ?>"><?php echo esc_html($category->name); ?></label>
                    </div>
                <?php endforeach; ?>
            <?php else : ?>
                <p>No categories found.</p>
            <?php endif; ?>
        </div>
        
        <label for="tags">Tags:</label>
        <div id="tags">
            <?php if (!empty($tags) && !is_wp_error($tags)) : ?>
                <?php foreach ($tags as $tag) : ?>
                    <div>
                        <input type="checkbox" id="tag-<?php echo esc_attr($tag->term_id); ?>" name="tags[]" value="<?php echo esc_attr($tag->name); ?>"> <!-- Use name instead of ID -->
                        <label for="tag-<?php echo esc_attr($tag->term_id); ?>"><?php echo esc_html($tag->name); ?></label>
                    </div>
                <?php endforeach; ?>
            <?php else : ?>
                <p>No tags found.</p>
            <?php endif; ?>
        </div>
        
        <label for="reading_time">Estimated Reading Time (minutes):</label>
        <input type="number" id="reading_time" name="reading_time">
        
        <input type="submit" value="Submit">
    </form>
    
    <div id="form-message"></div>
    
    <?php
    return ob_get_clean();
}

add_shortcode('written_work_form', 'written_work_form_shortcode');