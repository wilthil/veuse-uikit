<?php

class VeuseButtonWidget extends WP_Widget {

	/**
	 * Register widget with WordPress.
	 */
	public function __construct() {
		parent::__construct(
	 		'veuse_button_widget', // Base ID
			__('Button (Veuse)','veuse-uikit'), // Name
			array( 'description' => __( 'Add a button', 'veuse-uikit' ), ) // Args
		);
	}

	public function widget( $args, $instance ) {
		
		extract( $args );
		
		$title = apply_filters( 'widget_title', $instance['title'] );
		$link = $instance['link'];

		if ( isset( $instance[ 'button_icon' ] ) ) $button_icon = $instance[ 'button_icon' ];	else $button_icon = '';
		if ( isset( $instance[ 'button_color' ] ) ) $button_color = $instance[ 'button_color' ];	else $button_color = '';
		if ( isset( $instance[ 'button_size' ] ) ) $button_size = $instance[ 'button_size' ];	else $button_size = '';
		if ( isset( $instance[ 'button_align' ] ) ) $button_align = $instance[ 'button_align' ];	else $button_align = '';
		
		echo $before_widget;
		echo do_shortcode('[veuse_button icon="'.$button_icon .'" align="'.$button_align.'" color="'.$button_color.'" size="'.$button_size.'" text="'.$title.'" href="'.$link.'"]');
		echo $after_widget;
	}


	public function update( $new_instance, $old_instance ) {
		
		$instance = array();
				
		$instance['title'] = strip_tags( $new_instance['title'] );
		$instance['link'] = $new_instance['link'];
		$instance['button_icon'] = strip_tags( $new_instance['button_icon'] );
		$instance['button_color'] = strip_tags( $new_instance['button_color'] );
		$instance['button_size'] = strip_tags( $new_instance['button_size'] );
		$instance['button_align'] = strip_tags( $new_instance['button_align'] );
	
		return $instance;
	}

	 
	public function form( $instance ) {
	
		global $widget, $wp_widget_factory, $wp_query;
		
		if ( isset( $instance[ 'title' ] ) ) $title = $instance[ 'title' ];	else $title = __( '', 'veuse-uikit' );
		if ( isset( $instance[ 'link' ] ) ) $link = $instance[ 'link' ];	else $link = __( '', 'veuse-uikit' );
		if ( isset( $instance[ 'button_icon' ] ) ) $button_icon = $instance[ 'button_icon' ];	else $button_icon = '';
		if ( isset( $instance[ 'button_color' ] ) ) $button_color = $instance[ 'button_color' ];	else $button_color = '';
		if ( isset( $instance[ 'button_size' ] ) ) $button_size = $instance[ 'button_size' ];	else $button_size = 'medium';
		if ( isset( $instance[ 'button_align' ] ) ) $button_align = $instance[ 'button_align' ];	else $button_align = '';	
		
		?>

		<p>
		<label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e( 'Button text:' ); ?></label> 
		<input class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" type="text" value="<?php echo esc_attr( $title ); ?>" />
		</p>
		
		<p>
		<label for="<?php echo $this->get_field_id( 'link' ); ?>"><?php _e( 'Button text:' ); ?></label> 
		<input class="widefat" id="<?php echo $this->get_field_id( 'link' ); ?>" name="<?php echo $this->get_field_name( 'link' ); ?>" type="text" value="<?php echo esc_attr( $link ); ?>" />
		</p>
					
	
			
		<p>
		<label for="<?php echo $this->get_field_id( 'button_icon' ); ?>"><?php _e( 'Icon:' ); ?></label>
		<input type="text" id="<?php echo $this->get_field_id( 'button_icon' ); ?>" name="<?php echo $this->get_field_name( 'button_icon' ); ?>" value="<?php echo esc_attr($button_icon);?>"/></p>
		
		<p>
		<label for="<?php echo $this->get_field_id( 'button_color' ); ?>"><?php _e( 'Button color:' ); ?></label>
		<select id="<?php echo $this->get_field_id( 'button_color' ); ?>" name="<?php echo $this->get_field_name( 'button_color' ); ?>">
			<option value="white"  <?php selected( $button_color, 'white' , true); ?>><?php _e('White','veuse-uikit');?></option>
			<option value="red"  <?php selected( $button_color, 'red' , true); ?>><?php _e('Red','veuse-uikit');?></option>
			<option value="yellow"  <?php selected( $button_color, 'yellow' , true); ?>><?php _e('Yellow','veuse-uikit');?></option>
			<option value="green"  <?php selected( $button_color, 'green' , true); ?>><?php _e('Green','veuse-uikit');?></option>
			<option value="grey"  <?php selected( $button_color, 'grey' , true); ?>><?php _e('Grey','veuse-uikit');?></option>
			<option value="blue"  <?php selected( $button_color, 'blue' , true); ?>><?php _e('Blue','veuse-uikit');?></option>
		
		</select>
		</p>
		
		<p>
		<label for="<?php echo $this->get_field_id( 'button_size' ); ?>"><?php _e( 'Button size:' ); ?></label>
		<select id="<?php echo $this->get_field_id( 'button_size' ); ?>" name="<?php echo $this->get_field_name( 'button_size' ); ?>">
			<option value="small"  <?php selected( $button_size, 'small' , true); ?>><?php _e('Small','veuse-uikit');?></option>
			<option value="medium"  <?php selected( $button_size, 'medium' , true); ?>><?php _e('Medium','veuse-uikit');?></option>
			<option value="large"  <?php selected( $button_size, 'large' , true); ?>><?php _e('Large','veuse-uikit');?></option>
		</select>
		</p>
		
		<p>
		<label for="<?php echo $this->get_field_id( 'button_align' ); ?>"><?php _e( 'Alignment:' ); ?></label>
		<select id="<?php echo $this->get_field_id( 'button_align' ); ?>" name="<?php echo $this->get_field_name( 'button_align' ); ?>">
			<option value=""  <?php selected( $button_align, '' , true); ?>><?php _e('None','veuse-uikit');?></option>
			<option value="left"  <?php selected( $button_align, 'left' , true); ?>><?php _e('Left','veuse-uikit');?></option>
			<option value="right"  <?php selected( $button_align, 'right' , true); ?>><?php _e('Right','veuse-uikit');?></option>
			<option value="justify"  <?php selected( $button_align, 'justify' , true); ?>><?php _e('Justify','veuse-uikit');?></option>
		</select>
		</p>

		

		<?php

	}

} 

add_action('widgets_init',create_function('','return register_widget("VeuseButtonWidget");'));