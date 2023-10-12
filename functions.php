<?php
/**
 * UnderStrap functions and definitions
 *
 * @package UnderStrap
 */

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;

// UnderStrap's includes directory.
$understrap_inc_dir = get_template_directory() . '/inc';

// Array of files to include.
$understrap_includes = array(
	'/theme-settings.php',                  // Initialize theme default settings.
	'/setup.php',                           // Theme setup and custom theme supports.
	'/widgets.php',                         // Register widget area.
	'/enqueue.php',                         // Enqueue scripts and styles.
	'/template-tags.php',                   // Custom template tags for this theme.
	'/pagination.php',                      // Custom pagination for this theme.
	'/hooks.php',                           // Custom hooks.
	'/extras.php',                          // Custom functions that act independently of the theme templates.
	'/customizer.php',                      // Customizer additions.
	'/custom-comments.php',                 // Custom Comments file.
	'/class-wp-bootstrap-navwalker.php',    // Load custom WordPress nav walker. Trying to get deeper navigation? Check out: https://github.com/understrap/understrap/issues/567.
	'/editor.php',                          // Load Editor functions.
	'/custom-data.php',                     // Load custom data functions.
	'/acf.php',								//acf stuff
	'/deprecated.php',                      // Load deprecated functions.
);

// Load WooCommerce functions if WooCommerce is activated.
if ( class_exists( 'WooCommerce' ) ) {
	$understrap_includes[] = '/woocommerce.php';
}

// Load Jetpack compatibility file if Jetpack is activiated.
if ( class_exists( 'Jetpack' ) ) {
	$understrap_includes[] = '/jetpack.php';
}

// Include files.
foreach ( $understrap_includes as $file ) {
	require_once $understrap_inc_dir . $file;
}


//query loop for displaying updates

// WP QUERY LOOP
function updates_query_loop($tag){
	 $html = '';
	 $args = array(
      'posts_per_page' => -1,
      'post_type'   => 'update', 
      'post_status' => 'publish', 
      'tag' => $tag,
      'nopaging' => true,
                    );
	  $the_query = new WP_Query( $args );
	                    if( $the_query->have_posts() ): 
	                      while ( $the_query->have_posts() ) : $the_query->the_post();
	                       //DO YOUR THING
	                      	//echo ($requestVars->_name == '') ? $redText : ''
	                      	$well = (get_field('going_well')) ? get_field('going_well') : 'N/A';
	                      	$flags = (get_field('flags')) ? get_field('flags') : 'N/A';
	                      	$else = (get_field('else')) ? get_field('else') : 'N/A';
	                      	$date = get_the_date( 'l F j, Y' );
	                        $html .= "<div class='update'><div class='date'>{$date}</div><div class='well'>{$well}</div><div class='flags'>{$flags}</div><div class='else'>{$else}</div></div>";
	                         endwhile;
	                    else: $html = "No updates yet.";
	                  endif;
	            wp_reset_query();  // Restore global post data stomped by the_post().
	   return $html;
}    

                
//add cards to category archive

function card_query_post_type($query) {
    $post_types = get_post_types();

    if ( is_category() || is_tag()) {

        $post_type = get_query_var('card');

        if ( $post_type ) {
            $post_type = $post_type;
        } else {
            $post_type = $post_types;
        }

        $query->set('post_type', $post_type);

        return $query;
    }
}

add_filter('pre_get_posts', 'card_query_post_type');



//show cards on home 

function the_home_cards(){

	$args_cat = [
	    'orderby' => 'name',
	    'order' => 'ASC',
	];

	$categories = get_categories($args_cat);

if (!empty($categories)):
    foreach ($categories as $category){
    	$html = '';
	 $args = array(
      'posts_per_page' => -1,
      'post_type'   => 'card', 
      'post_status' => 'publish', 
      'nopaging' => true,
      'cat' => $category->term_id,
      'tag__not_in' => array(44),//tag id for 'done'
                    );
	  $the_query = new WP_Query( $args );
	                    if( $the_query->have_posts() ): 
	                      while ( $the_query->have_posts() ) : $the_query->the_post();
	                       //DO YOUR THING	
	                         if($the_query->current_post === 0) {
	                         	$html .= "<div class='col-md-4'>
	                         				<div class='card-bucket'>
	                         					<h2>{$category->category_nicename}</h2>";
	                         		}                    	
			                         $title = get_the_title();
			                         $link = get_the_permalink();
			                         $slug = get_post_field( 'post_name', get_post());

		                        	$count = update_count($slug);
	                        $html .= "<div class='home-card-title'>
	                        			<a href='{$link}'>
	                        				{$title}
	                        				<div class='update-count'>{$count}</div>
	                        			</a>
	                        		 </div>";
	                         endwhile;
	                 //        else:
	              			$html .= "</div></div>";
	                  endif;

	   echo $html;
	   wp_reset_postdata(); // reset the query 

    }
	
endif;
    wp_reset_query();  // Restore global post data stomped by the_post().

}

function update_count($slug){
	if(get_term_by('slug', $slug, 'post_tag')){
		$tag = get_term_by('slug', $slug, 'post_tag');
		$count = $tag->count;
		return $count;
	} else {
		return 0;
	}
	
}


//card category

function show_card_categories(){
	$cats = get_the_category();
	if ( ! empty( $cats ) ) {
    return '<a href="' . esc_url( get_category_link( $cats[0]->term_id ) ) . '">Program: ' . esc_html( $cats[0]->name ) . '</a>';
	}
}

//change slug on cards if title is changed
add_action('acf/save_post', 'cell_card_title_fix');
function cell_card_title_fix( $post_id ) {
	if(get_post_type($post_id)== "card"){
		$post = get_post($post_id);
		$title = $post->post_title;
		$clean_title = sanitize_title($title);
		$slug = $post->post_name;
		if($slug != $clean_title){
			 $clean_post = array(
		      'ID'           => $post_id,
		      'post_name'   => $clean_title,
		  );
		 
		// Update the post into the database
		  wp_update_post( $clean_post );
		}

	}
}