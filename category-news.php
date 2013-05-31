<?php get_header(); ?>

<!--start content--><title>Untitled Document</title>
    <div id="content">
    <div class="inner-content">
    <!--c1-->
    <div id="c1">     
    	
        <?php
		
		if ( $paged < 2 ) {
		
			if (have_posts()) {
			
				$postcount = 0;
				$page = (get_query_var('paged')) ? get_query_var('paged') : 1;
				
				query_posts( 'paged=$page&post_per_page=-1&cat=3');
				while (have_posts()) { the_post(); 	
					if( $postcount == 0 ) { ?>
					<!--main-pages-->
					<div class="main-story">
						<h3><a href="<?php the_permalink() ?>" title="<?php the_title(); ?>"><?php the_title(); ?></a></h3>
						<div class="date"><strong><?php the_time('F j, Y') ?></strong> Last updated at <?php the_time('g:i a') ?></div>
						<a href="<?php the_permalink() ?>" title="<?php the_title(); ?>"><img src="<?php bloginfo('template_url'); ?>/scripts/timthumb.php?q=100&w=296&h=163&src=<?php echo PostThumbURL(); ?>" /></a>                    
						<p><?php dispaly_content('75'); ?></p>
						<div class="clearboth"></div>
					</div>
					<!--/main-story-->                
				<?php		
					}
					elseif( $postcount > 0 && $postcount <= 4 ) {
				?>
					<!--sub-story-->
					<div class="sub-story">
						<a href="<?php the_permalink() ?>" title="<?php the_title(); ?>"><img src="<?php bloginfo('template_url'); ?>/scripts/timthumb.php?q=100&w=144&h=95&src=<?php echo PostThumbURL(); ?>" /></a>        	
						<h4><a href="<?php the_permalink() ?>" title="<?php the_title(); ?>"><?php the_title(); ?></a></h4>
						<div class="date"><strong><?php the_time('F j, Y') ?></strong> Last updated at <?php the_time('g:i a') ?></div>
						<p><?php dispaly_content('25'); ?></p>
						<div class="clearboth"></div>
					</div>
					
				<?php
					}
					$postcount ++;	
				}
				//end While	
				?>
		
	
				
				<div class="navigation">
				<div class="alignleft"><?php next_posts_link('&laquo; Older Entries') ?></div>
				<div class="alignright"><?php previous_posts_link('Newer Entries &raquo;') ?></div>
				</div>
				
			<?php
			}
		} else{ ?>
		
        		<?php while (have_posts()) : the_post(); ?>        
                    <div class="sub-story">
                        <a href="<?php the_permalink() ?>" title="<?php the_title(); ?>"><img src="<?php bloginfo('template_url'); ?>/scripts/timthumb.php?q=100&w=144&h=95&src=<?php echo PostThumbURL(); ?>" /></a>        	
                        <h4><a href="<?php the_permalink() ?>" title="<?php the_title(); ?>"><?php the_title(); ?></a></h4>
                        <div class="date"><strong><?php the_time('F j, Y') ?></strong> Last updated at <?php the_time('g:i a') ?></div>
                        <p><?php dispaly_content('25'); ?></p>
                        <div class="clearboth"></div>
                    </div>
                <?php endwhile; ?>
        
		<?php
		}		
		?>
        
                
        
    </div>
    <!--/c1-->
    
     <?php get_sidebar(); ?>
    
    </div>
    <!--/inner-content-->    
    </div>
	<!--/content-->
   
  <?php get_footer(); ?>  