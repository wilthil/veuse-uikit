<?php if(have_posts()): ?>
			
<ul class="veuse-postlist">			
<?php while (have_posts()): the_post();
			
$img_url = wp_get_attachment_url( get_post_thumbnail_id());
$fallback_img_url = get_stylesheet_directory_uri().'/images/fallback-featured.jpg';
?>
			
				<?php //echo veuse_retina_interchange_image( $img_url, $width, $height, true); ?>
	<li <?php post_class();?>>
	
		<div class="veuse-postlist-meta">
			<div class="veuse-postlist-entry-date">
				<span class="day"><?php the_time('j');?></span>
				<span class="month"><?php the_time('M');?></span>
			</div>
		</div>		

						
		<h4><a href="<?php the_permalink();?>"><?php the_title();?></a></h4>
						
		<span class="veuse-postlist-entry-comments"><a href="<?php comments_link();?>"> <i class="fa fa-comments-o fa-lg"></i> <?php comments_number( '0', '1', '%' ); ?></a></span>
										
		<p><?php echo get_the_excerpt();?>
		
				

	</li>	
<?php endwhile;?>
</ul>		
<?php endif; wp_reset_query();?>


