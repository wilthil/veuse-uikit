<?php

class VeuseTabWidget extends WP_Widget {

	/**
	 * Register widget with WordPress.
	 */
	public function __construct() {
		parent::__construct(
	 		'veuse_tab_widget', // Base ID
			__('Tab','veuse-uikit'), // Name
			array( 'description' => __( 'Add a tabbed panel', 'veuse-uikit' ), ) // Args
		);
	}

	public function widget( $args, $instance ) {
		
		extract( $args );
		
		$title = apply_filters( 'widget_title', $instance['title'] );
		
		//$tab_icon =  $instance['tab_icon'];
		$tab_content =  $instance['tab_content'];

		
		if ( isset( $instance[ 'tab_icon' ] ) ) $tab_icon = $instance[ 'tab_icon' ];	else $tab_icon = '';
		
		echo $before_widget;
		//if ( ! empty( $title ) )
			//echo $before_title . $title . $after_title;

			echo do_shortcode('[veuse_tab title="'.$title.'" icon="'.$tab_icon .'"]'. $tab_content.'[/veuse_tab]');
			
		
		echo $after_widget;
	}


	public function update( $new_instance, $old_instance ) {
		
		$instance = array();
				
		$instance['title'] = strip_tags( $new_instance['title'] );
		$instance['tab_icon'] = strip_tags( $new_instance['tab_icon'] );
		//$instance['tab_content'] = strip_tags( $new_instance['tab_content'] );
		$instance['tab_content'] = stripslashes( wp_filter_post_kses( addslashes($new_instance['tab_content']) ) ); // wp_filter_post_kses() expects slashed

		return $instance;
	}

	 
	public function form( $instance ) {
	
		global $widget, $wp_widget_factory, $wp_query;
		
		if ( isset( $instance[ 'title' ] ) ) $title = $instance[ 'title' ];	else $title = __( '', 'text_domain' );
		if ( isset( $instance[ 'tab_icon' ] ) ) $tab_icon = $instance[ 'tab_icon' ];	else $tab_icon = '';
		if ( isset( $instance[ 'tab_content' ] ) ) $tab_content = $instance[ 'tab_content' ];	else $tab_content = '';
			
		
		?>

		<p>
		<label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e( 'Toggle title:' ); ?></label> 
		<input class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" type="text" value="<?php echo esc_attr( $title ); ?>" />
		</p>
					
		<p>
		<label for="<?php echo $this->get_field_id( 'tab_content' ); ?>"><?php _e( 'Toggle content:' ); ?></label> 
		<textarea class="widefat" rows="10" name="<?php echo $this->get_field_name( 'tab_content' ); ?>"><?php echo esc_attr($tab_content);?></textarea></p>
			
		<p>
		<label for="<?php echo $this->get_field_id( 'tab_icon' ); ?>"><?php _e( 'Icon:' ); ?></label>
		<input type="text" id="<?php echo $this->get_field_id( 'tab_icon' ); ?>" name="<?php echo $this->get_field_name( 'tab_icon' ); ?>" value="<?php echo esc_attr($tab_icon);?>"/></p>

		<?php

	}

} 

add_action('widgets_init',create_function('','return register_widget("VeuseTabWidget");'));
 
?>