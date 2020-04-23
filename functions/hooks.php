<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}
function tnl_archives($template, $type, $templates) {
  if ( is_post_type_archive('newsletter') ) {
    add_filter('tnl_hero_single_global_title_filter', function($string) {
      return tnl_newsletter_archive_title();
    });
  }
  if ( is_post_type_archive('news') || is_singular('news') ) {
    add_filter('tnl_hero_single_global_title_filter', function($string) {
      return tnl_news_archive_title();
    });
  }
}

add_filter('archive_template', 'tnl_archives', 100, 3);
add_filter('single_template', 'tnl_archives', 100, 3);
