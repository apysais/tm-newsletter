<?php

/**
 * The plugin bootstrap file
 *
 * This file is read by WordPress to generate the plugin information in the plugin
 * admin area. This file also includes all of the dependencies used by the plugin,
 * registers the activation and deactivation functions, and defines a function
 * that starts the plugin.
 *
 * @link              tornmarketing.com.au
 * @since             1.2.4
 * @package           Tm_Newsletter
 *
 * @wordpress-plugin
 * Plugin Name:       TM NewsLetter
 * Plugin URI:        https://tornmarketing.com.au/
 * Description:       This is a short description of what the plugin does. It's displayed in the WordPress admin area.
 * Version:           1.2.4
 * Author:            Torn Marketing
 * Author URI:        tornmarketing.com.au
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       tm-newsletter
 * Domain Path:       /languages
 */

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}

/**
 * Currently plugin version.
 * Start at version 1.0.0 and use SemVer - https://semver.org
 * Rename this for your plugin and update it as you release new versions.
 */
define( 'TM_NEWSLETTER_VERSION', '1.2.4' );
define( 'TM_NEWS_CPT', 'news' );
define( 'TM_NEWSLETTER_CPT', 'newsletter' );
define( 'TM_NEWSLETTER_TAX', 'category_newsletter' );
define( 'TM_NEWS_TAX', 'category_news' );
define( 'TM_NEWS_PLUGIN_URL', plugin_dir_url( __FILE__ ) );
define( 'TM_NEWSLETTER_ARCHIVE_LIMIT', 4 );
/**
 * For autoloading classes
 * */
spl_autoload_register('tnl_directory_autoload_class');
function tnl_directory_autoload_class($class_name){
	if ( false !== strpos( $class_name, 'TNL' ) ) {
	 $include_classes_dir = realpath( get_template_directory( __FILE__ ) ) . DIRECTORY_SEPARATOR;
	 $admin_classes_dir = realpath( plugin_dir_path( __FILE__ ) ) . DIRECTORY_SEPARATOR;
	 $class_file = str_replace( '_', DIRECTORY_SEPARATOR, $class_name ) . '.php';
	 if( file_exists($include_classes_dir . $class_file) ){
		 require_once $include_classes_dir . $class_file;
	 }
	 if( file_exists($admin_classes_dir . $class_file) ){
		 require_once $admin_classes_dir . $class_file;
	 }
 }
}
function tnl_get_plugin_details(){
 // Check if get_plugins() function exists. This is required on the front end of the
 // site, since it is in a file that is normally only loaded in the admin.
 if ( ! function_exists( 'get_plugins' ) ) {
	 require_once ABSPATH . 'wp-admin/includes/plugin.php';
 }
 $ret = get_plugins();
 return $ret['tm-newsletter/tm-newsletter.php'];
}
function tnl_get_text_domain() {
 $ret = tnl_get_plugin_details();
 return $ret['TextDomain'];
}
function tnl_get_plugin_dir() {
 return plugin_dir_path( __FILE__ );
}
function tnl_get_plugin_dir_url() {
 return plugin_dir_url( __FILE__ );
}

/**
 * The code that runs during plugin activation.
 * This action is documented in includes/class-tm-newsletter-activator.php
 */
function activate_tm_newsletter() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-tm-newsletter-activator.php';
	Tm_Newsletter_Activator::activate();

}

/**
 * The code that runs during plugin deactivation.
 * This action is documented in includes/class-tm-newsletter-deactivator.php
 */
function deactivate_tm_newsletter() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-tm-newsletter-deactivator.php';
	Tm_Newsletter_Deactivator::deactivate();
}

register_activation_hook( __FILE__, 'activate_tm_newsletter' );
register_deactivation_hook( __FILE__, 'deactivate_tm_newsletter' );

/**
 * The core plugin class that is used to define internationalization,
 * admin-specific hooks, and public-facing site hooks.
 */
require plugin_dir_path( __FILE__ ) . 'includes/class-tm-newsletter.php';

require plugin_dir_path( __FILE__ ) . 'functions/helper.php';

/**
 * Begins execution of the plugin.
 *
 * Since everything within the plugin is registered via hooks,
 * then kicking off the plugin from this point in the file does
 * not affect the page life cycle.
 *
 * @since    1.0.0
 */
function run_tm_newsletter() {

	$plugin = new Tm_Newsletter();
	$plugin->run();

	TNL_ShortCode_NewsLetterLists::get_instance();
	TNL_ShortCode_NewsLists::get_instance();
	TNL_ShortCode_NewsLetterSingle::get_instance();
	//TNL_NewsLetter_MetaBox::get_instance();
	TNL_AjaxCategory::get_instance();
}
//run_tm_newsletter();
add_action('plugins_loaded', 'run_tm_newsletter');

function tnl_init() {
	TNL_CPT_News::get_instance();
	TNL_CPT_Newsletter::get_instance();
	TNL_Terms_Term::get_instance()->create();
	TNL_NewsLetter_Template::get_instance();
	TNL_NewsLetter_Template::get_instance()->redirectNewsCategory();
}
add_action( 'init', 'tnl_init' );
