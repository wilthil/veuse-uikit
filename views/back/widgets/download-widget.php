<?php

class VeuseDownloadWidget extends WP_Widget {

	/**
	 * Register widget with WordPress.
	 */
	public function __construct() {
		parent::__construct(
	 		'veuse_download_widget', // Base ID
			__('Download (Veuse)','veuse-uikit'), // Name
			array( 'description' => __( 'Insert a link to a document or file.', 'veuse-uikit' ), ) // Args
		);
	}

	public function widget( $args, $instance ) {
		
		extract( $args );
		
		$title = apply_filters( 'widget_title', $instance['title'] );
		
		if ( isset( $instance[ 'file_src' ] ) ) $file_src = $instance[ 'file_src' ];	else $file_src = '';
		if ( isset( $instance[ 'file_id' ] ) ) $file_id = $instance[ 'file_id' ];	else $file_id = '';
		if ( isset( $instance[ 'text' ] ) ) $text = $instance[ 'text' ];	else $text = '';
		if ( isset( $instance[ 'button_text' ] ) ) $button_text = $instance[ 'button_text' ];	else $button_text = '';
		
		
		echo $before_widget;
		
		//if ( ! empty( $title ) )
			echo $before_title . $title . $after_title;
			
			echo do_shortcode('[veuse_download button_text="'.$button_text.'" id="'.$file_id.'"]');
			
			//$file= wp_get_attachment_file_src($instance["file_id"],$instance["file_size"] );
			//$file = $file[0];
			//echo('<file src="'.$file.'" style="margin-bottom:'.$margin_bottom.'px; margin-top:'.$margin_top.'px;"/>');
			
			
		
		echo $after_widget;
	}


	public function update( $new_instance, $old_instance ) {
		
		$instance = array();
				
		$instance['title'] = strip_tags( $new_instance['title'] );
		$instance['file_id'] = strip_tags( $new_instance['file_id'] );
		$instance['file_src'] = strip_tags( $new_instance['file_src'] );
		$instance['button_text'] = strip_tags( $new_instance['button_text'] );
	
		
		return $instance;
	}

	 
	public function form( $instance ) {
	
		global $widget, $wp_widget_factory, $wp_query;
		
		if ( isset( $instance[ 'title' ] ) ) $title = $instance[ 'title' ];	else $title = __( '', 'text_domain' );
		if ( isset( $instance[ 'file_id' ] ) ) $file_id = $instance[ 'file_id' ];	else $file_id = '';
		if ( isset( $instance[ 'file_src' ] ) ) $file_src = $instance[ 'file_src' ];	else $file_src = '';
		if ( isset( $instance[ 'button_text' ] ) ) $button_text = $instance[ 'button_text' ];	else $button_text = '';

	?>
		
		
		<p style="margin-bottom:20px;">
			<label style="min-width:90px;" for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e( 'Title:' ); ?></label> 
			<input class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" type="text" value="<?php echo esc_attr( $title ); ?>" />
		</p>
		 
   
			<p>
				<label style="min-width:90px;" for="<?php echo $this->get_field_id( 'file_button' ); ?>">Select file</label>
			 <a href="#" id="<?php echo $this->get_field_id( 'file_button' ); ?>" class="button">Choose file</a></p>
	         <input id="<?php echo $this->get_field_id( 'file_id' ); ?>" name="<?php echo $this->get_field_name( 'file_id' ); ?>" type="hidden" value="<?php echo $file_id; ?>" />
	         <input id="<?php echo $this->get_field_id( 'file_src' ); ?>" name="<?php echo $this->get_field_name( 'file_src' ); ?>" type="hidden" value="<?php echo $file_src; ?>" />
			 <p id="filepath"><?php echo $file_src; ?></p>
            
            <p>
                <label style="min-width:90px;" for="<?php echo $this->get_field_id( 'button_text' ); ?>">Button text</label>
                <input type="text"  id="<?php echo $this->get_field_id( 'button_text' ); ?>" name="<?php echo $this->get_field_name( 'button_text' ); ?>" value="<?php echo esc_attr( $button_text ); ?>"/>
            </p>
            
     
    
			
		 <script type="text/javascript">
                jQuery(document).ready(function(){
                    jQuery("#<?php echo $this->get_field_id( 'file_button' ); ?>").click(function(e) {
                        e.preventDefault();
                        var custom_uploader = wp.media({title: 'Choose file', button: {text: 'Use file'}, multiple: false})
                        .on('select', function() {
                            var attachment = custom_uploader.state().get('selection').first().toJSON();
                            jQuery('#<?php echo $this->get_field_id( 'file_id' ); ?>').val(attachment.id);
                            jQuery('#<?php echo $this->get_field_id( 'file_src' ); ?>').val(attachment.url);
                            jQuery('#filepath').html(attachment.url);
                            console.log(attachment);
                        })
                        .open();
                    });
                   
                });
            </script>
           
		<?php

	}

} 

add_action('widgets_init',create_function('','return register_widget("VeuseDownloadWidget");'));
 
?>