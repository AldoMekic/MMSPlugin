<?php
function ww_slider_shortcode($atts) {
    $atts = shortcode_atts([
        'category' => '', // Filter by category slug
    ], $atts, 'written_work_slider');

    $args = [
        'post_type' => 'written_work',
        'posts_per_page' => -1, // Retrieve all written works for pagination
        'post_status' => 'publish',
    ];

    if (!empty($atts['category'])) {
        $args['tax_query'] = [
            [
                'taxonomy' => 'written_work_category',
                'field' => 'slug',
                'terms' => $atts['category'],
            ],
        ];
    }

    $query = new WP_Query($args);

    if (!$query->have_posts()) {
        return '<p>No Written Works found.</p>';
    }

    $written_works = [];
    while ($query->have_posts()) {
        $query->the_post();
        $written_works[] = [
            'title' => get_the_title(),
            'date' => get_the_date(),
            'author' => get_the_author(),
            'link' => get_the_permalink(),
        ];
    }
    wp_reset_postdata();

    $slider_id = 'ww-slider-' . uniqid(); // Generate a unique ID for each slider

    ob_start(); ?>
    <div id="<?php echo esc_attr($slider_id); ?>" class="ww-slider-container" data-works='<?php echo wp_json_encode($written_works); ?>'>
        <div class="ww-slider">
            <!-- Cards will be dynamically inserted here -->
        </div>
        <div class="ww-slider-controls">
            <button class="ww-prev-btn ww-slider-btn" disabled>Previous</button>
            <button class="ww-next-btn ww-slider-btn">Next</button>
        </div>
    </div>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            wwInitializeSlider('<?php echo esc_js($slider_id); ?>');
        });
    </script>
    <?php
    return ob_get_clean();
}
add_shortcode('written_work_slider', 'ww_slider_shortcode');