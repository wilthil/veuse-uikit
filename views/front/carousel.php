<ul class="veuse-carousel carousel-type-<?php echo $post_type;?>">

<?php


if($type == 'loop'){
	
	if(!empty($post_type)){
			
		global $wp_query;
		
		query_posts(array(
			'post_type' => $post_type,
			'showposts' => $postcount,
			'order' => $order,
			'orderby' 	=> $orderby,
			'category_name' => $categories
			)
		);
		
		
		if(have_posts()): while (have_posts()): the_post();
		
		if($post_type == 'portfolio')	
		include(veuse_uikit_locate_part('carousel/single-portfolio'));
		
		if($post_type == 'staff')	
		include(veuse_uikit_locate_part('carousel/single-staff'));
		
		else	
		include(veuse_uikit_locate_part('carousel/single-post'));
		
		endwhile; endif;
		
		wp_reset_query();
		
	}
	
}

else {
	
	if(!empty($id)){
	
		$ids = explode(',', $id);
		
		foreach ($ids as $post_id){
					
			$post = get_post($post_id);
			
			$title =  $post->post_title;
			$exc 	=  $post->post_excerpt;
			
			$thumb = wp_get_attachment_url( get_post_thumbnail_id($post_id));
			
			echo '<li>';
			if(has_post_thumbnail()){
				echo veuse_retina_interchange_image( $thumb, $width, $height, true);
			}
			echo '<div class="slide-caption"><div class="slide-inner-caption">';
			echo '<h3>'.$title.'</h3>';
			echo '<p>'.$exc. '</p>';
			echo '</div></div>';
			echo '</li>';
				
		}	
	}	
}


 ?>
		
</ul>

<script>
		
jQuery(document).ready(function(){

	var owl = jQuery(".veuse-carousel");
 
	  owl.owlCarousel({
	      navigation : true, // Show next and prev buttons
	      slideSpeed : 300,
	      paginationSpeed : 400,
	      singleItem:false,
	      autoHeight : false,
		  transitionStyle:"fade",
		  items : <?php echo $desktop;?>,
	      itemsDesktop: [1400, <?php echo $desktop;?>],
	      itemsDesktopSmall: [1024, <?php echo $desktop_small;?>],
	      itemsTablet: [768, <?php echo $tablet;?>],
	      itemsMobile: [480, <?php echo $mobile;?>]
	  });
	
	
});
</script>	
