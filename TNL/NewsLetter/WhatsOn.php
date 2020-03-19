<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}
/**
 * Get the Events category by date range.
 */
class TNL_NewsLetter_WhatsOn
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
   * Get event posts.
   *
   * @param array $args  {
   *  array of arguments
   *  @type int $post_id the post id
   * }
   * @return array|bool
   **/
  public function getNewsPosts( $args = []) {
    $post_id = 0;
    if ( isset( $args['post_id'] ) ) {
      $post_id = $args['post_id'];
    }

    $fields =  TNL_ACF_Fields::get_instance()->getFields( 'whats_on', $post_id );

    if ( $fields ) {
      return $fields;
    }

    return false;
  }


}//