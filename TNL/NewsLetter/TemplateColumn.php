<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}
/**
* Newsletter Template Column.
**/
class TNL_NewsLetter_TemplateColumn
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
	 * Select template type.
	 * whether 2 column or 1 and 2 column.
	 * column_1 : One Column
	 * column_1_full_width : One Column full width with full text
	 * column_1_full_width_excerpt  : One Column full width with excerpt text
	 * column_2 : Two Column
	 * column_1_2 : One and Two Column
	 * column_3 : Three Column Card
	 */
	public function getType( $args = [] ) {
		$select_template = 'column_1';
		if ( isset( $args['select_template'] ) ) {
			$select_template = $args['select_template'];
		}
		return $select_template;
	}

	public function showOneColumn( $args = [] ) {
		//one column - default

	  $template = locate_template( 'tm-newsletter/one-column.php' );

	  if ( !$template ) {
	    TNL_View::get_instance()->public_partials('newsletter/one-column.php', $args);
	  } else {
			TNL_View::get_instance()->display($template, $args);
	  }
	}

	public function showTwoColumn( $args = [] ) {
		//two column
	  $template = locate_template( 'tm-newsletter/two-column.php' );

	  if ( !$template ) {
	    TNL_View::get_instance()->public_partials('newsletter/two-column.php', $args);
	  } else {
			TNL_View::get_instance()->display($template, $args);
	  }
	}

	public function showThreeColumn( $args = [] ) {
		//two column
	  $template = locate_template( 'tm-newsletter/three-column.php' );

	  if ( !$template ) {
	    TNL_View::get_instance()->public_partials('newsletter/three-column.php', $args);
	  } else {
			TNL_View::get_instance()->display($template, $args);
	  }
	}

	public function showOneTwoColumn( $args = [] ) {

		//one , two column
	  $template = locate_template( 'tm-newsletter/one-column-two.php' );

	  if ( !$template ) {
	    TNL_View::get_instance()->public_partials('newsletter/one-column-two.php', $args);
	  } else {
			TNL_View::get_instance()->display($template, $args);
	  }
	}

	public function showOneColumnFullWidth($args = []) {
		$template = locate_template( 'tm-newsletter/one-column-full-width.php' );

	  if ( !$template ) {
	    TNL_View::get_instance()->public_partials('newsletter/one-column-full-width.php', $args);
	  } else {
			TNL_View::get_instance()->display($template, $args);
	  }
	}

	public function showOneColumnFullWidthExcerpt($args = []) {
		$template = locate_template( 'tm-newsletter/one-column-full-width-excerpt.php' );

	  if ( !$template ) {
	    TNL_View::get_instance()->public_partials('newsletter/one-column-full-width-excerpt.php', $args);
	  } else {
			TNL_View::get_instance()->display($template, $args);
	  }
	}

	public function showByColumns($args = []) {
		//tnl_dd($args);
		$template_column = isset($args['template']) ? $args['template'] : 'column_1';
		switch($template_column) {
			case 'column_1_full_width':
				$this->showOneColumnFullWidth($args);
				break;
			case 'column_1_full_width_excerpt':
				$this->showOneColumnFullWidthExcerpt($args);
				break;
			case 'column_3':
				$this->showThreeColumn($args);
				break;
			case 'column_1_2':
				$this->showOneTwoColumn($args);
				break;
			case 'column_2':
				$this->showTwoColumn($args);
				break;
			default:
			case 'column_1':
				$this->showOneColumn($args);
				break;
		}
	}

}//
