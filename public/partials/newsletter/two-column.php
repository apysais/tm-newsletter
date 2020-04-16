<?php if ( $posts ) : ?>
  <?php $i = 1; ?>
  <div class="row  row-eq-height two-column-template">
  <?php foreach ( $posts as $post ) : ?>
        <?php setup_postdata( $post ); ?>

        <div class="col-md-6 col-sm-12 loop-column-item">
          <div class="loop-list-item index-<?php echo $i; ?>">

            <?php $post_id = $post->ID; ?>

            <div class="loop-title">
              <?php if ( $show_title ) : ?>
                <h2>
                  <?php //echo $post->post_title; ?>
                  <a href="<?php echo get_the_permalink( $post_id ); ?>">
                    <?php echo $post->post_title; ?>
                  </a>
                </h2>
              <?php endif; ?>
            </div>

            <div class="featured-image">
              <?php if ( has_post_thumbnail( $post_id ) ) : ?>
                <a href="<?php echo tnl_featured_img( $post_id );?>'" title="<?php echo esc_attr( $post->post_title );?>" target="_blank">
                  <div class="loop-featured-image" style="background-image:url(<?php echo get_the_post_thumbnail_url($post_id, 'large', ['class'=>'img-fluid mx-auto d-block']);?>);"></div>
                </a>
              <?php endif; ?>
            </div>

            <div class="loop-teaser">
              <p><?php //echo wpautop($post->post_excerpt); ?></p>
            </div>

            <div class="loop-content">
              <?php if ( ! empty( $post->post_excerpt ) ) : ?>
                <p><?php echo $post->post_excerpt; ?></p>
              <?php else: ?>
                <p><?php echo wp_trim_words( wpautop($post->post_content) ); ?></p>
              <?php endif; ?>
            </div>

            <?php if ( $event_page ) : ?>
              <p>
                <strong>
                  When : <?php echo ' ' . tribe_events_event_schedule_details( $post ) . ' '; ?>
                </strong>
                <br>
                <strong>
                  Where : <?php echo ' ' . tribe_get_venue( $post ) . ' '; ?>
                </strong>
                <br>
                <strong>
                  Cost : <?php echo ' ' . ( tribe_get_formatted_cost( $post ) == '' ) ? 'Free' :  tribe_get_formatted_cost( $post ) . ' '; ?>
                </strong>
              </p>
            <?php endif; ?>

            <?php tnl_naked_url($post_id); ?>

          </div>
        </div>
        <?php $i++; ?>
  <?php endforeach; ?>
</div>
<?php endif; ?>
