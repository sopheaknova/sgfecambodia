<?php

//Referrence site: http://www.vooshthemes.com/blog/wordpress-tip/create-a-professional-portfolio-using-wordpress-3-0-custom-post-types/

add_action('init', 'portfolio_menu');

function portfolio_menu() {
	$labels = array(
		    'name' => _x('Portfolio Items', 'post type general name'),
		    'singular_name' => _x('Portfolio Entry', 'post type singular name'),
		    'add_new' => _x('Add New', 'portfolio'),
		    'add_new_item' => __('Add New Portfolio Entry'),
		    'edit_item' => __('Edit Portfolio Entry'),
		    'new_item' => __('New Portfolio Entry'),
		    'view_item' => __('View Portfolio Entry'),
		    'search_items' => __('Search Portfolio Entries'),
		    'not_found' =>  __('No Portfolio Entries found'),
		    'not_found_in_trash' => __('No Portfolio Entries found in Trash'), 
		    'parent_item_colon' => ''
		  );
	
		$slugRule = get_option('category_base');
		if($slugRule == "") $slugRule = 'category';
		
    	$args = array(
        	'labels' => $labels,
        	'public' => true,
        	'show_ui' => true,
        	'capability_type' => 'post',
        	'hierarchical' => false,
        	'rewrite' => array('slug'=>$slugRule.'/portfolio','with_front'=>true),
        	'query_var' => true,
        	'show_in_nav_menus'=> false,
        	'menu_position' => 5,
        	'supports' => array('title','thumbnail','editor')
        );

    	register_post_type( 'portfolio' , $args );
    	
    	
    	register_taxonomy("portfolio_entries", 
					    	array("portfolio"), 
					    	array(	"hierarchical" => true, 
					    			"label" => "Portfolio Categories", 
					    			"singular_label" => "Portfolio Categories", 
					    			"rewrite" => true,
					    			"query_var" => true

					    		));  
}


//Show Meta box in Portfolio Entry
add_action("admin_init", "add_portfolio");
add_action('save_post', 'update_website_url');

function add_portfolio(){
		add_meta_box("portfolio_details", "Portfolio Options", "portfolio_options", "portfolio", "normal", "low");
}
function portfolio_options(){
		global $post;
		$custom = get_post_custom($post->ID);
		$website_url = $custom["website_url"][0];
?>
	<div id="portfolio-options">
		<label>Website URL:</label><input name="website_url" value="<?php echo $website_url; ?>" />		
	</div><!--end portfolio-options-->   
<?php
}
function update_website_url(){
		global $post;
		update_post_meta($post->ID, "website_url", $_POST["website_url"]);
}



#portfolio_columns, <-  register_post_type then append _columns
add_filter("manage_edit-portfolio_columns", "prod_edit_columns");
add_action("manage_posts_custom_column",  "prod_custom_columns");

function prod_edit_columns($columns){

		$newcolumns = array(
			"cb" => "<input type=\"checkbox\" />",
			"title" => "Title",
			"portfolio_entries" => "Categories"
		);
		
		$columns= array_merge($newcolumns, $columns);

		return $columns;
}

function prod_custom_columns($column){
		global $post;
		switch ($column)
		{
			case "description":
				#the_excerpt();
				break;
			case "price":
				#$custom = get_post_custom();
				#echo $custom["price"][0];
				break;
			case "portfolio_entries":
				echo get_the_term_list($post->ID, 'portfolio_entries', '', ', ','');
				break;
		}
}



?>