<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}
/**
* Filter news by category.
**/
class TNL_News_FilterCategory
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

  public function showDropdownFilter() {
    $taxonomies = get_terms( array(
        'taxonomy' => 'category_news',
        'hide_empty' => false
    ) );
    if ( !empty($taxonomies) ) :
        $output = '<form method="get" action="'.home_url().'">';
        $output .= '<select name="category-news" onchange="this.form.submit()">';
        $output .= '<option value="-1">Choose Category</option>';
        foreach( $taxonomies as $category ) {
            $output .= '<option value="'. esc_attr( $category->slug ) .'">
                '. esc_html( $category->name ) .'</option>';
        }
        $output.='</select>';
        $output.='</form>';
        echo $output;
    endif;
  }

}//
