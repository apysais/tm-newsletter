<?php

/**
 * The public-facing functionality of the plugin.
 *
 * @link       tornmarketing.com.au
 * @since      1.0.0
 *
 * @package    Tm_Newsletter
 * @subpackage Tm_Newsletter/public
 */

/**
 * The public-facing functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the public-facing stylesheet and JavaScript.
 *
 * @package    Tm_Newsletter
 * @subpackage Tm_Newsletter/public
 * @author     Torn Marketing <info@tornmarketing.com.au>
 */
class Tm_Newsletter_Public {

	/**
	 * The ID of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $plugin_name    The ID of this plugin.
	 */
	private $plugin_name;

	/**
	 * The version of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $version    The current version of this plugin.
	 */
	private $version;

	/**
	 * Initialize the class and set its properties.
	 *
	 * @since    1.0.0
	 * @param      string    $plugin_name       The name of the plugin.
	 * @param      string    $version    The version of this plugin.
	 */
	public function __construct( $plugin_name, $version ) {

		$this->plugin_name = $plugin_name;
		$this->version = $version;

	}

	/**
	 * Register the stylesheets for the public-facing side of the site.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_styles() {

		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in Tm_Newsletter_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Tm_Newsletter_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */
		wp_enqueue_style( 'bootstrap4-iso', TM_NEWS_PLUGIN_URL . 'assets/bootstrap-iso/bootstrap-iso.min.css', array(), $this->version, 'all' );
		wp_enqueue_style( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'css/tm-newsletter-public.css', array(), $this->version, 'all' );
		wp_enqueue_style( $this->plugin_name . '-custom-css', plugin_dir_url( __FILE__ ) . 'css/tm-newsletter-public-custom.css', array(), $this->version, 'all' );

	}

	/**
	 * Register the JavaScript for the public-facing side of the site.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_scripts() {

		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in Tm_Newsletter_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Tm_Newsletter_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */
		wp_enqueue_script( 'bootstrap4-iso', TM_NEWS_PLUGIN_URL . 'assets/bootstrap-iso/bootstrap.min.js', array( 'jquery' ), $this->version, false );
		wp_enqueue_script( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'js/tm-newsletter-public.js', array( 'jquery' ), $this->version, false );
		wp_localize_script(
			$this->plugin_name,
			'tnl',
    	array(
				'ajax_url' => admin_url( 'admin-ajax.php' ),
			)
		);
	}

}
