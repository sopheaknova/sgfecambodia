<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=<?php bloginfo( 'charset' ); ?>" />
<title>
	<?php if(is_home() ) { bloginfo('name'); ?> | <?php bloginfo('description'); } ?>
	<?php if(is_single() || is_page() || is_archive() || is_tag() || is_category() ) { wp_title('',true); ?> | <?php bloginfo('name'); } ?>
    <?php if(is_404()) { ?> Ops page not found | <?php bloginfo('name'); } ?>    
</title>
<meta name="description" content="SGFE (Sustainable Green Fuel Enterprise) was created in 2008 with the aim of alleviating poverty and reducing deforestation in Cambodia, as well as improving waste management in urban areas, by developing a local economic activity: manufacturing charcoal using organic waste." />
<meta name="keywords" content="sustainable, green, coconut, charcoal, briquettes, charbriquettes, recycled, social business, Cambodia, environmental, ecological, social, asia, biomass" />
<link rel="stylesheet" type="text/css" media="all" href="<?php bloginfo( 'stylesheet_url' ); ?>" />
<link rel="shortcut icon" href="<?php bloginfo('template_url'); ?>/icon.ico" />
<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>" />
<script src="<?php bloginfo('template_url'); ?>/js/jquery-1.4.2.min.js" type="text/javascript"></script>

<style type="text/css">
	@import "<?php bloginfo('template_url'); ?>/styles/uibase.css";	
</style>
<?php wp_head(); ?>

</head>

<body>
<!--start wrap-->
<div id="wrap">

	<!--star header-->
    <div id="header">
    	
        <div id="logo">
        <h1><a href="<?php bloginfo('url'); ?>" title="<?php bloginfo('name'); ?>"><img src="<?php bloginfo('template_url'); ?>/images/logo.jpg" alt="sgfe cambodia" /></a></h1>
        </div>
        
        <div class="inner-header-right">
        	
            <div class="socialshare">
                <a href="http://www.facebook.com/#!/profile.php?id=100001570585648&v=wall"><img src="<?php bloginfo('template_url'); ?>/images/facebook.png" alt="facebook" /></a>
                <a href="http://www.sgfe-cambodia.com/feed"><img src="<?php bloginfo('template_url'); ?>/images/rss.png" alt="rss" /></a>
            </div>
            
        	<!--start menu-->
            <div class="ddsmoothmenu">
                <ul>
                    <li class="<?php if ( is_home() ) { ?>current_page_item<?php } ?>"><a href="<?php echo get_option('home'); ?>/">Home</a></li>                    
                    <?php wp_list_pages('sort_column=menu_order&title_li=&depth=1'); ?>                                        
                    <?php wp_list_categories('include=3&title_li='); ?>
                    <div class="clear"></div>
                </ul>        
            </div>
            <!--/menu-->
        </div>
        
    </div>
    <!--/header--> 