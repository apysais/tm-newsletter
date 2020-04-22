<?php
/**
 * The template for displaying single posts and pages.
 */

get_header();
?>

<div class="bootstrap-iso">

  <div class="wrap">
    <?php tnl_news_archive_title(); ?>
    <div class="category-news-filter d-none d-md-block">
      <p>Filter by category</p>
      <?php TNL_News_FilterCategory::get_instance()->showNav(); ?>
    </div>
    <div class="category-news-filter d-block d-md-none d-sm-block">
      <p>Filter by category</p>
      <?php TNL_News_FilterCategory::get_instance()->showDropdownFilter(); ?>
    </div>

    <div id="overlay"></div>

    <div class="news-container">

      <!-- Start the Loop. -->
       <?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
         <?php $post_id = get_the_ID(); ?>
         <div class="one-column-template">
           <div class="loop-title">
               <h2 class="layout">
                 <a href="<?php echo get_the_permalink( $post_id ); ?>">
                   <?php the_title(); ?>
                 </a>
               </h2>
           </div>
           <div class="single-loop-list-item single-news-post-id-<?php echo $post_id; ?>">
             <div class="row row-eq-height ">

               <div class="col-lg-4 col-md-12 col-sm-12 ">

                 <div class="featured-image d-block d-md-none d-sm-block">
                   <?php if ( has_post_thumbnail( $post_id ) ) : ?>
                       <div class="loop-featured-image">
                         <?php
                           if ( has_post_thumbnail( $post_id ) ) {
                               echo '<a href="' . tnl_featured_img( $post_id ) . '" title="' . esc_attr( get_the_title() ) . '" target="_blank">';
                                 echo get_the_post_thumbnail( $post_id, 'full', ['class'=>'img-fluid'] );
                               echo '</a>';
                           }
                         ?>
                       </div>
                   <?php endif; ?>
                 </div>

                 <div class="loop-content">
                   <?php the_excerpt(); ?>
                 </div>

               </div>

               <div class="col-lg-8 col-md-6 col-sm-12 d-none d-md-block">
                 <div class="featured-image">
                   <?php if ( has_post_thumbnail( $post_id ) ) : ?>
                       <div class="loop-featured-image">
                         <?php
                           if ( has_post_thumbnail( $post_id ) ) {
                               echo '<a href="' . tnl_featured_img( $post_id ) . '" title="' . esc_attr( get_the_title() ) . '" target="_blank">';
                                 echo get_the_post_thumbnail( $post_id, 'large', ['class'=>'img-fluid mx-auto d-block'] );
                               echo '</a>';
                           }
                         ?>
                       </div>
                   <?php endif; ?>
                 </div>
               </div>

             </div>

           </div>
         </div>

       	<!-- Stop The Loop (but note the "else:" - see next line). -->

       <?php endwhile; else : ?>

       	<!-- The very first "if" tested to see if there were any Posts to -->
       	<!-- display.  This "else" part tells what do if there weren't any. -->
       	<p><?php esc_html_e( 'Sorry, no posts matched your criteria.' ); ?></p>

       	<!-- REALLY stop The Loop. -->
       <?php endif; ?>
        <div class="post-pagination"><?php wp_pagenavi(); ?></div>
    </div>

  </div>

</div>

<?php get_footer(); ?>
