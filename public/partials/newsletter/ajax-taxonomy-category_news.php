<!-- Start the Loop. -->
 <?php if ( $query->have_posts() ) : while ( $query->have_posts() ) : $query->the_post(); ?>
   <?php
    $post_id = get_the_ID();
    $post_title = get_the_title();
    $post_content = get_the_content();
   ?>
   <div class="one-column-template wrap">
     <div class="loop-list-item index-<?php echo $i; ?>">
       <?php //$post_id = $post->ID; ?>

       <div class="row row-eq-height ">
         <div class="col-lg-6 col-md-12 col-sm-12 ">
           <div class="loop-title">
             <h2 class="layout">
               <?php //echo $post->post_title; ?>
               <a href="<?php echo get_the_permalink( $post_id ); ?>">
                 <?php echo $post_title; ?>
               </a>
             </h2>
           </div>

           <div class="featured-image d-block d-md-none d-sm-block">
             <?php if ( has_post_thumbnail( $post_id ) ) : ?>
                 <div class="loop-featured-image">
                   <?php
                     echo '<a href="' . tnl_featured_img( $post_id ) . '" title="' . esc_attr( $post_title ) . '" target="_blank">';
                       echo get_the_post_thumbnail( $post_id, 'large', ['class'=>'img-fluid mx-auto d-block'] );
                     echo '</a>';
                   ?>
                 </div>
             <?php endif; ?>
           </div>

           <div class="loop-teaser">
             <p><?php //echo wpautop($post->post_excerpt); ?></p>
           </div>

           <div class="loop-content">
             <p><?php echo wp_trim_words( wpautop($post_content) ); ?></p>
           </div>

           <?php tnl_naked_url($post_id); ?>
         </div>
         <div class="col-lg-6 col-md-6 col-sm-12 d-none d-md-block">
           <div class="featured-image">
             <?php if ( has_post_thumbnail( $post_id ) ) : ?>
                 <div class="loop-featured-image">
                   <?php
                     echo '<a href="' . tnl_featured_img( $post_id ) . '" title="' . esc_attr( $post_title ) . '" target="_blank">';
                       echo get_the_post_thumbnail( $post_id, 'large', ['class'=>'img-fluid mx-auto d-block'] );
                     echo '</a>';
                   ?>
                 </div>
             <?php endif; ?>
           </div>
         </div>
       </div>
       <?php //tnl_cta_url($post_id); ?>
     </div>
   </div>

  <!-- Stop The Loop (but note the "else:" - see next line). -->

<?php endwhile; ?>

 <?php else : ?>

  <!-- The very first "if" tested to see if there were any Posts to -->
  <!-- display.  This "else" part tells what do if there weren't any. -->
  <p><?php esc_html_e( 'Sorry, no posts matched your criteria.' ); ?></p>

  <!-- REALLY stop The Loop. -->
 <?php endif; ?>

 <div class="post-pagination"><?php wp_pagenavi(['query' => $query]); ?></div>
