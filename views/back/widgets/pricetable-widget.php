<?php

class VeusePricetableWidget extends WP_Widget {

	public function __construct() {
		parent::__construct(
	 		'veuse_pricetable_widget', // Base ID
			'Pricetable (Veuse)', // Name
			array( 'description' => __( 'Add a pricetable to your page', 'veuse_pricetable' ), ) // Args
		);
	}

	public function widget( $args, $instance ) {
		extract( $args );
		$title = apply_filters( 'widget_title', $instance['title'] );
		$pricetable = $instance['pricetable'];
				
		echo $before_widget;
		
		if ( ! empty( $title ) )
			echo $before_title . $title . $after_title;
					
		echo do_shortcode('[veuse_pricetable  pricetable="'.$pricetable.'"]');	
		
		echo $after_widget;
	}


	public function update( $new_instance, $old_instance ) {
		
		$instance = array();
				
		$instance['title'] = strip_tags( $new_instance['title'] );
		$instance['pricetable'] = strip_tags( $new_instance['pricetable'] );		
		
		return $instance;
	}

	 
	public function form( $instance ) {
	
		global $widget, $wp_widget_factory, $wp_query;
		
		isset( $instance[ 'title' ] ) ? $title = $instance[ 'title' ] : $title = '';		
		isset($instance['pricetable']) ? $team = $instance['pricetable'] : $team = '';
		
		
		?>

		<p>
		<label style="min-width:80px;" for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e( 'Title:' ); ?></label> 
		<input class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" type="text" value="<?php echo esc_attr( $title ); ?>" />
		</p>
		<p>
		<label style="min-width:80px;" for="<?php echo $this->get_field_id('pricetable');?>"><?php _e('Pricetable:','veuse-staff');?></label>
			<select name="<?php echo $this->get_field_name('pricetable');?>">
			<?php
					
			$terms = get_terms( 'pricetable', array('hide_empty' => 1 ));
	        
	        if( $terms ){
	                            
	            foreach( $terms as $term ){ ?>
	
	            	<option value="<?php echo $term->slug;?>" <?php selected($team ,$term->slug, true);?>> <?php echo $term->name;?></option>
	            	<?php
	            }
	        }
	
			?>
		</select>
		</p>		 

		<?php

	}

} 

add_action('widgets_init',create_function('','return register_widget("VeusePricetableWidget");'));
 
?>