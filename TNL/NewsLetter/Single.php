<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}
/**
 * Get the Single Newsletter.
 */
class TNL_NewsLetter_Single
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

  public function get( $args = [] ) {
    $newsletter_id = isset($args['newsletter_id']) ? $args['newsletter_id'] : false;
    if ( $newsletter_id ) {
      $newsletter = TNL_NewsLetter_Settings::get_instance()->getMetaData( $newsletter_id );

  		$query_args = [
  			'post_id' => $newsletter_id
  		];
  		$featured = TNL_NewsLetter_Query::get_instance()->getFeatured( $query_args );
  		$standard = TNL_NewsLetter_Query::get_instance()->getStandard( $query_args );
  		$did_you_know = TNL_NewsLetter_Query::get_instance()->getDidYouKnow( $query_args );
  		$meet_the_community = TNL_NewsLetter_Query::get_instance()->getMeetCommunity( $query_args );
  		$whats_on = TNL_NewsLetter_Query::get_instance()->getWhatsOn( $query_args );
  		$instagram = TNL_NewsLetter_Query::get_instance()->getInstagram( $query_args );
  		$project_updates = TNL_NewsLetter_Query::get_instance()->getProjectUpdates( $query_args );
  		$community_contributions = TNL_NewsLetter_Query::get_instance()->getCommunityContributions( $query_args );
  		$community_notice = TNL_NewsLetter_Query::get_instance()->getCommunityNotice( $query_args );
      $data = [
  			'post_id' => $args['newsletter_id'],
  			'newsletter_data' => $newsletter,
  			'featured' => $featured,
  			'standard' => $standard,
  			'did_you_know' => $did_you_know,
  			'meet_the_community' => $meet_the_community,
  			'whats_on' => $whats_on,
  			'instagram' => $instagram,
  			'project_updates' => $project_updates,
  			'community_contributions' => $community_contributions,
  			'community_notice' => $community_notice,
  		];
			// tnl_debug_print($data);
			// tnl_dd($data);
      return $data;
    }
    return false;
  }

  public function show($args = []) {
    $data = TNL_NewsLetter_Single::get_instance()->get($args);
		$data['grid_container'] = isset($args['grid_container']) ? $args['grid_container'] : 'col-md-8';

		$template = locate_template( 'tm-newsletter/single-part-newsletter.php' );

		if ( !$template ) {
			TNL_View::get_instance()->public_partials('shortcodes/newsletter/single.php', $data);
		} else {
			TNL_View::get_instance()->display($template, $data);
		}

  }

}//
