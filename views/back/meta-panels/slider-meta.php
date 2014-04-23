<?php
add_action('add_meta_boxes', 'veuse_slider_metabox');
add_action('save_post', 'veuse_slider_save_metadata');

/* Adds a box to the main column on the Post and Page edit screens */
function veuse_slider_metabox() {
    add_meta_box( 'veuse_slider_sectionid', __( 'Slideshow Builder', 'veuse' ),'veuse_slider_add_metabox', 'veuse_slider', 'normal', 'high' );
   }


/* Prints the box content */
function veuse_slider_add_metabox() {
 	global $post,  $term;
  	
  	
	wp_nonce_field( 'veuse_slider_nonce', 'veuse_slider_noncename' );

	$slidecount = get_post_meta($post->ID,'veuse_slidecount',true);?>


<div class="veuse_panel">
	<div style="margin-bottom:20px;">
			<div id="slides-container">

				<?php
				$i = 0;
			
				while ($i < $slidecount):
			
				$caption 		= get_post_meta($post->ID,'veuse_slide_'. $i .'_caption',true);
				$description 	= get_post_meta($post->ID,'veuse_slide_'. $i .'_description',true);
				$link		 	= get_post_meta($post->ID,'veuse_slide_'. $i .'_link',true);
				$buttontext	 	= get_post_meta($post->ID,'veuse_slide_'. $i .'_linktext',true);
				$background		= get_post_meta($post->ID,'veuse_slide_'. $i .'_background',true);
				$color			= get_post_meta($post->ID,'veuse_slide_'. $i .'_color',true);
				$position		= get_post_meta($post->ID,'veuse_slide_'. $i .'_position',true);
				$image 			= get_post_meta($post->ID,'veuse_slide_'. $i .'_image', true);
				
				
								?>
				<div class="slide-item postbox">

					<div class="handlediv" title="Click to toggle"><br /></div><h3 class="hndle"><span><?php _e('Slide: ','veuse-slider');?><?php echo $caption;?></span></h3>

						<div class="inside clearfix">


						<figure id="image_<?php echo $i;?>_holder" class="slide-item-image">
							
							<?php $image_src = wp_get_attachment_image_src($image, 'large');?>
						
						
							<img src="<?php echo mr_image_resize($image_src[0], '400', '200', true, 'c', false);?>" class="slide_image"/>
							<a href="#" class="add_slide_image button" id="add_slide_button">Add image</a>
							<a href="#" class="remove_slide_image button">Remove image</a>
							
							<!--<h1 class="maincap" style="position:absolute; left:0; top:0;"></h1>
							<h2 class="subcap" style="position:absolute; left:0; top:0;"></h2>-->
						</figure>

						<div class="slide-item-form">
							<fieldset><legend><?php _e('Slide caption','veuse');?></legend><input type="text" class="maincaption-input" name="slide[<?php echo $i;?>][caption]" value="<?php echo  $caption;?>"/></fieldset>
							<fieldset><legend><?php _e('Slide description','veuse');?></legend><textarea  name="slide[<?php echo $i;?>][description]" ><?php echo $description;?></textarea></fieldset>
							<fieldset><legend><?php _e('Link text','veuse');?></legend><input type="text" name="slide[<?php echo $i;?>][linktext]" value="<?php echo $buttontext;?>"/></fieldset>
							<fieldset><legend><?php _e('Link url','veuse');?></legend><input type="text" name="slide[<?php echo $i;?>][link]" value="<?php echo $link;?>"/></fieldset>
							
							<fieldset>
								<legend><?php _e('Caption position','veuse');?></legend>
								<select name="slide[<?php echo $i;?>][position]">
									<option value="caption-left" <?php selected( $position, 'caption-left', true); ?>>Left</option>
									<option value="caption-center" <?php selected( $position, 'caption-center', true); ?>>Center</option>
									<option value="caption-right" <?php selected( $position, 'caption-right', true); ?>>Right</option>
								</select>
							</fieldset>
					
							<input type="hidden" class="slide_image_id" id="slide_<?php echo $i;?>" class="slide_image_id" name="slide[<?php echo $i;?>][image]" value="<?php echo $image;?>"/>
							<p><a href="#" class="veuse_remove_slide button"><?php _e('Delete slide','veuse');?></a></p>
						</div>
					</div>
			</div>
	<?php
	$i++;
	endwhile;
	?>
</div>

	<p><a href="#" id="veuse_add_slide" class="button-primary"><?php _e('Add slide','veuse');?></a></p>
	<form action="post" >
	<input type="hidden" id="veuse_slidecount" name="veuse_slidecount" value="<?php echo $slidecount;?>" />
	</form>


</div>

</div>
<?php
}

