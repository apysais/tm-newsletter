<?php
/**
 * The template for displaying single posts and pages.
 */

get_header();
?>

<div class="tnl-archive-container">

  <?php TNL_NewsLetter_Archive::get_instance()->show(); ?>

</div>

<?php get_footer(); ?>
