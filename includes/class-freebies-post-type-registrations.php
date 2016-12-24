<?php
/**
 * Freebies Post Type
 *
 * @package   Portfolio_Post_Type
 * @license   GPL-2.0+
 */

/**
 * Register post types and taxonomies.
 *
 * http://blog.teamtreehouse.com/create-your-first-wordpress-custom-post-type
 * @package Portfolio_Post_Type
 */
class Freebies_Post_Type_Registrations {

	public $post_type = 'freebies';

	public $taxonomies = array( 'freebies-category', 'tags' );

	public function init() {
		// Add the team post type and taxonomies
		add_action( 'init', array( $this, 'register' ) );
	}

	/**
	 * Initiate registrations of post type and taxonomies.
	 *
	 * @uses Team_Post_Type_Registrations::register_post_type()
	 * @uses Team_Post_Type_Registrations::register_taxonomy_category()
	 */
	public function register() {
		$this->register_post_type();
        $this->register_taxonomy_categories();
		$this->register_taxonomy_tags();
	}

	/**
	 * Register the custom post type.
	 *
	 * @link http://codex.wordpress.org/Function_Reference/register_post_type
	 */
	protected function register_post_type() {
		$labels = array(
            'name'                  => _x( 'Freebies', 'Post Type General Name', 'porto' ),
    		'singular_name'         => _x( 'Freebies', 'Post Type Singular Name', 'porto' ),
    		'menu_name'             => __( 'Freebies', 'porto' ),
    		'name_admin_bar'        => __( 'Freebies', 'porto' ),
    		'archives'              => __( 'Freebies Archives', 'porto' ),
    		'attributes'            => __( 'Freebies Attributes', 'porto' ),
    		'parent_item_colon'     => __( 'Parent Freebies:', 'porto' ),
    		'all_items'             => __( 'All Freebies', 'porto' ),
    		'add_new_item'          => __( 'Add New Freebies', 'porto' ),
    		'add_new'               => __( 'Add New', 'porto' ),
    		'new_item'              => __( 'New Freebies', 'porto' ),
    		'edit_item'             => __( 'Edit Freebies', 'porto' ),
    		'update_item'           => __( 'Update Freebies', 'porto' ),
    		'view_item'             => __( 'View Freebies', 'porto' ),
    		'view_items'            => __( 'View Freebies', 'porto' ),
    		'search_items'          => __( 'Search Freebies', 'porto' ),
    		'not_found'             => __( 'Not found', 'porto' ),
    		'not_found_in_trash'    => __( 'Not found in Trash', 'porto' ),
    		'featured_image'        => __( 'Featured Image', 'porto' ),
    		'set_featured_image'    => __( 'Set featured image', 'porto' ),
    		'remove_featured_image' => __( 'Remove featured image', 'porto' ),
    		'use_featured_image'    => __( 'Use as featured image', 'porto' ),
    		'insert_into_item'      => __( 'Insert into Freebies', 'porto' ),
    		'uploaded_to_this_item' => __( 'Uploaded to this Freebies', 'porto' ),
    		'items_list'            => __( 'Freebies list', 'porto' ),
    		'items_list_navigation' => __( 'Freebies list navigation', 'porto' ),
    		'filter_items_list'     => __( 'Filter Freebies list', 'porto' ),
		);

		$supports = array(
			'title',
			'editor',
			'thumbnail',
			'revisions',
		);

		$args = array(
            'label'           => __( 'Freebies', 'porto' ),
            'description'     => __( 'Post to show your Frebies', 'porto' ),
			'labels'          => $labels,
			'supports'        => $supports,
			'public'          => true,
            'show_ui'         => true,
            'show_in_menu'    => true,
            'can_export'      => true,
		    'has_archive'     => true,
			'capability_type' => 'page',
			'rewrite'         => array( 'slug' => 'freebies', ), // Permalinks format
			'menu_position'   => 22,
			'menu_icon'       => 'dashicons-images-alt',
		);

		$args = apply_filters( 'Freebies_post_type_args', $args );

		register_post_type( $this->post_type, $args );
	}

