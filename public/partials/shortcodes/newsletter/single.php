<div class="newsletter-single mx-auto">

  <div class="row">
    <div class="col-sm-12 col-md-6 mx-auto">

      <div class="newsletter-container">
        <div class="logo">
          <?php TNL_NewsLetter_Template::get_instance()->getWPLogo(); ?>
        </div>
        <div class="newsletter-featured-image">
          <?php if ( has_post_thumbnail( $post_id ) ) : ?>
              <div class="loop-featured-image">
                <?php echo get_the_post_thumbnail( $post_id, 'full', ['class' => 'img-fluid mx-auto d-block'] ); ?>
              </div>
          <?php endif; ?>
        </div>
      </div>

      <?php if ( $featured ) : ?>
        <div class="featured-container newsletter-loop-container">
            <h1 class="display-4 newsletter-loop-title">Featured</h1>
            <?php
              TNL_NewsLetter_Featured::get_instance()->showAll(['post_id' => $post_id, 'posts' => $featured]);
            ?>
        </div>
      <?php endif; ?>
      <!-- Standard -->
      <?php if ( $standard ) : ?>
        <div class="standard-container newsletter-loop-container">
            <h1 class="display-4 newsletter-loop-title">Standard</h1>
            <?php
              TNL_NewsLetter_Standard::get_instance()->showAll(['post_id' => $post_id, 'posts' => $standard, 'show_title' => false]);
            ?>
        </div>
      <?php endif; ?>

      <?php if ( $whats_on ) : ?>
        <!-- Whats On -->
        <div class="whatson-container newsletter-loop-container">
            <h1 class="display-4 newsletter-loop-title">Whats On</h1>
            <?php
              TNL_NewsLetter_WhatsOn::get_instance()->showAll(['post_id' => $post_id, 'posts' => $whats_on]);
            ?>
        </div>
      <?php endif; ?>

      <?php if ( $did_you_know ) : ?>
        <!-- Did You Know -->
        <div class="didyouknow-container newsletter-loop-container">
            <h1 class="display-4 newsletter-loop-title">Did You Know</h1>
            <?php
              TNL_NewsLetter_DidYouKnow::get_instance()->showAll(['post_id' => $post_id, 'posts' => $did_you_know]);
            ?>
        </div>
      <?php endif; ?>

      <?php if ( $meet_the_community ) : ?>
        <!--Meet the community-->
        <div class="meetthecommunity-container newsletter-loop-container">
            <h1 class="display-4 newsletter-loop-title">Meet the Community</h1>
            <?php
              TNL_NewsLetter_MeetCommunity::get_instance()->showAll(['post_id' => $post_id, 'posts' => $meet_the_community]);
            ?>
        </div>
      <?php endif; ?>

      <?php if ( $project_updates ) : ?>
        <!--Project Updates-->
        <div class="projectupdates-container newsletter-loop-container">
            <h1 class="display-4 newsletter-loop-title">Project Updates</h1>
            <?php
              TNL_NewsLetter_ProjectUpdates::get_instance()->showAll(['post_id' => $post_id, 'posts' => $project_updates]);
            ?>
        </div>
      <?php endif; ?>

      <div class="tnl-footer">
        <div class="card">
    			<div class="card-body">
            Footer
    			</body>
    		</div>
  		</div>

    </div>

  </div>

</div>
