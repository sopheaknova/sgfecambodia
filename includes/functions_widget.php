<?php


// Register thumbnail sizes.
if ( function_exists('add_image_size') )
{
	$sizes = get_option('jlao_cat_post_thumb_sizes');
	if ( $sizes )
	{
		foreach ( $sizes as $id=>$size )
			add_image_size( 'cat_post_thumb_size' . $id, $size[0], $size[1], true );
	}
}

//Widget to show recently post only News category
class SGFE_Widget_Recently_News extends WP_Widget{
	function SGFE_Widget_Recently_News(){
		$widget_ops = array( 'description' => __( 'Your sidebar recently news', 'sgfe') );
        $this->WP_Widget('recently_news_updated', __('Recently News Updated', 'sgfe'), $widget_ops);
	}
	
	function widget( $args, $instance ){
	
		extract( $args );
		
		$sizes = get_option('jlao_cat_post_thumb_sizes');
		
		// If not title, use the name of the category.
		if( !$instance["title"] ) {
			$category_info = get_category(3);
			$instance["title"] = $category_info->name;
		}
		
		// Get array of post info.
		$cat_posts = new WP_Query("showposts=" . $instance["num"] . "&cat=3");
	
		// Excerpt length filter
		$new_excerpt_length = create_function('$length', "return " . $instance["excerpt_length"] . ";");
		if ( $instance["excerpt_length"] > 0 )
			add_filter('excerpt_length', $new_excerpt_length);
			

        $title = apply_filters('widget_title', empty($instance['title']) ? __('Recently News Updated', 'sgfe') : $instance['title']);

        echo $before_widget;

        if ( $title )
                echo $before_title . '<a href="' . get_category_link('3') . '">' . $title . '</a>' . $after_title;
			
		// Post list
		echo '<ul class="pop-news-list">';
		
		while ( $cat_posts->have_posts() )
		{
			$cat_posts->the_post();
		?>
			<li class="cat-post-item">				
				<?php
					if (
						function_exists('the_post_thumbnail') &&
						current_theme_supports("post-thumbnails") &&
						$instance["thumb"] &&
						has_post_thumbnail()
					) :
				?>
					<a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>">
					<?php the_post_thumbnail( 'cat_post_thumb_size'.$this->id ); ?>
					</a>
				<?php endif; ?>	
                
                <a class="post-title" href="<?php the_permalink(); ?>" rel="bookmark" title="Permanent link to <?php the_title_attribute(); ?>"><?php the_title(); ?></a>				
				
				<?php if ( $instance['excerpt'] ) : ?>
				<?php the_excerpt(); ?> 
				<?php endif; ?>
				
			</li>
		<?php
		}
		
		echo "</ul>\n";
		
		echo $after_widget;
	
		remove_filter('excerpt_length', $new_excerpt_length);
		
		$post = $post_old; // Restore the post object.
	}
	
	function update($new_instance, $old_instance) {
		if ( function_exists('the_post_thumbnail') )
		{
			$sizes = get_option('jlao_cat_post_thumb_sizes');
			if ( !$sizes ) $sizes = array();
			$sizes[$this->id] = array($new_instance['thumb_w'], $new_instance['thumb_h']);
			update_option('jlao_cat_post_thumb_sizes', $sizes);
		}
		
		return $new_instance;
	}
	
