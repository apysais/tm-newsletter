<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}
/**
* Get news posts.
**/
class TNL_GetPosts
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

  }

  /**
   * Get news posts by category
   * @see https://developer.wordpress.org/reference/classes/wp_query/
   * @param array $args {
   *    an array of arguments pass to WP_Query, check WP_Query list of arguments
   * }
   * @return array|bool
   */
  public function query( $args = [] ) {

    $defaults = [
      'post_type' => 'news',
      'post__in' => []
    ];

    $args = wp_parse_args( $args, $defaults );

    $query_args = $args;

    $query = new WP_Query( $query_args );

    if ( $query->have_posts() ) {
      return $query->posts;
    }

    wp_reset_postdata();

    return false;
  }


}//
