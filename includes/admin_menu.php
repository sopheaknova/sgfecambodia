<?php

$themename = "SGFE Cambodia";
$shortname = "sgfe";

$options = array (
 
array( "name" => $themename." Options",
	"type" => "title"),
 

array( "name" => "Contact",
	"type" => "section"),
array( "type" => "open"),
 
array( "name" => "Contact Name",
	"desc" => "Enter the Contact Person's name. e.g: Mr. Ly Mathheat",
	"id" => $shortname."_contact_name",
	"type" => "text",
	"std" => "Mr. Ly Mathheat"),
array( "name" => "Position",
	"desc" => "Enter the position of the Contact person",
	"id" => $shortname. "_contact_pos",
	"type" => "text",
	"std" => "Executive Director" ),
array( "name" => "Photo",
	"desc" => "Enter full path of Contact Photo (e.g: width:110px and hieght:146px)",
	"id" => $shortname."_contact_photo",
	"type" => "file",
	"std" => get_bloginfo('url') ."/wp-content/uploads/2010/12/mr.sgfe-briquette.jpg"),
array( "name" => "Phone",
	"desc" => "Enter the primary phone number",
	"id" => $shortname.'_phone_01',
	"type" => "text",
	"std" => "+855 11 324 936" ),
array( "name" => "Other Phone",
	"desc" => "Enter the secondary phone number",
	"id" => $shortname.'_phone_02',
	"type" => "text",
	"std" => "+855 89 293 875" ),
array( "name" => "Email",
	"desc" => "Enter the primary email address",
	"id" => $shortname.'_email_01',
	"type" => "text",
	"std" => "info@sgfe-cambodia.com" ),
array( "name" => "Other Email",
	"desc" => "Enter the secondary email address",
	"id" => $shortname.'_email_02',
	"type" => "text",
	"std" => "sgfe.executivdir@gmail.com" ),
array( "name" => "Address",
	"desc" => "Enter the full address. e.g: #000, Stree, District, City, Country",
	"id" => $shortname.'_address',
	"type" => "text",
	"std" => "Phlove Lom, Phoum Russey, Sangkat Stueng Meanchey, Khan Meanchey, Phnom Penh, Cambodia" ),							
array( "name" => "Location",
	"desc" => "Setup your location",
	"id" => $shortname.'_map',
	"type" => "map",
	"std" => "" ),
array( "name" => "Latitude",
	"desc" => "Optional",
	"id" => $shortname.'_lat',
	"type" => "text",
	"std" => "" ),
array( "name" => "Longitude",
	"desc" => "Optional",
	"id" => $shortname.'_lng',
	"type" => "text",
	"std" => "" ),										
	
array( "type" => "close"),

array( "name" => "Video Sidebar",
	"type" => "section"),
array( "type" => "open"),
 
array( "name" => "Disable",
	"desc" => "Select Yes/No to disable/enable the video sidebar. (default: No)",
	"id" => $shortname."_is_video_sidebar",
	"type" => "radio",	
	"options" => array(
                array('name' => 'Yes', 'value' => 'yes'),
                array('name' => 'No', 'value' => 'no')
				),
	"std" => "" ),
array( "name" => "Title",
	"desc" => "Enter the title of Video sidebar. e.g: Watch and Listen",
	"id" => $shortname.'_video_title',
	"type" => "text",
	"std" => "Watch and Listen" ),					

array( "type" => "close"),

array( "name" => "News Sidebar",
	"type" => "section"),
array( "type" => "open"),
 
array( "name" => "Title",
	"desc" => "Enter the title of News sidebar. e.g: Recently News Updated",
	"id" => $shortname."_news_title",
	"type" => "text",	
	"std" => "Recently News Updated" ),
array( "name" => "Number of News",
	"desc" => "Enter the number of news, how many would be display",
	"id" => $shortname.'_news_num',
	"type" => "text",
	"std" => "5" ),						

array( "type" => "close")
 
);


