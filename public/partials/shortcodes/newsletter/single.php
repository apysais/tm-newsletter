<div class="bootstrap-iso">
  <h1>NewsLetter Single</h1>
  <?php echo $post_id; ?>

  <!-- Featured -->
  <h3>Featured</h3>
  <?php
    TNL_NewsLetter_Featured::get_instance()->showAll(['post_id' => $post_id, 'posts' => $featured]);
  ?>

  <!-- Standard -->
  <h3>Standard</h3>
  <?php
    TNL_NewsLetter_Standard::get_instance()->showAll(['post_id' => $post_id, 'posts' => $standard, 'show_title' => false]);
  ?>

  <!-- Whats On -->
  <h3>Whats On</h3>
  <?php
    TNL_NewsLetter_WhatsOn::get_instance()->showAll(['post_id' => $post_id, 'posts' => $whats_on]);
  ?>

  <!-- Did You Know -->
  <h3>Did You Know</h3>
  <?php
    TNL_NewsLetter_DidYouKnow::get_instance()->showAll(['post_id' => $post_id, 'posts' => $did_you_know]);
  ?>

  <!--Meet the community-->
  <h3>Meet the Community</h3>
  <?php
    TNL_NewsLetter_MeetCommunity::get_instance()->showAll(['post_id' => $post_id, 'posts' => $meet_the_community]);
  ?>

  <!--Project Updates-->
  <h3>Project Updates</h3>
  <?php
    TNL_NewsLetter_ProjectUpdates::get_instance()->showAll(['post_id' => $post_id, 'posts' => $project_updates]);
  ?>
</div>
