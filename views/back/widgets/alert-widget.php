<?php

class VeuseAlertWidget extends WP_Widget {

	/**
	 * Register widget with WordPress.
	 */
	public function __construct() {
		parent::__construct(
	 		'veuse_alert_widget', // Base ID
			__('Alert','veuse-uikit'), // Name
			array( 'description' => __( 'Add an alert notice', 'veuse-uikit' ), ) // Args
		);
	}

	public function widget( $args, $instance ) {
		
		extract( $args );
		
		$title = apply_filters( 'widget_title', $instance['title'] );
		

		if ( isset( $instance[ 'alert_icon' ] ) ) $alert_icon = $instance[ 'alert_icon' ];	else $alert_icon = '';
		if ( isset( $instance[ 'alert_color' ] ) ) $alert_color = $instance[ 'alert_color' ];	else $alert_color = '';
		
		echo $before_widget;
		echo do_shortcode('[veuse_alert icon="'.$alert_icon .'" color="'.$alert_color.'" ]'.$title.'[/veuse_alert]');
		echo $after_widget;
	}


	public function update( $new_instance, $old_instance ) {
		
		$instance = array();
				
		$instance['title'] = strip_tags( $new_instance['title'] );
		$instance['alert_icon'] = strip_tags( $new_instance['alert_icon'] );
		$instance['alert_color'] = strip_tags( $new_instance['alert_color'] );

		return $instance;
	}

	 
	public function form( $instance ) {
	
		global $widget, $wp_widget_factory, $wp_query;
		
		if ( isset( $instance[ 'title' ] ) ) $title = $instance[ 'title' ];	else $title = __( '', 'veuse-uikit' );
		if ( isset( $instance[ 'alert_icon' ] ) ) $alert_icon = $instance[ 'alert_icon' ];	else $alert_icon = '';
		if ( isset( $instance[ 'alert_color' ] ) ) $alert_color = $instance[ 'alert_color' ];	else $alert_color = '';	
		?>

		<p>
		<label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e( 'Alert text:' ); ?></label> 
		<input class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" type="text" value="<?php echo esc_attr( $title ); ?>" />
		</p>
					
	
			
		<p>
		<label for="<?php echo $this->get_field_id( 'alert_icon' ); ?>"><?php _e( 'Icon:' ); ?></label>
		<input type="text" id="<?php echo $this->get_field_id( 'alert_icon' ); ?>" name="<?php echo $this->get_field_name( 'alert_icon' ); ?>" value="<?php echo esc_attr($alert_icon);?>"/></p>
		
		<p>
		<label for="<?php echo $this->get_field_id( 'alert_color' ); ?>"><?php _e( 'Icon:' ); ?></label>
		
		<select id="<?php echo $this->get_field_id( 'alert_color' ); ?>" name="<?php echo $this->get_field_name( 'alert_color' ); ?>">
		
			<option value="white"  <?php selected( $alert_color, 'white' , true); ?>><?php _e('White','veuse-uikit');?></option>
			<option value="red"  <?php selected( $alert_color, 'red' , true); ?>><?php _e('Red','veuse-uikit');?></option>
			<option value="yellow"  <?php selected( $alert_color, 'yellow' , true); ?>><?php _e('Yellow','veuse-uikit');?></option>
			<option value="green"  <?php selected( $alert_color, 'green' , true); ?>><?php _e('Green','veuse-uikit');?></option>
			<option value="grey"  <?php selected( $alert_color, 'grey' , true); ?>><?php _e('Grey','veuse-uikit');?></option>
			<option value="blue"  <?php selected( $alert_color, 'blue' , true); ?>><?php _e('Blue','veuse-uikit');?></option>
		
		</select>
		</p>
		<?php
	}
} 

add_action('widgets_init',create_function('','return register_widget("VeuseAlertWidget");'));