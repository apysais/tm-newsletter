<div class="featured-container">
  <ul>
    <?php if ( $posts ) : ?>
      <?php foreach ( $posts as $post ) : ?>
            <?php setup_postdata( $post ); ?>
            <li>
              <?php $post_id = $post->ID; ?>

              <?php if ( $show_title ) : ?>
                <?php echo $post->post_title; ?>
              <?php endif; ?>

              <?php echo $post->post_excerpt; ?>

              <?php if ( has_post_thumbnail( $post_id ) ) : ?>
                  <?php echo get_the_post_thumbnail( $post_id, 'large' ); ?>
              <?php endif; ?>

              <?php echo $post->post_content; ?>
            </li>
      <?php endforeach; ?>
    <?php endif; ?>
  </ul>
</div>
