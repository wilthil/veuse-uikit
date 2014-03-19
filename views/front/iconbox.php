<div class="veuse-iconbox veuse-iconbox-<?php echo $style;?>" style="background-color:<?php echo $background;?>; border-color:<?php echo $bordercolor;?>; color:<?php echo $color;?>;">
	<div class="icon"><i class="fa fa-<?php echo $icon;?>"></i></div>
	<div class="content">	    
	<h4>
	   <?php if(!empty($href)){?> <a href="<?php echo $href;?>"><?php } ?>
	   <?php echo $title;?>
	   <?php if(!empty($href)){?> </a> <?php } ?>
	</h4>
	<p><?php echo $text;?></p>	    
	<?php if(!empty($href) && !empty($buttontext)){?><a href="" class="veuse-button"><?php echo $buttontext;?></a><?php }?>
	</div>		    
	
</div>