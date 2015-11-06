<?php // Static Slider; ?>
<div id="featured_slider">
	<div class="slider_wrapper">
		<div id="static-slider" class="staticslider">
		<?php
		$pageslider = get_post_meta($post->ID,'page_slider', true);
		$width = '';
		if( get_option( 'atp_layoutoption' ) == 'boxed'){ $width = '1200';  }else{ $width = '1920';}

		if( $pageslider != '' ) {
			$src = get_post_meta($post->ID, 'staticimage', true);
			$link = esc_url( get_post_meta($post->ID, 'cimage_link', true));
		}else{
			$src = get_option( 'atp_static_image_upload' ); 
			$link = esc_url( get_option( 'atp_static_link' ) );
		}
		
		if( $link != '' ) {
			echo '<figure>'.atp_resize( '', $src, $width, '', '', '' ).'</figure>';
		}else {
			echo '<figure>'.atp_resize( '', $src, $width, '', '', '' ).'</figure>'; 
		}
		?>
		</div>
	</div>
</div>