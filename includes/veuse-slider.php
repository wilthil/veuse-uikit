<?php

class VeuseSliders{

	private $pluginURI  = '';
	private $pluginPATH = '';
	
	function __construct(){
		
		$this->pluginURI  = plugin_dir_url(__FILE__) ;
		$this->pluginPATH = plugin_dir_path(__FILE__) ;
		
				
		add_action('init', array(&$this,'register_slider_posttype'));

		
		add_action('media_buttons_context',  array(&$this,'add_my_custom_button'));
		add_action( 'admin_footer',  array(&$this,'slider_popup_content' ));
		
		add_shortcode('veuse_slider', array(&$this,'veuse_slider'));
		
		//add_filter("manage_edit-veuse_slider_columns", array(&$this,"veuse_slider_columns"));

		
	}
		
	function register_slider_posttype() {

		$labels = array(
	        'name' => __( 'Slideshows', 'veuse-flexslider' ), // Tip: _x('') is used for localization
	        'singular_name' => __( 'Slideshow', 'veuse-flexslider' ),
	        'add_new' => __( 'Add New Slideshow', 'veuse-flexslider' ),
	        'add_new_item' => __( 'Add New Slideshow','veuse-flexslider' ),
	        'edit_item' => __( 'Edit Slideshow', 'veuse-flexslider' ),
	        'all_items' => __( 'All Slideshows','veuse-flexslider' ),
	        'new_item' => __( 'New Slideshow','veuse-flexslider' ),
	        'view_item' => __( 'View Slideshow','veuse-flexslider' ),
	        'search_items' => __( 'Search Slideshows','veuse-flexslider' ),
	        'not_found' =>  __( 'No Slideshows','veuse-flexslider' ),
	        'not_found_in_trash' => __( 'No Slideshows found in Trash','veuse-flexslider' ),
	        'parent_item_colon' => ''
	    );

		register_post_type('veuse_slider',
			array(
				'labels' => $labels,
				'public' => true,
				'show_ui' => true,
				'_builtin' => false, // It's a custom post type, not built in
				'_edit_link' => 'post.php?post=%d',
				'capability_type' => 'post',
				'hierarchical' => false,
				'rewrite' => array("slug" => "slideshow"), // Permalinks
				'query_var' => "slider", // This goes to the WP_Query schema
				'supports' => array('title'),
				'menu_position' => 30,
				'menu_icon' => 'dashicons-images-alt2',
				'publicly_queryable' => true,
				'exclude_from_search' => true,
				'show_in_nav_menus' => false,
				'show_in_menu'  => false
				)
			);
	}
		
	
		function veuse_slider_columns( $columns ){

			$columns = array(
				"cb" => "<input type=\"checkbox\" />",
				"title" => "Slideshow Title",
				"thumbnail" => "Featured image",
				//"exc" => "Excerpt",
				//"showcase" => "Showcase",
				"slides" => "Slides"
			);
		
			return $columns;
		
		}
			
				
		function veuse_slider_locate_part($file) {

		     if ( file_exists( get_stylesheet_directory().'/'.$file.'.php'))
		     	$filepath = get_stylesheet_directory().'/'.$file.'.php';
			 else
		        $filepath = $this->pluginPATH .$file.'.php';
	
			return $filepath;
		}
		
		
		
		
		function add_my_custom_button($context) {

			  //path to my icon
			  $img = $this->pluginURI.'assets/images/icon-slider-large.png';
			
			  //our popup's title
			  $title = 'Slider';
			
			  //append the icon
			  $context .= "<a href='#TB_inline?&width=640&height=600&inlineId=veuse-slider-popup&modal=false' class='thickbox' title='{$title}' style='width:24px; margin:0; padding:0 !important;'>
		    <img src='{$img}' style='width:24px !important; height:24px !important; margin:-1px 0 0 2px;'/></a>";
			
			  return $context;
			}
			
