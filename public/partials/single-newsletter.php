<?php
/**
 * The template for displaying single posts and pages.
 */

get_header();
?>

<div class="bootstrap-iso">

  <div class="container">
    <?php do_shortcode("[tm_newsletter_single id=".get_queried_object_id()."]"); ?>
  </div>

</div>

<?php get_footer(); ?>
