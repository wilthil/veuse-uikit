<?php

class VeuseTestimonialWidget extends WP_Widget {

	/**
	 * Register widget with WordPress.
	 */
	public function __construct() {
		parent::__construct(
	 		'veuse_testimonial_widget', // Base ID
			__('Testimonial','veuse-uikit'), // Name
			array( 'description' => __( 'Add a testimonial', 'veuse-uikit' ), ) // Args
		);
	}

	public function widget( $args, $instance ) {
		
		extract( $args );
		
		$title = apply_filters( 'widget_title', $instance['title'] );
		$text =  $instance['text'];
		$name =  $instance['name'];
		$designation =  $instance['designation'];

		echo $before_widget;
		
		if ( ! empty( $title ) )
			echo $before_title . $title . $after_title;
			echo do_shortcode('[veuse_testimonial name="'.$name.'" designation="'.$designation.'"]'. $text.'[/veuse_testimonial]');
			
		
		echo $after_widget;
	}


	public function update( $new_instance, $old_instance ) {
		
		$instance = array();
				
		$instance['title'] = strip_tags( $new_instance['title'] );
		$instance['name'] = strip_tags( $new_instance['name'] );
		$instance['designation'] = strip_tags( $new_instance['designation'] );
		$instance['text'] = stripslashes( wp_filter_post_kses( addslashes($new_instance['text']) ) ); // wp_filter_post_kses() expects slashed

		return $instance;
	}

	 
	public function form( $instance ) {
	
		global $widget, $wp_widget_factory, $wp_query;
		
		if ( isset( $instance[ 'title' ] ) ) $title = $instance[ 'title' ];	else $title = __( '', 'text_domain' );
		if ( isset( $instance[ 'text' ] ) ) $text = $instance[ 'text' ];	else $text = '';
		if ( isset( $instance[ 'name' ] ) ) $name = $instance[ 'name' ];	else $name = '';
		if ( isset( $instance[ 'designation' ] ) ) $designation = $instance[ 'designation' ];	else $designation = '';
			
		
		?>

		<p>
		<label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e( 'Title:' ); ?></label> 
		<input class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" type="text" value="<?php echo esc_attr( $title ); ?>" />
		</p>
					
		<p>
		<label for="<?php echo $this->get_field_id( 'text' ); ?>"><?php _e( 'Testimonial:' ); ?></label> 
		<textarea class="widefat" rows="10" name="<?php echo $this->get_field_name( 'text' ); ?>"><?php echo esc_attr($text);?></textarea></p>
		
		<p>
		<label for="<?php echo $this->get_field_id( 'name' ); ?>"><?php _e( 'Name:' ); ?></label>
		<input type="text" id="<?php echo $this->get_field_id( 'name' ); ?>" name="<?php echo $this->get_field_name( 'name' ); ?>" value="<?php echo esc_attr($name);?>"/></p>
		
		<p>
		<label for="<?php echo $this->get_field_id( 'designation' ); ?>"><?php _e( 'Designation:' ); ?></label>
		<input type="text" id="<?php echo $this->get_field_id( 'designation' ); ?>" name="<?php echo $this->get_field_name( 'designation' ); ?>" value="<?php echo esc_attr($designation);?>"/></p>

		

		<?php

	}

} 

add_action('widgets_init',create_function('','return register_widget("VeuseTestimonialWidget");'));
 
?>