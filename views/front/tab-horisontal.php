<a href="#" class="veuse-tab-title <?php echo $iconclass;?>">
	<?php if(!empty($icon)){ ?>
		<i class="fa fa-<?php echo $icon;?>"></i>
	<?php } ?>
	<?php echo $title;?>
</a>
<div class="veuse-tab-content"><?php echo wpautop($content);?></p></div>