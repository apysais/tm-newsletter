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
			'post_id' => $atts['id']
    ], $atts, 'tm_newsletter_single' );

		$newsletter = TNL_NewsLetter_Settings::get_instance()->getMetaData( $atts['post_id'] );

		$query_args = [
			'post_id' => $atts['post_id']
		];

		$featured = TNL_NewsLetter_Query::get_instance()->getFeatured( $query_args );
		$standard = TNL_NewsLetter_Query::get_instance()->getStandard( $query_args );
		$did_you_know = TNL_NewsLetter_Query::get_instance()->getDidYouKnow( $query_args );
		$meet_the_community = TNL_NewsLetter_Query::get_instance()->getMeetCommunity( $query_args );
		$whats_on = TNL_NewsLetter_Query::get_instance()->getWhatsOn( $query_args );
		$instagram = TNL_NewsLetter_Query::get_instance()->getInstagram( $query_args );
		$project_updates = TNL_NewsLetter_Query::get_instance()->getProjectUpdates( $query_args );

    $data = [
			'post_id' => $atts['post_id'],
			'newsletter_data' => $newsletter,
			'featured' => $featured,
			'standard' => $standard,
			'did_you_know' => $did_you_know,
			'meet_the_community' => $meet_the_community,
			'whats_on' => $whats_on,
			'instagram' => $instagram,
			'project_updates' => $project_updates,
		];
		
    TNL_View::get_instance()->public_partials('shortcodes/newsletter/single.php', $data);

  }

}//
