<div class="featured-container">
  <ul>
    <?php if ( $posts ) : ?>
      <?php foreach ( $posts as $post ) : ?>
            <?php setup_postdata( $post ); ?>
            <li>
              <?php $post_id = $post->ID; ?>
              
              <a href="<?php echo get_the_permalink( $post_id ); ?>">
                <?php echo $post->post_title; ?>
              </a>

            </li>
      <?php endforeach; ?>
    <?php endif; ?>
  </ul>
</div>
