<?php
/**
 * acf specific functions
 *
 * @package UnderStrap
 */

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;


function the_instructional_designer(){
	$designer = get_field('lead_instructional_designer');
	return $designer['display_name'];
}

function the_google_folder(){
	$url = get_field('link_to_shared_drive');
	$id = str_replace('https://drive.google.com/drive/folders/', '', $url);
	return '<iframe src="https://drive.google.com/embeddedfolderview?id='.$id.'#list" width="100%" height="200" frameborder="0"></iframe>';
}

function the_notes(){
	$url = get_field('link_to_notes_document');
	$dir = get_stylesheet_directory_uri();
	return "<div class='col-md-6 card-icon'><a href='{$url}'><img src='{$dir}/imgs/notes.svg' class='notes' alt='Clock icon.'><h3>Notes</h3></a></div>";
}

function the_timeline(){
	$url = get_field('link_to_course_development_timeline');
	$dir = get_stylesheet_directory_uri();
	return "<div class='col-md-6 card-icon'><a href='{$url}'><img src='{$dir}/imgs/time.svg' class='timeline' alt='Clock icon.'><h3>Timeline</h3></a></div>";
}



function update_form_creation($title){
	$args = array(
		'id' => 'new-resource',
	        'post_id'       => 'new_post',
	        'post_title'   => false,
	        'new_post'      => array(
	            'post_type'     => 'update',
	            'tags_input' => array($title),
	            'post_status' => 'publish',
	            'post_title' => $title . ' Update: ' . date( 'Y-m-d H:i:s', current_time( 'timestamp', 1 ) ),
	        ),
	        'submit_value'  => 'Create new update',
	);
	
	return acf_form($args);
}



	//save acf json
		add_filter('acf/settings/save_json', 'cello_json_save_point');
		 
		function cello_json_save_point( $path ) {
		    
		    // update path
		    $path = get_stylesheet_directory() . '/acf-json'; //replace w get_stylesheet_directory() for theme
		    
		    
		    // return
		    return $path;
		    
		}


		// load acf json
		add_filter('acf/settings/load_json', 'cello_json_load_point');

		function cello_json_load_point( $paths ) {
		    
		    // remove original path (optional)
		    unset($paths[0]);
		    
		    
		    // append path
		    $paths[] = get_stylesheet_directory() . '/acf-json';//replace w get_stylesheet_directory() for theme
		    
		    
		    // return
		    return $paths;
		    
		}