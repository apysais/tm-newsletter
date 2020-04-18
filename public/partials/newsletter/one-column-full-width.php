<?php if ( $posts ) : ?>
  <?php $i = 1; ?>
  <?php foreach ( $posts as $post ) : ?>
        <?php setup_postdata( $post ); ?>
        <div class="one-column-template one-column-full-width-template">
          <div class="loop-list-item index-<?php echo $i; ?>">
            <?php $post_id = $post->ID; ?>

            <div class="row row-eq-height ">
              <div class="col-md-12 col-sm-12 ">
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
                      <div class="loop-featured-image">
                        <?php
                            echo '<a href="' . tnl_featured_img( $post_id ) . '" title="' . esc_attr( $post->post_title ) . '" target="_blank">';
                              echo get_the_post_thumbnail( $post_id, 'full', ['class'=>'img-fluid mx-auto d-block'] );
                            echo '</a>';
                        ?>
                      </div>
                  <?php endif; ?>
                </div>

                <div class="loop-teaser">
                  <p><?php //echo wpautop($post->post_excerpt); ?></p>
                </div>

                <div class="loop-content">
                  <?php echo wpautop( $post->post_content ); ?>
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
            <?php //tnl_cta_url($post_id); ?>
          </div>
        </div>
        <?php $i++; ?>
  <?php endforeach; ?>
<?php endif; ?>
