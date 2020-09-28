<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}
/**
 * NewsLetter Shortcode.
 **/
class TNL_ShortCode_NewsLetterLists
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
    add_shortcode( 'tm_newsletter_lists', [ $this, 'init' ] );
  }

  public function init( $atts ) {

    $atts = shortcode_atts( [
			'show_archive' => 0,
			'archvied_top_content_limit' => 0
    ], $atts, 'tm_newsletter_lists' );


		$ret = TNL_NewsLetter_Archive::get_instance()->build($atts);

		if ( $atts['archvied_top_content_limit'] > 0 ) {
			$count = count($ret['archvied_top_content']['content']);
			$array_splice_index = ($count - $atts['archvied_top_content_limit']);
			array_splice( $ret['archvied_top_content']['content'], $atts['archvied_top_content_limit'] );
		}

		$data = [
			'content' => $ret
		];

		//tnl_dd($data);
		ob_start();

		$template = locate_template( 'tm-newsletter/shortcode-newsletter-list.php' );

		if ( !$template ) {
			$template = TNL_View::get_instance()->public_part_partials('newsletter/shortcode-newsletter-list.php');
		}

		TNL_View::get_instance()->display($template, $data);

		return ob_get_clean();
  }

}//
