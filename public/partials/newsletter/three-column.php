<?php if ( $posts ) : ?>
  <?php $i = 1; ?>
  <div class="row row-cols-1 row-cols-xs-1 row-cols-sm-1 row-cols-md-2 row-cols-lg-3 three-column-template">
  <?php foreach ( $posts as $post ) : ?>
        <?php setup_postdata( $post ); ?>
        <?php
          $class_prefix = '';
          if ( $event_page ) {
            $class_prefix = ' event-page';
          }
        ?>
        <?php
          $post_id = $post->ID;
          $cta = tnl_cta($post_id);
        ?>

        <div class="col mb-4">
          <div class="card h-100">

            <?php if ( has_post_thumbnail( $post_id ) ) : ?>
              <a href="<?php echo tnl_featured_img( $post_id );?>'" title="<?php echo esc_attr( $post->post_title );?>" target="_blank" class="<?php echo $cta->classpopup;?>">
                <img src="<?php echo get_the_post_thumbnail_url($post_id, 'large');?>" class="card-img-top">
              </a>
            <?php endif; ?>

            <?php if ( $event_page ) : ?>
              <div class="overlay-event">
                <p>
                    <i class="fa fa-calendar" aria-hidden="true"></i> <?php echo ' ' . tribe_events_event_schedule_details( $post ) . ' '; ?>
                </p>
              </div>
            <?php endif; ?>

            <div class="card-body">
              <?php if ( $show_title ) : ?>
                <h5 class="card-title <?php echo $class_prefix;?>">
                  <?php //echo $post->post_title; ?>
                  <a href="<?php echo get_the_permalink( $post_id ); ?>">
                    <?php echo $post->post_title; ?>
                  </a>
                </h5>
              <?php endif; ?>
              <?php if ( ! empty( $post->post_excerpt ) ) : ?>
                <p class="card-text"><?php echo $post->post_excerpt; ?></p>
              <?php else: ?>
                <p class="card-text"><?php echo wp_trim_words( wpautop($post->post_content) ); ?></p>
              <?php endif; ?>
            </div>

            <div class="card-footer">
              <?php tnl_naked_url($post_id, 'Read More'); ?>
            </div>

          </div>
        </div>

        <?php $i++; ?>
  <?php endforeach; ?>
</div>
<?php endif; ?>
