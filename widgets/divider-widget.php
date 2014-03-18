<?php

class VeuseDividerWidget extends WP_Widget {

	/**
	 * Register widget with WordPress.
	 */
	public function __construct() {
		parent::__construct(
	 		'veuse_divider_widget', // Base ID
			__('Divider (Veuse)', 'veuse-uikit'),// Name
			array( 'description' => __( 'Add a divider line, with or without text.', 'veuse-uikit'), 
			) // Args
		);
	}

	public function widget( $args, $instance ) {
		extract( $args );
		$title = apply_filters( 'widget_title', $instance['title'] );
		$alignment = $instance['alignment'];
		$icon = $instance['icon'];
		$container = $instance['container'];
		
		echo $before_widget;
		
			
						
			echo do_shortcode('[veuse_divider textstyle="'.$container.'" alignment="'.$alignment.'" title="'.$title.'" icon="'.$icon.'"]');
			
		
		echo $after_widget;
	}


	public function update( $new_instance, $old_instance ) {
		
		$instance = array();
				
		$instance['title'] = strip_tags( $new_instance['title'] );
		$instance['alignment'] = strip_tags( $new_instance['alignment'] );
		$instance['icon'] = strip_tags( $new_instance['icon'] );
		$instance['container'] = strip_tags( $new_instance['container'] );
		
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
		
		if ( isset( $instance[ 'icon' ] ) ) {
			$icon = $instance[ 'icon' ];
		}
		else {
			$icon = '';
		}
		
	
		
		if ( isset( $instance[ 'alignment' ] ) ) {
			$alignment = $instance[ 'alignment' ];
		}
		else {
			$alignment = __( 'left', 'text_domain' );
		}
		
		if ( isset( $instance[ 'container' ] ) ) {
			$container = $instance[ 'container' ];
		}
		else {
			$container = __( 'h4', 'text_domain' );
		}
		
		?>

		<p>
		<label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e( 'Title:' ); ?></label> 
		<input class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" type="text" value="<?php echo esc_attr( $title ); ?>" />
		</p>
		
		<p>
			<label style="min-width:60px;" for="<?php echo $this->get_field_id('icon');?>"><?php _e('Icon:','veuse-pagelist');?></label>
			<input id="<?php echo $this->get_field_id( 'icon' ); ?>" name="<?php echo $this->get_field_name( 'icon' ); ?>" type="text" value="<?php echo esc_attr( $icon ); ?>" />
		</p>


		<p>
			<label style="min-width:60px;" for="<?php echo $this->get_field_id('alignment');?>"><?php _e('Alignment:','veuse-pagelist');?></label>
			<select name="<?php echo $this->get_field_name('alignment');?>">
		  		<option value="left" <?php selected( $alignment, 'left' , true); ?>><?php _e('Left','veuse-pagelist');?></option>
		  		<option value="center" <?php selected( $alignment, 'center' , true); ?>><?php _e('Center','veuse-pagelist');?></option>	
		  		<option value="right" <?php selected( $alignment, 'right' , true); ?>><?php _e('Right','veuse-pagelist');?></option>	
		  	</select>
		</p>
		
				
		<p>
			<label style="min-width:60px;" for="<?php echo $this->get_field_id('container');?>"><?php _e('Text style:','veuse-pagelist');?></label>
			<select name="<?php echo $this->get_field_name('container');?>">
		  		<option value="h3" <?php selected( $container, 'h3' , true); ?>><?php _e('Heading 3','veuse-pagelist');?></option>
		  		<option value="h4" <?php selected( $container, 'h4' , true); ?>><?php _e('Heading 4','veuse-pagelist');?></option>	
		  		<option value="h5" <?php selected( $container, 'h5' , true); ?>><?php _e('Heading 5','veuse-pagelist');?></option>	
		  		<option value="h6" <?php selected( $container, 'h6' , true); ?>><?php _e('Heading 6','veuse-pagelist');?></option>	
		  		<option value="p" <?php selected( $container, 'p' , true); ?>><?php _e('Paragraph','veuse-pagelist');?></option>	
		  	</select>
		</p>
		 
		<?php

	}

} 

add_action('widgets_init',create_function('','return register_widget("VeuseDividerWidget");'));



 
?>