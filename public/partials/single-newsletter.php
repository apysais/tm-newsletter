<?php
/**
 * The template for displaying single posts and pages.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package WordPress
 * @subpackage Twenty_Twenty
 * @since 1.0.0
 */

get_header();
?>

<div class="bootstrap-iso">

  <div class="container">
    <?php do_shortcode("[tm_newsletter_single id=".get_queried_object_id()."]"); ?>
  </div>

</div>

<?php get_footer(); ?>
