<?php

class VeusePostgridWidget extends WP_Widget {

	/**
	 * Register widget with WordPress.
	 */
	public function __construct() {
		parent::__construct(
	 		'veuse_postgrid_widget', // Base ID
			'Posts grid (Veuse)', // Name
			array( 'description' => __( 'Display blog posts in a list.', 'veuse-uikit' ), ) // Args
		);
	}

	public function widget( $args, $instance ) {
		extract( $args );
		$title = apply_filters( 'widget_title', $instance['title'] );
		$category = $instance['category'];
		$perpage = $instance['perpage'];
		$orderby = $instance['orderby'];	
		$order = $instance['order'];
		$width = $instance['width'];
		$height = $instance['height'];	
		$grid = $instance['grid'];	

		$category = rtrim($category, ',');
		
		echo $before_widget;
		if ( ! empty( $title ) )
			echo $before_title . $title . $after_title;	
			 // Do Your Widgety Stuff Here…
			echo do_shortcode('[veuse_postgrid categories="'. $category .'" grid="'.$grid.'" orderby="'.$orderby.'" order="'.$order.'" perpage="'.$perpage.'" width="'.$width.'" height="'.$height.'"]');
		
		echo $after_widget;
	}


	public function update( $new_instance, $old_instance ) {
		
		$instance = array();
				
		$instance['title'] = strip_tags( $new_instance['title'] );
		$instance['category'] = strip_tags( $new_instance['category'] );
		$instance['perpage'] = strip_tags( $new_instance['perpage'] );
		$instance['orderby'] = strip_tags( $new_instance['orderby'] );
		$instance['order'] = strip_tags( $new_instance['order'] );
		$instance['width'] = strip_tags( $new_instance['width'] );
		$instance['height'] = strip_tags( $new_instance['height'] );
		$instance['grid'] = strip_tags( $new_instance['grid'] );
		
		return $instance;
	}

	 
	public function form( $instance ) {
	
		global $widget, $wp_widget_factory, $wp_query;
		
		if ( isset( $instance[ 'title' ] ) ) $title = $instance[ 'title' ]; else $title = __( '', 'text_domain' );	
		if ( isset( $instance[ 'category' ] ) ) $category = $instance[ 'category' ]; else $category = '';
		if ( isset( $instance[ 'perpage' ] ) ) $perpage = $instance[ 'perpage' ]; else $perpage = __( '-1', 'text_domain' );
		if ( isset( $instance[ 'orderby' ] ) ) $orderby = $instance[ 'orderby' ]; else $orderby = __( 'date', 'text_domain' );
		if ( isset( $instance[ 'order' ] ) ) $order = $instance[ 'order' ]; else $order = __( 'ASC', 'text_domain' );
		if ( isset( $instance[ 'width' ] ) ) $width = $instance[ 'width' ]; else $width = '1000';
		if ( isset( $instance[ 'height' ] ) ) $height = $instance[ 'height' ]; else $height = '500';
		if ( isset( $instance[ 'grid' ] ) ) $grid = $instance[ 'grid' ]; else $grid = '3';
	
		?>
		
		<p>
		<label style="width:80px;" for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e( 'Title:' ); ?></label> 
		<input class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" type="text" value="<?php echo esc_attr( $title ); ?>" />
		</p>
		
		<style>
			.categoryselector-wrapper {
				
				padding:10px; background: #fff; border:1px solid #eee; overflow: scroll; max-height:180px; margin-bottom: 20px;
				
			}
			
			.categoryselector-wrapper a { 
				padding:3px 10px 3px 0px;  display: block; margin: 0; cursor: pointer; text-decoration: none;
				border-bottom:1px dotted #d4d4d4;
			}
			
			.categoryselector-wrapper a:hover { color:#2a95c5;}
						
			.categoryselector-wrapper a:after {
					content:'';
					color:#999;
					float:right;
					font-weight: bold;
				} 
			.categoryselector-wrapper a.active { font-weight: bold; color:#de4b29;}
			.categoryselector-wrapper a.active:after {
					content:'x';
					color:#de4b29;
				
				} 
		</style>
		
		<label style="min-width:90px;" for="<?php echo $this->get_field_id( 'category' ); ?>"><?php _e( "Select categories:",'veuse-uikit' ); ?></label> 
		
		<div class="categoryselector-wrapper">
		<?php
		
		
		$categories = get_categories( array('hide_empty' => 1 ));
        
        if( $categories ){
                              
            foreach( $categories as $term ){
            	?>

            	<a href="#" data-category-id="<?php echo $term->slug;?>"> <?php echo $term->name;?></a>
            	<?php
     
            }
            
        }

		?>
		</div>
		<input id="<?php echo $this->get_field_id( 'category' ); ?>" name="<?php echo $this->get_field_name( 'category' ); ?>" type="hidden" value="<?php echo esc_attr( $category );?>" />
		
		<p>
			<label style="min-width:80px;" for="<?php echo $this->get_field_id('grid');?>"><?php _e('Grid:','veuse-pagelist');?></label>
			<select name="<?php echo $this->get_field_name('grid');?>">
		  		<option value="1" <?php selected( $grid, '1' , true); ?>><?php _e('1 column','veuse-pagelist');?></option>
		  		<option value="2" <?php selected( $grid, '2' , true); ?>><?php _e('2 columns','veuse-pagelist');?></option>	
		  		<option value="3" <?php selected( $grid, '3' , true); ?>><?php _e('3 columns','veuse-pagelist');?></option>	
		  		<option value="4" <?php selected( $grid, '4' , true); ?>><?php _e('4 columns','veuse-pagelist');?></option>		  
		  	</select>
		</p>
				
		<p>
		<label style="min-width:90px;" for="<?php echo $this->get_field_id( 'orderby' ); ?>"><?php _e( "Order by:",'veuse-uikit' ); ?></label> 

			
			<select name="<?php echo $this->get_field_name('orderby');?>">
		  		<option value="title" <?php selected( $orderby, 'title' , true); ?>><?php _e('Post title','veuse-uikit');?></option>
		  		<option value="date" <?php selected( $orderby, 'date' , true); ?>><?php _e('Post date','veuse-uikit');?></option>	
		  	
		  	</select>
			
		</p>
		
		<p>
		<label style="min-width:90px;" for="<?php echo $this->get_field_id( 'order' ); ?>"><?php _e( "Order:",'veuse-uikit' ); ?></label> 

			
			<select name="<?php echo $this->get_field_name('order');?>">
		  		<option value="ASC" <?php selected( $order, 'ASC' , true); ?>><?php _e('Ascending','veuse-uikit');?></option>
		  		<option value="DESC" <?php selected( $order, 'DESC' , true); ?>><?php _e('Descending','veuse-uikit');?></option>	
		  	
		  	</select>
			
		</p>
		
		<p>
		<label style="min-width:90px;"  for="<?php echo $this->get_field_id( 'perpage' ); ?>"><?php _e( "Per page:",'veuse-uikit' ); ?></label> 
			<input size="6" id="<?php echo $this->get_field_id( 'perpage' ); ?>" name="<?php echo $this->get_field_name( 'perpage' ); ?>" type="text" value="<?php echo esc_attr( $perpage ); ?>" />
			<small><?php _e( "To show all, enter -1",'veuse-uikit' ); ?></small>
		</p>
		
		<p>
	
		<label style="min-width:90px;"  for="<?php echo $this->get_field_id( 'width' ); ?>"><?php _e( "Image width:",'veuse-uikit' ); ?></label> 
			<input size="6" id="<?php echo $this->get_field_id( 'width' ); ?>" name="<?php echo $this->get_field_name( 'width' ); ?>" type="text" value="<?php echo esc_attr( $width ); ?>" />
			<small><?php _e( "Numeric value",'veuse-uikit' ); ?></small>
		</p>
		<p>
		<label style="min-width:90px;"  for="<?php echo $this->get_field_id( 'height' ); ?>"><?php _e( "Image height:",'veuse-uikit' ); ?></label> 
			<input size="6" id="<?php echo $this->get_field_id( 'height' ); ?>" name="<?php echo $this->get_field_name( 'height' ); ?>" type="text" value="<?php echo esc_attr( $height ); ?>" />
			<small><?php _e( "Numeric value",'veuse-uikit' ); ?></small>
		</p>
		
		<?php

	}

} 

add_action('widgets_init',create_function('','return register_widget("VeusePostgridWidget");'));
 
?>