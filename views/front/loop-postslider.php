<div class="flexslider-wrapper">
	<div id="featured" class="flexslider veuse-postslider">
		<ul class="slides">
		<?php

			if(have_posts()): while (have_posts()): the_post();
			
				$img_url = wp_get_attachment_url( get_post_thumbnail_id());
				$fallback_img_url = get_stylesheet_directory_uri().'/images/fallback-featured.jpg';

				if(!empty($img_url)){

				?>
				<li>
					<?php echo veuse_retina_interchange_image( $img_url, $width, $height, true); ?>
						<div class="veuse-postslider-caption">
							<a href="<?php the_permalink();?>"><span><?php the_title();?></span></a>
							<a href="<?php the_permalink();?>" class="veuse-button primary right small"><?php _e('More','veuse');?></a>	</div>			
						<div class="veuse-postslider-date"><span><i class="fa fa-clock-o fa-lg"></i> <?php echo get_the_date();?></span><span class="veuse-postslider-comments"><a href="<?php comments_link(); ?>"> <i class="fa fa-comments-o fa-lg"></i> <?php comments_number( '0', '1', '%' ); ?></a></span></div>
						
				</li>
		<?php
		}
		 endwhile; endif; 
			
			wp_reset_query();
		?>
	</ul>
</div>
</div>
<script type="text/javascript" charset="utf-8">
	jQuery(function($) {
			
			jQuery(".veuse-postslider").flexslider({
					directionNav: true,
					controlNav: false,
					animation: "slide",
					slideshowSpeed: 7000,
					slideshow: true,
					pauseOnHover: true,
					smoothHeight: true	      
				});

	});
	
</script>