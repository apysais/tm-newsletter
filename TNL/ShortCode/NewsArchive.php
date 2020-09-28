<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}
/**
 * News lists Shortcode.
 **/
class TNL_ShortCode_NewsArchive
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
    add_shortcode( 'tm_news_archive', [ $this, 'init' ] );
  }

  public function init( $atts ) {
		/**
		 * get
		 * latest, all
		 * count
		 * -1 all
		 * {count} - how many to get
		 */
		 /**
 		 * Select template type.
 		 * whether 2 column or 1 and 2 column.
 		 * column_1 : One Column
 		 * column_1_full_width : One Column full width with full text
 		 * column_2 : Two Column
 		 * column_1_2 : One and Two Column
 		 */
    $atts = shortcode_atts( [
			'get' => 'latest',
			'posts_per_page' => -1,
			'template' => 'column_1'
    ], $atts, 'tm_news_archive' );

    $data = [];
		$archive_obj = new TNL_NewsLetter_Archive;

		$get_all = $archive_obj->getAll([
			'posts_per_page' => 1
		]);

    $posts = $archive_obj->getPostLimit([
      'data' => $get_all
    ]);
    $archives = $archive_obj->getArchiveBy([
      'data' => $get_all
    ]);
    $archvied_top_content = $archive_obj->getArchivedTop([
      'data' => $archives
    ]);

		$data = [
			'content' => [
				'all' => $get_all,
	      'archvied_top_content' => $archvied_top_content,
	      'archives' => $archives,
			]
		];
		tnl_dd($data);
		ob_start();
    TNL_View::get_instance()->public_partials('shortcodes/newsletter/latest-newsletter.php', $data);
		return ob_get_clean();
  }

}//
