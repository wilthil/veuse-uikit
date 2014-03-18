<a href="#" class="veuse-verticaltab-title <?php echo $iconclass;?>">
	<?php if(!empty($icon)){ ?>
		<i class="fa fa-<?php echo $icon;?>"></i>
	<?php } ?>
	<?php echo $title;?>
</a>
<div class="veuse-verticaltab-content"><?php echo wpautop($content);?></p></div>