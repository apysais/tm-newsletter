<?php
/**
 * The template for displaying single posts and pages.
 */

require 'header-tnl.php';
?>

<div class="single-newsletter-container bootstrap-iso">

  <div class="container-fluid">

      <?php
        TNL_NewsLetter_Single::get_instance()->show(['newsletter_id'=>get_queried_object_id()]);
      ?>

  </div>

</div>

<?php require 'footer-tnl.php'; ?>
