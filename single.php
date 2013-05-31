<?php get_header(); ?>

<!--start content-->
    <div id="content">
    <div class="inner-content">
    <!--c1-->
    <div id="c1">     
    	
        <!--full-pages-->
        <div class="full-story">
        	<?php if (have_posts()) : ?>

				<?php while (have_posts()) : the_post(); ?> 
                
                <h2><?php the_title(); ?></h2>
                <div class="date"><strong><?php the_time('F j, Y') ?></strong> Last updated at <?php the_time('g:i a') ?></div>
                <?php the_content('Read the rest of this entry &raquo;'); ?>
                
                <?php endwhile; 
            	else : ?>
        
                <h2>Not Found</h2>
                <p>Sorry, but you are looking for something that isn't here.</p>
        
            <?php endif; ?>        
        
        </div>
        <!--/full-story-->        
        
    </div>
    <!--/c1-->
    
     <?php get_sidebar(); ?>
    
    </div>
    <!--/inner-content-->    
    </div>
	<!--/content-->
   
  <?php get_footer(); ?>  