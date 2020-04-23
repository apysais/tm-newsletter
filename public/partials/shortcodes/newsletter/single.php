<div class="newsletter-single mx-auto">

  <div class="row">
    <div class="col-sm-12 <?php echo $grid_container;?> mx-auto">

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

      <!-- Featured -->
      <?php if ( $featured ) : ?>
        <div class="featured-container newsletter-loop-container">
            <!-- <h1 class="display-5 newsletter-loop-title w-50">Featured</h1> -->
            <?php
              TNL_NewsLetter_Featured::get_instance()->showAll([
                'post_id'   => $post_id,
                'posts'     => $featured['posts'],
                'template_column'  => $featured['template']
              ]);
            ?>
        </div>
      <?php endif; ?>

      <!-- Standard -->
      <?php if ( $standard ) : ?>
        <div class="standard-container newsletter-loop-container">
            <!-- <h1 class="display-5 newsletter-loop-title w-50">Standard</h1> -->
            <?php
              TNL_NewsLetter_Standard::get_instance()->showAll([
                'post_id' => $post_id,
                'posts' => $standard['posts'],
                'template_column'  => $standard['template']
              ]);
            ?>
        </div>
      <?php endif; ?>

      <?php if ( $community_contributions ) : ?>
        <!-- community_contributions -->
        <div class="instagram-container newsletter-loop-container with-title">
            <h1 class="display-5 newsletter-loop-title w-50">Community Contributions</h1>
            <?php
              TNL_NewsLetter_CommunityContributions::get_instance()->showAll([
                'post_id' => $post_id,
                'posts' => $community_contributions['posts'],
                'template_column'  => $community_contributions['template']
              ]);
            ?>
        </div>
      <?php endif; ?>

      <?php if ( $whats_on ) : ?>
        <!-- Whats On -->
        <div class="whatson-container newsletter-loop-container with-title">
            <h1 class="display-5 newsletter-loop-title w-50">Whats On</h1>
            <?php
              TNL_NewsLetter_WhatsOn::get_instance()->showAll([
                'post_id' => $post_id,
                'posts' => $whats_on['posts'],
                'template_column'  => $whats_on['template']
              ]);
            ?>
        </div>
      <?php endif; ?>

      <?php if ( $instagram ) : ?>
        <!-- Whats On -->
        <div class="instagram-container newsletter-loop-container with-title">
            <h1 class="display-5 newsletter-loop-title w-50">#SnappedatRedbank</h1>
            <?php
              TNL_NewsLetter_Instagram::get_instance()->showAll([
                'post_id' => $post_id,
                'posts' => $instagram['posts'],
                'template_column'  => $instagram['template']
              ]);
            ?>
        </div>
      <?php endif; ?>

      <?php if ( $did_you_know ) : ?>
        <!-- Did You Know -->
        <div class="didyouknow-container newsletter-loop-container with-title">
            <h1 class="display-5 newsletter-loop-title w-50">Did You Know</h1>
            <?php
              TNL_NewsLetter_DidYouKnow::get_instance()->showAll([
                'post_id' => $post_id,
                'posts' => $did_you_know['posts'],
                'template_column'  => $did_you_know['template']
              ]);
            ?>
        </div>
      <?php endif; ?>

      <?php if ( $meet_the_community ) : ?>
        <!--Meet the community-->
        <div class="meetthecommunity-container newsletter-loop-container with-title">
            <h1 class="display-5 newsletter-loop-title w-50">Meet the Community</h1>
            <?php
              TNL_NewsLetter_MeetCommunity::get_instance()->showAll([
                'post_id' => $post_id,
                'posts' => $meet_the_community['posts'],
                'template_column'  => $meet_the_community['template']
              ]);
            ?>
        </div>
      <?php endif; ?>

      <?php if ( $community_notice ) : ?>
        <!-- community_notice -->
        <div class="instagram-container newsletter-loop-container with-title">
            <h1 class="display-5 newsletter-loop-title w-50">Community Notice</h1>
            <?php
              TNL_NewsLetter_CommunityNotice::get_instance()->showAll([
                'post_id' => $post_id,
                'posts' => $community_notice['posts'],
                'template_column'  => $community_notice['template']
              ]);
            ?>
        </div>
      <?php endif; ?>

      <?php if ( $project_updates ) : ?>
        <!--Project Updates-->
        <div class="projectupdates-container newsletter-loop-container with-title">
            <h1 class="display-5 newsletter-loop-title w-50">Project Updates</h1>
            <?php
              TNL_NewsLetter_ProjectUpdates::get_instance()->showAll([
                'post_id' => $post_id,
                'posts' => $project_updates['posts'],
                'template_column'  => $project_updates['template']
              ]);
            ?>
        </div>
      <?php endif; ?>

      <div class="_tnl-footer">
        <div class="_card">
          <div class="_card-body">

          </div>
        </div>
      </div>

  </div>

</div>
