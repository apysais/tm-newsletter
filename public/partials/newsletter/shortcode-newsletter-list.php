<div class="bootstrap-isox">

  <div class="wrap shortcode-plugin-view">
    <?php if ( isset($content['archvied_top_content']) ) : ?>
      <?php //tnl_dd($content['archvied_top_content']['content']); ?>
      <?php foreach( $content['archvied_top_content']['content'] as $key => $item) : ?>

        <?php //if ( !empty($item) ) : ?>
          <?php
            //echo $item->ID;
            $tnl_post = $item;
            $post_id = $tnl_post->ID;
            $cta = tnl_cta($post_id);
            $newsletter_assoc = tnl_get_newsletter_post($post_id);

            $link = get_the_permalink( $post_id );
            if ( $newsletter_assoc ) {
              $link = get_the_permalink($newsletter_assoc->ID);
            }
          ?>
          <div class="row row-eq-height community-news <?php echo 'news-id-'.$post_id;?>">

            <div class="col-lg-5 col-md-12 col-sm-12">
              <div class="loop-title">
                  <h2 class="newsletter-related-title">
                    Newsletter : <?php

                     if ( $newsletter_assoc ) {
                       ?>
                       <a href="<?php echo $link;?>" style="color:#000;" class="<?php //echo $cta->classpopup;?>"><?php echo $newsletter_assoc->post_title;?></a>
                       <?php
                     }
                     ?>
                  </h2>
                  <h2 class="newsletter-main-title">
                    <a href="<?php echo $link; ?>">
                      <?php echo $tnl_post->post_title;?>
                    </a>
                  </h2>
              </div>
              <div class="featured-image d-block d-md-none d-sm-block">
                  <div class="loop-featured-image">
                    <?php
                      if ( has_post_thumbnail( $tnl_post->ID ) ) {
                          echo '<a href="' . tnl_newsletter_link( $tnl_post->ID ) . '" title="' . esc_attr( $tnl_post->post_title ) . '" target="_blankx" class="'.$cta->classpopup.'">';
                            echo get_the_post_thumbnail( $tnl_post->ID, 'large', ['class'=>'img-fluid'] );
                          echo '</a>';
                      }
                    ?>
                  </div>
              </div>

              <div class="loop-content">
                <p><?php //tnl_excerpt_or_content($post_id, $tnl_post->post_content); ?></p>
                <?php if ( ! empty( $tnl_post->post_excerpt ) ) : ?>
                  <p><?php echo $tnl_post->post_excerpt; ?></p>
                <?php else: ?>
                  <p><?php echo wp_trim_words( wpautop($tnl_post->post_content) ); ?></p>
                <?php endif; ?>
              </div>

              <div class="naked-url">
                <a href="<?php echo $link; ?>" target="_xblank" class="button">Read Full Article</a>
              </div>

            </div>

            <div class="col-lg-7 col-md-6 col-sm-12 d-none d-md-block">
              <div class="featured-image">
                  <div class="loop-featured-image">
                    <?php
                      if ( has_post_thumbnail( $tnl_post->ID ) ) {
                          echo '<a href="' . tnl_newsletter_link( $tnl_post->ID ) . '" title="' . esc_attr( $tnl_post->post_title ) . '" target="_blankx" class="'.$cta->classpopup.'">';
                            echo get_the_post_thumbnail( $tnl_post->ID, 'large', ['class'=>'img-fluid'] );
                          echo '</a>';
                      }
                    ?>
                  </div>
              </div>
            </div>

          </div>
        <?php //endif; ?>

      <?php endforeach; ?>
    <?php endif; ?>
  </div>

</div>
