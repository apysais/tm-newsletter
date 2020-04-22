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

  public function __construct() {}

	public function showNav() {
		$taxonomies = get_terms([
			'taxonomy' => 'category_news'
		]);

    if ( !empty($taxonomies) ) {
        $output = '<ul class="nav">';
				$output .= '<li class="nav-item category-news-nav">';
					$output .= '<a href="#" class="nav-link get-news-category all-category active" data-cat-id="0" data-cat-slug="-1">All</a>';
				$output .= '</li>';
        foreach( $taxonomies as $category ) {
            $output .= '<li class="nav-item category-news-nav">';
							$output .= '<a href="#" class="nav-link get-news-category" data-cat-id="'.$category->term_id.'" data-cat-slug="'. esc_attr( $category->slug ) .'">';
								$output .= esc_html( $category->name );
							$output .= '</a>';
						$output .= '</li>';
        }
        $output.='</ul>';
        echo $output;
    }
	}

  public function showDropdownFilter() {
		$taxonomies = get_terms([
			'taxonomy' => 'category_news'
		]);

    if ( !empty($taxonomies) ) {
        //$output = '<form method="get" action="'.home_url().'">';
        $output = '<select name="category-news" class="category-news">';
        $output .= '<option value="-1">All</option>';
        foreach( $taxonomies as $category ) {
            $output .= '<option value="'. esc_attr( $category->slug ) .'" data-cat-id="'.$category->term_id.'">'. esc_html( $category->name ) .'</option>';
        }
        $output.='</select>';
        //$output.='</form>';
        echo $output;
    }
  }

}//
