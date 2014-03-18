<div class="veuse-callout veuse-callout-<?php echo $style;?>" style="background-color:<?php echo $background;?>; border-color:<?php echo $bordercolor;?>;">
	<div class="veuse-callout-content <?php echo $contentbox;?>">
		<?php if(!empty($icon)){?>
		<i class="fa fa-<?php echo $icon;?> fa-2x"></i>
		<?php } ?>
		<h3 style="color:<?php echo $color;?>;"><?php echo $caption;?></h3>
	</div>
	<?php if(!empty($link) && !empty($buttontext)){?>
	<div class="veuse-callout-btn">
		<a href="<?php echo $link;?>" class="veuse-button medium"><?php echo $buttontext;?></a>
	</div>
	<?php } ?>
</div>