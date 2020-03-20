<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}
/**
* Build newsletter
**/
class TNL_NewsLetter_Query
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
	 * Get the featured posts.
	 * @param array $args {
	 *		@type int $post_id the post id
 	 * }
	 */
  public function getFeatured( $args = [] ) {
		$post_id = false;
		$data = false;

		if ( isset( $args['post_id'] ) ) {
			$post_id = $args['post_id'];
		}

		if ( $post_id ) {
			$get_posts = TNL_NewsLetter_Featured::get_instance()->getNewsPosts([
					'post_id' => $post_id
			]);

			if ( $get_posts ) {
				$query = [
					'post__in' => $get_posts
				];
				$posts = TNL_GetPosts::get_instance()->query($query);

				$data = $posts;
			}
		}

		return $data;

	}


	/**
	 * Get the standard posts.
	 * @param array $args {
	 *		@type int $post_id the post id
 	 * }
	 */
  public function getStandard( $args = [] ) {
		$post_id = false;
		$data = false;

		if ( isset( $args['post_id'] ) ) {
			$post_id = $args['post_id'];
		}

		if ( $post_id ) {
			$get_posts = TNL_NewsLetter_Standard::get_instance()->getNewsPosts([
					'post_id' => $post_id
			]);

			if ( $get_posts ) {
				$query = [
					'post__in' => $get_posts
				];
				$posts = TNL_GetPosts::get_instance()->query($query);

				$data = $posts;
			}
		}

		return $data;

	}

	/**
	 * Get the instagram posts.
	 * @param array $args {
	 *		@type int $post_id the post id
 	 * }
	 */
  public function getInstagram( $args = [] ) {
		$post_id = false;
		$data = false;

		if ( isset( $args['post_id'] ) ) {
			$post_id = $args['post_id'];
		}

		if ( $post_id ) {
			$get_posts = TNL_NewsLetter_Instagram::get_instance()->getNewsPosts([
					'post_id' => $post_id
			]);

			if ( $get_posts ) {
				$query = [
					'post__in' => $get_posts
				];
				$posts = TNL_GetPosts::get_instance()->query($query);

				$data = $posts;
			}
		}

		return $data;

	}

	/**
	 * Get did you know posts.
	 * @param array $args {
	 *		@type int $post_id the post id
 	 * }
	 */
  public function getDidYouKnow( $args = [] ) {
		$post_id = false;
		$data = false;

		if ( isset( $args['post_id'] ) ) {
			$post_id = $args['post_id'];
		}

		if ( $post_id ) {
			$get_posts = TNL_NewsLetter_DidYouKnow::get_instance()->getNewsPosts([
					'post_id' => $post_id
			]);

			if ( $get_posts ) {
				$query = [
					'post__in' => $get_posts
				];
				$posts = TNL_GetPosts::get_instance()->query($query);

				$data = $posts;
			}
		}

		return $data;

	}

	/**
	 * Get meet community posts.
	 * @param array $args {
	 *		@type int $post_id the post id
 	 * }
	 */
  public function getMeetCommunity( $args = [] ) {
		$post_id = false;
		$data = false;

		if ( isset( $args['post_id'] ) ) {
			$post_id = $args['post_id'];
		}

		if ( $post_id ) {
			$get_posts = TNL_NewsLetter_MeetCommunity::get_instance()->getNewsPosts([
					'post_id' => $post_id
			]);

			if ( $get_posts ) {
				$query = [
					'post__in' => $get_posts
				];
				$posts = TNL_GetPosts::get_instance()->query($query);

				$data = $posts;
			}
		}

		return $data;

	}

	/**
	 * Get project udpdates posts.
	 * @param array $args {
	 *		@type int $post_id the post id
 	 * }
	 */
  public function getProjectUpdates( $args = [] ) {
		$post_id = false;
		$data = false;

		if ( isset( $args['post_id'] ) ) {
			$post_id = $args['post_id'];
		}

		if ( $post_id ) {
			$get_posts = TNL_NewsLetter_ProjectUpdates::get_instance()->getNewsPosts([
					'post_id' => $post_id
			]);

			if ( $get_posts ) {
				$query = [
					'post__in' => $get_posts
				];
				$posts = TNL_GetPosts::get_instance()->query($query);

				$data = $posts;
			}
		}

		return $data;

	}

	/**
	 * Get whats on (event) posts.
	 * @param array $args {
	 *		@type int $post_id the post id
 	 * }
	 */
  public function getWhatsOn( $args = [] ) {
		$post_id = false;
		$data = false;

		if ( isset( $args['post_id'] ) ) {
			$post_id = $args['post_id'];
		}

		if ( $post_id ) {
			$get_fields = TNL_NewsLetter_WhatsOn::get_instance()->getNewsPosts([
					'post_id' => $post_id
			]);

			if ( $get_fields ) {
				$events = TNL_EO_Events::get_instance()->query( $get_fields );
				$data = $events;
			}
		}

		return $data;

	}

}//
