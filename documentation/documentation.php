<style>
	#veuse-documentation-wrapper hr { margin: 40px 0;}
		#veuse-documentation-wrapper a { text-decoration: none;}
		#veuse-documentation-wrapper p {  }
		#veuse-documentation-wrapper ul { margin-bottom: 30px !important;}
		ul.inline-list { list-style: disc !important; list-style-position: inside;}
		ul.inline-list li { display: inline; margin-right: 10px; list-style: disc;}
		ul.inline-list li:after { content:'-'; margin-left: 10px; }
</style>

<div class="wrap about-wrap">
			
		<div id="veuse-documentation-wrapper" style="padding:20px 0; max-width:800px;">	
			<div class="icon32" id="icon-options-general"><br></div>
		<h2> <?php _e('Documentation','veuse-portfoliodocumentation');?></h2>
		
			<?php
		
		$docpath = '/documentation';
		
		if ( isset ( $_GET['tab'] ) ) $this->veuse_uikit_documentation_tabs($_GET['tab']); else $this->veuse_uikit_documentation_tabs('intro'); ?>
		
		<div id="veuse-documentation-wrapper" style="padding:20px 0; max-width:800px;">	
			
		
	
			
		<?php
		
		if ( isset ( $_GET['tab'] ) ) $tab = $_GET['tab']; else $tab = 'intro';
		

			
			switch ($tab ) {	
				
				
				case $tab :
				
					echo '<div>';
					
						include("pages/$tab.php");
										
					echo '</div>';
					
					break;
				
			} // end switch			
			

	
		?>
		</div>
		
		</div>
		
</div><!-- / .wrap -->
	