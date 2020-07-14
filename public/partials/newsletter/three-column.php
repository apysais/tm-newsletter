<?php if ( $posts ) : ?>
  <?php $i = 1; ?>
  <div class="row row-cols-1 row-cols-md-3 three-column-template">
  <?php foreach ( $posts as $post ) : ?>
        <?php setup_postdata( $post ); ?>

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
            <div class="">
              <h5 class="card-title">Card title</h5>
            </div>
            <div class="card-body">
              <h5 class="card-title">
                <?php if ( $show_title ) : ?>
                  <h2>
                    <?php //echo $post->post_title; ?>
                    <a href="<?php echo get_the_permalink( $post_id ); ?>">
                      <?php echo $post->post_title; ?>
                    </a>
                  </h2>
                <?php endif; ?>
              </h5>
              <?php if ( ! empty( $post->post_excerpt ) ) : ?>
                <p class="card-text"><?php echo $post->post_excerpt; ?></p>
              <?php else: ?>
                <p class="card-text"><?php echo wp_trim_words( wpautop($post->post_content) ); ?></p>
              <?php endif; ?>
            </div>

            <div class="card-footer">
              <?php tnl_naked_url($post_id); ?>
            </div>

          </div>
        </div>

        <?php $i++; ?>
  <?php endforeach; ?>
</div>
<?php endif; ?>