function mytheme_add_admin() {
 
global $themename, $shortname, $options;
 
if ( $_GET['page'] == basename(__FILE__) ) {
 
	if ( 'save' == $_REQUEST['action'] ) {
 
		foreach ($options as $value) {
		update_option( $value['id'], $_REQUEST[ $value['id'] ] ); }
 
foreach ($options as $value) {
	if( isset( $_REQUEST[ $value['id'] ] ) ) { update_option( $value['id'], $_REQUEST[ $value['id'] ]  ); } else { delete_option( $value['id'] ); } }
 
	header("Location: admin.php?page=admin_menu.php&saved=true");
die;
 
} 
else if( 'reset' == $_REQUEST['action'] ) {
 
	foreach ($options as $value) {
		delete_option( $value['id'] ); }
 
	header("Location: admin.php?page=admin_menu.php&reset=true");
die;
 
}
}
 
add_menu_page($themename, $themename, 'administrator', basename(__FILE__), 'mytheme_admin');
}

function mytheme_add_init() {

$file_dir=get_bloginfo('template_directory');
wp_enqueue_style("css", $file_dir."/includes/css/admin.css", false, "1.0", "all");
wp_enqueue_script("nova_script", $file_dir."/includes/js/admin_script.js", false, "1.0");
	
wp_enqueue_script('media-upload');
wp_enqueue_script('thickbox');
wp_enqueue_style('thickbox');    
wp_enqueue_script('upload');

}
function mytheme_admin() {
 
global $themename, $shortname, $options;
$i=0;
 
if ( $_REQUEST['saved'] ) echo '<div id="message" class="updated fade"><p><strong>'.$themename.' settings saved.</strong></p></div>';
if ( $_REQUEST['reset'] ) echo '<div id="message" class="updated fade"><p><strong>'.$themename.' settings reset.</strong></p></div>';
 
?>
<div class="wrap nova_wrap">
<h2><?php echo $themename; ?> Settings</h2>
 
<div class="nova_opts">
<form method="post">
<?php foreach ($options as $value) {
switch ( $value['type'] ) {
 
case "open":
?>
 
<?php break;
 
case "close":
?>
 
</div>
</div>
<br />

 
<?php break;
 
case "title":
?>
<p>To easily use the <?php echo $themename;?> theme, you can use the menu below.</p>

 
<?php break;
 
case 'text':
?>

<div class="nova_input nova_text">
	<label for="<?php echo $value['id']; ?>"><?php echo $value['name']; ?></label>
 	<input name="<?php echo $value['id']; ?>" id="<?php echo $value['id']; ?>" type="<?php echo $value['type']; ?>" value="<?php if ( get_settings( $value['id'] ) != "") { echo stripslashes(get_settings( $value['id'])  ); } else { echo $value['std']; } ?>" />
 <small><?php echo $value['desc']; ?></small><div class="clearfix"></div>
 
 </div>
<?php
break;
 
case 'textarea':
?>

<div class="nova_input nova_textarea">
	<label for="<?php echo $value['id']; ?>"><?php echo $value['name']; ?></label>
 	<textarea name="<?php echo $value['id']; ?>" type="<?php echo $value['type']; ?>" cols="" rows=""><?php if ( get_settings( $value['id'] ) != "") { echo stripslashes(get_settings( $value['id']) ); } else { echo $value['std']; } ?></textarea>
 <small><?php echo $value['desc']; ?></small><div class="clearfix"></div>
 
 </div>
  
<?php
break;
 
case 'select':
?>

<div class="nova_input nova_select">
	<label for="<?php echo $value['id']; ?>"><?php echo $value['name']; ?></label>
	
<select name="<?php echo $value['id']; ?>" id="<?php echo $value['id']; ?>">
<?php foreach ($value['options'] as $option) { ?>
		<option <?php if (get_settings( $value['id'] ) == $option) { echo 'selected="selected"'; } ?>><?php echo $option; ?></option><?php } ?>
</select>

	<small><?php echo $value['desc']; ?></small><div class="clearfix"></div>
</div>

<?php
break;
 
case 'radio':				
?>
	<div class="nova_input nova_radio">
	<label for="<?php echo $value['id']; ?>"><?php echo $value['name']; ?></label>
    
<?php foreach ($value['options'] as $option) { ?>	
		
	<?php if (get_settings( $value['id'] ) == $option['value']){ $checked = 'checked=\"checked\"'; } else{ $checked = "";} ?>
    <input name="<?php echo $value['id']; ?>" id="<?php echo $value['id']; ?>" type="<?php echo $value['type']; ?>" value="<?php echo $option['value']; ?>" <?php echo $checked; ?> /> <?php echo $option['name'];?>          
<?php } ?>
	<small><?php echo $value['desc']; ?></small><div class="clearfix"></div>
    </div>

<?php
break;
 
case 'file':
?>
<div class="nova_input nova_file">
	<label for="<?php echo $value['id']; ?>"><?php echo $value['name']; ?></label>
        <input name="<?php echo $value['id']; ?>" id="<?php echo $value['id']; ?>" type="text" value="<?php if ( get_settings( $value['id'] ) != "") { echo stripslashes(get_settings( $value['id'])  ); } else { echo $value['std']; } ?>" />
        <input class="button-primary" type="submit" name="uploadfile" id="uploadfile_btn" value="Upload" />	
 <small><?php echo $value['desc']; ?></small><div class="clearfix"></div> 
 </div>
 
<?php
break;

case 'map':
?>	
            
            <div class="nova_input nova_maps">
                
                <script type="text/javascript"
							src="http://maps.google.com/maps/api/js?sensor=false">
						</script>
						<script type="text/javascript">						 
						  
						  jQuery(document).ready(function ($)
							{
								var lat = <?php if ( get_settings('sgfe_lat') != ""){ echo stripslashes(get_settings('sgfe_lat')); } else { echo '11.572473'; }?>;
								var lng = <?php if ( get_settings('sgfe_lng') != ""){ echo stripslashes(get_settings('sgfe_lng')); } else { echo '104.923296'; }?>;
					  
								var myLatlng = new google.maps.LatLng(lat,lng);
								var myOptions = {							  
								  zoom: 12,
								  center: myLatlng,
								  mapTypeId: google.maps.MapTypeId.ROADMAP
								}
								var map = new google.maps.Map(document.getElementById("map"), myOptions);
								
								var marker = new google.maps.Marker({
									position: myLatlng, 
									draggable:true,
									map: map,
									animation: google.maps.Animation.DROP,
									title:"SGFE Cambodia"
								});
								
								google.maps.event.addListener(marker, 'dragend', function() {
									myLatlng = marker.getPosition();
									//location.hash = "#lat=" + point.lat() + "&lng=" + point.lng();			
									jQuery('#sgfe_lat').attr('value', fix6ToString(myLatlng.lat()));
									jQuery('#sgfe_lng').attr('value', fix6ToString(myLatlng.lng()));									
								});
								
								function fix6ToString(n) {
									return n.toFixed(6).toString();
								}  
							});
						</script>
                
                
                <h4><?php echo $value['name']; ?></h4>                
                <div id="map"></div>                
                <style media="screen"type="text/css">#map { width:700px; height:360px; }</style>
                                
            </div>
<?php
break;
 
case "checkbox":
?>

<div class="nova_input nova_checkbox">
	<label for="<?php echo $value['id']; ?>"><?php echo $value['name']; ?></label>
	
<?php if(get_option($value['id'])){ $checked = "checked=\"checked\""; }else{ $checked = "";} ?>
<input type="checkbox" name="<?php echo $value['id']; ?>" id="<?php echo $value['id']; ?>" value="true" <?php echo $checked; ?> />


	<small><?php echo $value['desc']; ?></small><div class="clearfix"></div>
 </div>
 
<?php break; 
case "section":

$i++;

?>

<div class="nova_section">
<div class="nova_title"><h3><img src="<?php bloginfo('template_directory')?>/includes/images/trans.gif" class="inactive" alt="""><?php echo $value['name']; ?></h3><span class="submit"><input name="save<?php echo $i; ?>" type="submit" value="Save changes" />
</span><div class="clearfix"></div></div>
<div class="nova_options">

 
<?php break;
 
}
}
?>
 
<input type="hidden" name="action" value="save" />
</form>
<form method="post">
<p class="submit">
<input name="reset" type="submit" value="Reset" />
<input type="hidden" name="action" value="reset" />
</p>
</form>
</div> 
 

<?php
}
?>
<?php
add_action('admin_init', 'mytheme_add_init');
add_action('admin_menu', 'mytheme_add_admin');
?>