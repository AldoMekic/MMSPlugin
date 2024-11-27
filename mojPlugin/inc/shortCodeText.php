<?php
/**
 * SHORTCODE text.
 *
 * @copyright  Copyright (c) 2023, Multimedijalni Sistemi
 * @license    http://opensource.org/licenses/gpl-2.0.php GNU Public License
 */

function boxShow($atts, $content = null ){
    //default values
    $option = shortcode_atts( array(
        'type' => '',
    ), $atts );

    ob_start(); 

    $class = $option[ 'type' ] == "shadow" ? 'shadow' : 'normal';

    //HTML goes here
    ?>
    <div class="box <?php echo $class; ?>"><?php echo $content; ?></box>

    <?php
    $output = ob_get_clean();
    return $output;
}
add_shortcode( 'box', 'boxShow' );