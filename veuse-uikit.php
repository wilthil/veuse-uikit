<?php
/*

Plugin Name: Veuse UI Kit
Plugin URI: http://veuse.com/plugins/ui-kit
Description: A great collection of useful shortcodes and widgets for your theme.
Version: 1.0
Author: Andreas Wilthil
Author URI: http://veuse.com
License: GPL3
GitHub Plugin URI: https://github.com/veuse/veuse-uikit
*/


// Setup filters
add_filter('wp_editor_widget_content', 'wptexturize');
add_filter('wp_editor_widget_content', 'convert_smilies');
add_filter('wp_editor_widget_content', 'convert_chars');
add_filter('wp_editor_widget_content', 'wpautop');
add_filter('wp_editor_widget_content', 'shortcode_unautop');
add_filter('wp_editor_widget_content', 'prepend_attachment');
add_filter('wp_editor_widget_content', 'do_shortcode', 11);

class VeuseUikit {

	private $pluginURI  = '';
	private $pluginPATH = '';
	
	function __construct(){
		
		$this->pluginURI  = plugin_dir_url(__FILE__) ;
		$this->pluginPATH = plugin_dir_path(__FILE__) ;
		
		add_action('wp_enqueue_scripts', array(&$this,'veuse_uikit_enqueue_styles'), 100);
		add_action('admin_enqueue_scripts', array(&$this,'veuse_uikit_enqueue_admin_script'));
		add_action('plugins_loaded', array(&$this,'veuse_uikit_load_textdomain'));
		
		add_action('admin_head', array(&$this, 'widgets_admin_page'), 100);		
		
		add_action( 'admin_menu', array(&$this,  'register_menu_page' ),11);
		
		
		
		/* Veuse Slider */
		require $this->pluginPATH . 'includes/veuse-slider.php';	
		
		/* Pricetable */
		require $this->pluginPATH . 'includes/veuse-pricetable.php';		
		
		/* Include widgets */
		require 'shortcodes.php';
		
		/* Include widgets */
		
		require 'views/back/widgets/page-widget.php';
		require 'views/back/widgets/image-widget-2.php';
		require 'views/back/widgets/download-widget.php';
		require 'views/back/widgets/divider-widget.php';		
		require 'views/back/widgets/callout-widget.php';
		require 'views/back/widgets/toggle-widget.php';
		require 'views/back/widgets/tab-widget.php';
		require 'views/back/widgets/verticaltab-widget.php';
		require 'views/back/widgets/alert-widget.php';
		require 'views/back/widgets/button-widget.php';
		require 'views/back/widgets/iconbox-widget.php';
		require 'views/back/widgets/testimonial-widget.php';
		require 'views/back/widgets/postslider-widget.php';
		require 'views/back/widgets/posts-widget.php';
		require 'views/back/widgets/posts-grid-widget.php';
		require 'views/back/widgets/progressbar-widget.php';
		require 'views/back/widgets/slider-widget.php';
		
		/* Add theme support */
		add_post_type_support('page', 'excerpt'); // Enable excerpts on pages
		
		require_once $this->pluginPATH . 'views/back/meta-panels/slider-meta.php';
		require_once $this->pluginPATH . 'views/back/meta-panels/priceitem-meta.php';
		
	
	}
	
	
	

	function register_menu_page(){
	     
	     add_menu_page( 'Veuse Uikit Settings', 'Veuse Uikit', 'edit_posts', 'veuse-uikit', array(&$this, 'add_settings_page'), 'dashicons-desktop' , '99' );
	     add_submenu_page( 'veuse-uikit' , 'Slideshows', 'Slideshows', 'edit_posts', 'edit.php?post_type=veuse_slider', '');
		 //add_submenu_page( 'veuse-uikit' , 'Pricetables', 'Pricetables', 'edit_posts', 'edit-tags.php?taxonomy=pricetable', '');
	     add_submenu_page( 'veuse-uikit' , 'Pricetable', 'Pricetable', 'edit_posts', 'edit.php?post_type=priceitem', '');  
	     add_submenu_page( 'veuse-uikit' , 'Documentation', 'Documentation', 'edit_posts', 'veuse-uikit-documentation', array(&$this, 'add_documentation_page'));
	     
	      //add_submenu_page( $parent_slug, $page_title, $menu_title, $capability, $menu_slug, $function );
	}
	
