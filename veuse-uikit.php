<?php
/*

Plugin Name: Veuse UI Kit
Plugin URI: http://veuse.com/plugins/ui-kit
Description: A great collection of useful shortcodes and widgets for your theme.
Version: 1.0
Author: Andreas Wilthil
Author URI: http://veuse.com
License: GPL3

*/


// Setup actions
//add_action('init', array('VeuseUikit', 'init'));
//add_action('admin_init', array('VeuseUikit', 'admin_init'));
//add_action('plugins_loaded', array('VeuseUikit', 'plugins_loaded'));

//add_action('widgets_init', array('VeuseUikit', 'widgets_init'));
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
		
		/* Include github updater */
		require 'updater/github-updater.php';
		
		/* Include widgets */
		require 'shortcodes.php';
		
		/* Include widgets */
		
		require 'widgets/page-widget.php';
		require 'widgets/image-widget-2.php';
		//require 'widgets/parallax-widget.php'; // Beta
		require 'widgets/download-widget.php';
		require 'widgets/divider-widget.php';		
		require 'widgets/callout-widget.php';
		require 'widgets/toggle-widget.php';
		require 'widgets/tab-widget.php';
		require 'widgets/verticaltab-widget.php';
		require 'widgets/alert-widget.php';
		require 'widgets/button-widget.php';
		require 'widgets/iconbox-widget.php';
		require 'widgets/testimonial-widget.php';
		require 'widgets/postslider-widget.php';
		require 'widgets/posts-widget.php';
		require 'widgets/posts-grid-widget.php';
		require 'widgets/progressbar-widget.php';
				
	}
	
	
	/* Enqueue scripts */
	
	function veuse_uikit_enqueue_styles() {

		wp_register_style( 'veuse-uikit_css',  $this->pluginURI . 'assets/css/veuse-uikit.css', array(), '', 'screen' );
		wp_enqueue_style ( 'veuse-uikit_css' );
		
		wp_register_style( 'font-awesome',  $this->pluginURI  . 'assets/css/font-awesome.css', array(), '', 'all' );
		wp_enqueue_style ( 'font-awesome' );
		
		//wp_register_style( 'flexslider-css',  $this->pluginURI . 'assets/css/flexslider.css', array(), '', 'screen' );
	    //wp_enqueue_style ( 'flexslider-css' );
		
		wp_enqueue_script('veuse_uikit_js', $this->pluginURI  . 'assets/js/veuse-uikit.js', array('jquery'), '', false);
		
		wp_enqueue_script('flexslider', $this->pluginURI . 'assets/js/jquery.flexslider-min.js', array('jquery'), '', true);

	}
	
	/* Enqueue scripts */
	
	function veuse_uikit_enqueue_admin_script() {
		
		wp_enqueue_script('veuse_uikit-admin-js', $this->pluginURI  . 'assets/js/veuse-uikit-admin.js', array('jquery'), '', true);
		
		wp_register_script('wp-editor-widget-js', $this->pluginURI  . 'assets/js/parallax-widget.js', array('jquery'), '', true);
		wp_enqueue_script('wp-editor-widget-js');
		
		wp_register_style( 'wp-editor-widget-css',  $this->pluginURI . 'assets/css/parallax-widget.css', array(), '', 'screen' );
		wp_enqueue_style ( 'wp-editor-widget-css' );
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



/* Find template part

	Makes it possible to override the files with
	a custom theme file.php
	
	============================================ */
	
	function veuse_uikit_locate_part($file) {
		
		/* Check stylesheet directory */
		
		if ( file_exists( get_stylesheet_directory().'/'. $file .'.php'))
		   	$filepath = get_stylesheet_directory().'/'. $file .'.php';
		
		else
			$filepath = 'views/front/'.$file.'.php';
		
		return $filepath;
	}
?>