    /**
	 * Register a taxonomy for Category Freebies.
	 *
	 * @link http://codex.wordpress.org/Function_Reference/register_taxonomy
	 */
	protected function register_taxonomy_categories() {
		$labels = array(
            'name'                       => __( 'Freebies Categories', 'porto' ),
			'singular_name'              => __( 'Freebies Category', 'porto' ),
			'menu_name'                  => __( 'Categories', 'porto' ),
			'edit_item'                  => __( 'Edit Freebies Category', 'porto' ),
			'update_item'                => __( 'Update Freebies Category', 'porto' ),
			'add_new_item'               => __( 'Add New Freebies Category', 'porto' ),
			'new_item_name'              => __( 'New Freebies Category Name', 'porto' ),
			'parent_item'                => __( 'Parent Freebies Category', 'porto' ),
			'parent_item_colon'          => __( 'Parent Freebies Category:', 'porto' ),
			'all_items'                  => __( 'All Freebies Categories', 'porto' ),
			'search_items'               => __( 'Search Freebies Categories', 'porto' ),
			'popular_items'              => __( 'Popular Freebies Categories', 'porto' ),
			'separate_items_with_commas' => __( 'Separate Freebies categories with commas', 'porto' ),
			'add_or_remove_items'        => __( 'Add or remove Freebies categories', 'porto' ),
			'choose_from_most_used'      => __( 'Choose from the most used freebies categories', 'porto' ),
			'not_found'                  => __( 'No freebies categories found.', 'porto' ),
			'items_list_navigation'      => __( 'Freebies categories list navigation', 'porto' ),
			'items_list'                 => __( 'Freebies categories list', 'porto' ),
		);

		$args = array(
			'labels'            => $labels,
			'public'            => true,
			'show_in_nav_menus' => false,
			'show_ui'           => true,
			'show_tagcloud'     => true,
			'hierarchical'      => true,
			'rewrite'           => array( 'slug' => 'freebies-category' ),
			'show_admin_column' => true,
			'query_var'         => true,
		);

		$args = apply_filters( 'freebies_post_type_category_args', $args );

		register_taxonomy( $this->taxonomies[0], $this->post_type, $args );
	}

	/**
	 * Register a taxonomy for Tags Portfolio.
	 *
	 * @link http://codex.wordpress.org/Function_Reference/register_taxonomy
	 */
	protected function register_taxonomy_tags() {
		$labels = array(
			'name'                       => __( 'Tags', 'porto' ),
			'singular_name'              => __( 'Tags', 'porto' ),
			'menu_name'                  => __( 'Tags', 'porto' ),
			'edit_item'                  => __( 'Edit Tag', 'porto' ),
			'update_item'                => __( 'Update Tag', 'porto' ),
			'add_new_item'               => __( 'Add New Tag', 'porto' ),
			'new_item_name'              => __( 'New Tag Name', 'porto' ),
			'parent_item'                => __( 'Parent Tag', 'porto' ),
			'parent_item_colon'          => __( 'Parent Tag:', 'porto' ),
			'all_items'                  => __( 'All Tags', 'porto' ),
			'search_items'               => __( 'Search Tags', 'porto' ),
			'popular_items'              => __( 'Popular Tags', 'porto' ),
			'separate_items_with_commas' => __( 'Separate tags with commas', 'porto' ),
			'add_or_remove_items'        => __( 'Add or remove tag', 'porto' ),
			'choose_from_most_used'      => __( 'Choose from the most used tags', 'porto' ),
			'not_found'                  => __( 'No skill found.', 'porto' ),
		);

		$args = array(
			'labels'            => $labels,
			'public'            => true,
			'show_in_nav_menus' => false,
			'show_ui'           => true,
			'show_tagcloud'     => true,
			'hierarchical'      => false,
			'rewrite'           => array( 'slug' => 'tags' ),
			'show_admin_column' => true,
			'query_var'         => true,
		);

		$args = apply_filters( 'freebies_post_type_tags_args', $args );

		register_taxonomy( $this->taxonomies[1], $this->post_type, $args );
	}
}