	function get_documentation_tabs(){
	
		 $tabs = array( 
	    	
	    	'intro' 		=> __('Intro','veuse-uikit'), 
	    	'slideshow' 	=> __('Slideshows','veuse-uikit'), 
	    	'pricetable'	=> __('Pricetables','veuse-uikit'),
	    	'shortcodes'	=> __('Shortcodes','veuse-uikit'),
	    	
	    	);
	    	
	    return $tabs;
	}
	
	function veuse_uikit_documentation_tabs( $current = 'intro' ) {

	    $tabs = $this->get_documentation_tabs();  
	     
	    echo '<h3 class="nav-tab-wrapper" style="padding-left:0; border-bottom:0;">';
	    foreach( $tabs as $tab => $name ){
	        $class = ( $tab == $current ) ? ' nav-tab-active' : '';
	        echo "<a class='nav-tab$class' style='padding-top:6px; margin:0px -1px -1px 0; border:1px solid #ccc;' href='?page=veuse-uikit-documentation&tab=$tab'>$name</a>";
	
	    }
	    echo '</h3>';
	}
	
	function add_settings_page(){
		?>
		<div class="wrap">

		<div class="icon32" id="icon-options-general"><br></div>
		<h2> <?php _e('Info','veuse-portfoliodocumentation');?></h2>
		<p><?php
			
			echo __( 'Here you find instructions on how to use the %s plugin. For more in-depth info, please check out http://veuse.com/support.');?>
		</p>
		</div>
		
		
		<?php
	}
	
	
	
	function add_documentation_page(){
		
		include_once $this->pluginPATH . 'documentation/documentation.php';
	}
	
	
	/* Enqueue scripts */
	
	function veuse_uikit_enqueue_styles() {

		wp_register_style( 'veuse-uikit-styles',  $this->pluginURI . 'assets/css/veuse-uikit.css', array(), '', 'screen' );
		wp_enqueue_style ( 'veuse-uikit-styles' );
		
		wp_register_style( 'font-awesome',  $this->pluginURI  . 'assets/css/font-awesome.css', array(), '', 'all' );
		wp_enqueue_style ( 'font-awesome' );
		
		wp_register_style( 'flexslider-css',  $this->pluginURI . 'assets/css/flexslider.css', array(), '', 'screen' );
	    wp_enqueue_style ( 'flexslider-css' );
		
	
		wp_enqueue_script('veuse_uikit_js', $this->pluginURI  . 'assets/js/veuse-uikit.js', array('jquery'), '', false);
		
		wp_enqueue_script('owl', $this->pluginURI . 'assets/js/owl.carousel.min.js', array('jquery'), '', true);
		wp_enqueue_script('flexslider', $this->pluginURI . 'assets/js/jquery.flexslider-min.js', array('jquery'), '', true);
		
		

	}
	
	/* Enqueue scripts */
	
