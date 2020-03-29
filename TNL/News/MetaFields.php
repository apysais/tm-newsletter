<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}
/**
* News Meta Fields.
**/
class TNL_News_MetaFields
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

  public function settings($post_id) {
    $settings =  TNL_ACF_Fields::get_instance()->getFields( 'settings', $post_id );
    if ( $settings ) {
      return $settings;
    }
    return false;
  }

  public function cta($post_id) {
    $settings =  $this->settings($post_id );
    if ( $settings && isset($settings['cta_url']) ) {
      return get_permalink($settings['cta_url']);
    }
    return false;
  }


}//
