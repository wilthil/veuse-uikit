<div class="veuse-parallax-widget" style="background-image: url( <?php echo $image;?>); padding-top:<?php echo $padding_top;?>px; padding-bottom:<?php echo $padding_bottom;?>px;">
	<div class="row">
		<div class="small-12 large-12 columns">
			<?php echo $content;?>
		</div>
	</div>	
		
</div>

	<style>
	
		.veuse-parallax-widget {			
			background-size: cover;
		}
	
	</style>
	
	
	<script>
	jQuery(function($){
		jQuery('.veuse-parallax-widget').parallax({
			speed: 0.30
		});
	});
	</script>