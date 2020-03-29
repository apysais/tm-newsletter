<?php
/**
 * The template for displaying single posts and pages.
 */

get_header();
?>

<div class="tnl-archive-container">

  <?php
    $data = [];
    TNL_View::get_instance()->public_partials('newsletter/build-newsletter.php', $data);
  ?>

</div>

<?php get_footer(); ?>
