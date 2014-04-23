<?php

$thumb = wp_get_attachment_url( get_post_thumbnail_id());
			
echo '<li class="type-'.$post_type.'">';
if(has_post_thumbnail()){
	
	echo veuse_retina_interchange_image( $thumb, $width, $height, true);
}

echo '<div class="slide-caption"><div class="slide-inner-caption">';

if($title == true)
echo '<h3>'.the_title().'</h3>';

if($excerpt == true)
echo '<p>'.the_excerpt(). '</p>';

echo '</div></div>';
echo '</li>';

?>