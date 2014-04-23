<?php

/* Post meta
=========================================================== */

add_action( 'add_meta_boxes', 'veuse_priceitem_metabox' );

function veuse_priceitem_metabox()
{
	add_meta_box( 'veuse_priceitem_meta', __('Price Items','veuse-priceitem'), 'veuse_priceitem_meta_box_panel', 'priceitem', 'normal', 'high' );
	
}

function veuse_priceitem_meta_box_panel( $post )
{
	$prefix = 'veuse_priceitem';

	$values = get_post_custom( $post->ID );

	$currency = isset( $values[$prefix.'_currency'] ) ?  $values[$prefix.'_currency'][0]  : '';
	$price = isset( $values[$prefix.'_price'] ) ? esc_attr( $values[$prefix.'_price'][0] ) : '';
	$period 	  = isset( $values[$prefix.'_period'] ) ? esc_attr( $values[$prefix.'_period'][0] ) : '';
	$bullets 	  = isset( $values[$prefix.'_bullets'] ) ? esc_attr( $values[$prefix.'_bullets'][0] ) : '';	
	$featured 	  = isset( $values[$prefix.'_featured'] ) ? esc_attr( $values[$prefix.'_featured'][0] ) : '';
	$button_text 	  = isset( $values[$prefix.'_button_text'] ) ? esc_attr( $values[$prefix.'_button_text'][0] ) : '';
	$button_href 	  = isset( $values[$prefix.'_button_href'] ) ? esc_attr( $values[$prefix.'_button_href'][0] ) : '';
	$ribbon_text 	  = isset( $values[$prefix.'_ribbon_text'] ) ? esc_attr( $values[$prefix.'_ribbon_text'][0] ) : '';
	$ribbon_color 	  = isset( $values[$prefix.'_ribbon_color'] ) ? esc_attr( $values[$prefix.'_ribbon_color'][0] ) : '';

	wp_nonce_field( 'veuse_priceitem_nonce', 'meta_box_nonce' );?>

	<div class="inside">
		<table class="" width="100%" cellpadding="5">
			<tbody>
				<tr>
					<td colspan="2" style="padding-top:12px">
							<div id="titlediv"><div id="titlewrap">
							<label for="post_title" id="title-prompt-text"><?php echo empty($post->post_title) ? __('Title','veuse-priceitem') :''; ?></label>
							<input type="text" name="post_title" id="title" value="<?php echo isset($post->post_title) ? $post->post_title :''; ?>" size="60"/></div></div>
				
							
						
					</td>
				</tr>
				
				
				<tr>
					<th valign="top" scope="row" style="text-align:left"><label for="<?php echo $prefix;?>_featured"><?php _e('Featured product','veuse-priceitem');?></label></th>
					<td>	
							<input type="checkbox" name="<?php echo $prefix;?>_featured" id="<?php echo $prefix;?>_featured" <?php echo (isset($featured) && $featured == 'on') ? 'checked="checked"' : '';?>/>							
					</td>
				</tr>
				
				
				<tr>
					<th scope="row" style="text-align:left"><label for="<?php echo $prefix;?>_email"><?php _e('Price Info','veuse-priceitem');?></label></th>
					<td>
						
						
							<span class=""><?php _e('Currency symbol','veuse-priceitem');?> </span><input type="text" name="<?php echo $prefix;?>_currency" id="<?php echo $prefix;?>_currency" value="<?php echo $currency; ?>" size="1"/>
							<span class=""><?php _e('Price','veuse-priceitem');?> </span><input type="text" name="<?php echo $prefix;?>_price" id="<?php echo $prefix;?>_price" value="<?php echo $price; ?>" size="4"/>
							<span class=""><?php _e('Period','veuse-priceitem');?> </span><input type="text" name="<?php echo $prefix;?>_period" id="<?php echo $prefix;?>_period" value="<?php echo $period; ?>" size="10"/>
							
						
					</td>
				</tr>
				
				<tr>
					<th valign="top" scope="row" style="text-align:left"><label for="<?php echo $prefix;?>_email"><?php _e('Description','veuse-priceitem');?></label></th>
					<td>	
							<textarea type="text" name="post_excerpt" id="post_excerpt" style="width:100%;" rows="3"><?php echo $post->post_excerpt; ?></textarea>
							
					</td>
				</tr>
				
				<tr>
					<td colspan="2"><h2><?php _e('Bullets','veuse-priceitem');?></h2></td>
				</tr>
				
				
				<tr>
					<th valign="top" scope="row" style="text-align:left"><label for="<?php echo $prefix;?>_bullets"><?php _e('Bullets','veuse-priceitem');?></label></th>
					<td>	
							<textarea type="text" name="<?php echo $prefix;?>_bullets" id="<?php echo $prefix;?>_bullets" style="width:100%;" rows="3"><?php echo $bullets;?></textarea>
							<div class="description"><?php _e('Separate by comma','veuse-priceitem');?></div>
							
					</td>
				</tr>
			
				
				
				<tr>
					<td colspan="2"><h2><?php _e('Button','veuse-priceitem');?></h2></td>
				</tr>
			
				<tr>
					<th scope="row" style="text-align:left"><label for="<?php echo $prefix;?>_button_text"><?php _e('Button text','veuse-priceitem');?></label></th>
					<td><input type="text" name="<?php echo $prefix;?>_button_text" id="<?php echo $prefix;?>_button_text" value="<?php echo $button_text; ?>" size="30"/>
					<span class="description"><?php _e('Text for the button','veuse-priceitem');?></span></td>
				</tr>
			
				<tr>
					<th scope="row" style="text-align:left"><label for="<?php echo $prefix;?>_button_href"><?php _e('Button href','veuse-priceitem');?></label></th>
					<td><input type="text" name="<?php echo $prefix;?>_button_href" id="<?php echo $prefix;?>_button_href" value="<?php echo $button_href; ?>" size="30"/>
					<span class="description"><?php _e('Enter the url for the button','veuse-priceitem');?></span></td>
				</tr>
			
				<tr>
					<th scope="row" style="text-align:left"><label for="<?php echo $prefix;?>_ribbon_text"><?php _e('Ribbon text','veuse-priceitem');?></label></th>
					<td><input type="text" name="<?php echo $prefix;?>_ribbon_text" id="<?php echo $prefix;?>_ribbon_text" value="<?php echo $ribbon_text; ?>" size="30"/>
					<span class="description"><?php _e('Text for ribbon','veuse-priceitem');?></span></td>
				</tr>
				
				
				<tr>
					<th scope="row" style="text-align:left"><label for="<?php echo $prefix;?>_ribbon_color"><?php _e('Ribbon color','veuse-priceitem');?></label></th>
					<td>
					<select name="<?php echo $prefix;?>_ribbon_color" id="<?php echo $prefix;?>_ribbon_color">
						<option value="blue-light" <?php selected( $ribbon_color, 'blue-light' ); ?>><?php _e('Light blue','veuse-priceitem');?></option>
						<option value="yellow" <?php selected( $ribbon_color, 'yellow' ); ?>><?php _e('Yellow','veuse-priceitem');?></option>
						<option value="red"  <?php selected( $ribbon_color, 'red' ); ?>><?php _e('Red','veuse-priceitem');?></option>
						<option value="green"  <?php selected( $ribbon_color, 'green' ); ?>><?php _e('Green','veuse-priceitem');?></option>
						<option value="blue"  <?php selected( $ribbon_color, 'blue' ); ?>><?php _e('Blue','veuse-priceitem');?></option>
						<option value="black"  <?php selected( $ribbon_color, 'black' ); ?>><?php _e('Black','veuse-priceitem');?></option>
					</select>
				</tr>
			
				
			</tbody>
		</table>
	</div>
<?php }
	
	
add_action( 'save_post', 'veuse_priceitem_save_meta_box',2 );


function veuse_priceitem_save_meta_box( $post_id ){

	$prefix = 'veuse_priceitem';

	// Bail if we're doing an auto save
	if( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) return;

	// if our nonce isn't there, or we can't verify it, bail
	if( !isset( $_POST['meta_box_nonce'] ) || !wp_verify_nonce( $_POST['meta_box_nonce'], 'veuse_priceitem_nonce' ) ) return;

	// if our current user can't edit this post, bail
	if( !current_user_can( 'edit_posts' ) ) return;
	
	

	// now we can actually save the data
	/*
	
		$allowed = array(
		'a' => array( // on allow a tags
		'href' => array() // and those anchors can only have href attribute
		)
	);
	*/
	
	$meta_entries = array(
	
	
		'_price', 
		'_currency',
		'_period',
		'_bullets',
		'_featured',
		'_ribbon_text',
		'_button_text',
		'_button_href',
		'_ribbon_color'
	
	);
	
	foreach($meta_entries as $meta ) {
	
		if( isset( $_POST[$prefix.$meta] ) )
		update_post_meta( $post_id, $prefix.$meta,  esc_attr( $_POST[$prefix.$meta] ));
		else 
		delete_post_meta( $post_id, $prefix.$meta);
	}
}