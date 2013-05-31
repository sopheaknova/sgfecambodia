<?php get_header(); ?>

	<!--start content-->
    <div id="content">
    <div class="inner-content">
    <!--c1-->
    <div id="c1">     
	    <?php if (have_posts()) : ?>		
				<?php if ( is_day() ) : ?>
                <h2 class="page-title">
                <?php printf( __( 'Daily Archives: <span>%s</span>', 'sandbox' ),
                get_the_time(get_option('date_format')) ) ?>
                </h2> 
                <?php elseif ( is_month() ) : ?>
                <h2 class="page-title"> 
                <?php printf( __( 'Monthly Archives: <span>%s</span>', 'sandbox' ),
                get_the_time('F Y') ) ?>
                </h2> 
                <?php elseif ( is_year() ) : ?> 
                <h2 class="page-title"> 
                <?php printf( __( 'Yearly Archives: <span>%s</span>', 'sandbox' ),
                get_the_time('Y') ) ?>
                </h2> 
                <?php elseif ( isset($_GET['paged']) && !empty($_GET['paged']) ) : ?>
                <h2 class="page-title"><?php _e( 'Blog Archives', 'sandbox' ) ?></h2>
                <?php endif; ?>
                
                <?php while (have_posts()) : the_post(); ?>        
                    <div class="sub-story">
                        <a href="<?php the_permalink() ?>" title="<?php the_title(); ?>"><img src="<?php bloginfo('template_url'); ?>/scripts/timthumb.php?q=100&w=144&h=95&src=<?php echo PostThumbURL(); ?>" /></a>        	
                        <h4><a href="<?php the_permalink() ?>" title="<?php the_title(); ?>"><?php the_title(); ?></a></h4>
                        <div class="date"><strong><?php the_time('F j, Y') ?></strong> Last updated at <?php the_time('g:i a') ?></div>
                        <p><?php dispaly_content('35'); ?></p>
                        <div class="clearboth"></div>
                    </div>
                <?php endwhile; ?>
                
                <div class="navigation">
                    <div class="alignleft"><?php next_posts_link('&laquo; Older Entries') ?></div>
                    <div class="alignright"><?php previous_posts_link('Newer Entries &raquo;') ?></div>
                </div>
                
                <?php else :
        
                if ( is_category() ) { // If this is a category archive
                    printf("<h2 class='center'>Sorry, but there aren't any posts in the %s category yet.</h2>", single_cat_title('',false));
                } else if ( is_date() ) { // If this is a date archive
                    echo("<h2>Sorry, but there aren't any posts with this date.</h2>");
                } else if ( is_author() ) { // If this is a category archive
                    $userdata = get_userdatabylogin(get_query_var('author_name'));
                    printf("<h2 class='center'>Sorry, but there aren't any posts by %s yet.</h2>", $userdata->display_name);
                } else {
                    echo("<h2 class='center'>No posts found.</h2>");
                }               
        
            endif;
        ?>    
        
    </div>
    <!--/c1-->
    
     <?php get_sidebar(); ?>
    
    </div>
    <!--/inner-content-->    
    </div>
	<!--/content-->
   
  <?php get_footer(); ?>  