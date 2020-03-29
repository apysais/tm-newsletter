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

function tnl_featured_img($post_id) {
	$cta = TNL_News_MetaFields::get_instance()->cta($post_id);
	if ( $cta ) {
		return $cta;
	} else {
		return get_permalink($post_id);
	}
}

function tnl_naked_url( $post_id ) {
	?>
	<div class="naked-url">
		<a href="<?php echo get_permalink( $post_id );?>" target="_blank"><?php echo get_permalink( $post_id );?></a>
	</div>
	<?php
}

function tnl_add_feature_img_video_class($post_id) {
	$class = '';
	if ( is_object_in_term( $post_id, 'category_news', 'video' ) ) {
	    $class = 'video-popup';
	}
	return $class;
}