		function slider_popup_content() {
			?>
			 <style>
			 
			 	#TB_overlay { z-index: 9998 !important; }
			 	#TB_window { z-index: 9999 !important; }
			 
			 	/* new clearfix */
				.clearfix:after {
					visibility: hidden;
					display: block;
					font-size: 0;
					content: " ";
					clear: both;
					height: 0;
					}
				* html .clearfix             { zoom: 1; } /* IE6 */
				*:first-child+html .clearfix { zoom: 1; } /* IE7 */

			 	div.info { width:45%; float: right; margin:0; padding:0;}
			 	div.selector {width:50%; float: left;}
			 	div.info p { margin:0 0 3px !important; padding:0 !important;}
			 	div.info p.desc { color: #888;}
			 	
			  	form#veuse-slider-insert { margin:0; width: auto; padding: 0; display: block;}
			  	form#veuse-slider-insert p { margin-bottom: 8px;}
			  	form#veuse-slider-insert hr { border:0; border-top:1px solid #eee !important; margin:15px 0; background-color: #eee !important;}
			  	form#veuse-slider-insert > section { margin-bottom: 10px; /*border-bottom: 1px dotted #d4d4d4;*/}
			  
			    .selector select,
			    .selector input[type=text] { width:100%;}			  	
			  	.selector ul { margin:0; } 
			  	.selector ul li { display: inline-block;  margin:0; padding:0;}	  	
			  	.selector ul li a{ color:#606060 !important; display: inline-block; padding:4px 8px; background:#eee;  border:1px solid #fff; text-decoration: none;
				  	
				  	border-radius: 2px;
				  	-moz-border-radius: 2px;
				  	-webkit-border-radius: 2px;
				  	margin:0 2px 2px 0;
				  	
			  	}
			  	
			  	.selector.group ul li a{ 
				  	
				  	border-radius: 0px;
				  	-moz-border-radius: 0px;
				  	-webkit-border-radius: 0px;
				  	margin:0 -5px 2px 0;
				  	
			  	}
			  	
			  	.selector.group ul li:first-child a {
			  			border-radius: 2px 0 0 2px;
				  	-moz-border-radius: 2px 0 0 2px;
				  	-webkit-border-radius: 2px 0 0 2px;
			  	}
			  	
			  	.selector.group ul li:lase-child a {
			  			border-radius: 0 2px 2px 0;
				  	-moz-border-radius: 0 2px 2px 0;
				  	-webkit-border-radius: 0 2px 2px 0;
			  	}
			  	
			  	.selector ul li a.active {   	
				  	background: #2a95c5; border-color:#fff; color:#fff !important;
			  	}
			  	
			  	
			
			  
			 </style>
<div id="veuse-slider-popup" style="width:100%; height:100%; display:none;">
		
	  <h2><?php _e('Insert slideshow','veuse-slider');?></h2>
			  
	  <script>
	  
	  	jQuery(function($){
	  		
	  		jQuery('a.slider-selector-item').click(function(){
	  			$('#slider-selector a').removeClass('active');
	  			$(this).toggleClass('active');
	  			return false;
	  		});
	  		
	  		jQuery('#slider-autoplay-selector a').click(function(){
	  			$('#slider-autoplay-selector a').removeClass('active');
	  			$(this).addClass('active');
	  			return false;
	  		});
	  		
	  		jQuery('#slider-directionnav-selector a').click(function(){
	  			$('#slider-directionnav-selector a').removeClass('active');
	  			$(this).addClass('active');
	  			return false;
	  		});
	  		
	  		jQuery('#slider-controlnav-selector a').click(function(){
	  			$('#slider-controlnav-selector a').removeClass('active');
	  			$(this).addClass('active');
	  			return false;
	  		});
	  		
	  		


	  		 	  		
		  	jQuery('#insert-slider-shortcode').click(function(){
			  	
			  	var slidershortcode;					
			 						
				var slideshow = $('#slider-selector').val();	
				var height = $('#veuse-slider-height').val();
				var width = $('#veuse-slider-width').val();
				var speed = $('#veuse-slider-interval').val();
				
				var autoplay;
				if ($('#slider-autoplay-selector').find('a[data-id=true]').hasClass('active')){
					autoplay = 'true';
				} else {
					autoplay = 'false';
				}
				
				var controlnav;
				if ($('#slider-controlnav-selector').find('a[data-id=true]').hasClass('active')){
					controlnav = 'true';
				} else {
					controlnav = 'false';
				}
				
				var directionnav;
				if ($('#slider-directionnav-selector').find('a[data-id=true]').hasClass('active')){
					directionnav = 'true';
				} else {
					directionnav = 'false';
				}
				
				/*
				
				'autoheight' 	=> true,
				'interval' 		=> 5000,
				'autoplay' 		=> true,
				'animation' 	=> 'fade',
				'controlnav' 	=> true,
				'directionnav' 	=> true
				
				
				*/
					  		
			  	slidershortcode = '[veuse_slider id="' + slideshow + '" width="'+width+'" height="'+height+'" speed="'+speed+'" autoplay="'+autoplay+'" controlnav="'+controlnav+'" directionnav="'+directionnav+'" ]';
			  	tinyMCE.activeEditor.execCommand('mceInsertContent', false, slidershortcode);
			    tb_remove();
			  	return false;
		  	});
		  	
	  	});
	  
	  
	  
	  </script>
			  
	  
	  <form id="veuse-slider-insert" class="clearfix">
	 
		<hr>
	  	 <section class="clearfix">
			<div class="info">
				<p><strong><?php _e('Sliders','veuse-slider');?></strong></p>
				<p class="desc">Select slideshow to display</p>
			</div>
			<div class="selector">	
				 
				 <select id="slider-selector">
				 
	 			<?php $args = array(
						'posts_per_page'   => -1,
						'offset'           => 0,
						'orderby'          => 'post_date',
						'order'            => 'DESC',
						'post_type'        => 'veuse_slider',
						'post_status'      => 'publish',
						'suppress_filters' => true ); 
						
						
						$slideshows = get_posts($args);
						
						foreach($slideshows as $slideshow){
						
							echo '<option value="'.$slideshow->ID.'">'.$slideshow->post_title.'</option>';
						}
									
					?>
				 </select>
			 </div>
	  	</section>
		<hr>	
		
		<section class="clearfix">
			<div class="info">
				<p><strong><?php _e('Width','veuse-portfolio');?></strong></p>
				<p class="desc"><?php _e('Override the predefined slider width','veuse-portfolio');?></p>
			</div>
			<div class="selector">
			<input type="text" name="veuse-slider-width" id="veuse-slider-width" value="1000" />
			</div>
		</section>
		
	  	
	  	<hr>
	  	
	  	<section class="clearfix">
			<div class="info">
				<p><strong><?php _e('Height','veuse-portfolio');?></strong></p>
				<p class="desc"><?php _e('Override the predefined slider height','veuse-portfolio');?></p>
			</div>
			<div class="selector">
			<input type="text" name="veuse-slider-height" id="veuse-slider-height" value="500" />
			</div>
		</section>
		
		<hr>
		
		<section class="clearfix">
			<div class="info">
				<p><strong><?php _e('Interval','veuse-portfolio');?></strong></p>
				<p class="desc"><?php _e('Time between each slide in milliseconds. To turn off autoplay, enter 0','veuse-portfolio');?></p>
			</div>
			<div class="selector">
			<input type="text" name="veuse-slider-interval" id="veuse-slider-interval" value="7000"/>
			</div>
		</section>
	  	
	  	<hr>
	  	
	  	 <section class="clearfix">
			<div class="info">
			<p><strong><?php _e('Autoplay','veuse-portfolio');?></strong></p>
			<p class="desc">Select if you want the slideshow to run automatically.</p>
			</div>
			<div class="selector group">	
				<ul id="slider-autoplay-selector" class="clearfix">				
					<li><a href="#" class="slider-autoplay-selector-item active" data-id="true">Yes</a></li>
					<li><a href="#" class="slider-autoplay-selector-item" data-id="false">No</a></li>
				</ul>
			</div>
	  	</section>
	  	
	  	<hr>
	  	
	  	<section class="clearfix">
			<div class="info">
			<p><strong><?php _e('Show directional navigation','veuse-portfolio');?></strong></p>
			
			</div>
			<div class="selector group">	
				<ul id="slider-directionnav-selector" class="clearfix">				
					<li><a href="#" class="slider-directionnav-selector-item active" data-id="true">Yes</a></li>
					<li><a href="#" class="slider-directionnav-selector-item" data-id="false">No</a></li>
				</ul>
			</div>
	  	</section>
	  	
	  	<hr>
	  	
	  	<section class="clearfix">
			<div class="info">
			<p><strong><?php _e('Show controls navigation','veuse-portfolio');?></strong></p>
			
			</div>
			<div class="selector group">	
				<ul id="slider-controlnav-selector" class="clearfix">				
					<li><a href="#" class="slider-controlnav-selector-item active" data-id="true">Yes</a></li>
					<li><a href="#" class="slider-controlnav-selector-item" data-id="false">No</a></li>
				</ul>
			</div>
	  	</section>
	  	
	  	<hr>
	  				  		
		<input type="submit" class="button-primary" id="insert-slider-shortcode"  value="<?php _e('Insert shortcode') ?>" />	  
	  
	  </form>
	</div>
	<?php
	}
}

$veuse_slider = new VeuseSliders;




?>