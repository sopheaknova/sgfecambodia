<?php 
/* Template Name: Contact
*/ 
?> 
<?php get_header(); ?>

    <!--start content-->
    <div id="content">    
    	<div  class="inner-content">
    		<?php if (have_posts()) : ?>

				<?php while (have_posts()) : the_post(); ?> 
                
                <h2><?php the_title(); ?></h2>
                <?php the_content('Read the rest of this entry &raquo;'); ?>
                
                <?php endwhile; 
            	else : ?>
        
                <h2>Not Found</h2>
                <p>Sorry, but you are looking for something that isn't here.</p>
        
            <?php endif; ?>
            
            <!--Location in Phnom Penh-->
            <div class="quick-contact">
                <div class="gm-photo">
                    <p><img src="<?php echo get_option('sgfe_contact_photo'); ?>" /></p>
                    <h4><?php echo get_option('sgfe_contact_name'); ?></h4>
                    <p><?php echo get_option('sgfe_contact_pos'); ?></p>
                </div>
                <div class="quick-info">
                    <p class="tel">HP: <?php echo get_option('sgfe_phone_01'); ?><br />
                    
                    <?php if(get_option('sgfe_phone_02') != '') : ?>
                    HP: <?php echo get_option('sgfe_phone_02'); ?><br />
                    <?php endif; ?>
                    E-Mail: <a href="mailto:<?php echo get_option('sgfe_email_01'); ?>"><?php echo get_option('sgfe_email_01'); ?></a><br />
                    
                    <?php if(get_option('sgfe_email_02') != '') : ?>                    
                    E-Mail: <a href="mailto:<?php echo get_option('sgfe_email_02'); ?>"><?php echo get_option('sgfe_email_02'); ?></a></p>
                    <?php endif; ?>
                    <h4>SGFE Office &amp; Factory:</h4>
                    <p><?php echo get_option('sgfe_address'); ?></p>
                </div>
                <div class="maps">
                		<script type="text/javascript"
							src="http://maps.google.com/maps/api/js?sensor=false">
						</script>
						<script type="text/javascript">					
						  jQuery(document).ready(function ($)
							{
								var myLatlng = new google.maps.LatLng(<?php echo get_option('sgfe_lat'); ?>,<?php echo get_option('sgfe_lng'); ?>);
								var myOptions = {							  
								  zoom: 12,
								  center: myLatlng,
								  mapTypeId: google.maps.MapTypeId.ROADMAP
								}
								var map = new google.maps.Map(document.getElementById("gm-map"), myOptions);
								
								var marker = new google.maps.Marker({
									position: myLatlng, 
									map: map,
									animation: google.maps.Animation.DROP,
									title:"SGFE Cambodia in Phnom Penh"
								});
							});
						</script>
                <div id="gm-map"></div>
                </div>
            </div>
            <!--End Location in Phnom Penh-->
            
            
            <!--manualy for other person-->
            <div class="quick-contact">
            	<div class="gm-photo"> 
                <h4>Mr. Chom Vichet</h4>
                <p>Production Manager</p>
                </div>
                
                <div class="quick-info">                    
                    <p class="tel">HP: 092 907 086</p>
                </div>
            </div>
            <!--/ manualy for other person-->
            
            <!--Location in Takeo-->
            <div class="quick-contact">
                <div class="gm-photo">                    
                    <h4>Mrs. Sokhaleap</h4>
                </div>
                <div class="quick-info">                    
                    <h4>Retailer, &amp; Wholesaler <br />in Takeo province:</h4>
                    <p class="tel">HP: 077 56 80 03<br />
                    HP: 032 6950 999</p>
                </div>
                
            </div>
            <!--End Location in Takeo-->
            
            <!--Location in Siem Reap-->
            <div class="quick-contact">
                <div class="gm-photo">                    
                    <h4>Chea Sovanna</h4>
                </div>
                <div class="quick-info">                    
                    <h4>Retailer, &amp; Wholesaler <br />in Seam Reap province:</h4>
                    <p>Kantrork Village, Sangkat Svaydongkom, Khan Siem Reap, Siem Reap City</p>
                    <p class="tel">HP: 089 512 413<br />
                    HP: 097 6539 478</p>
                </div>
                
            </div>
            <!--End Location in Siem Reap-->

            
          
            <!--Make Anquiry-->
            <script type="text/javascript" src="<?php bloginfo('template_url'); ?>/js/form.js"></script>
			<script language="javascript">
            <!--
            jQuery(document).ready(function ($)
            {
                $('#myform').FormValidate({
                    phpFile:"<?php bloginfo('template_url'); ?>/send.php",
                    ajax:true,
                    validCheck: true
                });
            });
            -->
            </script>
                <style type="text/css">
                .valid{border:1px solid green !important;}
                .invalid{border:1px solid #800 !important;}
                </style>
            <div class="anquiry">            
                <h4>For any question or enquiry:</h4>
                <p>Feel free to contact me or please fill up below in the following details and we will be in touch shortly.</p>
                <div>
                <form id="myform">
                	<div>
                    <label for="name">Name / Company:</label>
                    <label for="email">Email Address:</label>
                    <label for="subject" class="last">Subject:</label>
                    </div>
                	<div>                    
                    <input type="text" name="name" class="txt-box is_required" />
                    <input type="text" name="email" class="txt-box is_required" />
                    <input type="text" name="subject" class="txt-box is_required" />                    
                    <label for="message">Message:</label>
                    <textarea name="message" class="txt-area is_required" rows="8"></textarea>                    
                    </div>
                    <p align="center"><input type="submit" value="" class="submit_btn" /></p>
                </form>
                </div>
                
            </div>
            <!--/Make Anquiry-->
            
        </div>
        <!--/inner-content-->
        
    </div>
<!--/content-->


<?php get_footer(); ?>
