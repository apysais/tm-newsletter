<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}
/**
* Filter news by category.
**/
class TNL_AjaxCategory
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
    add_action( 'wp_ajax_tnl_get_category', [$this, 'getCategory'] );
    add_action( 'wp_ajax_nopriv_tnl_get_category', [$this, 'getCategory'] );
  }

  public function getCategory() {
    if ( isset($_POST['action']) ) {
      $paged = ( $_POST['paged'] ) ? $_POST['paged'] : 1;
      $cat_id   = isset($_POST['cat_id']) ? $_POST['cat_id'] : false;
      $cat_slug = isset($_POST['cat_slug']) ? $_POST['cat_slug'] : false;

      $args = array(
        'post_type' => 'news',
				'paged' => $paged,
      );
			if ( $cat_slug != 'all' && $cat_id != 0 ) {
				$args['tax_query'] = array(
            array(
                'taxonomy' => 'category_news',
                'field'    => 'slug',
                'terms'    => $cat_slug,
            ),
        );
			}
      if ( $cat_id == 0 ) {
        $args['tax_query'] = [];
      }

			query_posts($args);
      //$query = new WP_Query( $args );

      $template = locate_template( 'tm-newsletter/ajax-taxonomy-category_news.php' );
			if ( !$template ) {
				$template = TNL_View::get_instance()->public_part_partials('newsletter/ajax-taxonomy-category_news.php');
			}
			wp_reset_postdata();
      require $template;
    }

    wp_die();
  }


}//
