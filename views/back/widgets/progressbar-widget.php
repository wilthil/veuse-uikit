<?php

class VeuseProgressbarWidget extends WP_Widget {

	/**
	 * Register widget with WordPress.
	 */
	public function __construct() {
		parent::__construct(
	 		'veuse_alert_widget', // Base ID
			__('Progressbar','veuse-uikit'), // Name
			array( 'description' => __( 'Add a progressbar', 'veuse-uikit' ), ) // Args
		);
	}

	public function widget( $args, $instance ) {
		
		extract( $args );
		
		$title = apply_filters( 'widget_title', $instance['title'] );
		

		if ( isset( $instance[ 'width' ] ) ) $width = $instance[ 'width' ];	else $width = '';
		if ( isset( $instance[ 'color' ] ) ) $color = $instance[ 'color' ];	else $color = '';
		
		echo $before_widget;
		echo do_shortcode('[veuse_progressbar width="'.$width .'" color="'.$color.'" title="'.$title.'"]');
		echo $after_widget;
	}


	public function update( $new_instance, $old_instance ) {
		
		$instance = array();
				
		$instance['title'] = strip_tags( $new_instance['title'] );
		$instance['width'] = strip_tags( $new_instance['width'] );
		$instance['color'] = strip_tags( $new_instance['color'] );


		return $instance;
	}

	 
	public function form( $instance ) {
	
		global $widget, $wp_widget_factory, $wp_query;
		
		if ( isset( $instance[ 'title' ] ) ) $title = $instance[ 'title' ];	else $title = __( '', 'veuse-uikit' );
		if ( isset( $instance[ 'width' ] ) ) $width = $instance[ 'width' ];	else $width = '';
		if ( isset( $instance[ 'color' ] ) ) $color = $instance[ 'color' ];	else $color = '';
			
		
		?>

		<p>
		<label style="min-width:90px" for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e( 'Title:' ); ?></label> 
		<input id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" type="text" value="<?php echo esc_attr( $title ); ?>" />
		</p>
					
	
			
		<p>
		<label style="min-width:90px" for="<?php echo $this->get_field_id( 'width' ); ?>"><?php _e( 'Width:' ); ?></label>
		<input type="text" id="<?php echo $this->get_field_id( 'width' ); ?>" name="<?php echo $this->get_field_name( 'width' ); ?>" value="<?php echo esc_attr($width);?>"/></p>
		
		<p>
		<label style="min-width:90px" for="<?php echo $this->get_field_id( 'color' ); ?>"><?php _e( 'Color:' ); ?></label>
		
		<select id="<?php echo $this->get_field_id( 'color' ); ?>" name="<?php echo $this->get_field_name( 'color' ); ?>">
		
			<option value="lightblue"  <?php selected( $color, 'lightblue' , true); ?>><?php _e('Light blue','veuse-uikit');?></option>
			<option value="red"  <?php selected( $color, 'red' , true); ?>><?php _e('Red','veuse-uikit');?></option>
			<option value="yellow"  <?php selected( $color, 'yellow' , true); ?>><?php _e('Yellow','veuse-uikit');?></option>
			<option value="green"  <?php selected( $color, 'green' , true); ?>><?php _e('Green','veuse-uikit');?></option>
			<option value="grey"  <?php selected( $color, 'grey' , true); ?>><?php _e('Grey','veuse-uikit');?></option>
			<option value="blue"  <?php selected( $color, 'blue' , true); ?>><?php _e('Blue','veuse-uikit');?></option>
			<option value="pink"  <?php selected( $color, 'pink' , true); ?>><?php _e('Pink','veuse-uikit');?></option>
			<option value="purple"  <?php selected( $color, 'purple' , true); ?>><?php _e('Purple','veuse-uikit');?></option>
			<option value="brown"  <?php selected( $color, 'brown' , true); ?>><?php _e('Brown','veuse-uikit');?></option>
		
		</select>
		</p>

		

		<?php

	}

} 

add_action('widgets_init',create_function('','return register_widget("VeuseProgressbarWidget");'));
 
?>