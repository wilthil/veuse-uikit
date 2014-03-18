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
	




});