/* When the post is saved, saves our custom data */
function veuse_slider_save_metadata( $post_id ) {
	
	// Bail if we're doing an auto save
	if( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) return;

	// if our nonce isn't there, or we can't verify it, bail
	if( !isset( $_POST['veuse_slider_noncename'] ) || !wp_verify_nonce( $_POST['veuse_slider_noncename'], 'veuse_slider_nonce' ) ) return;

	// if our current user can't edit this post, bail
	if( !current_user_can( 'edit_posts' ) ) return;
   		 
     		 
  	// Save slide count
  	$veuse_slidecount = $_POST['veuse_slidecount'];

  	if($veuse_slidecount){ update_post_meta($post_id, 'veuse_slidecount', $veuse_slidecount); } else { update_post_meta($post_id, 'veuse_slidecount', '0');}

	// Delete all post meta before saving new meta
	$slidecount = get_post_meta($post_id,'veuse_slidecount',true);
	$x=0;
	while($x <= ($slidecount + 3)){
		delete_post_meta($post_id, 'veuse_slide_'. $x .'_caption');
		delete_post_meta($post_id, 'veuse_slide_'. $x .'_description');
		delete_post_meta($post_id, 'veuse_slide_'. $x .'_image');
		delete_post_meta($post_id, 'veuse_slide_'. $x .'_linktext');
		delete_post_meta($post_id, 'veuse_slide_'. $x .'_link');
		delete_post_meta($post_id, 'veuse_slide_'. $x .'_background');
		delete_post_meta($post_id, 'veuse_slide_'. $x .'_color');
		delete_post_meta($post_id, 'veuse_slide_'. $x .'_position');
		$x++;
	}

	$b = 0;
  	foreach($_POST['slide'] as $slide){

  		$caption = $slide['caption'];
  		$description = $slide['description'];
  		$image = $slide['image'];
  		$link = $slide['link'];
  		$buttontext = $slide['linktext'];
  		$position = $slide['position'];

		if(!empty($caption)){ update_post_meta($post_id, 'veuse_slide_'. $b .'_caption', $caption); } else { delete_post_meta($post_id, 'veuse_slide_'. $b .'_caption');}
		if(!empty($description)){ update_post_meta($post_id, 'veuse_slide_'. $b .'_description', $description); } else { delete_post_meta($post_id, 'veuse_slide_'. $b .'_description');}
		if(!empty($image)){ update_post_meta($post_id, 'veuse_slide_'. $b .'_image', $image); } else { delete_post_meta($post_id, 'veuse_slide_'. $b .'_image');}
		if(!empty($link)){ update_post_meta($post_id, 'veuse_slide_'. $b .'_link', $link); } else { delete_post_meta($post_id, 'veuse_slide_'. $b .'_link');}
		if(!empty($buttontext)){ update_post_meta($post_id, 'veuse_slide_'. $b .'_linktext', $buttontext); } else { delete_post_meta($post_id, 'veuse_slide_'. $b .'_linktext');}
		if(!empty($background)){ update_post_meta($post_id, 'veuse_slide_'. $b .'_background', $background); } else { delete_post_meta($post_id, 'veuse_slide_'. $b .'_background');}
		if(!empty($color)){ update_post_meta($post_id, 'veuse_slide_'. $b .'_color', $color); } else { delete_post_meta($post_id, 'veuse_slide_'. $b .'_color');}
		if(!empty($position)){ update_post_meta($post_id, 'veuse_slide_'. $b .'_position', $position); } else { delete_post_meta($post_id, 'veuse_slide_'. $b .'_position');}

		$b++;
  	}
} ?>