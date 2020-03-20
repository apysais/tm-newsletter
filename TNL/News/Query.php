<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}
/**
* Build newsletter
**/
class TNL_News_Query
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
	 * Get all newsletters.
	 * @param array $args {
	 *		@type int $post_id the post id
 	 * }
	 */
	public function getAllNews( $args = [] ) {
		$defaults = [
			'posts_per_page' 	=> '-1',
			'post_type' 			=> 'news',
		];

		$args = wp_parse_args( $args, $defaults );

		$get = get_posts( $args );

		return $get;
	}

}//
