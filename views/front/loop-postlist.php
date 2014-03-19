<?php if(have_posts()): ?>
			
<ul class="veuse-postlist">			
<?php while (have_posts()): the_post();
			
$img_url = wp_get_attachment_url( get_post_thumbnail_id());
$fallback_img_url = get_stylesheet_directory_uri().'/images/fallback-featured.jpg';
?>
			
				<?php //echo veuse_retina_interchange_image( $img_url, $width, $height, true); ?>
	<li <?php post_class();?>>
	
	

						
		<h4><a href="<?php the_permalink();?>"><?php the_title();?></a></h4>
		<ul class="veuse-postlist-meta">
		
			<li><?php echo get_the_date();?></li>
			<li><a href="<?php comments_link();?>"> <?php comments_number( '0 comments', '1 comment', '% comments' ); ?></a></li>
		
		</ul>
													
		<p><?php echo get_the_excerpt();?>
		
				

	</li>	
<?php endwhile;?>
</ul>		
<?php endif; wp_reset_query();?>


