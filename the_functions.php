<?php 

add_filter( 'use_block_editor_for_post', '__return_false' );
add_filter( 'use_block_editor_for_post_type', function( $enabled, $post_type ) {
    return 'page' === $post_type ? false : $enabled;
}, 10, 2 ); 

/* PT */
function cptui_register_my_cpts() {

	/**
	 * Post Type: articles.
	 */

	$labels = [
		"name" => __( "Articles", "" ),
		"singular_name" => __( "Article", "" ),
	];

	$args = [
		"label" => __( "Articles", "" ),
		"labels" => $labels,
		"description" => "",
		"public" => true,
		"publicly_queryable" => true,
		"show_ui" => true,
		"show_in_rest" => true,
		"rest_base" => "",
		"rest_controller_class" => "WP_REST_Posts_Controller",
		"has_archive" => false,
		"show_in_menu" => true,
		"show_in_nav_menus" => true,
		"delete_with_user" => false,
		"exclude_from_search" => false,
		"capability_type" => "post",
		"map_meta_cap" => true,
		"hierarchical" => false,
		"rewrite" => [ "slug" => "article", "with_front" => true ],
		"query_var" => true,
		"supports" => [ "title", "editor", "thumbnail" ],
		"show_in_graphql" => false,
	];

	register_post_type( "article", $args );
}

add_action( 'init', 'cptui_register_my_cpts' );
function cptui_register_my_cpts_article() {

	/**
	 * Post Type: articles.
	 */

	$labels = [
		"name" => __( "Articles", "" ),
		"singular_name" => __( "Article", "" ),
	];

	$args = [
		"label" => __( "Articles", "" ),
		"labels" => $labels,
		"description" => "",
		"public" => true,
		"publicly_queryable" => true,
		"show_ui" => true,
		"show_in_rest" => true,
		"rest_base" => "",
		"rest_controller_class" => "WP_REST_Posts_Controller",
		"has_archive" => false,
		"show_in_menu" => true,
		"show_in_nav_menus" => true,
		"delete_with_user" => false,
		"exclude_from_search" => false,
		"capability_type" => "post",
		"map_meta_cap" => true,
		"hierarchical" => false,
		"rewrite" => [ "slug" => "article", "with_front" => true ],
		"query_var" => true,
		"supports" => [ "title", "editor", "thumbnail" ],
		"show_in_graphql" => false,
	];

	register_post_type( "article", $args );
}

add_action( 'init', 'cptui_register_my_cpts_article' );

/*********************/

?>