	function veuse_uikit_enqueue_admin_script() {
	
		wp_enqueue_script( 'jquery-ui-sortable' );
	
		/* CSS */
		wp_register_style( 'slideshow-builder',  $this->pluginURI . 'assets/css/slideshow-builder.css', array(), '', 'screen' );
	    wp_enqueue_style ( 'slideshow-builder' );
	    
	    
	    wp_register_style( 'wp-editor-widget-css',  $this->pluginURI . 'assets/css/parallax-widget.css', array(), '', 'screen' );
		wp_enqueue_style ( 'wp-editor-widget-css' );
		
		/* Javascript */
		if(function_exists( 'wp_enqueue_media' )){
			wp_enqueue_media();
		}
				
        wp_enqueue_script('media-upload');
		
		wp_enqueue_script('veuse_uikit-admin-js', $this->pluginURI  . 'assets/js/veuse-uikit-admin.js', array('jquery'), '', true);
		
		
		//wp_register_script('wp-editor-widget-js', $this->pluginURI  . 'assets/js/parallax-widget.js', array('jquery'), '', true);
		//wp_enqueue_script('wp-editor-widget-js');
		
		
		
		
        
        
	}
	
	/* Localization
	============================================= */
	
	function veuse_uikit_load_textdomain() {
	    load_plugin_textdomain('veuse-uikit', false, dirname(plugin_basename(__FILE__)) . '/languages');
	    
	    
	}
	
	
	/**
	 * Action: widgets_admin_page
	 */
	function widgets_admin_page() {
		?>
		<div id="wp-editor-widget-container" style="display: none;">
			<a class="close" href="javascript:WPEditorWidget.hideEditor();" title="<?php esc_attr_e('Close', 'veuse-uikit'); ?>"><span class="icon"></span></a>
			<div class="editor">
				<?php
				$settings = array(
					'textarea_rows' => 15
				);
				wp_editor('', 'wp-editor-widget', $settings);
				?>
				<p>
					<a href="javascript:WPEditorWidget.updateWidgetAndCloseEditor(true);" class="button button-primary"><?php _e('Save and close', 'veuse-uikit'); ?></a>
				</p>
			</div>
		</div>
		<div id="wp-editor-widget-backdrop" style="display: none;"></div>
		<?php
	}
	
	
}

$uikit = new VeuseUikit;


/* Include github updater */
		require 'updater/github-updater.php';

/* Find template part

Makes it possible to override the files with
a custom theme file.php

============================================ */

function veuse_uikit_locate_part($file) {
	
	/* Check stylesheet directory */
	
	if ( file_exists( get_stylesheet_directory().'/veuse-uikit/'. $file .'.php'))
	   	$filepath = get_stylesheet_directory().'/veuse-uikit/'. $file .'.php';
	
	if ( file_exists( get_stylesheet_directory().'/'. $file .'.php'))
	   	$filepath = get_stylesheet_directory().'/'. $file .'.php';
	
	else
		$filepath = plugin_dir_path(__FILE__).'views/front/'.$file.'.php';
	
	return $filepath;
}
	
/* Insert retina image */

if(!function_exists('veuse_retina_interchange_image')){

	function veuse_retina_interchange_image($img_url, $width, $height, $crop){

		$imagepath = '<img src="'. mr_image_resize($img_url, $width, $height, $crop, 'c', false) .'" data-interchange="['. mr_image_resize($img_url, $width, $height, $crop, 'c', true) .', (retina)]" alt=""/>';
	
		return $imagepath;
	
	}
}

/**
  *  Resizes an image and returns the resized URL. Uses native WordPress functionality.
  *
  *  The function supports GD Library and ImageMagick. WordPress will pick whichever is most appropriate.
  *  If none of the supported libraries are available, the function will return the original image url.
  *
  *  Images are saved to the WordPress uploads directory, just like images uploaded through the Media Library.
  * 
  *  Supports WordPress 3.5 and above.
  * 
  *  Based on resize.php by Matthew Ruddy (GPLv2 Licensed, Copyright (c) 2012, 2013)
  *  https://github.com/MatthewRuddy/Wordpress-Timthumb-alternative
  * 
  *  License: GPLv2
  *  http://www.gnu.org/licenses/gpl-2.0.html
  *
  *  @author Ernesto MŽndez (http://der-design.com)
  *  @author Matthew Ruddy (http://rivaslider.com)
  */

