<div class="flexslider-wrapper">

	<div id="featured" class="flexslider veuse-slider">

		<ul class="slides">
		<?php

		$counter = 0;
		$slidecount = get_post_meta($id,'veuse_slidecount',true);
		
		while($counter < $slidecount):

			$caption = get_post_meta($id, 'veuse_slide_'.$counter.'_caption', true);
			$subcaption = get_post_meta($id, 'veuse_slide_'.$counter.'_subcaption', true);
			$description = get_post_meta($id, 'veuse_slide_'.$counter.'_description', true);
			$link = get_post_meta($id, 'veuse_slide_'.$counter.'_link', true);
			$buttontext = get_post_meta($id, 'veuse_slide_'.$counter.'_linktext', true);
			$image = get_post_meta($id, 'veuse_slide_'.$counter.'_image', true);
			$image_src = wp_get_attachment_image_src($image, 'full');
			$position = get_post_meta($id, 'veuse_slide_'.$counter.'_position', true);
			$counter++;

			?>
			<li>
				<?php if($link):?><a href="<?php echo $link;?>"><?php endif;?>
				<?php echo veuse_retina_interchange_image( $image_src[0], $width, $height, true);	?>
				<?php if($link):?></a><?php endif;?>
				<?php if($caption || $description):?>

					<div class="flex-caption">
						<div class="caption-inner <?php echo $position;?>">
						<?php if($caption):?><h3><span><?php echo $caption;?></span></h3><?php endif;?>
						<!--<?php if($subcaption):?><h2 class="subheader"><?php echo $subcaption;?></h2><?php endif;?>-->
						<?php if($description):?><?php echo '<p><span>'.do_shortcode($description).'</span></p>';?><?php endif;?>
						
						<?php //if($link && $buttontext):?>
						<!--<a href="<?php echo $link;?>" class="slide-link"><?php echo $buttontext;?></a>-->
						<?php //endif;?>
						</div>
					</div>
				<?php endif;?>
				
			</li>
		<?php endwhile; ?>
	</ul>
</div>
</div>
<script type="text/javascript" charset="utf-8">
	
	
		jQuery(window).load(function($) { 
			
		jQuery(".veuse-slider").flexslider({
		
				easing: 'swing',
				directionNav: <?php echo $directionnav;?>,
				controlNav: <?php echo $controlnav;?>,
				animation: "<?php echo $animation;?>",
				slideshowSpeed: <?php echo $speed;?>,
				slideshow: <?php echo $slideshow;?>,
				pauseOnHover: true,
				smoothHeight: false,
				
				start: function(slider) {
				
			        jQuery('.flex-active-slide').find('.flex-caption h3').delay(0).animate({'opacity': 1,'left': '0px'},300,'swing'); 
			        jQuery('.flex-active-slide').find('.flex-caption p').delay(0).animate({'opacity': 1,'right': '0px'},300,'swing');
			        
			   
			      },
				  
				before: function(slider) { 
					jQuery('.flex-active-slide').find('.flex-caption h3').css({ 'opacity': 0, 'left': '-600px' }); 
					jQuery('.flex-active-slide').find('.flex-caption p').css({ 'opacity': 0, 'right': '-600px' }); 
					 
									}, 
				after: function(slider) { 
					
					jQuery('.flex-active-slide').find('.flex-caption h3').delay(0).animate({'opacity': 1,'left': '0px'},300, 'swing');
					jQuery('.flex-active-slide').find('.flex-caption p').delay(0).animate({'opacity': 1,'right': '0px'},300, 'swing');
					
				}   
			});
	});

	
	

		
		
</script>

