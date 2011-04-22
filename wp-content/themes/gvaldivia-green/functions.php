<?php 

add_action( 'after_setup_theme', 'gvaldivia_setup' );

if ( ! function_exists( 'gvaldivia_setup' ) ):

	function gvaldivia_setup() {

		// This theme styles the visual editor with editor-style.css to match the theme style.
		add_editor_style();
				
		// This theme uses post thumbnails
		add_theme_support( 'post-thumbnails' );
	
		// Add default posts and comments RSS feed links to head
		add_theme_support( 'automatic-feed-links' );
		
		function myfeed_request($qv) {
			if (isset($qv['feed']))
			$qv['post_type'] = get_post_types();
			return $qv;
		}
		add_filter('request', 'myfeed_request');
		
		
		// This theme uses wp_nav_menu().
		if (function_exists('register_nav_menus')) {
			register_nav_menus( array(
				'primary' => 'Primary Navigation',
				'secondary' => 'Secondary Navigation',
				'footer' => 'Footer Navigation',
			) );	
		}

		if (function_exists('add_image_size')){
			add_image_size('home_thumbnail', '290', '210', true);
			add_image_size('obra_thumbnail', '325', '235', true);
			add_image_size('featured_thumbnail', '385', '280', true);
		}
	}

endif;

function get_image($post_id = null, $size = 'large'){
	if ($post_id == null){
		return false;
	}
	$post_thumbnail_id = get_post_thumbnail_id( $post_id );
	if ($post_thumbnail_id == false) {
		$post_thumbnail_id = $post_id;
	}
	$image = wp_get_attachment_image_src($post_thumbnail_id, $size, false);
	$image[3] = trim(strip_tags( get_post_meta($post_thumbnail_id, '_wp_attachment_image_alt', true) ));
	$image[4] = trim(strip_tags( get_post_field('post_title', $post_id) ));
	return $image;
}

function get_image_link($post_id = null, $size = 'large'){
	$image = get_image($post_id, $size);
	return $image[0];
}

function get_random_image($limit = 0){
	global $wpdb;
	$sql = 'SELECT hijo.ID FROM ' . $wpdb->posts . ' as padre JOIN ' . $wpdb->posts . ' as hijo ON (hijo.post_parent = padre.ID) where hijo.post_type = \'attachment\' and padre.post_type = \'obra\' ORDER BY RAND() LIMIT 1';
	$myid = $wpdb->get_var($wpdb->prepare($sql));
	//die($sql .  $myid);
	return get_image($myid, 'obra_thumbnail');
}

function dropcap_first($content='') {
    $pos = stripos($content, '<p>');
    if (($pos !== 0) || ($pos === false)) {
        return '<p class="dropcap-first">' . $content;
    } else {
        return '<p class="dropcap-first"' . stristr($content, '>');
    }
}

function get_gallery($id = null) {
	$gallery = array();
	$attachments = get_children( array('post_parent' => $id, 'post_status' => 'inherit', 'post_type' => 'attachment', 'post_mime_type' => 'image', 'order' => 'ASC', 'orderby' => 'menu_order ID') );
	//$attachments = get_children( array('post_parent' => $id) );
	if ($attachments) {
		foreach ( $attachments as $id => $attachment ) {
			$gallery[] = array(
				'title'  => $attachment->post_title,
				'desc'   => $attachment->post_content,
				'alt'    => $attachment->post_excerpt,
				'large'  => wp_get_attachment_image_src($id, 'large', false),
			);
		}
	}
	return $gallery;
}

function get_pager(){
	require_once dirname(__FILE__) . '/pagination.php';
}

add_filter('the_content', 'dropcap_first', 7);