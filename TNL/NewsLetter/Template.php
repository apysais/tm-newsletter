<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}
/**
* Newsletter Templates.
**/
class TNL_NewsLetter_Template
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
		add_filter('single_template', [$this, 'init'], 100, 3);
		add_filter('archive_template', [$this, 'init'], 100, 3);
  }

	/**
	 * Check and use template in the plugin.
	 */
  public function init( $template, $type, $templates) {

    if ( is_singular( 'newsletter' ) ) {
			$template = locate_template( 'tm-newsletter/single-newsletter.php' );
			if ( !$template ) {
				$template = TNL_View::get_instance()->public_part_partials('newsletter/single-newsletter.php');
			}
    }

    if ( is_singular( 'news' ) ) {
			$template = locate_template( 'tm-newsletter/single-news.php' );

			if ( !$template ) {
				$template = TNL_View::get_instance()->public_part_partials('newsletter/single-news.php');
			}
    }

    if ( is_post_type_archive('news') ) {
			$template = locate_template( 'tm-newsletter/archive-news.php' );

			if ( !$template ) {
				$template = TNL_View::get_instance()->public_part_partials('newsletter/archive-news.php');
			}
    }

    if ( is_post_type_archive('newsletter') ) {
			$template = locate_template( 'archive-newsletter.php' );

			if ( !$template ) {
				$template = TNL_View::get_instance()->public_part_partials('newsletter/archive-newsletter.php');
			}
    }

		return $template;
  }

	public function getWPLogo() {
		$custom_logo_id = get_theme_mod( 'custom_logo' );
		$logo = wp_get_attachment_image_src( $custom_logo_id , 'full' );
		if ( has_custom_logo() ) {
		    echo '<img src="' . esc_url( $logo[0] ) . '" alt="' . get_bloginfo( 'name' ) . '" class="mx-auto d-block">';
		} else {
		    echo '<h1>'. get_bloginfo( 'name' ) .'</h1>';
		}
	}

}//