	function form($instance) {
	?>
    
    <p><label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('Title:', 'sgfe') ?></label>
    <input type="text" class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" value="<?php if (isset ($instance['title'])) {echo esc_attr( $instance['title']);} ?>" /></p>
    
    <p>
        <label for="<?php echo $this->get_field_id("num"); ?>">
            <?php _e('Number of posts to show'); ?>:
            <input style="text-align: center;" id="<?php echo $this->get_field_id("num"); ?>" name="<?php echo $this->get_field_name("num"); ?>" type="text" value="<?php echo absint($instance["num"]); ?>" size='3' />
        </label>
    </p>
    
    <p>
        <label for="<?php echo $this->get_field_id("excerpt"); ?>">
            <input type="checkbox" class="checkbox" id="<?php echo $this->get_field_id("excerpt"); ?>" name="<?php echo $this->get_field_name("excerpt"); ?>"<?php checked( (bool) $instance["excerpt"], true ); ?> />
            <?php _e( 'Show post excerpt' ); ?>
        </label>
    </p>
    
    <p>
        <label for="<?php echo $this->get_field_id("excerpt_length"); ?>">
            <?php _e( 'Excerpt length (in words):' ); ?>
        </label>
        <input style="text-align: center;" type="text" id="<?php echo $this->get_field_id("excerpt_length"); ?>" name="<?php echo $this->get_field_name("excerpt_length"); ?>" value="<?php echo $instance["excerpt_length"]; ?>" size="3" />
    </p>
    
    <?php if ( function_exists('the_post_thumbnail') && current_theme_supports("post-thumbnails") ) : ?>
		<p>
			<label for="<?php echo $this->get_field_id("thumb"); ?>">
				<input type="checkbox" class="checkbox" id="<?php echo $this->get_field_id("thumb"); ?>" name="<?php echo $this->get_field_name("thumb"); ?>"<?php checked( (bool) $instance["thumb"], true ); ?> />
				<?php _e( 'Show post thumbnail' ); ?>
			</label>
		</p>
		<p>
			<label>
				<?php _e('Thumbnail dimensions'); ?>:<br />
				<label for="<?php echo $this->get_field_id("thumb_w"); ?>">
					W: <input class="widefat" style="width:40%;" type="text" id="<?php echo $this->get_field_id("thumb_w"); ?>" name="<?php echo $this->get_field_name("thumb_w"); ?>" value="<?php echo $instance["thumb_w"]; ?>" />
				</label>
				
				<label for="<?php echo $this->get_field_id("thumb_h"); ?>">
					H: <input class="widefat" style="width:40%;" type="text" id="<?php echo $this->get_field_id("thumb_h"); ?>" name="<?php echo $this->get_field_name("thumb_h"); ?>" value="<?php echo $instance["thumb_h"]; ?>" />
				</label>
			</label>
		</p>
	<?php endif; ?>
    
<?php
	}

}
register_widget('SGFE_Widget_Recently_News');




//Widget to show only once latest video post
class SGFE_Widget_Video_Post extends WP_Widget{
	function SGFE_Widget_Video_Post(){
		$widget_ops = array( 'description' => __( 'Your sidebar Video', 'sgfe') );
        $this->WP_Widget('watch_and_listen', __('Watch and Listen', 'sgfe'), $widget_ops);
	}
	
	function widget($args, $instance){		
		
		extract( $args );
		
		// Get array of Video post info.
		$cat_vidoe = new WP_Query("showposts=1&cat=4");
		
		if (have_posts()) :
		
		$title = apply_filters('widget_title', empty($instance['title']) ? __('Watch and Listen', 'sgfe') : $instance['title']);		
		echo $before_widget;
		if ( $title )
                echo $before_title . '<a href="' . get_category_link('4') . '">' . $title . '</a>' . $after_title;
		
		echo '<ul class="video-items">';
		while ( $cat_vidoe->have_posts() )		
		{
			$cat_vidoe->the_post();
		?>	
			<li><?php the_content(); ?></li>
            
		<?php
        }	
		
		echo '</ul>';
		
		echo $after_widget;
		endif;
	}
	
	function update($new_instance, $old_instance){
		$instance = $old_instance;
		$instance['title'] = strip_tags($new_instance['title']);
		
		return $new_instance;
	}
	
	function form($instance){
?>
    <p><label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('Title:', 'sgfe') ?></label>
    <input type="text" class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" value="<?php if (isset ($instance['title'])) {echo esc_attr( $instance['title']);} ?>" /></p>
    
<?php	
		
	}
}
register_widget('SGFE_Widget_Video_Post');


//Widget to show SGFE location
class SGFE_Widget_Minimap extends WP_Widget{
	function SGFE_Widget_Minimap(){
		$widget_ops = array( 'description' => __( 'Your sidebar Map', 'sgfe' ) );
		$this->WP_Widget('get_intouch_with_us', __('Get In touch with Us', 'sgfe'), $widget_ops);
	}
	
