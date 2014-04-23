<?php

class VeuseCalloutWidget extends WP_Widget {

	/**
	 * Register widget with WordPress.
	 */
	public function __construct() {
		parent::__construct(
	 		'veuse_callout_widget', // Base ID
			__('Callout (Veuse)','veuse-uikit'), // Name
			array( 'description' => __( 'Add a call-to-action block', 'veuse-uikit' ), ) // Args
		);
	}

	public function widget( $args, $instance ) {
		extract( $args );
		$title = apply_filters( 'widget_title', $instance['title'] );
		$bordercolor = $instance['bordercolor'];
		$backgroundcolor = $instance['backgroundcolor'];
		$textcolor = $instance['textcolor'];
		$icon = $instance['icon'];
		$button_text = $instance['button_text'];
		$button_link = $instance['button_link'];
		$style = $instance['style'];
		
		echo $before_widget;
		if ( ! empty( $title ) )
			//echo $before_title . $title . $after_title;
			?>
			
			<?php
			
			echo do_shortcode('[veuse_callout caption="'.$title.'" link="'.$button_link .'" buttontext="'. $button_text .' " style="'.$style.'" bordercolor="'.$bordercolor.'"  background="'.$backgroundcolor.'" color="'.$textcolor.'" icon="'.$icon.'"]');
			
		
		echo $after_widget;
	}


