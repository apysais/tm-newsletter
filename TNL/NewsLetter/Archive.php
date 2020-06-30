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
  public function getAll($args = []) {
    $data = [];
    // The Query
    $defaults = [
      'posts_per_page' => isset($args['posts_per_page']) ? $args['posts_per_page'] : -1,
      'post_type' => 'newsletter',
			'meta_key' => 'settings_issue_date',
			'orderby' =>  'meta_value_num'
    ];

		$args = wp_parse_args( $args, $defaults );

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
				$get_issue_date = get_field('settings_issue_date', $v->ID);
        $date = substr($get_issue_date, -4);
        // $date = date('Y', strtotime($v->post_date) );
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
				//$get_issue_date = get_field('settings_issue_date', $item_data->ID);
        //$date = date('Y', strtotime($get_issue_date) );
        // $date = date('Y', strtotime($item_data->post_date) );
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
		for( $i = 0; $i < $limit; $i++) {
			$posts = $this->getTopContent([
				'post_id' => $get_datas[$i]->ID
			]);
			if ( $posts ) {
				$ret_datas['content'][] = $posts;
			}
		}
    
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
			$get_posts = TNL_NewsLetter_Featured::get_instance()->getNewsPosts([
					'post_id' => $post_id
			]);

      if ( $get_posts && !empty($get_posts['news_post']) ) {
				$arr_post_id = [];
				if ( isset($get_posts['news_post'][0]) ) {
					$arr_post_id = $get_posts['news_post'][0];
				}
				$posts = TNL_GetPosts::get_instance()->query(['post__in' => [ $arr_post_id ] ]);
        $data = $posts[0];
      } else {
        $standard = $get_posts = TNL_NewsLetter_Standard::get_instance()->getNewsPosts([
  					'post_id' => $post_id
  			]);

				$arr_post_id = [];
				if ( isset($standard['news_post'][0]) ) {
					$arr_post_id = $standard['news_post'][0];
				}
				$posts = TNL_GetPosts::get_instance()->query(['post__in' => [ $arr_post_id ] ]);
        $data = $posts[0];
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
      'data' => $get_all
    ]);

    $datas = [
      'all' => $get_all,
      'archvied_top_content' => $archvied_top_content,
      'archives' => $archives,
    ];
		//tnl_dd($datas);
    return $datas;
  }

	/**
	 * Show build newsletter
	 *
	 * @return HTML
	 */
	public function show($args = []) {
		$defaults = array (
			'content' => []
    );

    // Parse incoming $args into an array and merge it with $defaults
    $args = wp_parse_args( $args, $defaults );
		$content = $this->build();

		$data['content'] = $content;

		$template = locate_template( 'tm-newsletter/build-newsletter.php' );

		if ( !$template ) {
			$template = TNL_View::get_instance()->public_part_partials('newsletter/build-newsletter.php');
		}

		TNL_View::get_instance()->display($template, $data);
	}

}//
