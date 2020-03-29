<div class="featured-container">
  <ul class="list-unstyled">
    <?php if ( $posts ) : ?>
      <?php foreach ( $posts as $post ) : ?>
            <?php setup_postdata( $post ); ?>
            <li class="loop-list-item">

              <?php $post_id = $post->ID; ?>

              <div class="featured-image">
                <?php if ( has_post_thumbnail( $post_id ) ) : ?>
                    <div class="loop-featured-image">
                      <?php
                        if ( has_post_thumbnail( $post_id ) ) {
                            echo '<a href="' . tnl_featured_img( $post_id ) . '" title="' . esc_attr( $post->post_title ) . '" target="_blank">';
                              echo get_the_post_thumbnail( $post_id, 'large', ['class'=>'img-fluid mx-auto d-block'] );
                            echo '</a>';
                        }
                      ?>
                    </div>
                <?php endif; ?>
              </div>

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

              <div class="loop-teaser">
                <p><?php echo $post->post_excerpt; ?></p>
              </div>

              <div class="loop-content">
                <?php echo $post->post_content; ?>
              </div>

              <?php tnl_naked_url($post_id); ?>

            </li>
      <?php endforeach; ?>
    <?php endif; ?>
  </ul>
</div>
