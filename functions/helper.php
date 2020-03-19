<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

/**
 * wrap the array to pre tag.
 *
 * @param array $arr
 *
 * @return html|array
 */
function tnl_dd( $arr = [] ) {
  echo '<pre>';
  print_r($arr);
  echo '</pre>';
}