if(!function_exists('mr_image_resize')){

	add_action('delete_attachment', 'mr_delete_resized_images');
	
	function mr_image_resize($url, $width=null, $height=null, $crop=true, $align='c', $retina=false) {
	
	  global $wpdb;
	
	  // Get common vars
	  $args = func_get_args();
	  $common = mr_common_info($args);
	
	  // Unpack vars if got an array...
	  if (is_array($common)) extract($common);
	
	  // ... Otherwise, return error, null or image
	  else return $common;
	
	  if (!file_exists($dest_file_name)) {
	
	    // We only want to resize Media Library images, so we can be sure they get deleted correctly when appropriate.
	    $query = $wpdb->prepare("SELECT * FROM $wpdb->posts WHERE guid='%s'", $url);
	    $get_attachment = $wpdb->get_results($query);
	
	    // Load WordPress Image Editor
	    $editor = wp_get_image_editor($file_path);
	    
	    // Print possible wp error
	    if (is_wp_error($editor)) {
	      if (is_user_logged_in()) print_r($editor);
	      return null;
	    }
	
	    if ($crop) {
	
	      $src_x = $src_y = 0;
	      $src_w = $orig_width;
	      $src_h = $orig_height;
	
	      $cmp_x = $orig_width / $dest_width;
	      $cmp_y = $orig_height / $dest_height;
	
	      // Calculate x or y coordinate and width or height of source
	      if ($cmp_x > $cmp_y) {
	
	        $src_w = round ($orig_width / $cmp_x * $cmp_y);
	        $src_x = round (($orig_width - ($orig_width / $cmp_x * $cmp_y)) / 2);
	
	      } else if ($cmp_y > $cmp_x) {
	
	        $src_h = round ($orig_height / $cmp_y * $cmp_x);
	        $src_y = round (($orig_height - ($orig_height / $cmp_y * $cmp_x)) / 2);
	
	      }
	
	      // Positional cropping. Uses code from timthumb.php under the GPL
	      if ($align && $align != 'c') {
	        if (strpos ($align, 't') !== false) {
	          $src_y = 0;
	        }
	        if (strpos ($align, 'b') !== false) {
	          $src_y = $orig_height - $src_h;
	        }
	        if (strpos ($align, 'l') !== false) {
	          $src_x = 0;
	        }
	        if (strpos ($align, 'r') !== false) {
	          $src_x = $orig_width - $src_w;
	        }
	      }
	      
	      // Crop image
	      $editor->crop($src_x, $src_y, $src_w, $src_h, $dest_width, $dest_height);
	
	    } else {
	     
	      // Just resize image
	      $editor->resize($dest_width, $dest_height);
	     
	    }
	
	    // Save image
	    $saved = $editor->save($dest_file_name);
	    
	    // Print possible out of memory error
	    if (is_wp_error($saved)) {
	      @unlink($dest_file_name);
	      if (is_user_logged_in()) print_r($saved);
	      return null;
	    }
	
	    // Add the resized dimensions and alignment to original image metadata, so the images
	    // can be deleted when the original image is delete from the Media Library.
	    if ($get_attachment) {
	      $metadata = wp_get_attachment_metadata($get_attachment[0]->ID);
	      if (isset($metadata['image_meta'])) {
	        $md = $saved['width'] . 'x' . $saved['height'];
	        if ($crop) $md .= ($align) ? "_${align}" : "_c";
	        $metadata['image_meta']['resized_images'][] = $md;
	        wp_update_attachment_metadata($get_attachment[0]->ID, $metadata);
	      }
	    }
	
	    // Resized image url
	    $resized_url = str_replace(basename($url), basename($saved['path']), $url);
	
	  } else {
	
	    // Resized image url
	    $resized_url = str_replace(basename($url), basename($dest_file_name), $url);
	
	  }
	
	  // Return resized url
	  return $resized_url;
	
	}
	
	// Returns common information shared by processing functions
	
	function mr_common_info($args) {
	
	  // Unpack arguments
	  list($url, $width, $height, $crop, $align, $retina) = $args;
	  
	  // Return null if url empty
	  if (empty($url)) {
	    return is_user_logged_in() ? "image_not_specified" : null;
	  }
	
	  // Return if nocrop is set on query string
	  if (preg_match('/(\?|&)nocrop/', $url)) {
	    return $url;
	  }
	  
	  // Get the image file path
	  $urlinfo = parse_url($url);
	  $wp_upload_dir = wp_upload_dir();
	  
	  if (preg_match('/\/[0-9]{4}\/[0-9]{2}\/.+$/', $urlinfo['path'], $matches)) {
	    $file_path = $wp_upload_dir['basedir'] . $matches[0];
	  } else {
	    return $url;
	  }
	  
	  // Don't process a file that doesn't exist
	  if (!file_exists($file_path)) {
	    return null; // Degrade gracefully
	  }
	  
	  // Get original image size
	  $size = @getimagesize($file_path);
	
	  // If no size data obtained, return error or null
	  if (!$size) {
	    return is_user_logged_in() ? "getimagesize_error_common" : null;
	  }
	
	  // Set original width and height
	  list($orig_width, $orig_height, $orig_type) = $size;
	
	  // Generate width or height if not provided
	  if ($width && !$height) {
	    $height = floor ($orig_height * ($width / $orig_width));
	  } else if ($height && !$width) {
	    $width = floor ($orig_width * ($height / $orig_height));
	  } else if (!$width && !$height) {
	    return $url; // Return original url if no width/height provided
	  }
	
	  // Allow for different retina sizes
	  $retina = $retina ? ($retina === true ? 2 : $retina) : 1;
	
	  // Destination width and height variables
	  $dest_width = $width * $retina;
	  $dest_height = $height * $retina;
	
	  // Some additional info about the image
	  $info = pathinfo($file_path);
	  $dir = $info['dirname'];
	  $ext = $info['extension'];
	  $name = wp_basename($file_path, ".$ext");
	
	  // Suffix applied to filename
	  $suffix = "${dest_width}x${dest_height}";
	
	  // Set align info on file
	  if ($crop) {
	    $suffix .= ($align) ? "_${align}" : "_c";
	  }
	
	  // Get the destination file name
	  $dest_file_name = "${dir}/${name}-${suffix}.${ext}";
	  
	  // Return info
	  return array(
	    'dir' => $dir,
	    'name' => $name,
	    'ext' => $ext,
	    'suffix' => $suffix,
	    'orig_width' => $orig_width,
	    'orig_height' => $orig_height,
	    'orig_type' => $orig_type,
	    'dest_width' => $dest_width,
	    'dest_height' => $dest_height,
	    'file_path' => $file_path,
	    'dest_file_name' => $dest_file_name,
	  );
	
	}
	
	// Deletes the resized images when the original image is deleted from the WordPress Media Library.
	
	function mr_delete_resized_images($post_id) {
	
	  // Get attachment image metadata
	  $metadata = wp_get_attachment_metadata($post_id);
	  
	  // Return if no metadata is found
	  if (!$metadata) return;
	
	  // Return if we don't have the proper metadata
	  if (!isset($metadata['file']) || !isset($metadata['image_meta']['resized_images'])) return;
	  
	  $wp_upload_dir = wp_upload_dir();
	  $pathinfo = pathinfo($metadata['file']);
	  $resized_images = $metadata['image_meta']['resized_images'];
	  
	  // Delete the resized images
	  foreach ($resized_images as $dims) {
	
	    // Get the resized images filename
	    $file = $wp_upload_dir['basedir'] . '/' . $pathinfo['dirname'] . '/' . $pathinfo['filename'] . '-' . $dims . '.' . $pathinfo['extension'];
	
	    // Delete the resized image
	    @unlink($file);
	
		}
    }
}


/* Enable excerpts for pages. Needed for the featured page shortcode */


?>