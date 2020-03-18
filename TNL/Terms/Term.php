<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}
/**
* Convert parse string to Input text.
**/
class TNL_Terms_Term
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
   * Get the terms;
   */
  public function get_terms() {
    $terms_arr = [
      'Feature',
      'Standard',
      'What\'s on ',
      'Did you know',
      'Meet the community',
      'Project Updates',
    ];
    return $terms_arr;
  }

  /**
   * Create terms.
   */
  public function create() {
    if ( !get_option('tnl_create_news_category') ) {
      $get_terms = $this->get_terms();
      foreach ( $get_terms as $term ) {
        $check_term = term_exists( $term, TM_NEWS_TAX );
        if ( $check_term == 0 && $check_term == null ) {
          wp_insert_term ( $term , TM_NEWS_TAX );
        }
      }
      $this->setOption();
    }
  }

  /**
   * Search Terms if exists.
   */
  public function search() {

  }

  /**
   * Set the option to true so it dont always check for the terms.
   */
  public function setOption() {
    update_option('tnl_create_news_category', 1);
  }

}//
