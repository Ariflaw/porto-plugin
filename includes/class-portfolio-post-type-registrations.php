<?php
/**
 * Portfolio Post Type
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
class Portfolio_Post_Type_Registrations {

	public $post_type = 'portfolio';

	public $taxonomies = array( 'portfolio-category', 'skills' );

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
            'name'                  => _x( 'Portfolio', 'Post Type General Name', 'porto' ),
    		'singular_name'         => _x( 'Portfolio', 'Post Type Singular Name', 'porto' ),
    		'menu_name'             => __( 'Portfolio', 'porto' ),
    		'name_admin_bar'        => __( 'Portfolio', 'porto' ),
    		'archives'              => __( 'Portfolio Archives', 'porto' ),
    		'attributes'            => __( 'Portfolio Attributes', 'porto' ),
    		'parent_item_colon'     => __( 'Parent Portfolio:', 'porto' ),
    		'all_items'             => __( 'All Portfolio', 'porto' ),
    		'add_new_item'          => __( 'Add New Portfolio', 'porto' ),
    		'add_new'               => __( 'Add New', 'porto' ),
    		'new_item'              => __( 'New Portfolio', 'porto' ),
    		'edit_item'             => __( 'Edit Portfolio', 'porto' ),
    		'update_item'           => __( 'Update Portfolio', 'porto' ),
    		'view_item'             => __( 'View Portfolio', 'porto' ),
    		'view_items'            => __( 'View Portfolios', 'porto' ),
    		'search_items'          => __( 'Search Portfolio', 'porto' ),
    		'not_found'             => __( 'Not found', 'porto' ),
    		'not_found_in_trash'    => __( 'Not found in Trash', 'porto' ),
    		'featured_image'        => __( 'Featured Image', 'porto' ),
    		'set_featured_image'    => __( 'Set featured image', 'porto' ),
    		'remove_featured_image' => __( 'Remove featured image', 'porto' ),
    		'use_featured_image'    => __( 'Use as featured image', 'porto' ),
    		'insert_into_item'      => __( 'Insert into Portfolio', 'porto' ),
    		'uploaded_to_this_item' => __( 'Uploaded to this Portfolio', 'porto' ),
    		'items_list'            => __( 'Portfolios list', 'porto' ),
    		'items_list_navigation' => __( 'Portfolios list navigation', 'porto' ),
    		'filter_items_list'     => __( 'Filter Portfolios list', 'porto' ),
		);

		$supports = array(
			'title',
			'editor',
			'thumbnail',
			'revisions',
		);

		$args = array(
            'label'           => __( 'Portfolio', 'porto' ),
            'description'     => __( 'Post to show your Portfolio', 'porto' ),
			'labels'          => $labels,
			'supports'        => $supports,
			'public'          => true,
            'show_ui'         => true,
            'show_in_menu'    => true,
            'can_export'      => true,
		    'has_archive'     => true,
			'capability_type' => 'page',
			'rewrite'         => array( 'slug' => 'portfolio', ), // Permalinks format
			'menu_position'   => 20,
			'menu_icon'       => 'dashicons-layout',
		);

		$args = apply_filters( 'portfolio_post_type_args', $args );

		register_post_type( $this->post_type, $args );
	}

    /**
	 * Register a taxonomy for Category Portfolio.
	 *
	 * @link http://codex.wordpress.org/Function_Reference/register_taxonomy
	 */
	protected function register_taxonomy_categories() {
		$labels = array(
            'name'                       => __( 'Portfolio Categories', 'porto' ),
			'singular_name'              => __( 'Portfolio Category', 'porto' ),
			'menu_name'                  => __( 'Categories', 'porto' ),
			'edit_item'                  => __( 'Edit Portfolio Category', 'porto' ),
			'update_item'                => __( 'Update Portfolio Category', 'porto' ),
			'add_new_item'               => __( 'Add New Portfolio Category', 'porto' ),
			'new_item_name'              => __( 'New Portfolio Category Name', 'porto' ),
			'parent_item'                => __( 'Parent Portfolio Category', 'porto' ),
			'parent_item_colon'          => __( 'Parent Portfolio Category:', 'porto' ),
			'all_items'                  => __( 'All Portfolio Categories', 'porto' ),
			'search_items'               => __( 'Search Portfolio Categories', 'porto' ),
			'popular_items'              => __( 'Popular Portfolio Categories', 'porto' ),
			'separate_items_with_commas' => __( 'Separate portfolio categories with commas', 'porto' ),
			'add_or_remove_items'        => __( 'Add or remove portfolio categories', 'porto' ),
			'choose_from_most_used'      => __( 'Choose from the most used portfolio categories', 'porto' ),
			'not_found'                  => __( 'No portfolio categories found.', 'porto' ),
			'items_list_navigation'      => __( 'Portfolio categories list navigation', 'porto' ),
			'items_list'                 => __( 'Portfolio categories list', 'porto' ),
		);

		$args = array(
			'labels'            => $labels,
			'public'            => true,
			'show_in_nav_menus' => false,
			'show_ui'           => true,
			'show_tagcloud'     => true,
			'hierarchical'      => true,
			'rewrite'           => array( 'slug' => 'category-portfolio' ),
			'show_admin_column' => true,
			'query_var'         => true,
		);

		$args = apply_filters( 'portfolio_post_type_category_args', $args );

		register_taxonomy( $this->taxonomies[0], $this->post_type, $args );
	}

	/**
	 * Register a taxonomy for Tags Portfolio.
	 *
	 * @link http://codex.wordpress.org/Function_Reference/register_taxonomy
	 */
	protected function register_taxonomy_tags() {
		$labels = array(
			'name'                       => __( 'Skills', 'porto' ),
			'singular_name'              => __( 'Skills', 'porto' ),
			'menu_name'                  => __( 'Skills', 'porto' ),
			'edit_item'                  => __( 'Edit Skill', 'porto' ),
			'update_item'                => __( 'Update Skill', 'porto' ),
			'add_new_item'               => __( 'Add New Skill', 'porto' ),
			'new_item_name'              => __( 'New Skill Name', 'porto' ),
			'parent_item'                => __( 'Parent Skill', 'porto' ),
			'parent_item_colon'          => __( 'Parent Skill:', 'porto' ),
			'all_items'                  => __( 'All Skills', 'porto' ),
			'search_items'               => __( 'Search Skills', 'porto' ),
			'popular_items'              => __( 'Popular Skills', 'porto' ),
			'separate_items_with_commas' => __( 'Separate skills with commas', 'porto' ),
			'add_or_remove_items'        => __( 'Add or remove skill', 'porto' ),
			'choose_from_most_used'      => __( 'Choose from the most used skills', 'porto' ),
			'not_found'                  => __( 'No skill found.', 'porto' ),
		);

		$args = array(
			'labels'            => $labels,
			'public'            => true,
			'show_in_nav_menus' => false,
			'show_ui'           => true,
			'show_tagcloud'     => true,
			'hierarchical'      => false,
			'rewrite'           => array( 'slug' => 'skills' ),
			'show_admin_column' => true,
			'query_var'         => true,
		);

		$args = apply_filters( 'portfolio_post_type_tags_args', $args );

		register_taxonomy( $this->taxonomies[1], $this->post_type, $args );
	}
}
