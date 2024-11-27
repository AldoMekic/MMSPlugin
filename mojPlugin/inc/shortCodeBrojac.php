<?php
/**
 * SHORTCODE brojac.
 *
 * @copyright  Copyright (c) 2023, Multimedijalni Sistemi
 * @license    http://opensource.org/licenses/gpl-2.0.php GNU Public License
 */

function broj_shortcode(){ 
    global $post;
    $post_id=$post->ID;
    ?>
    <input type="text" class="input" id="brojac" name="brojac" placeholder="Broj" required>
    <input type="submit" class="btnSubmit btn-Blue" value=Adejtuj>

    <p id="broj_text">Broj : 
        <?php 
            $br=get_post_meta($post_id, 'broj_input', true); 
            ($br ==! null) ? $br=get_post_meta($post_id, 'broj_input', true) : $br="Nije definisan"; 
            echo $br;
        ?>
    </p>
    <p id="broj_text0"></p>
    <pre class="message-response"> </pre>
    
<?php
}
add_shortcode('shortcodeBrojac', 'broj_shortcode' );