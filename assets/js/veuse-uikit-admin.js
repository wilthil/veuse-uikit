jQuery(document).ready(function($){

	    
	  /* Admin widget */
	  
	  $('.categoryselector-wrapper').each(function(){
	  
		actives = jQuery(this).next().val();

		var arr = actives.split(',');

				
		$(this).find('a[data-category-id]').each(function(){
		
			id = jQuery(this).attr('data-category-id');
		
			if( jQuery.inArray(id, arr) >= 0 ){
				jQuery(this).addClass('active');
			}
		
		});	
		
		actives = '';
		arr = '';
	});

	
	jQuery(document).on('click','.categoryselector-wrapper a', function(){
		
		var ids = '';
		
		$(this).toggleClass('active');
		
		$(this).parent().find('a.active').each(function(){			
			ids += $(this).attr('data-category-id') + ',';
		});
		
		$(this).parent().next().val(ids);
		
		ids = '';
		return false;
	});
	
	
	/* Pricetable sorting */

	jQuery('.wp-list-table tbody').sortable({
			axis: 'y',
			handle: '.order-priceitem',
			placeholder: 'ui-state-highlight',
			forcePlaceholderSize: true,
			update: function(event, ui) {
				var theOrder = $(this).sortable('toArray');
	
				var data = {
					action: 'veuse_priceitem_update_post_order',
					postType: $(this).attr('data-post-type'),
					order: theOrder
				};
				
				//alert(data.order);
	
				$.post(ajaxurl, data);
			}
		}).disableSelection();
	




});




/* Slideshow builder */

(function ($) {
	
	'use strict';

	$(document).ready(function($){

		var _custom_media = true;
	
	    $(document).on('click', '.add_slide_image', function(e) {
	
		    var send_attachment_bkp = wp.media.editor.send.attachment;
		    var button = $(this);
		    //var id = button.attr('id').replace('_button', '');
		    _custom_media = true;
		    wp.media.editor.send.attachment = function(props, attachment){
		      if ( _custom_media ) {
		
		        $(button).parent().parent().find('input.slide_image_id').val(attachment.id);
		        $(button).parent().append('<img src="' + attachment.url + '" class="slide_image" />');
		        $(button).hide();
		        $(button).parent().find('.remove_slide_image').show();
		
		      } else {
		        return _orig_send_attachment.apply( this, [props, attachment] );
		      };
	    }
	
	    wp.media.editor.open(button);
	    return false;
	  });
	
	  $(document).on('click', '.remove_slide_image', function(e) {
	
		  $(this).hide();
		  $(this).parent().find('.add_slide_image').show();
		  $(this).parent().find('.slide_image').remove();
		  $(this).parent().parent().find('input[type=hidden]').val('');
	
	  });
	
	  $('.add_media').on('click', function(){
	    _custom_media = false;
	  });
	
	
	  /* Post meta scritp */
	  
	  jQuery('.slide-item').each(function(){
			if( jQuery(this).find('figure img').attr('src') != ''){
				jQuery(this).find('.remove_slide_image').show();
				jQuery(this).find('.add_slide_image').hide();
			}else{
				jQuery(this).find('.remove_slide_image').hide();
				jQuery(this).find('.add_slide_image').show();
			}
	});

		var container = jQuery('#slides-container');
		var i = jQuery('#slides-container > div').size();

		var out;

	
     jQuery('#veuse_add_slide').live('click', function() {
            	
            	i++;
            	out = '';
            	out += '<div class="slide-item postbox">';
            	out += '<div class="handlediv" title="Click to toggle"><br /></div><h3 class="hndle"><span>Item</span></h3>';
            	out += '<div class="inside clearfix">';
            	out += '<figure id="image_' + i +'_holder" class="slide-item-image">';
				out += '<img src=""/>';
				out += '<a href="#" class="add_slide_image button">Add image</a>';
				out += '<a href="#" class="remove_slide_image button">Remove image</a>';
				out += '</figure>';
            	out += '';
            	out += '<div class="slide-item-form">';
				out += '<fieldset><legend>Caption</legend><input type="text" name="slide[' + i +'][caption]" value=""/></fieldset>';
				out += '<fieldset><legend>Description</legend><textarea  name="slide[' + i + '][description]" ></textarea></fieldset>';
				out += '<fieldset><legend>Link text</legend><input type="text" name="slide[' + i +'][linktext]" value=""/></fieldset>';
				out += '<fieldset><legend>Link</legend><input type="text" name="slide[' + i +'][link]" value=""/></fieldset>';
				out += '<fieldset><select name="slide['+ i +'][position]">';
				out += '<option value="left">Left</option>';
				out += '<option value="center">Center</option>';
				out += '<option value="right">Right</option>';
				out += '</select></fieldset>';
				out += '<input type="hidden" class="slide_image_id" id="slide_'+ i +'_image" name="slide['+ i +'][image]" value=""/>';
            	out += '<p><a href="#" class="veuse_remove_slide button">Delete slide</a></p>';
            	out += '</div>';
            	out += '</div>';
            	out += '</div>';

            	jQuery(out).appendTo(container);
            	jQuery('#veuse_slidecount').val(i);

            	return false;
        });


				jQuery(document).on('click', '.veuse_remove_slide',  function() {

                	i = jQuery('#veuse_slidecount').val();

                	jQuery(this).parent().parent().parent().parent().remove();
                	i--;
                	jQuery('#veuse_slidecount').val(i);
                	return false;
        		});


				jQuery( "#slides-container" ).sortable({

   					containment: '#slides-container'

  				});
	
	
	});

}( jQuery ));