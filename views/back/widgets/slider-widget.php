<?php

class VeuseSlideshowWidget extends WP_Widget {

	/**
	 * Register widget with WordPress.
	 */
	public function __construct() {
		parent::__construct(
	 		'veuse_slider_widget', // Base ID
			__('Slider (Veuse)','veuse-slider'), // Name
			array( 'description' => __( 'Insert a slider', 'veuse-slider' ), ) // Args
		);
	}

	public function widget( $args, $instance ) {
		extract( $args );
		$title = apply_filters( 'widget_title', $instance['title'] );
		$slider = $instance['slider'];
		$width = $instance['width'];
		$height = $instance['height'];
		$speed = $instance['speed'];
		$controlnav = $instance['controlnav'];
		$directionnav = $instance['directionnav'];
		
		if($controlnav == '1') $controlnav = 'true'; else $controlnav = 'false';
		if($directionnav == '1') $directionnav = 'true'; else $directionnav = 'false';

		echo $before_widget;
		if ( ! empty( $title ) )
			echo $before_title . $title . $after_title;
		
			 // Do Your Widgety Stuff Here…
			 echo do_shortcode('[veuse_slider  id="'. $slider .'" width="' . $width . '" height="' . $height . '" speed="'.$speed.'" controlnav="'.$controlnav.'" directionnav="'.$directionnav.'"]');
		
		echo $after_widget;
	}


	public function update( $new_instance, $old_instance ) {
		
		$instance = array();
				
		$instance['title'] = strip_tags( $new_instance['title'] );
		$instance['slider'] = strip_tags( $new_instance['slider'] );
		$instance['height'] = strip_tags( $new_instance['height'] );
		$instance['speed'] = strip_tags( $new_instance['speed'] );
		$instance['width'] = strip_tags( $new_instance['width'] );
		$instance['controlnav'] = isset($new_instance['controlnav']);
		$instance['directionnav'] = isset($new_instance['directionnav']);

		
		return $instance;
	}

	 
	public function form( $instance ) {
	
		global $widget, $wp_widget_factory, $wp_query;
		
		if ( isset( $instance[ 'title' ] ) ) {
			$title = $instance[ 'title' ];
		}
		else {
			$title = __( '', 'text_domain' );
		}
		
		if ( isset( $instance[ 'slider' ] ) ) {
			$slider = $instance[ 'slider' ];
		}
		else {
			$slider = '';
		}
		
		if ( isset( $instance[ 'speed' ] ) )  $speed = $instance[ 'speed' ]; 	else $speed = '7000';
		if ( isset( $instance[ 'height' ] ) ) $height = $instance[ 'height' ]; 	else $height = '';
		if ( isset( $instance[ 'width' ] ) )  $width = $instance[ 'width' ]; 	else $width  = '';

		if ( isset( $instance[ 'controlnav' ] ) ) {
			$controlnav = $instance[ 'controlnav' ];
		}
		else {
			$controlnav = 0;
		}
		
		if ( isset( $instance[ 'directionnav' ] ) ) {
			$directionnav = $instance[ 'directionnav' ];
		}
		else {
			$directionnav = 0;
		}

		?>
		

		<p>
		<label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e( 'Title:' ); ?></label> 
		<input class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" type="text" value="<?php echo esc_attr( $title ); ?>" />
		</p>
		
		
		<p>
		<label style="min-width:60px;" for="<?php echo $this->get_field_id('slider');?>"><?php _e('Slider:','veuse-pagelist');?></label>
			<select name="<?php echo $this->get_field_name('slider');?>">
		<?php
		
		$sliders = get_posts( array(
		 
            'orderby' => 'title', 
            'order' => 'DESC', 
            'posts_per_page' => -1, 
            'post_status' => 'publish',
            'post_type'	=> 'veuse_slider'
        ));
        
                 
        
        if( $sliders ){
                              
            foreach( $sliders as $slider_item ){
            	?>
				<option value="<?php echo $slider_item->ID;?>" <?php selected( $slider, $slider_item->ID , true); ?>><?php echo $slider_item->post_title;?></option>	
            	
            	<?php
     
            }
            
        }

		?>
		</select>
		</p>
		
		<p>
		<label style="min-width:60px;" for="<?php echo $this->get_field_id( 'speed' ); ?>"><?php _e( "Speed:",'veuse-pagelist' ); ?></label> 
			<input size="6" id="<?php echo $this->get_field_id( 'speed' ); ?>" name="<?php echo $this->get_field_name( 'speed' ); ?>" type="text" value="<?php echo esc_attr( $speed ); ?>" />
			<small><?php _e('milliseconds','veuse-slider');?></small>
		</p>
		
		<p>
		<label style="min-width:60px;" for="<?php echo $this->get_field_id( 'width' ); ?>"><?php _e( "Width:",'veuse-pagelist' ); ?></label> 
			<input size="6" id="<?php echo $this->get_field_id( 'width' ); ?>" name="<?php echo $this->get_field_name( 'width' ); ?>" type="text" value="<?php echo esc_attr( $width ); ?>" />
			<small><?php _e('pixels','veuse-slider');?></small>
		</p>
		
		<p>
		<label style="min-width:60px;" for="<?php echo $this->get_field_id( 'height' ); ?>"><?php _e( "Height:",'veuse-pagelist' ); ?></label> 
			<input size="6" id="<?php echo $this->get_field_id( 'height' ); ?>" name="<?php echo $this->get_field_name( 'height' ); ?>" type="text" value="<?php echo esc_attr( $height ); ?>" />
			<small><?php _e('pixels','veuse-slider');?></small>
		</p>
		
		<p>
		<input id="<?php echo $this->get_field_id('controlnav'); ?>" name="<?php echo $this->get_field_name('controlnav'); ?>" type="checkbox" <?php checked( '1', $controlnav ); ?> />
		<label for="<?php echo $this->get_field_id('controlnav'); ?>"><?php _e('Show controlnav', 'veuse-pagelist'); ?></label>
		</p>

		<p>
		<input id="<?php echo $this->get_field_id('directionnav'); ?>" name="<?php echo $this->get_field_name('directionnav'); ?>" type="checkbox" <?php checked( '1', $directionnav ); ?> />
		<label for="<?php echo $this->get_field_id('directionnav'); ?>"><?php _e('Show directionnav', 'veuse-pagelist'); ?></label>
		</p>
		
		<?php

	}

} 

add_action('widgets_init',create_function('','return register_widget("VeuseSlideshowWidget");'));
 
?>