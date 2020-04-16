<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}
/**
 * Get events organiser posts.
 **/
class TNL_Tribe_Events
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

  }

  /**
   * Get events organiser
   * @see http://codex.wp-event-organiser.com/function-eo_get_events.html
   * @param array $args {
   *    array of date ranges or settings to get events.
   *    @type string|date $start_event_date the start date.
   *    @type string  $range the range of the date, if its start date only then range of how many months till the end date.
   *    @type string|date  $end_event_date end date.
   *    @type number  $custom_months If the range is custom then its set custom.
   *    @type number  $numberposts number of posts to display.
   * }
   * @return array|bool
   */
  public function query( $args = [] ) {
    $events = false;
    $date_range = $this->getDateRange( $args );
    if ( $date_range ) {
      $args_query = [
        'start_date'     => $date_range['start_date'],
        'end_date'  => $date_range['end_date']
      ];

			if( function_exists('tribe_get_events')  ) {
				  $events = tribe_get_events($args_query);
					// $get_meta = get_post_meta(1516);
					// tnl_dd($get_meta);
					// tnl_dd($events);
			}

    }

    return $events;
  }

  /**
   * set and get the date range to be pass on events query.
   * @see http://codex.wp-event-organiser.com/function-eo_get_events.html
   * @param array $args {
   *    array of date ranges or settings to get events.
   *    @type string|date $start_event_date the start date.
   *    @type string  $range the range of the date, if its start date only then range of how many months till the end date.
   *    @type string|date  $end_event_date end date.
   *    @type number  $custom_months If the range is custom then its set custom.
   *    @type number  $numberposts number of posts to display.
   * }
   * @return array|bool
   */
  public function getDateRange( $args = [] ) {
    $arg_date = [];

    if ( isset( $args['start_event_date'] ) ) {
      $first_day_month = new DateTime( $args['start_event_date'] );

      if ( isset( $args['range'] ) && $args['range'] == 3 ) {
        $first_day_month->modify('first day of this month');
        $pre_last_day_month = new DateTime( $args['start_event_date'] );
        $pre_last_day_month->modify('+'.$args['range'].' month');
        $last_day_month = new DateTime( $pre_last_day_month->format('Y-m-d') );
        $last_day_month->modify('last day of this month');

        $arg_date = [
          'start_date'  => $first_day_month->format('Y-m-d'),
          'end_date'    => $last_day_month->format('Y-m-d')
        ];
      } elseif ( isset( $args['range'] ) && $args['range'] == 'finish_date' ) {
        $first_day_month->modify('first day of this month');
        $last_day_month = new DateTime( $args['end_event_date'] );
        $last_day_month->modify('last day of this month');

        $arg_date = [
          'start_date'  => $first_day_month->format('Y-m-d'),
          'end_date'    => $last_day_month->format('Y-m-d')
        ];
      } elseif ( isset( $args['range'] ) && $args['range'] == 'custom' ) {
        $first_day_month->modify('first day of this month');
        $pre_last_day_month = new DateTime( $args['start_event_date'] );
        $pre_last_day_month->modify('+'.$args['custom_months'].' month');
        $last_day_month = new DateTime( $pre_last_day_month->format('Y-m-d') );
        $last_day_month->modify('last day of this month');

        $arg_date = [
          'start_date'  => $first_day_month->format('Y-m-d'),
          'end_date'    => $last_day_month->format('Y-m-d')
        ];
      }

    }

    return $arg_date;
  }

}//
