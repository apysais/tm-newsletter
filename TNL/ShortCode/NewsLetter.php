<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}
/**
 * NewsLetter Shortcode.
 **/
class TNL_ShortCode_NewsLetter
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
    add_shortcode( 'tm_newsletter', [ $this, 'init' ] );
  }

  public function init( $atts ) {

    $atts = shortcode_atts( [

    ], $atts, 'tm_newsletter' );

    $data = [];

    TNL_View::get_instance()->public_partials('shortcodes/newsletter/index.php', $data);

  }

}//
