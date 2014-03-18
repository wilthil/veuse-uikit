<?php

class VeuseParallaxWidget extends WP_Widget {

	/**
	 * Register widget with WordPress.
	 */
	public function __construct() {
		parent::__construct(
	 		'veuse_parallax_widget', // Base ID
			__('Parallax (Veuse)','veuse-uikit'), // Name
			array( 'description' => __( 'Insert a parallax background and text', 'veuse-uikit' ), ) // Args
		);
	}

	public function widget( $args, $instance ) {
		
		extract( $args );
		
		$title = apply_filters( 'widget_title', $instance['title'] );
		
				
		if ( isset( $instance[ 'content' ] ) ) $content = $instance[ 'content' ];	else $content = '';
		
		if ( isset( $instance[ 'thumb_src' ] ) ) $image_id = $instance[ 'thumb_src' ];	else $image_id = '';
		if ( isset( $instance[ 'image_id' ] ) ) $image_id = $instance[ 'image_id' ];	else $image_id = '';
		if ( isset( $instance[ 'image_size' ] ) ) $image_size = $instance[ 'image_size' ];	else $image_size = '';
		if ( isset( $instance[ 'padding_top' ] ) ) $padding_top = $instance[ 'padding_top' ];	else $padding_top = '';
		if ( isset( $instance[ 'padding_bottom' ] ) ) $padding_bottom = $instance[ 'padding_bottom' ];	else $padding_bottom = '';
		
		echo $before_widget;
		
		//if ( ! empty( $title ) )
			//echo $before_title . $title . $after_title;
			
			$img= wp_get_attachment_image_src($instance["image_id"],$instance["image_size"] );
			$img = $img[0];
	
			
			
			echo do_shortcode('[veuse_parallax  
				
				image="'.$img.'" 
				content="'.$content.'" 
				padding-top="'.$padding_top.'" 
				padding-bottom="'.$padding_bottom.'" 
				]');

			
		
		echo $after_widget;
	}


