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
	                      	$well = get_field('going_well');
	                      	$flags = get_field('flags');
	                      	$else = get_field('else');
	                      	$date = get_the_date( 'l F j, Y' );
	                        $html .= "<div class='update'><div class='date'>{$date}</div><div class='well'>{$well}</div><div class='flags'>{$flags}</div><div class='else'>{$else}</div></div>";
	                         endwhile;
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

