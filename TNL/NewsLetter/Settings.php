<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}
/**
 * NewsLetter settings.
 **/
class TNL_NewsLetter_Settings
{
  /**
	 * instance of this class
	 *
	 * @since 0.0.1
	 * @access protected
	 * @var	null
	 * */
	protected static $instance = null;

  protected $post_id = null;

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
   * Set post ID
   *
   * @param int $post_id post id.
   * @return none;
   */
  public function setPostId( $post_id ) {
    $this->post_id = $post_id;
  }

  /**
   * Get post ID
   *
   * @return int|$post_id;
   */
  public function getPostId() {
    return $this->post_id;
  }

  /**
   * Get the settings acf fields
   *
   * @return array|bool
   */
  public function get() {
    $post_id = $this->getPostId();
    return get_field( 'settings', $post_id);
  }

  /**
   * Get the issue date
   *
   * @return array|bool
   */
  public function getIssueDate() {
   $get = $this->get();
   return $get;
  }

	/**
	 * Get the newsletter meta data
	 */
	public function getMetaData( $post_id ) {
		$data = false;

		$args = [
			'include' 	=> [$post_id],
			'post_type' => 'newsletter',
		];

		$get = get_posts( $args );

		if ( $get ) {
			$meta[] = get_field( 'settings', $post_id);
			$data = [
				'post' => $get[0],
				'meta' => $meta
			];
		}

		return $data;
	}


}//
