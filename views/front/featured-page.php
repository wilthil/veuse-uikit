<!-- This file can be overridden by creating a featured-page.php in your theme directory -->

<div id="featured-page-<?php echo $page->ID;?>" class="veuse-featured-page">
	<!-- Post thumbnail -->
	<div class="entry-thumbnail">
		<?php if(isset($link)):?><a href="<?php echo get_permalink($page->ID);?>"><?php endif;?>
		<?php echo $image_str;?>
		<?php if(isset($link)):?></a><?php endif;?>
	</div>
	<!-- Post title and excerpt -->
	<div class="entry-content">
		<h4><a href="<?php echo get_permalink($page->ID);?>"><?php echo $page->post_title;?></a></h4>
		<p><?php echo $page->post_excerpt;?></p>
		
		<!-- Button -->
		<?php if(!empty($button_text) && isset($link)):?>
		<a href="<?php echo get_permalink($page->ID);?>" class="veuse-button small"><?php echo $button_text; ?></a>
		<?php endif;?>
	</div>
</div>