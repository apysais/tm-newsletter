<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}
/**
 * NewsLetter Single Shortcode need to provide the ID.
 **/
class TNL_ShortCode_NewsLetterSingle
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
    add_shortcode( 'tm_newsletter_single', [ $this, 'init' ] );
  }

  public function init( $atts ) {

    $atts = shortcode_atts( [
			'newsletter_id' => $atts['id'],
			'grid_container' => 'col-md-6',
    ], $atts, 'tm_newsletter_single' );

		$data = TNL_NewsLetter_Single::get_instance()->get($atts);
		$data['grid_container'] = $atts['grid_container'];
		ob_start();
    TNL_View::get_instance()->public_partials('shortcodes/newsletter/single.php', $data);
		return ob_get_clean();
  }

}//
