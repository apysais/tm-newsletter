<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}
/**
* Custom post type, News.
**/
class TNL_CPT_News
{
  /**
	 * instance of this class
	 *
	 * @since 0.0.1
	 * @access protected
	 * @var	null
	 * */
	protected static $instance = null;

	/**
	 * Return an instance of this class.
	 *
	 * @since     0.0.1
	 *
	 * @return    object    A single instance of this class.
	 */
	public static function get_instance() {

		/*
		 * - Uncomment following lines if the admin class should only be available for super admins
		 */
		/* if( ! is_super_admin() ) {
			return;
		} */

		// If the single instance hasn't been set, set it now.
		if ( null == self::$instance ) {
			self::$instance = new self;
		}

		return self::$instance;
	}

  public function __construct() {
    $this->register();
  }

	/**
	 * Register the custom post type.
	 */
  public function register() {

      /**
      * Post Type: News.
      */

      $text_domain = tnl_get_text_domain();

      $labels = array(
        "name" => __( "News", $text_domain ),
        "singular_name" => __( "News", $text_domain ),
        "menu_name" => __( "News", $text_domain ),
      );

			$args = array(
        'labels'             => $labels,
        'public'             => true,
        'publicly_queryable' => true,
        'show_ui'            => true,
        'show_in_menu'       => true,
        'query_var'          => true,
        'rewrite'            => array( 'slug' => 'news' ),
        'capability_type'    => 'post',
        'has_archive'        => true,
        'hierarchical'       => false,
        'menu_position'      => null,
				'show_in_rest' 			 => false,
        'supports'           => array( 'title', 'editor', 'author', 'thumbnail', 'page-attributes', 'excerpt', 'comments' ),
    	);


      register_post_type( "news", $args );

      $labels_news_tax = array(
        'name'              => _x( 'Category', 'taxonomy general name', $text_domain ),
        'singular_name'     => _x( 'Category', 'taxonomy singular name', $text_domain ),
        'search_items'      => __( 'Search Category', $text_domain ),
        'all_items'         => __( 'All Category', $text_domain ),
        'parent_item'       => __( 'Parent Category', $text_domain ),
        'parent_item_colon' => __( 'Parent Category:', $text_domain ),
        'edit_item'         => __( 'Edit Category', $text_domain ),
        'update_item'       => __( 'Update Category', $text_domain ),
        'add_new_item'      => __( 'Add New Category', $text_domain ),
        'new_item_name'     => __( 'New Category Name', $text_domain ),
        'menu_name'         => __( 'Category', $text_domain ),
      );

      $args_news_tax = array(
        'hierarchical'      => true,
				'show_in_rest' 			=> false,
        'labels'            => $labels_news_tax,
        'show_ui'           => true,
        'show_admin_column' => true,
        'query_var'         => true,
        'rewrite'           => array( 'slug' => 'category-news' ),
      );

      register_taxonomy( 'category_news', array( 'news' ), $args_news_tax );

    }


}//
