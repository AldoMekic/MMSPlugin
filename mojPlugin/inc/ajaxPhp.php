<?php

/**
 * AJAX.
 *
 * @copyright  Copyright (c) 2023, Multimedijalni Sistemi
 * @license    http://opensource.org/licenses/gpl-2.0.php GNU Public License
 */

add_action( 'wp_ajax_add_update_metaKey', 'f_add_update_metaKey' );
add_action( 'wp_ajax_nopriv_add_update_metaKey', 'f_add_update_metaKey_nopriv' );

function f_add_update_metaKey() {
	$brojac=$_POST['brojac'];
    $post_id =$_POST['post_id'];
	if( empty(get_post_meta($post_id, 'broj_input', true))) {
		add_post_meta($post_id, 'broj_input', $brojac, true);
		echo "Dodao nije bilo";
	} else {
		update_post_meta($post_id, 'broj_input', $brojac);
		echo "Apdejtovao ";
	}
    $broj = get_post_meta($post_id, 'broj_input', true);
	echo $broj;	
	die(' Zavrsio');
}

function f_add_update_metaKey_nopriv() {
	$brojac=$_POST['brojac'];
    $post_id =$_POST['post_id'];
	if( empty(get_post_meta($post_id, 'broj_input', true))) {
		add_post_meta($post_id, 'broj_input', $brojac, true);
		echo "Dodao nije bilo NOPRIV za neregistrovane korisnike";
	} else {
		update_post_meta($post_id, 'broj_input', $brojac);
		echo "Apdejtovao NOPRIV ";
	}
    $broj = get_post_meta($post_id, 'broj_input', true);
	echo $broj;	
	die(' Zavrsio');
}