	public function update( $new_instance, $old_instance ) {
		
		$instance = array();
				
		$instance['title'] = strip_tags( $new_instance['title'] );
		$instance['bordercolor'] = strip_tags( $new_instance['bordercolor'] );
		$instance['backgroundcolor'] = strip_tags( $new_instance['backgroundcolor'] );
		$instance['textcolor'] = strip_tags( $new_instance['textcolor'] );
		$instance['icon'] = strip_tags( $new_instance['icon'] );
		$instance['button_text'] = strip_tags( $new_instance['button_text'] );
		$instance['button_link'] = strip_tags( $new_instance['button_link'] );
		$instance['style'] = strip_tags( $new_instance['style'] );
		
		return $instance;
	}

	 
	public function form( $instance ) {
	
		global $widget, $wp_widget_factory, $wp_query;
		
		if ( isset( $instance[ 'title' ] ) ) $title = $instance[ 'title' ];	else $title = __( '', 'text_domain' );		
		if ( isset( $instance[ 'bordercolor' ] ) ) $bordercolor = $instance[ 'bordercolor' ];   else $bordercolor = '';
		if ( isset( $instance[ 'backgroundcolor' ] ) ) $backgroundcolor = $instance[ 'backgroundcolor' ];   else $backgroundcolor = '';
		if ( isset( $instance[ 'icon' ] ) ) $icon = $instance[ 'icon' ];   else $icon = '';
		if ( isset( $instance[ 'textcolor' ] ) ) $textcolor = $instance[ 'textcolor' ];   else $textcolor = '';
		if ( isset( $instance[ 'button_text' ] ) ) $button_text = $instance[ 'button_text' ];	else $button_text = '';
		if ( isset( $instance[ 'button_link' ] ) ) $button_link = $instance[ 'button_link' ];	else $button_link = '';
		isset($instance['style']) ? $style = $instance['style'] : $style = 'white';
		
		?>

		<p>
		<label style="min-width:100px" for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e( 'Text:' ); ?></label> 
		<input class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" type="text" value="<?php echo esc_attr( $title ); ?>" />
		</p>
		
				
		<p>
		<label style="min-width:100px;" for="<?php echo $this->get_field_id( 'button_text' ); ?>"><?php _e( 'Button text:' ); ?></label> 
		<input size="30" id="<?php echo $this->get_field_id( 'button_text' ); ?>" name="<?php echo $this->get_field_name( 'button_text' ); ?>" type="text" value="<?php echo esc_attr( $button_text ); ?>" />
		</p>
		
		<p>
		<label style="min-width:100px;" for="<?php echo $this->get_field_id( 'button_link' ); ?>"><?php _e( 'Button link:' ); ?></label> 
		<input size="30" id="<?php echo $this->get_field_id( 'button_link' ); ?>" name="<?php echo $this->get_field_name( 'button_link' ); ?>" type="text" value="<?php echo esc_attr( $button_link ); ?>" />
		</p>
		
		<p>
			<label style="min-width:100px;" for="<?php echo $this->get_field_id('style');?>"><?php _e('Style:','veuse-pagelist');?></label>
			<select name="<?php echo $this->get_field_name('style');?>">
		  		<option value="dark" <?php selected( $style, 'dark' , true); ?>><?php _e('Dark','veuse-pagelist');?></option>
		  		<option value="silver" <?php selected( $style, 'silver' , true); ?>><?php _e('Silver','veuse-pagelist');?></option>	
		  		<option value="white" <?php selected( $style, 'white' , true); ?>><?php _e('White','veuse-pagelist');?></option>
		  		<option value="light-blue" <?php selected( $style, 'light-blue' , true); ?>><?php _e('Light blue','veuse-pagelist');?></option>
		  		<option value="green" <?php selected( $style, 'green' , true); ?>><?php _e('Green','veuse-pagelist');?></option>
		  		<option value="yellow" <?php selected( $style, 'yellow' , true); ?>><?php _e('Yellow','veuse-pagelist');?></option>
		  		<option value="orange" <?php selected( $style, 'orange' , true); ?>><?php _e('Orange','veuse-pagelist');?></option>
		  		<option value="transparent-dark" <?php selected( $style, 'transparent-dark' , true); ?>><?php _e('Transparent - dark text','veuse-pagelist');?></option>
		  		<option value="transparent-light" <?php selected( $style, 'transparent-light' , true); ?>><?php _e('Transparent - light text','veuse-pagelist');?></option>	
		  	</select>
		</p>
		
		<p>
		<label style="min-width:100px;" for="<?php echo $this->get_field_id( 'bordercolor' ); ?>"><?php _e( 'Bordercolor:' ); ?></label> 
		<input size="30" id="<?php echo $this->get_field_id( 'bordercolor' ); ?>" name="<?php echo $this->get_field_name( 'bordercolor' ); ?>" type="text" value="<?php echo esc_attr( $bordercolor ); ?>" />
		<small><?php _e('Hex value (#000000)','veuse-pagelist');?></small>
		</p>


		<p>
		<label style="min-width:100px;" for="<?php echo $this->get_field_id( 'backgroundcolor' ); ?>"><?php _e( 'Backgroundcolor:' ); ?></label> 
		<input size="30" id="<?php echo $this->get_field_id( 'backgroundcolor' ); ?>" name="<?php echo $this->get_field_name( 'backgroundcolor' ); ?>" type="text" value="<?php echo esc_attr( $backgroundcolor ); ?>" />
		<small><?php _e('Hex value (#000000)','veuse-pagelist');?></small>
		</p>
		
		<p>
		<label style="min-width:100px;" for="<?php echo $this->get_field_id( 'textcolor' ); ?>"><?php _e( 'Text color:' ); ?></label> 
		<input size="30" id="<?php echo $this->get_field_id( 'textcolor' ); ?>" name="<?php echo $this->get_field_name( 'textcolor' ); ?>" type="text" value="<?php echo esc_attr( $textcolor ); ?>" />
		<small><?php _e('Hex value (#000000)','veuse-pagelist');?></small>
		</p>
		
		<p>
		<label style="min-width:100px;" for="<?php echo $this->get_field_id( 'icon' ); ?>"><?php _e( 'Icon:' ); ?></label> 
		<input size="30" id="<?php echo $this->get_field_id( 'icon' ); ?>" name="<?php echo $this->get_field_name( 'icon' ); ?>" type="text" value="<?php echo esc_attr( $icon ); ?>" />
		<small><?php _e('Font Awesome icon. Find icons here: <a href="http://fontawesome.io" target="blank">http://fontawesome.io</a>','veuse-pagelist');?></small>
		</p>

		

		<?php

	}

} 

add_action('widgets_init',create_function('','return register_widget("VeuseCalloutWidget");'));
 
?>