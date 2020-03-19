<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}
/**
 * Get the Meet CommunityCategory Posts.
 */
class TNL_NewsLetter_MeetCommunity
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
   * Get news posts.
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

    $news_posts =  TNL_ACF_Fields::get_instance()->getFields( 'meet_the_community', $post_id );

    if ( $news_posts ) {
      return $news_posts['news_post'];
    }

    return false;
  }


}//
