<div class="bootstrap-iso">
  <div class="container newsletter-archive-container">
    <h1 class="display-1"> <?php tnl_newsletter_archive_title(); ?> </h1>
    <?php if ( isset($content['archvied_top_content']) ) : ?>
      <?php //tnl_dd($content['archvied_top_content']); ?>
      <?php foreach( $content['archvied_top_content'] as $key => $item) : ?>

        <?php if ( isset($item['content']) && !empty($item) ) : ?>
          <?php
            $tnl_post = $item['content'];
          ?>
          <div class="top-content-container">
            <div class="row">
              <div class="col-sm-12 col-md-6">
                <div class="content-archive-image">
                  <?php
                    if ( has_post_thumbnail( $tnl_post->ID ) ) {
                        echo '<a href="' . tnl_featured_img( $item->ID ) . '" title="' . esc_attr( $tnl_post->post_title ) . '" target="_blank">';
                          echo get_the_post_thumbnail( $tnl_post->ID, 'large', ['class'=>'img-fluid'] );
                        echo '</a>';
                    }
                  ?>
                </div>
              </div>
              <div class="col-sm-12 col-md-6">

                <div class="newsletter-title">
                  <h4><?php echo $item['title'];?></h4>
                </div>

                <div class="news-title">
                  <h2><?php echo $tnl_post->post_title;?></h2>
                </div>

                <div class="content-archive-teaser">
                  <div class="news-excerpt"><p><?php echo $tnl_post->post_excerpt;?></p></div>
                  <div class="news-permalink">
                    <p><a href="<?php echo get_permalink( $item->ID );?>" class="btn btn-primary">Read the full article</a></p>
                  </div>
                </div>

              </div>
            </div>
          </div>
        <?php endif; ?>

      <?php endforeach; ?>
    <?php endif; ?>


    <?php if ( isset($content['archives']) ) : ?>
      <?php //tnl_dd($content['archives']); ?>
      <div class="accordion" id="accordionYear">
        <h1 class="display-3 archived-newsletter-title"> Archived Newsletter </h1>
        <?php foreach( $content['archives'] as $year => $content ) : ?>
          <div class="card">
              <div class="card-header" id="headingOne">
                <h2 class="mb-0">
                    <a data-toggle="collapse" href="#collapse-<?php echo $year; ?>" aria-expanded="true" aria-controls="collapse-<?php echo $year; ?>" id="heading-<?php echo $year; ?>" class="d-block">
                        <i class="fa fa-chevron-down pull-right"></i>
                        <?php echo $year; ?>
                    </a>
                </h5>
              </div>
              <div id="collapse-<?php echo $year; ?>" class="collapse" aria-labelledby="heading-<?php echo $year; ?>" data-parent="#accordionYear">

                <?php if ( !empty($content) ) : ?>
                  <div class="card-body">
                    <?php foreach($content as $item) : ?>
                      <p>
                        <a href="<?php echo $item['permalink'];?>" title="<?php echo $item['title'];?>" class="">
                          <?php echo $item['title'];?>
                        </a>
                      </p>
                    <?php endforeach; ?>
                  </div>
                <?php endif; ?>

              </div>
        <?php endforeach; ?>
        </div>
      <?php endif; ?>
    </div>

  </div>
</div>
