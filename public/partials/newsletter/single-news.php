<?php
/**
 * The template for displaying single posts and pages.
 */

get_header();
?>

<div class="bootstrap-iso">

  <div class="container">

    <!-- Start the Loop. -->
     <?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>

     	<div class="post">
       	<!-- Display the Title as a link to the Post's permalink. -->
       	<h2>
            <?php the_title(); ?>
        </h2>
        <?php
          echo tnl_add_feature_img_video_class( get_the_ID() );
          if ( has_post_thumbnail( get_the_ID() ) ) {
              echo '<a href="' . tnl_featured_img( get_the_ID() ) . '" title="' . esc_attr( get_the_title() ) . '" target="_blank">';
                echo get_the_post_thumbnail( get_the_ID(), 'large', ['class' => 'img-fluid '.tnl_add_feature_img_video_class( get_the_ID() ).'' ] );
              echo '</a>';
          }
        ?>
       	<!-- Display the date (November 16th, 2009 format) and a link to other posts by this posts author. -->

       	<small><?php the_time('F jS, Y'); ?> by <?php the_author_posts_link(); ?></small>

       	<!-- Display the Post's content in a div box. -->

       	<div class="entry">
       		<?php the_content(); ?>
       	</div>


       	<!-- Display a comma separated list of the Post's Categories. -->

       	<p class="postmetadata"><?php _e( 'Posted in' ); ?> <?php the_category( ', ' ); ?></p>

          <?php tnl_naked_url(get_the_ID()); ?>
     	</div> <!-- closes the first div box -->


     	<!-- Stop The Loop (but note the "else:" - see next line). -->

     <?php endwhile; else : ?>


     	<!-- The very first "if" tested to see if there were any Posts to -->
     	<!-- display.  This "else" part tells what do if there weren't any. -->
     	<p><?php esc_html_e( 'Sorry, no posts matched your criteria.' ); ?></p>


     	<!-- REALLY stop The Loop. -->
     <?php endif; ?>

  </div>

</div>

<?php get_footer(); ?>
