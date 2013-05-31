<?php get_header(); ?>

<!--start content--><title>Untitled Document</title>
    <div id="content">
    <div class="inner-content">
    <!--c1-->
    <div id="c1">     
        
		<?php if (have_posts()) :
                
                    while (have_posts()) : the_post(); ?>                            
                                
                        <h4><a href="<?php the_permalink() ?>" title="<?php the_title(); ?>"><?php the_title(); ?></a></h4>
                        <div class="date"><strong><?php the_time('F j, Y') ?></strong> Last updated at <?php the_time('g:i a') ?></div>
                        <?php the_content(); ?>
                    
                    
                    <?php endwhile; ?>

                <div class="navigation">
                <div class="alignleft"><?php next_posts_link('&laquo; Older Entries') ?></div>
                <div class="alignright"><?php previous_posts_link('Newer Entries &raquo;') ?></div>
                </div>     

        <?php else : ?>            
                <p align="center">Sorry, There is no video for this page!</p>
        <?php endif; ?>
        
    </div>
    <!--/c1-->
    
     <?php get_sidebar(); ?>
    
    </div>
    <!--/inner-content-->    
    </div>
	<!--/content-->
   
  <?php get_footer(); ?>  