jQuery(document).ready(function(){
		jQuery('.nova_options').slideUp();

		jQuery('.nova_section h3').click(function(){
			if(jQuery(this).parent().next('.nova_options').css('display')==='none')
				{	jQuery(this).removeClass('inactive').addClass('active').children('img').removeClass('inactive').addClass('active');

				}
			else
				{	jQuery(this).removeClass('active').addClass('inactive').children('img').removeClass('active').addClass('inactive');
				}

			jQuery(this).parent().next('.nova_options').slideToggle('slow');
		});
		
		
		// Upload file use the wordpress engine upload feature
		window.formfield = '';

		jQuery('#uploadfile_btn').click(function() {
			window.formfield = jQuery('#sgfe_contact_photo',jQuery(this).parent().parent());
			tb_show('', 'media-upload.php?type=image&TB_iframe=true');
			return false;
		});
	
		window.original_send_to_editor = window.send_to_editor;
		window.send_to_editor = function(html) {
			if (window.formfield != '') {
				imgurl = jQuery('img',html).attr('src');
				/*window.formfield.val(imgurl);
				window.formfield = '';*/
				jQuery('#sgfe_contact_photo').val(imgurl);
				tb_remove();
			}
			else {
				window.original_send_to_editor(html);
			}
		}

});
