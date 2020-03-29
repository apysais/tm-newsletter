<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}
/**
 * Newsletter Archive.
 */
class TNL_NewsLetter_Archive
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
   * get all newsletters.
   */
  public function getAll() {
    $data = [];
    // The Query
    $args = [
      'posts_per_page' => -1,
      'post_type' => 'newsletter',
    ];
    $the_query = new WP_Query( $args );
    // The Loop
    if ( $the_query->have_posts() ) {
        $data = $the_query->posts;
    } else {
        // no posts found
    }
    /* Restore original Post Data */
    wp_reset_postdata();

    return $data;
  }

  public function getArchiveBy( $args = [] ) {
    $defaults = array (
      'by' => 'year',
      'data' => [],
      'exclude_this_ids' => []
    );

    // Parse incoming $args into an array and merge it with $defaults
    $args = wp_parse_args( $args, $defaults );

    $get_by = $args['by'];
    $get_datas = $args['data'];
    $ret_datas = [];
    if ( $get_datas ) {
      foreach( $get_datas as $k => $v ) {
        $date = date('Y', strtotime($v->post_date) );
        $ret_datas[$date][] = [
          'id' => $v->ID,
          'title' => $v->post_title,
          'permalink' => get_permalink($v->ID)
        ];
      }
    }
    return $ret_datas;
  }

  /**
   * get the post by array limit
   */
  public function getPostLimit( $args = [] ) {
    $defaults = array (
      'limit' => TM_NEWSLETTER_ARCHIVE_LIMIT,
      'data' => [],
    );

    // Parse incoming $args into an array and merge it with $defaults
    $args = wp_parse_args( $args, $defaults );

    $get_datas = $args['data'];
    $limit = $args['limit'];

    $ret_datas = [];
    if ( $get_datas ) {
      for( $i = 0; $i < $limit; $i++) {
        $item_data = $get_datas[$i];

        $date = date('Y', strtotime($item_data->post_date) );
        $ret_datas[] = $item_data;
      }
    }
    return $ret_datas;
  }

  /**
   * Get the archived top post
   */
  public function getArchivedTopByYear( $args = [] ) {
    $defaults = array (
      'limit' => TM_NEWSLETTER_ARCHIVE_LIMIT,
      'data' => [],
    );

    // Parse incoming $args into an array and merge it with $defaults
    $args = wp_parse_args( $args, $defaults );

    $get_datas = $args['data'];
    $limit = $args['limit'];

    $ret_datas = [];
    $key_archived_year = array_keys($get_datas);
    $top_archived_year = [];

    for( $i = 0; $i < $limit; $i++) {
      $top_archived_year[] = $key_archived_year[$i];
    }

    foreach( $top_archived_year as $k => $year ) {
      if ( isset($get_datas[$year][0]) ) {
        $ret_datas[$year] = $get_datas[$year][0];
        $post_id_arr = $this->getTopContent([
          'post_id'=>$get_datas[$year][0]['id']
        ]);
        if ( $post_id_arr ) {
          $query = [
  					'post__in' => $post_id_arr
  				];
          $content = TNL_GetPosts::get_instance()->query($query);
  				$ret_datas[$year]['content'] = isset($content[0]) ? $content[0] : [];
        }

      }
    }

    return $ret_datas;
  }

  public function getArchivedTop( $args = [] ) {
    $defaults = array (
      'limit' => TM_NEWSLETTER_ARCHIVE_LIMIT,
      'data' => [],
    );

    // Parse incoming $args into an array and merge it with $defaults
    $args = wp_parse_args( $args, $defaults );

    $get_datas = $args['data'];
    $limit = $args['limit'];

    $ret_datas = [];

    $key_archived_year = array_keys($get_datas);
    $top_archived_year = [];

    $current_year = isset($key_archived_year[0]) ? $key_archived_year[0] : false;

    if ( $current_year ) {
      for( $i = 0; $i < $limit; $i++) {
        $ret_datas[] = $get_datas[$current_year][$i];

        $posts = $this->getTopContent([
          'post_id' => $get_datas[$current_year][$i]['id']
        ]);

				if ( $posts ) {
					$ret_datas[$i]['content'] = $posts;
				}
        // if ( $post_id_arr && isset($post_id_arr[0])) {
        //   $query = [
  			// 		'post__in' => [$post_id_arr[0]]
  			// 	];
        //   $content = TNL_GetPosts::get_instance()->query($query);
  			// 	$ret_datas[$i]['content'] = isset($content[0]) ? $content[0] : [];
        // }
      }
    }
		//exit();
    return $ret_datas;
  }

  /**
   * Get the newsletter top content, featured first and standard fallback.
   * Grab one post only.
   */
  public function getTopContent( $args = [] ) {
    $defaults = array (
      'posts' => [],
      'data' => [],
      'newsletter_post_ids' => [],
      'post_id' => 0
    );

    // Parse incoming $args into an array and merge it with $defaults
    $args = wp_parse_args( $args, $defaults );
    $posts = $args['posts'];
    $data = $args['data'];
    $post_id = $args['post_id'];
    if ( $post_id ) {

			$get_featured_posts = TNL_NewsLetter_Query::get_instance()->getFeatured([
				'post_id' => $post_id
			]);

      if ( $get_featured_posts ) {
        $data = $get_featured_posts[0];
      } else {
        $standard = $get_posts = TNL_NewsLetter_Query::get_instance()->getStandard([
  					'post_id' => $post_id
  			]);
				if ( $standard ) {
					$data = $standard[0];
				}
      }
      return $data;
    }
    return false;
  }

  /**
   * Build the newsletter.
   */
  public function build( $args = [] ) {
    $datas = [];
    //get all first;
    $get_all = $this->getAll();

    $posts = $this->getPostLimit([
      'data' => $get_all
    ]);
    $archives = $this->getArchiveBy([
      'data' => $get_all
    ]);
    $archvied_top_content = $this->getArchivedTop([
      'data' => $archives
    ]);

    $datas = [
      'all' => $get_all,
      'archvied_top_content' => $archvied_top_content,
      'archives' => $archives,
    ];
  
    return $datas;
  }

}//
