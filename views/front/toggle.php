<div class="veuse-toggle '.$state.'">
	<span class="veuse-toggle-title <?php echo $iconclass;?>">
	<?php if(!empty($icon)){ ?>
		<i class="fa fa-<?php echo $icon;?>"></i>
	<?php } ?>
	<?php echo $title; ?>
	</span>
	<div class="veuse-toggle-inner "><p><?php echo wpautop(do_shortcode($content));?></p></div>
</div>