<?php

class VeusePageWidget extends WP_Widget {

	/**
	 * Register widget with WordPress.
	 */
	public function __construct() {
		parent::__construct(
	 		'veuse_page_widget', // Base ID
			__('Featured page (Veuse)','veuse-uikit'), // Name
			array( 'description' => __( 'Extract content from another page and insert on your page.', 'veuse-pagelist' ), ) // Args
		);
	}

	public function widget( $args, $instance ) {
		extract( $args );
		$title = apply_filters( 'widget_title', $instance['title'] );
		$imagesize = $instance['imagesize'];
		$custom_imagesize = $instance['custom_imagesize'];
		$link = $instance['link'];
		$image = $instance['image'];
		$btn_text = $instance['btn_text'];
		$page = $instance['page'];
		
		
		if(!empty($imagesize)) {
			
			$imagesize = 'imagesize="'.$imagesize.'"';
		}
		
		if(!empty($custom_imagesize)) {
			
			$custom_imagesize = 'custom_imagesize="'.$custom_imagesize.'"';
		}
	
	
		echo $before_widget;
		if ( ! empty( $title ) )
			echo $before_title . $title . $after_title;
		
			 // Do Your Widgety Stuff Here…
			 echo do_shortcode('[veuse_page id="'. $page .'" button_text="'.$btn_text.'" image="'.$image.'" link="'.$link.'" '.$imagesize.' '.$custom_imagesize.']');
		
		echo $after_widget;
	}


	public function update( $new_instance, $old_instance ) {
		
		$instance = array();
				
		$instance['title'] = strip_tags( $new_instance['title'] );
		$instance['imagesize'] = strip_tags( $new_instance['imagesize'] );
		$instance['custom_imagesize'] = strip_tags( $new_instance['custom_imagesize'] );
		$instance['page'] = strip_tags( $new_instance['page'] );
		$instance['link'] = isset($new_instance['link']);
		$instance['image'] = isset($new_instance['image']);
		$instance['btn_text'] = strip_tags( $new_instance['btn_text']);
		
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
		
		if ( isset( $instance[ 'btn_text' ] ) ) {
			$btn_text = $instance[ 'btn_text' ];
		}
		else {
			$btn_text = __( 'Read more', 'text_domain' );
		}
		
		if ( isset( $instance[ 'imagesize' ] ) )
			$imagesize = $instance[ 'imagesize' ];
		else 
			$imagesize = '';
			
		if ( isset( $instance[ 'custom_imagesize' ] ) )
			$custom_imagesize = $instance[ 'custom_imagesize' ];
		else 
			$custom_imagesize = '';
	
		
		if ( isset( $instance[ 'link' ] ) ) 
			$link = $instance[ 'link' ];
		else 
			$link = true;
			
		if ( isset( $instance[ 'image' ] ) ) 
			$image = $instance[ 'image' ];
		else 
			$image = true;
		

		if ( isset( $instance[ 'page' ] ) ) {
			$page = $instance[ 'page' ];
		}
		else {
			$page = '';
		}
		
		
		
			?>
		

		<p>
		<label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e( 'Title:' ); ?></label> 
		<input class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" type="text" value="<?php echo esc_attr( $title ); ?>" />
		</p>
		
				
		<label style="min-width:100px" for="<?php echo $this->get_field_id( 'page' ); ?>"><?php _e( "Select page:",'veuse-pagelist' ); ?></label> 
		<select name="<?php echo $this->get_field_name( 'page' ); ?>" id="<?php echo $this->get_field_id( 'page' ); ?>">
		<?php
			
		$get_pages = get_pages( array( 
            'orderby' => 'title', 
            'order' => 'DESC', 
            'posts_per_page' => -1, 
            'post_status' => 'publish' 
        ));
        
                 
        
        if( $get_pages ){
                              
            foreach( $get_pages as $item ){
            	?>

            	<option value="<?php echo $item->ID;?>" <?php selected($page, $item->ID, true);?>> <?php echo $item->post_title;?></option>
            	<?php
     
            }
            
        }

		?>
		
		</select>
		
		
		 <p>
                <label style="min-width:100px;" for="<?php echo $this->get_field_id( 'imagesize' ); ?>"><?php _e( "Image size:",'veuse-pagelist' ); ?></label>
                <select id="<?php echo $this->get_field_id( 'imagesize' ); ?>" name="<?php echo $this->get_field_name( 'imagesize' ); ?>">
                    <option value="full" <?php if($imagesize == "full") { ?>selected<?php } ?>><?php _e( "Original image:",'veuse-pagelist' ); ?></option>
                    <?php foreach (get_intermediate_image_sizes() as $s) {
                        ?><option value="<?php echo($s); ?>" <?php if ($imagesize == $s) { ?>selected<?php } ?>><?php echo($s); ?></option><?php
                    } ?>
                </select>
            </p>
				
		<p>
		<label style="min-width:100px;" for="<?php echo $this->get_field_id( 'custom_imagesize' ); ?>"><?php _e( "Custom size:",'veuse-pagelist' ); ?></label> 
			<input size="6" id="<?php echo $this->get_field_id( 'custom_imagesize' ); ?>" name="<?php echo $this->get_field_name( 'custom_imagesize' ); ?>" type="text" value="<?php echo esc_attr( $custom_imagesize ); ?>" />
			<small><?php _e( "width * height",'veuse-pagelist' ); ?></small>
		</p>
		
		<p>
		<label style="min-width:100px;" for="<?php echo $this->get_field_id( 'link' ); ?>"><?php _e( "Link",'veuse-pagelist' ); ?></label> 
			<input id="<?php echo $this->get_field_id( 'link' ); ?>" name="<?php echo $this->get_field_name( 'link' ); ?>" type="checkbox" <?php checked( '1', $link ); ?> /><small><?php _e( "Add a link to the page",'veuse-pagelist' ); ?></small>

			
		</p>
		
		<p>
		<label style="min-width:100px;" for="<?php echo $this->get_field_id( 'image' ); ?>"><?php _e( "Featured image",'veuse-pagelist' ); ?></label> 
			<input id="<?php echo $this->get_field_id( 'image' ); ?>" name="<?php echo $this->get_field_name( 'image' ); ?>" type="checkbox" <?php checked( '1', $image ); ?> /><small><?php _e( "Display the pages featured image.",'veuse-pagelist' ); ?></small>

			
		</p>
		
		<p>
		<label style="min-width:100px;" for="<?php echo $this->get_field_id( 'btn_text' ); ?>"><?php _e( 'Button text' ); ?></label> 
		<input id="<?php echo $this->get_field_id( 'btn_text' ); ?>" name="<?php echo $this->get_field_name( 'btn_text' ); ?>" type="text" value="<?php echo esc_attr( $btn_text ); ?>" /><small><?php _e( "Text to show in button",'veuse-pagelist' ); ?></small>

		</p>
	
				<?php

	}

} 

add_action('widgets_init',create_function('','return register_widget("VeusePageWidget");'));
 
?>