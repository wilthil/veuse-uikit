<?php

class VeuseImageWidget extends WP_Widget {

	// constructor
	public function __construct() {
            parent::__construct("veuse_image_widget", __('Image (Veuse)','veuse-uikit'), array("title" => "", "description" => __('Insert an image','veuse-uikit')));
	}

	// widget form creation
	function form($instance) {	
            // somewhat unecesary with PB but allows image to work with other locations (also applies to setting the field values
            $vgImageWidgetDefaults = array('title' => '', "image_size" => "full", "image_id" => "", "thumb_src" => '');
            
            $instance = wp_parse_args( (array) $instance, $vgImageWidgetDefaults );
			
            ?>
            <?php // button and field for image id ?>
            <p>
			<label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e( 'Title:' ); ?></label> 
			<input class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" type="text" value="<?php echo esc_attr( $title ); ?>" />
			</p>
		
            <p><img id="i<?php echo $this->get_field_id( 'thumb_src' ); ?>" src="<?php echo($instance["thumb_src"]); ?>" /></p>
            <p>
                <a href="#" id="<?php echo $this->get_field_id( 'image_button' ); ?>" class="button">Choose Image</a>
            </p>
            <input id="<?php echo $this->get_field_id( 'image_id' ); ?>" name="<?php echo $this->get_field_name( 'image_id' ); ?>" type="hidden" value="<?php echo($instance["image_id"]); ?>" />
            <input id="<?php echo $this->get_field_id( 'thumb_src' ); ?>" name="<?php echo $this->get_field_name( 'thumb_src' ); ?>" type="hidden" value="<?php echo($instance["thumb_src"]); ?>" />
            
            <?php // image size select box ?>
            <p>
                <label for="<?php echo $this->get_field_id( 'image_size' ); ?>">Image Size</label>
                <select id="<?php echo $this->get_field_id( 'image_size' ); ?>" name="<?php echo $this->get_field_name( 'image_size' ); ?>">
                    <option value="full" <?php if($instance['image_size'] == "full") { ?>selected<?php } ?>>Original Image</option>
                    <?php foreach (get_intermediate_image_sizes() as $s) {
                        ?><option value="<?php echo($s); ?>" <?php if($instance['image_size'] == $s) { ?>selected<?php } ?>><?php echo($s); ?></option><?php
                    } ?>
                </select>
            </p>
           <?php // js ?>
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

	// widget update
	function update($new_instance, $old_instance) {
            return $new_instance;
	}

	// widget display
	function widget($args, $instance) {
            
            extract( $args );
            
            $title = apply_filters( 'widget_title', $instance['title'] );
            
            echo $before_widget;
            
			if ( ! empty( $title ) )
				echo $before_title . $title . $after_title;
			
				 $img= wp_get_attachment_image_src($instance["image_id"],$instance["image_size"] );
				 $img = $img[0];
				 echo("<img src=\"$img\" />");
			
			echo $after_widget;
            
	}
}
// register widget
add_action( 'widgets_init', function(){register_widget( 'VeuseImageWidget' );});?>