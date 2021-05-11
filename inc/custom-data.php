<?php
/**
 * Custom post types and any taxonomies
 *
 * @package UnderStrap
 */

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;


//card custom post type

// Register Custom Post Type card
// Post Type Key: card

function create_card_cpt() {

  $labels = array(
    'name' => __( 'Cards', 'Post Type General Name', 'textdomain' ),
    'singular_name' => __( 'Card', 'Post Type Singular Name', 'textdomain' ),
    'menu_name' => __( 'Card', 'textdomain' ),
    'name_admin_bar' => __( 'Card', 'textdomain' ),
    'archives' => __( 'Card Archives', 'textdomain' ),
    'attributes' => __( 'Card Attributes', 'textdomain' ),
    'parent_item_colon' => __( 'Card:', 'textdomain' ),
    'all_items' => __( 'All Cards', 'textdomain' ),
    'add_new_item' => __( 'Add New Card', 'textdomain' ),
    'add_new' => __( 'Add New', 'textdomain' ),
    'new_item' => __( 'New Card', 'textdomain' ),
    'edit_item' => __( 'Edit Card', 'textdomain' ),
    'update_item' => __( 'Update Card', 'textdomain' ),
    'view_item' => __( 'View Card', 'textdomain' ),
    'view_items' => __( 'View Cards', 'textdomain' ),
    'search_items' => __( 'Search Cards', 'textdomain' ),
    'not_found' => __( 'Not found', 'textdomain' ),
    'not_found_in_trash' => __( 'Not found in Trash', 'textdomain' ),
    'featured_image' => __( 'Featured Image', 'textdomain' ),
    'set_featured_image' => __( 'Set featured image', 'textdomain' ),
    'remove_featured_image' => __( 'Remove featured image', 'textdomain' ),
    'use_featured_image' => __( 'Use as featured image', 'textdomain' ),
    'insert_into_item' => __( 'Insert into card', 'textdomain' ),
    'uploaded_to_this_item' => __( 'Uploaded to this card', 'textdomain' ),
    'items_list' => __( 'Card list', 'textdomain' ),
    'items_list_navigation' => __( 'Card list navigation', 'textdomain' ),
    'filter_items_list' => __( 'Filter Card list', 'textdomain' ),
  );
  $args = array(
    'label' => __( 'card', 'textdomain' ),
    'description' => __( '', 'textdomain' ),
    'labels' => $labels,
    'menu_icon' => '',
    'supports' => array('title', 'editor', 'revisions', 'author', 'trackbacks', 'custom-fields', 'thumbnail',),
    'taxonomies' => array('category', 'post_tag'),
    'public' => true,
    'show_ui' => true,
    'show_in_menu' => true,
    'menu_position' => 5,
    'show_in_admin_bar' => true,
    'show_in_nav_menus' => true,
    'can_export' => true,
    'has_archive' => true,
    'hierarchical' => false,
    'exclude_from_search' => false,
    'show_in_rest' => true,
    'publicly_queryable' => true,
    'capability_type' => 'post',
    'menu_icon' => 'dashicons-universal-access-alt',
  );
  register_post_type( 'card', $args );
  
  // flush rewrite rules because we changed the permalink structure
  global $wp_rewrite;
  $wp_rewrite->flush_rules();
}
add_action( 'init', 'create_card_cpt', 0 );


//update custom post type

// Register Custom Post Type update
// Post Type Key: update

function create_update_cpt() {

  $labels = array(
    'name' => __( 'Updates', 'Post Type General Name', 'textdomain' ),
    'singular_name' => __( 'Update', 'Post Type Singular Name', 'textdomain' ),
    'menu_name' => __( 'Update', 'textdomain' ),
    'name_admin_bar' => __( 'Update', 'textdomain' ),
    'archives' => __( 'Update Archives', 'textdomain' ),
    'attributes' => __( 'Update Attributes', 'textdomain' ),
    'parent_item_colon' => __( 'Update:', 'textdomain' ),
    'all_items' => __( 'All Updates', 'textdomain' ),
    'add_new_item' => __( 'Add New Update', 'textdomain' ),
    'add_new' => __( 'Add New', 'textdomain' ),
    'new_item' => __( 'New Update', 'textdomain' ),
    'edit_item' => __( 'Edit Update', 'textdomain' ),
    'update_item' => __( 'Update Update', 'textdomain' ),
    'view_item' => __( 'View Update', 'textdomain' ),
    'view_items' => __( 'View Updates', 'textdomain' ),
    'search_items' => __( 'Search Updates', 'textdomain' ),
    'not_found' => __( 'Not found', 'textdomain' ),
    'not_found_in_trash' => __( 'Not found in Trash', 'textdomain' ),
    'featured_image' => __( 'Featured Image', 'textdomain' ),
    'set_featured_image' => __( 'Set featured image', 'textdomain' ),
    'remove_featured_image' => __( 'Remove featured image', 'textdomain' ),
    'use_featured_image' => __( 'Use as featured image', 'textdomain' ),
    'insert_into_item' => __( 'Insert into update', 'textdomain' ),
    'uploaded_to_this_item' => __( 'Uploaded to this update', 'textdomain' ),
    'items_list' => __( 'Update list', 'textdomain' ),
    'items_list_navigation' => __( 'Update list navigation', 'textdomain' ),
    'filter_items_list' => __( 'Filter Update list', 'textdomain' ),
  );
  $args = array(
    'label' => __( 'update', 'textdomain' ),
    'description' => __( '', 'textdomain' ),
    'labels' => $labels,
    'menu_icon' => '',
    'supports' => array('title', 'editor', 'revisions', 'author', 'trackbacks', 'custom-fields', 'thumbnail',),
    'taxonomies' => array('category', 'post_tag'),
    'public' => true,
    'show_ui' => true,
    'show_in_menu' => true,
    'menu_position' => 5,
    'show_in_admin_bar' => true,
    'show_in_nav_menus' => true,
    'can_export' => true,
    'has_archive' => true,
    'hierarchical' => false,
    'exclude_from_search' => false,
    'show_in_rest' => true,
    'rest_base' => 'update',
    'publicly_queryable' => true,
    'capability_type' => 'post',
    'menu_icon' => 'dashicons-universal-access-alt',
  );
  register_post_type( 'update', $args );
  
  // flush rewrite rules because we changed the permalink structure
  global $wp_rewrite;
  $wp_rewrite->flush_rules();
}
add_action( 'init', 'create_update_cpt', 0 );

//ADD ROUTE FOR UPDATE CPT
function course_update_rest_route_for_post( $route, $post ) {
    if ( $post->post_type === 'update' ) {
        $route = '/wp/v2/update/' . $post->ID;
    }
 
    return $route;
}
add_filter( 'rest_route_for_post', 'course_update_rest_route_for_post', 10, 2 );

add_action( 'rest_api_init', 'register_updates_meta_fields');
function register_updates_meta_fields(){

    register_meta( 'update', 'going_well', array(
        'type' => 'string',
        'description' => 'good stuff',
        'single' => true,
        'show_in_rest' => true
    ));

    register_meta( 'update', 'flags', array(
        'type' => 'string',
        'description' => 'flags',
        'single' => true,
        'show_in_rest' => true
    ));

    register_meta( 'update', 'else', array(
        'type' => 'string',
        'description' => 'other information',
        'single' => true,
        'show_in_rest' => true
    ));

}