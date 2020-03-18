<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}
/**
* Convert parse string to Input text.
**/
class TNL_NewsLetter_MetaBox
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
    if ( is_admin() ) {
        add_action( 'load-post.php',     array( $this, 'init_metabox' ) );
        add_action( 'load-post-new.php', array( $this, 'init_metabox' ) );
    }
  }

  /**
   * Meta box initialization.
   */
  public function init_metabox() {
      add_action( 'add_meta_boxes', array( $this, 'add_metabox'  )        );
      add_action( 'save_post',      array( $this, 'save_metabox' ), 10, 2 );
  }

  /**
  * Adds the meta box.
  */
  public function add_metabox() {
    add_meta_box(
        'my-meta-box',
        __( 'My Meta Box', 'textdomain' ),
        array( $this, 'render_metabox' ),
        TM_NEWS_CPT,
        'advanced',
        'default'
    );

  }

  /**
  * Renders the meta box.
  */
  public function render_metabox( $post ) {
    // Add nonce for security and authentication.
    wp_nonce_field( 'custom_nonce_action', 'custom_nonce' );
  }

  /**
  * Handles saving the meta box.
  *
  * @param int     $post_id Post ID.
  * @param WP_Post $post    Post object.
  * @return null
  */
  public function save_metabox( $post_id, $post ) {
    // Add nonce for security and authentication.
    $nonce_name   = isset( $_POST['custom_nonce'] ) ? $_POST['custom_nonce'] : '';
    $nonce_action = 'custom_nonce_action';

    // Check if nonce is valid.
    if ( ! wp_verify_nonce( $nonce_name, $nonce_action ) ) {
        return;
    }

    // Check if user has permissions to save data.
    if ( ! current_user_can( 'edit_post', $post_id ) ) {
        return;
    }

    // Check if not an autosave.
    if ( wp_is_post_autosave( $post_id ) ) {
        return;
    }

    // Check if not a revision.
    if ( wp_is_post_revision( $post_id ) ) {
        return;
    }
  }

}//