	public function update( $new_instance, $old_instance ) {
		
		$instance = array();
				
		$instance['title'] = strip_tags( $new_instance['title'] );
		$instance['content'] = (!empty($new_instance['content']) ? $new_instance['content']:'');
		$instance['image_id'] = strip_tags( $new_instance['image_id'] );
		$instance['thumb_src'] = strip_tags( $new_instance['thumb_src'] );
		$instance['image_size'] = strip_tags( $new_instance['image_size'] );
		$instance['padding_top'] = strip_tags( $new_instance['padding_top'] );
		$instance['padding_bottom'] = strip_tags( $new_instance['padding_bottom'] );
	
		
		return $instance;
	}

	 
	public function form( $instance ) {
	
		global $widget, $wp_widget_factory, $wp_query;
	

		
		if ( isset( $instance[ 'title' ] ) ) $title = $instance[ 'title' ];	else $title = '';
		if ( isset( $instance[ 'content' ] ) ) $content = $instance[ 'content' ];	else $content = '';
		if ( isset( $instance[ 'image_id' ] ) ) $image_id = $instance[ 'image_id' ];	else $image_id = '';
		if ( isset( $instance[ 'thumb_src' ] ) ) $thumb_src = $instance[ 'thumb_src' ];	else $thumb_src = '';
		if ( isset( $instance[ 'image_size' ] ) ) $image_size = $instance[ 'image_size' ];	else $image_size = '';
		if ( isset( $instance[ 'padding_top' ] ) ) $padding_top = $instance[ 'padding_top' ];	else $padding_top = '';
		if ( isset( $instance[ 'padding_bottom' ] ) ) $padding_bottom = $instance[ 'padding_bottom' ];	else $padding_bottom = '';

	?>
		<input type="text" id="<?php echo $this->get_field_id('content'); ?>" name="<?php echo $this->get_field_name('content'); ?>" value="<?php echo esc_attr($content); ?>">
		
		<p style="margin-bottom:20px;">
			<label style="min-width:90px;" for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e( 'Title:' ); ?></label> 
			<input class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" type="text" value="<?php echo esc_attr( $title ); ?>" />
		</p>
		
		 
           
           
        <div style="float:left; width:160px;  max-width:94%; box-sizing:border-box;">					
			<div style="box-sizing:border-box; padding:4px; background:#f0f0f0; border:1px solid #e4e4e4; margin-right:20px;">
			 <img id="i<?php echo $this->get_field_id( 'thumb_src' ); ?>" src="<?php echo $thumb_src; ?>" style="max-width:100%"/>
	        </div>
			<p><a href="#" id="<?php echo $this->get_field_id( 'image_button' ); ?>" class="button"><?php _e('Select image','veuse-uikit');?></a></p>
	         <input id="<?php echo $this->get_field_id( 'image_id' ); ?>" name="<?php echo $this->get_field_name( 'image_id' ); ?>" type="hidden" value="<?php echo $image_id; ?>" />
	         <input id="<?php echo $this->get_field_id( 'thumb_src' ); ?>" name="<?php echo $this->get_field_name( 'thumb_src' ); ?>" type="hidden" value="<?php echo $thumb_src; ?>" />
		
		</div>
		
		<div style="float:left; width:70%; min-width:180px; max-width:100%;">
		
         <p>
			<a href="javascript:WPEditorWidget.showEditor('<?php echo $this->get_field_id('content'); ?>');"><?php _e('Edit content', 'veuse-uikit'); ?></a>
		</p>

           
               
           <p>
                <label style="min-width:90px;" for="<?php echo $this->get_field_id( 'image_size' ); ?>">Image Size</label>
                <select id="<?php echo $this->get_field_id( 'image_size' ); ?>" name="<?php echo $this->get_field_name( 'image_size' ); ?>">
                    <option value="full" <?php if($image_size == "full") { ?>selected<?php } ?>>Original Image</option>
                    <?php foreach (get_intermediate_image_sizes() as $s) {
                        ?><option value="<?php echo($s); ?>" <?php if ($image_size == $s) { ?>selected<?php } ?>><?php echo($s); ?></option><?php
                    } ?>
                </select>
            </p>
            
             <p>
                <label style="min-width:90px;" for="<?php echo $this->get_field_id( 'padding_top' ); ?>"><?php _e('Padding top','veuse-uikit');?></label>
                <input size="3" id="<?php echo $this->get_field_id( 'padding_top' ); ?>" name="<?php echo $this->get_field_name( 'padding_top' ); ?>" type="text" value="<?php echo esc_attr( $padding_top ); ?>"><span class="description">px</span>
            </p>
            
            <p>
                <label style="min-width:90px;" for="<?php echo $this->get_field_id( 'padding_bottom' ); ?>"><?php _e('Padding bottom','veuse-uikit');?></label>
                <input size="3" id="<?php echo $this->get_field_id( 'padding_bottom' ); ?>" name="<?php echo $this->get_field_name( 'padding_bottom' ); ?>" type="text" value="<?php echo esc_attr( $padding_bottom ); ?>"> <span class="description">px</span>
            </p>
            
         </div>
			
		 <script type="text/javascript">
                jQuery(document).ready(function(){
                    jQuery("#<?php echo $this->get_field_id( 'image_button' ); ?>").click(function(e) {
                        e.preventDefault();
                        var custom_uploader = wp.media({title: 'Choose Image', button: {text: 'Use Image'}, multiple: false})
                        .on('select', function() {
                            var attachment = custom_uploader.state().get('selection').first().toJSON();
                            jQuery('#<?php echo $this->get_field_id( 'image_id' ); ?>').val(attachment.id);
                            jQuery('#<?php echo $this->get_field_id( 'thumb_src' ); ?>').val(attachment.sizes.thumbnail.url);
                            jQuery('#i<?php echo $this->get_field_id( 'thumb_src' ); ?>').attr("src",jQuery('#<?php echo $this->get_field_id( 'thumb_src' ); ?>').val());
                            console.log(attachment);
                        })
                        .open();
                    });
                    jQuery('#i<?php echo $this->get_field_id( 'thumb_src' ); ?>').attr("src",jQuery('#<?php echo $this->get_field_id( 'thumb_src' ); ?>').val());
                });
            </script>
           
		<?php

	}

} 

add_action('widgets_init',create_function('','return register_widget("VeuseParallaxWidget");'));
 
?>