	function widget($args, $instance){
		extract($args);
		
		$title = apply_filters('widget_title', empty($instance['title']) ? __('Get In touch with Us', 'sgfe') : $instance['title']);		
		echo $before_widget;
		if ( $title )
                echo $before_title . '<a href="' . get_option('home') . '/contact">' . $title . '</a>' . $after_title;
				
		echo '<div class="contact-widget">';
		echo	'<h4>HP: ' . $instance['hp'] . '</h4>';
		if ( $instance['hp_02'] !== '')
			echo '<h4>HP: ' . $instance['hp_02'] . '</h4>';
			
            echo '<p>E-Mail: <a href="mailto:' . $instance['email'] . '">' . $instance['email'] . '</a><br />';
	    if ( $instance['email_02'] !== '' )
			echo 'E-Mail: <a href="mailto:' . $instance['email_02'] . '">' . $instance['email_02'] . '</a></p>';
		?>	
    		        <a href="<?php echo get_option('home'); ?>/contact"><img src="<?php bloginfo('template_url'); ?>/images/map-mini.gif" alt="mini map" /></a>
        <?php
        echo '<small>' . $instance['address'] . '</small>';
		echo '</div>';
				
		echo $after_widget;		
	}
	
	function update($new_instance, $old_instance){
		$instance = $old_instance;
		$instance['title'] = strip_tags($new_instance['title']);
		$instance['hp'] = strip_tags($new_instance['hp']);
		$instance['hp_02'] = strip_tags($new_instance['hp_02']);
		$instance['email'] = strip_tags($new_instance['email']);
		$instance['email_02'] = strip_tags($new_instance['email_02']);
		$instance['address'] = strip_tags($new_instance['address']);
		
		return $new_instance;
	}
	
	function form($instance){
?>
    <p><label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('Title:', 'sgfe') ?></label>
        <input type="text" class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" value="<?php if (isset ($instance['title'])) {echo esc_attr( $instance['title']);} ?>" /></p>
     
     <p><label for="<?php echo $this->get_field_id('hp'); ?>"><?php _e('HP:', 'sgfe') ?></label>
        <input type="text" class="widefat" id="<?php echo $this->get_field_id('hp'); ?>" name="<?php echo $this->get_field_name('hp'); ?>" value="<?php if (isset ($instance['hp'])) {echo esc_attr( $instance['hp']);} ?>" /></p>
        
     <p><label for="<?php echo $this->get_field_id('hp_02'); ?>"><?php _e('HP:', 'sgfe') ?></label>
        <input type="text" class="widefat" id="<?php echo $this->get_field_id('hp_02'); ?>" name="<?php echo $this->get_field_name('hp_02'); ?>" value="<?php if (isset ($instance['hp_02'])) {echo esc_attr( $instance['hp_02']);} ?>" /></p>
     
     <p><label for="<?php echo $this->get_field_id('email'); ?>"><?php _e('Email:', 'sgfe') ?></label>
        <input type="text" class="widefat" id="<?php echo $this->get_field_id('email'); ?>" name="<?php echo $this->get_field_name('email'); ?>" value="<?php if (isset ($instance['email'])) {echo esc_attr( $instance['email']);} ?>" /></p>    
        
      <p><label for="<?php echo $this->get_field_id('email_02'); ?>"><?php _e('Email:', 'sgfe') ?></label>
        <input type="text" class="widefat" id="<?php echo $this->get_field_id('email_02'); ?>" name="<?php echo $this->get_field_name('email_02'); ?>" value="<?php if (isset ($instance['email_02'])) {echo esc_attr( $instance['email_02']);} ?>" /></p>      
     
     <p><label for="<?php echo $this->get_field_id('address'); ?>"><?php _e('Address:', 'sgfe') ?></label>
        <input type="text" class="widefat" id="<?php echo $this->get_field_id('address'); ?>" name="<?php echo $this->get_field_name('address'); ?>" value="<?php if (isset ($instance['address'])) {echo esc_attr( $instance['address']);} ?>" /></p>           
<?php    		
	}
}
register_widget('SGFE_Widget_Minimap');


?>