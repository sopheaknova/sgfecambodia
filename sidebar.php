<!--c2-->
    <div id="c2">
    	<?php if ( is_active_sidebar( 'right-sidebar' ) ) : ?>        	
	        <?php dynamic_sidebar( 'right-sidebar' ); ?>
        <?php else : ?>
        	
            		<?php  // Video Sidebar 
							if ( get_option('sgfe_is_video_sidebar') == 'no') : 
								// Get array of Video post info.
								$cat_vidoe = new WP_Query("showposts=1&cat=4"); ?>
                                
								<div class="box-sidebar">
                                	<h3><?php echo get_option('sgfe_video_title'); ?></h3>
                                	<ul class="video-items">		
					<?php			
								if (have_posts()) : 
									while ( $cat_vidoe->have_posts() )		
										{
											$cat_vidoe->the_post(); ?>
                                            <li><?php the_content(); ?></li>
					<?php						
										}	
								endif
					?>		
                    				</ul>
                                   <?php $category_link = get_category_link(4); ?> 
                                   <a href="<?php echo esc_url( $category_link ); ?>">Watch more</a> 
                                   
                    			</div>
                                <!--/bod-sidebar-->	
                    <?php endif?>
                    
                    <?php // News Sidebar
							
							// Get array of post info.
							$cat_posts = new WP_Query("showposts=". get_option('sgfe_news_num') ."&cat=3");
					?>
                    		
							<div class="box-sidebar">
                           	<h3><a href="<?php echo get_category_link('3') ?>"><?php echo get_option('sgfe_news_title'); ?></a></h3>
                            <ul class="pop-news-list">
					<?php
							while ( $cat_posts->have_posts() )
							{
								$cat_posts->the_post();
					?>
                    		<li class="cat-post-item">				
				<?php
								if ( function_exists( 'add_theme_support' ) ) : // Added in 2.9																		
									add_image_size( 'single-post-thumbnail', 63, 63 ); // Permalink thumbnail size

								?>
									<a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>">
									<?php the_post_thumbnail('single-post-thumbnail'); ?>
									</a>
								<?php endif; ?>	
								
								<a class="post-title" href="<?php the_permalink(); ?>" rel="bookmark" title="<?php the_title(); ?>"><?php the_title(); ?></a>												
								<p><?php dispaly_content('10'); ?></p>								
							</li>
                    <?php			
							}	
					?>
                    		</ul>
                            </div>
                    		<!--/bod-sidebar-->	
                            
                            
                            <div class="box-sidebar">
                            	<h3><a href="<?php bloginfo('url'); ?>/contact">Get In touch with Us</a></h3><div class="contact-widget"><h4>HP: <?php echo get_option('sgfe_phone_01') ?></h4><p>E-Mail: <a href="mailto:<?php echo get_option('sgfe_email_01') ?>"><?php echo get_option('sgfe_email_01'); ?></a><br />E-Mail: <a href="mailto:<?php echo get_option('sgfe_email_02'); ?>"><?php echo get_option('sgfe_email_02'); ?></a></p>	
    		        <a href="<?php bloginfo('url'); ?>/contact"><img src="http://maps.google.com/maps/api/staticmap?center=<?php echo get_option('sgfe_lat') . ',' . get_option('sgfe_lng');?>&zoom=13&size=250x146&maptype=roadmap&markers=color:red|<?php echo get_option('sgfe_lat') . ',' . get_option('sgfe_lng');?>&sensor=false" alt="SGFE Cambodia's location" title="SGFE Cambodia's location" /></a>
        <small><?php echo get_option('sgfe_address'); ?></small></div>        
                            </div>

            	
        <?php endif ?>    
    </div>
    <!--/c2-->