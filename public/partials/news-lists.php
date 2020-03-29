<div class="bootstrap-iso">
  <div class="container news-lists-container">
    <?php if ( $posts->have_posts() ) : ?>
      <?php while ( $posts->have_posts() ) : $posts->the_post(); ?>
        <div class="row news-item">
          <div class="col-sm-12 col-md-6">
            <div class="news-image">
              <?php
                if ( has_post_thumbnail( get_the_ID() ) ) {
                    echo '<a href="' . tnl_featured_img( get_the_ID() ) . '" title="' . esc_attr( get_the_title() ) . '" target="_blank">';
                    echo get_the_post_thumbnail( get_the_ID(), 'large', ['class'=>'img-fluid'] );
                    echo '</a>';
                }
              ?>
            </div>
          </div>
          <div class="col-sm-12 col-md-6">
            <h2><?php the_title();?></h2>
            <div class="news-teaser">
              <p><?php the_excerpt();?></p>
              <p><a href="<?php echo get_permalink( get_the_ID() );?>" class="btn btn-primary">Read the full article</a></p>
            </div>
            <?php tnl_naked_url(get_the_ID()); ?>
          </div>
        </div>
      <?php endwhile; ?>
      <div class="nav-previous alignleft"><?php next_posts_link( 'Older posts' ); ?></div>
      <div class="nav-next alignright"><?php previous_posts_link( 'Newer posts' ); ?></div>
    <?php endif; ?>
  </div>
</div>
