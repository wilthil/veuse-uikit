<?php 

function veuse_uikit_register_shortcodes(){
	
	
	/* Alerts
	================================================  */

	function veuse_alert($atts, $content = null){
			
		extract(shortcode_atts(array(
			'color' => '',
			'icon' => ''
	    ), $atts));
	    
	   !empty($icon) ? $icon_str = "<i class='fa fa-$icon'></i> " : $icon_str = "";

	   return '<div data-alert class="veuse-alert veuse-alert-' . $color . '">' . $icon_str . do_shortcode( $content ) .  '</div>';
		
	}

	add_shortcode("veuse_alert", "veuse_alert");
	
	
	
	/* Attachment download
	================================================  */
	
	function veuse_download($atts, $content = null){
		
		extract(shortcode_atts(array(
			'title' 		=> '',
			'button_text'	=> __('Download','veuse-uikit'),
			'link'			=> '',
			'id'		=> ''
			
			), $atts));
			
			if(!empty($id)){
		
				$attachment = get_post($id);		
				$link = wp_get_attachment_url($id);
				$title = $attachment->post_title;
				$content = $attachment->post_content;		
			
			
			
				ob_start();
				require(veuse_uikit_locate_part('download-box'));
				$content = ob_get_contents();
				ob_end_clean();
						
				return $content;
			
			} else {
				
				return __('No file added to download box','veuse-uikit');
			}

	}
	
	add_shortcode("veuse_download", "veuse_download");
	
	
	/* Buttons 
	================================================  */

	if(!function_exists('veuse_button')){
		function veuse_button( $atts, $content = null ) {
			extract(shortcode_atts(array(
					'href' => '#',
					'text' => 'Button text',
					'size' => 'small',
					'color' => 'primary',
					'style' => '',
					'align' => '',
					'target' => '',
					'width' => '',
					'icon' => '',
					'bevel' => ''
		    ), $atts));

		    if($icon)
		    $icon_str = '<i class="fa fa-'.$icon.'"></i>';
		    else
		    $icon_str = '';

			if($bevel == true) $bevel = 'bevel'; else $bevel = '';

		    if(is_numeric($href)){
		    $btnurl = get_permalink($href);
		    }else{
		    $btnurl = $href;
		    }
			$out =  '<a href="'.$btnurl.'" class="veuse-button '.$size.' '.$align.' '.$color.' '.$style.' '.$bevel.'" target="'.$target.'">'.$icon_str.' '.$text.'</a>';

			return $out;
		}

		add_shortcode('veuse_button', 'veuse_button');
	}
	
	
	/* Call to action-block 
	================================================  */
	
	if(!function_exists('veuse_callout')){
	
		function veuse_callout( $atts, $content = null ) {
			extract(shortcode_atts(array(
					'caption' 		=> '',
					'subcaption' 	=> '',
					'link'			=> '',
					'buttontext'	=> '',
					'style'			=> '',
					'color'			=> '',
					'background'	=> '',
					'bordercolor'	=> '',
					'textcolor'		=> '',
					'icon'			=> ''
		    ), $atts));
	    
			if(!empty($link) && !empty($buttontext)) $contentbox = 'linked'; else $contentbox = '';
	
		
		
			ob_start();
			require(veuse_uikit_locate_part('callout'));
			$output = ob_get_contents();
			ob_end_clean();
		
			return $output;
		
		}

		add_shortcode('veuse_callout', 'veuse_callout');

	}

	
	/* Counter
	================================================  */
	
	if(!function_exists('veuse_chart')){
	
		function veuse_chart( $atts, $content = null ) {
			extract(shortcode_atts(array(
					'percentage' 	=> '50',
					'scale_color'	=> '#ccc',
					'track_color'	=> '#fff',
					'bar_color'		=> '#333'
					
		    ), $atts));
	    
			
		

			return '<div class="chart " data-percent="'.$percentage.'" data-bar-color="'.$bar_color.'" data-track-color="'.$track_color.'" data-scale-color="'.$scale_color.'"><span class="percent">'.$percentage.'<span></div>';
			
		
		}

		add_shortcode('veuse_chart', 'veuse_chart');

	}

	
	
	/* Counter
	================================================  */
	
	if(!function_exists('veuse_counter')){
	
		function veuse_counter( $atts, $content = null ) {
			extract(shortcode_atts(array(
					'from' 			=> '0',
					'to' 			=> '',
					'speed'			=> '3000',
					'color'			=> '',
					'background'	=> '',
					'caption'		=> '',
					'description' 	=> '',
					'prefix'		=> '',
					'postfix'		=> ''
					
		    ), $atts));
	    
			
		
			ob_start();
			require(veuse_uikit_locate_part('counter'));
			$output = ob_get_contents();
			ob_end_clean();
		
			return $output;
		
		}

		add_shortcode('veuse_counter', 'veuse_counter');

	}
	
	/* Gap
	================================================  */
	
	if(!function_exists('veuse_gap')){
	
		function veuse_gap( $atts, $content = null ) {
			extract(shortcode_atts(array(
					'size' 		=> '30',
					
		    ), $atts));
		    
		   
	    		
			return '<br style="margin-bottom:'.$size.'px;" />';
		
		}

		add_shortcode('veuse_gap', 'veuse_gap');

	}
	
	/* Mark
	================================================  */
	
	if(!function_exists('veuse_mark')){
	
		function veuse_mark( $atts, $content = null ) {
			extract(shortcode_atts(array(
					'type' => ''
					
		    ), $atts));
		    
		   
	    		
			return '<mark class="'.$type.'">'.$content.'</mark>';
		
		}

		add_shortcode('veuse_mark', 'veuse_mark');

	}
	
	/* Divider 
	================================================  */
	
	function veuse_divider($atts, $content = null){
		
		extract(shortcode_atts(array(
			'icon' 		=> '',
			'title'		=> '',
			'textstyle'	=> 'h4',
			'alignment'	=> 'left'
			
			), $atts));
			
			!empty($icon) ? $iconStr = '<i class="fa fa-'.$icon.'"></i>' :  $iconStr = '';
			
			if(!empty($title) || !empty($icon)) { 
				
				$wrapper_start = '<span>'; $wrapper_end = '</span>';
				
			}  else {
				
				$wrapper_start = ''; $wrapper_end = '';
				
			}
			
			isset($title) ? $titleStr = $title :  $titleStr = '';
		   
		    $output = '<'.$textstyle.' class="veuse-divider veuse-divider-'.$alignment.'">'.$wrapper_start.$iconStr.''.$titleStr.$wrapper_end.'</'.$textstyle.'>';
			
			return $output;

	}
	
	add_shortcode("veuse_divider", "veuse_divider");

	
	/* Featured page 
	================================================  */
	
	function veuse_page($atts, $content = null){
		
		extract(shortcode_atts(array(
			'id'				=> '',
			'imagesize'			=> 'medium',
			'custom_imagesize' 	=> '',
			'link'				=> 'true',
			'button_text'		=> __('Read more','veuse-uikit'),
			'image'				=> 'true'
			
		), $atts));
			
		if(!empty($custom_imagesize)){
			
			$custom_imagesize = str_replace(' ','',$custom_imagesize); // Remove whitespace
			$string_parts = explode("*", $custom_imagesize); 
	
			$custom_imagesize = array();
			$custom_imagesize['width'] = $string_parts[0];
			$custom_imagesize['height'] = $string_parts[1];
			
			$img_url = wp_get_attachment_url( get_post_thumbnail_id($id) );
			$image_str = veuse_retina_interchange_image( $img_url, $custom_imagesize['width'], $custom_imagesize['height'], true);
			
		} else {
			
			$img = wp_get_attachment_image_src(get_post_thumbnail_id($id),$imagesize );
			$image_str = veuse_retina_interchange_image( $img[0], $img[1], $img[2], true);
		}
			
			
		$page = get_page($id);			
		
		ob_start();			
		require(veuse_uikit_locate_part('featured-page'));
		$out = ob_get_contents();
		ob_end_clean();
				
		return $out;

	}
	
	add_shortcode("veuse_page", "veuse_page");
	
	/* Attachment download  */
	/*
	function veuse_download_box($atts, $content = null){
		
		extract(shortcode_atts(array(
			'title' 		=> '',
			'button_text'	=> __('Download','veuse-uikit'),
			'link'			=> ''
			
			), $atts));
			
			
			ob_start();
			require(veuse_uikit_locate_part('download-box'));
			$content = ob_get_contents();
			ob_end_clean();
					
			return $content;

	}
	
	add_shortcode("veuse_download_box", "veuse_download_box");
	*/
	
	
	
	
	/* Styled lists  
	================================================  */
	
	function veuse_list($atts, $content = null){
		
		extract(shortcode_atts(array(
			'title' 		=> '',
			'icon'			=> '',
			'style'			=> '',
			'color'			=> '',
			'direction'		=> 'vertical',
			
			
			), $atts));
			
			if(!empty($icon)) $iconstr = 'icon-list '.$icon; else $iconstr = '';
			
			$out = '<div class="veuse-list '.$iconstr.' '.$color.' '.$direction.' style-'.$style.'">'.do_shortcode($content).'</div>';
					
			return $out;

	}
	
	add_shortcode("veuse_list", "veuse_list");
	
	
	/* Post slider 
	================================================  */
	
	function veuse_postslider($atts, $content = null){
		
		extract(shortcode_atts(array(
			'categories'	=> '',
			'perpage'		=> '',
			'order'			=> 'DESC',
			'orderby'		=> 'title',
			'width'			=> '600',
			'height'		=> '300'
			
			), $atts));
			
			global $wp_query;
		
			query_posts(array(
	        	'post_type' => 'post',
	        	'showposts' => $perpage,
	        	'order' => $order,
	        	'orderby' 	=> $orderby,
	        	'category_name' => $categories
	        	)
        	);
			
			ob_start();
			require(veuse_uikit_locate_part('loop-postslider'));
			$content = ob_get_contents();
			ob_end_clean();
		
			return $content;

	}
	
	add_shortcode("veuse_postslider", "veuse_postslider");
	
	
	/* Progress bar
	================================================  */
	
	function veuse_progressbar($atts, $content = null){
		
		extract(shortcode_atts(array(
			'title' 		=> '',
			'color'			=> 'blue',
			'width'			=> '75',
			
			
			), $atts));
			
			ob_start();
			require(veuse_uikit_locate_part('progressbar'));
			$out = ob_get_contents();
			ob_end_clean();

					
			return $out;

	}
	
	add_shortcode("veuse_progressbar", "veuse_progressbar");
	
	
		
	/* Parallax 
	
	Uncomplete. Needs more work...
	
	function veuse_parallax($atts, $content = null){
		
		extract(shortcode_atts(array(
			
			'image'	 => '',
			'content' => '',
			'padding_top' => '70',
			'padding_bottom' => '70',
			
		), $atts));
			
		
				
		ob_start();			
		require(veuse_uikit_locate_part('parallax-section'));
		$out = ob_get_contents();
		ob_end_clean();
				
		return $out;

	}
	
	add_shortcode("veuse_parallax", "veuse_parallax");
	*/
	
	
	
	/* Post list 
	================================================  */
	
	function veuse_postlist($atts, $content = null){
		
		extract(shortcode_atts(array(
			'categories'	=> '',
			'perpage'		=> '',
			'order'			=> 'DESC',
			'orderby'		=> 'title',
			'width'			=> 'width',
			'height'		=> 'height'
			
			), $atts));
			
			global $wp_query;
		
			query_posts(array(
	        	'post_type' => 'post',
	        	'showposts' => $perpage,
	        	'order' => $order,
	        	'orderby' 	=> $orderby,
	        	'category_name' => $categories
	        	)
        	);
			
			ob_start();
			require(veuse_uikit_locate_part('loop-postlist'));
			$content = ob_get_contents();
			ob_end_clean();
		
			return $content;

	}
	
	add_shortcode("veuse_postlist", "veuse_postlist");
	
	/* Post grid 
	================================================  */
	
	function veuse_postgrid($atts, $content = null){
		
		extract(shortcode_atts(array(
			'categories'	=> '',
			'perpage'		=> '',
			'order'			=> 'DESC',
			'orderby'		=> 'title',
			'width'			=> 'width',
			'height'		=> 'height',
			'grid'			=> '3'
			
			), $atts));
			
			global $wp_query;
		
			query_posts(array(
	        	'post_type' => 'post',
	        	'showposts' => $perpage,
	        	'order' => $order,
	        	'orderby' 	=> $orderby,
	        	'category_name' => $categories
	        	)
        	);
			
			ob_start();
			require(veuse_uikit_locate_part('loop-postgrid'));
			$content = ob_get_contents();
			ob_end_clean();
		
			return $content;

	}
	
	add_shortcode("veuse_postgrid", "veuse_postgrid");
	
	
	/* Testimonial 
	================================================  */
	
	function veuse_testimonial($atts, $content = null){
		
		extract(shortcode_atts(array(
			'name' 			=> '',
			'thumbnail'		=> '',
			'designation'	=> '',
			'style'			=> ''
			
			), $atts));
			
			
			
			ob_start();
			require(veuse_uikit_locate_part('testimonial'));
			$output = ob_get_contents();
			ob_end_clean();
			
			return $output;

	}
	
	add_shortcode("veuse_testimonial", "veuse_testimonial");
	
	
	/* Accordion 
	================================================  */
	
	function veuse_accordion($atts, $content = null){
				
			$output  = '<dl class="veuse-accordion">';
			$output .= do_shortcode($content);
			$output .= '</dl>';
			
			return $output;

	}
	
	add_shortcode("veuse_accordion", "veuse_accordion");
	
	
	


	/* Toggle 
	================================================  */
	
	if (!function_exists('veuse_toggle')) {
		function veuse_toggle( $atts, $content = null ) {
		    extract(shortcode_atts(array(
				'title'    	 => 'Title goes here',
				'icon'		 => '',
				'state'		=> ''
		    ), $atts));
		    
		    if(!empty($icon)) $iconclass = 'veuse-toggle-icon'; else $iconclass = '';
		
		
			ob_start();
			require(veuse_uikit_locate_part('toggle'));
			$output = ob_get_contents();
			ob_end_clean();
			
			
			return $output;
			
			
		}
		add_shortcode('veuse_toggle', 'veuse_toggle');
	}

	
	/* Tab
	================================================  */
	
	if (!function_exists('veuse_tab')) {
		function veuse_tab( $atts, $content = null ) {
		    extract(shortcode_atts(array(
				'title'    	 => 'Title goes here',
				'icon'		 => '',
				'state'		=> ''
		    ), $atts));
		    
		    if(!empty($icon)) $iconclass = 'veuse-tab-icon'; else $iconclass = '';
		
		
			ob_start();
			require(veuse_uikit_locate_part('tab-horisontal'));
			$output = ob_get_contents();
			ob_end_clean();
			
			
			return $output;
			
			
		}
		add_shortcode('veuse_tab', 'veuse_tab');
	}
	

	/*	Vertical Tab 
	================================================  */
	
	if (!function_exists('veuse_verticaltab')) {
		function veuse_verticaltab( $atts, $content = null ) {
		    extract(shortcode_atts(array(
				'title'    	 => 'Title goes here',
				'icon'		 => '',
				'state'		=> ''
		    ), $atts));
		    
		    if(!empty($icon)) $iconclass = 'veuse-verticaltab-icon'; else $iconclass = '';
				
			ob_start();
			require(veuse_uikit_locate_part('tab-vertical'));
			$output = ob_get_contents();
			ob_end_clean();
			
			return $output;
			
			
		}
		add_shortcode('veuse_verticaltab', 'veuse_verticaltab');
	}

	
	/* Iconbox 
	================================================  */
	
	function veuse_iconbox($atts, $content = null){
		
		extract(shortcode_atts(array(
			'icon' 			=> '',
			'title'			=> '',
			'text'			=> '',
			'href'			=> '',
			'buttontext'	=> '',
			'background'	=> '',
			'color'			=> '',
			'style'			=> '',
			'bordercolor'	=> ''
			
			), $atts));
		    
	    ob_start();
	    require(veuse_uikit_locate_part('iconbox'));
		$output = ob_get_contents();
		ob_end_clean();
		
		return $output;		
		
	}
	
	add_shortcode("veuse_iconbox", "veuse_iconbox");
	
	

	/* Responsive video 
	================================================  */

	function veuse_responsive_video($atts, $content = null){
		
		   global $wp_embed;
		
		   $out  = '<div class="video-container">';
		   $out .= $wp_embed->shortcode( $content );
		   $out .= '</div>';
			
		   return $out;

	}

	add_shortcode("veuse_video", "veuse_responsive_video");
	
	

	/* Google Maps Shortcode 
	================================================  */
	
	function veuse_googlemaps($atts, $content = null) {
	   extract(shortcode_atts(array(
	      "width" => '100%',
	      "height" => '300',
	      "src" => ''
	   ), $atts));
	   return '<iframe style="width:'.$width.';" height="'.$height.'" frameborder="0" scrolling="no" marginheight="0" marginwidth="0" src="'.$src.'&amp;output=embed"></iframe>';
	}
	
	add_shortcode("veuse_googlemap", "veuse_googlemaps");




	/* Searchform */
	function veuse_searchform($atts, $content = null) {
	
	   return get_search_form( false);
	}
	
	add_shortcode("veuse_searchform", "veuse_searchform");


/* Shortcodes are listed alphabetically */

	


	if(!function_exists('veuse_buttongroup_shortcode')){
		function veuse_buttongroup_shortcode( $atts, $content = null ) {
			extract(shortcode_atts(array(

		    ), $atts));
		 	$out = '<div class="button-group-wrapper">';
		  	$out.= do_shortcode($content);
			$out.= '</div>';

			return $out;
		}

		add_shortcode('buttongroup', 'veuse_buttongroup_shortcode');
		}


	/* Block grid */

	if(!function_exists('ceon_grid')){
	function ceon_grid( $atts, $content = null ) {
		extract(shortcode_atts(array(
	          'tiny' => 'one',
	          'small' => 'two',
	          'large' => 'four',
	          'position' => ''

	        ), $atts));



	   return '<ul class="tiny-block-grid-' . $tiny . ' small-block-grid-'.$small.' large-block-grid-'.$large.' ">' . do_shortcode(wpautop( $content) ). '</ul>';
	}

	add_shortcode('grid', 'ceon_grid');
	}


	if(!function_exists('ceon_grid_column')){
	function ceon_grid_column( $atts, $content = null ) {
		extract(shortcode_atts(array(
			'type' => '',
			'position' => ''
	        ), $atts));

		if(isset($position) && $position != '')
			$position =  'clearleft';

	   if($type=='panel')
	   return '<li><div class="panel">' . do_shortcode($content) . '</div></li>';
	   else
	   return '<li class=" ' . $position  . '">' . do_shortcode($content) . '</li>';
	}

	add_shortcode('grid_column', 'ceon_grid_column');
	add_shortcode('block', 'ceon_grid_column');

	}



	/* Gist shortcode */

	function veuse_gist_shortcode( $atts ) {
	   extract(shortcode_atts(array(
		   'id' => '',
		   'file' => ''
	   ), $atts));
	   return '<script src="https://gist.github.com/'.$id.'.js?file='.$file.'"></script>';
		}
	add_shortcode('gist', 'veuse_gist_shortcode');


	/* Nav-menu */

	if(!function_exists('veuse_navmenu')){
		function veuse_navmenu( $atts, $content = null ) {
			extract(shortcode_atts(array(
					'name' => ''
		    	), $atts));

				if(!empty($name)){

					$menu = wp_nav_menu( array(
							'menu'				=> $name,
							'menu_class'		=> 'pagemenu',
							'menu_id'			=> 'pagemenu-'.$name,
							'container'    		=> 'nav',
							'sort_column' 		=> 'menu_order',
							'echo'				=> false,
							'walker' 			=> new pagemenu_walker(),
							'depth'				=> 0
							)
						);
					}

				return $menu;
		}

		add_shortcode('menu', 'veuse_navmenu');
	}


	/* Icons */

	if(!function_exists('veuse_font_icon')){
	function veuse_font_icon( $atts, $content = null ) {

		global $options;

		extract(shortcode_atts(array(

				'type' 			=> '',
				'size' 			=> 'small',
				'color' 		=> '',
				'style' 		=> '', // sircle, ring, square
				'link' 			=> '',
				'class' 		=> '',
				'variant' 		=> '',
				'caption' 		=> '',
				'subcaption' 	=> '',
				'tooltip'		=> '',
				'width'			=> ''

	    ), $atts));
	    
	    if(!empty($tooltip)) $isset_tooltip = 'tip'; else $isset_tooltip = '';

	    $out='';
		if(!empty($caption) || !empty($subcaption)) $out .= '<span class="fa-icon-advanced">';
		if(!empty($link)) $out .= '<a href="' . $link . '">';
		$out .=  '<i class="fa fa-'.$type.' fa-'.$size.' fa-'.$style.' '.$class.' '.$variant.' '.$isset_tooltip.'" data-tip="'.$tooltip.'" style="color:'.$color.'; width:'.$width.'px;"></i>';
		if(!empty($caption)) $out .= '<span><span class="fa-icon-caption">'.$caption.'</span>';
		if(!empty($subcaption)) $out .= '<span class="fa-icon-subcaption">'.$subcaption.'</span></span>';
		if(!empty($link)) $out .= '</a>';
		if(!empty($caption) || !empty($subcaption)) $out .= '</span>';
		return $out;
	}

	add_shortcode('icon', 'veuse_font_icon');
	add_shortcode('veuse_icon', 'veuse_font_icon');
	}



	/**********************************
	 HORISONTAL RULER
	**********************************/
	if(!function_exists('ceon_ruler')){

		function ceon_ruler( $atts, $content = null ) {

		   return '<hr/>';
		}

		add_shortcode('ruler', 'ceon_ruler');
		add_shortcode('divider', 'ceon_ruler');
	}

	/**********************************
	 BREAK
	**********************************/
	if(!function_exists('veuse_clear')){
		function veuse_clear( $atts, $content = null ) {

		   return '<br class="break"/>';
		}

		add_shortcode('clear', 'veuse_clear');
	}


	/**********************************
	BLOCKQUOTES
	**********************************/
	if(!function_exists('ceon_insert_blockquote')){
	function ceon_insert_blockquote( $atts, $content = null ) {
	    extract(shortcode_atts(array(
	        'style' => '',
	        'align' => ''
	    ), $atts));


	   return '<blockquote class="'.$style.' '.$align.'">'.do_shortcode($content).'</blockquote>';
	}

	add_shortcode('blockquote', 'ceon_insert_blockquote');
	add_shortcode('quote', 'ceon_insert_blockquote');
	}


	/* Foundation classes */

	/**********************************
	 ROW
	**********************************/
	if(!function_exists('veuse_row')){

		function veuse_row( $atts, $content = null ) {

		   return '<div class="row">'. do_shortcode($content). '</div>';
		}

		add_shortcode('veuse_row', 'veuse_row');
	}

	/**********************************
	 COLUMS
	**********************************/
	if(!function_exists('veuse_column')){

		function veuse_column( $atts, $content = null ) {
			extract(shortcode_atts(array(
	        'small' => '',
	        'large' => '',
	        'visibility' => ''
	          ), $atts));
		   return '<div class="small-'. $small.' large-' . $large . ' ' . $visibility . ' columns">'. wpautop( do_shortcode($content) ) . '</div>';
		}

		add_shortcode('veuse_column', 'veuse_column');
	}



	/* Move to framework */


	if(!function_exists('veuse_section_container')){

	function veuse_section_container( $atts, $content = null ) {

		extract(shortcode_atts(array(
			'type' => 'auto'
	    ), $atts));

		$out = '<div class="section-container '.$type.'" data-section="' . $type . '">';
		$out .= do_shortcode($content);
		$out .= '</div>';

		return $out;

	}

	add_shortcode('section_container', 'veuse_section_container');
}


if(!function_exists('veuse_section')){

	function veuse_section( $atts, $content = null ) {

		extract(shortcode_atts(array(
			'title' => '',
		), $atts));

		$out = '<section class="section">';
		$out.= '<p class="title"><a href="#">'.$title.'</a></p>';
		$out.= '<div class="content" data-section-content>';
      	$out .= wpautop(do_shortcode($content));
		$out .= '</div></section>';

		return $out;

	}

	add_shortcode('section', 'veuse_section');
}





} // veuse_register_shortcodes

add_action('plugins_loaded','veuse_uikit_register_shortcodes');
?>