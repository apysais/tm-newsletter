<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}
/**
 * News lists Shortcode.
 **/
class TNL_ShortCode_NewsLists
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
    add_shortcode( 'tm_news_lists', [ $this, 'init' ] );
  }

  public function init( $atts ) {
		/**
		 * Select template type.
		 * whether 2 column or 1 and 2 column.
		 * column_1 : One Column
		 * column_1_full_width : One Column full width with full text
		 * column_2 : Two Column
		 * column_1_2 : One and Two Column
		 */
    $atts = shortcode_atts( [
			'category' => '',
			'template' => 'column_1'
    ], $atts, 'tm_news_lists' );

    $data = [];

		// $paged = ( get_query_var('paged') ) ? get_query_var('paged') : 1;
		$tax_query = [];
		if ( $atts['category'] !== '' ) {
			$tax_query = array(
	        array(
	            'taxonomy' => 'category_news',
	            'field'    => 'slug',
	            'terms'    => $atts['category'],
	        ),
	    );
		}
		
		$query = array(
	    'post_type' => 'news',
	    'paged' => $paged,
			'tax_query' => $tax_query
		);

		// The Query
		$posts = TNL_GetPosts::get_instance()->query($query);

		$data = [
			'template' => $atts['template'],
			'posts' => $posts
		];

		ob_start();

		TNL_View::get_instance()->public_partials('news-lists.php', $data);

		return ob_get_clean();
  }

}//
