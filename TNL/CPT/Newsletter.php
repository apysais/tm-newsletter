<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}
/**
* Convert parse string to Input text.
**/
class TNL_CPT_Newsletter
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

  public function register() {

      /**
      * Post Type: News.
      */

      $text_domain = tnl_get_text_domain();

      $labels = array(
        "name" => __( "Newsletter", $text_domain ),
        "singular_name" => __( "Newsletter", $text_domain ),
        "menu_name" => __( "Newsletter", $text_domain ),
      );

      $args = array(
        "label" => __( "Newsletter", $text_domain ),
        "labels" => $labels,
        "description" => "",
        "public" => true,
        "publicly_queryable" => true,
        "show_ui" => true,
        "delete_with_user" => false,
        "show_in_rest" => true,
        "rest_base" => "",
        "rest_controller_class" => "WP_REST_Posts_Controller",
        "has_archive" => true,
        "show_in_menu" => true,
        "show_in_nav_menus" => true,
        "exclude_from_search" => false,
        "capability_type" => "post",
        "map_meta_cap" => true,
        "hierarchical" => false,
        "rewrite" => array( "slug" => "newsletter", "with_front" => true ),
        "query_var" => true,
        "supports" => array( "title", "thumbnail", "author", "page-attributes", "post-formats", "comments" ),
      );

      register_post_type( "newsletter", $args );

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
        'labels'            => $labels_news_tax,
        'show_ui'           => true,
        'show_admin_column' => true,
        'query_var'         => true,
        'rewrite'           => array( 'slug' => 'category-newsletter' ),
      );

      register_taxonomy( 'category_newsletter', array( 'newsletter' ), $args_news_tax );

    }


}//
