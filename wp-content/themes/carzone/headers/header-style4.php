<?php
/* Header Style4 */

global $post;
$cssextras  = $subheader_properties = '';
$sh_bg_properties 	= get_post_meta( $post->ID,'subheader_img', true );
$subheaderpadding   = get_post_meta( $post->ID,'sh_padding',true); 
$sh_padding 		= $subheaderpadding 		? 'padding:'.$subheaderpadding.';':'';

if( is_array( $sh_bg_properties ) && !empty( $sh_bg_properties['0']['image'] ) ) {
	$subheader_properties = 'background:url('.$sh_bg_properties['0']['image'].') '.$sh_bg_properties['0']['position'].' '.$sh_bg_properties['0']['repeat'].' '.$sh_bg_properties['0']['attachement'].' '.$sh_bg_properties['0']['color'].';';
} elseif( is_array($sh_bg_properties) && !empty($sh_bg_properties['0']['color']) ) {
	$subheader_properties = 'background-color:'.$sh_bg_properties['0']['color'].';';
} elseif( !is_array($sh_bg_properties)  && $sh_bg_properties !='' ){	
	$subheader_properties  = 'background:url('.$sh_bg_properties.');';
}
$cssextras = ( $subheader_properties != '' || $sh_padding != ''  ) ? ' style="'.$subheader_properties.$sh_padding.'"' : '';
$frontpageid = $post->ID;
$pageslider = get_post_meta( $frontpageid, 'page_slider', true );
if( !is_front_page() || $pageslider != '' ){
	echo '<div class="header_section" '.$cssextras .'>';
}?>

<div class="header_wrapper">
	<header class="header-style4">
		<div class="header">			
			<div class="header-area">
				<div class="logo">
					<?php atp_generator( 'atp_light_logo' ); ?>
				</div><!-- /logo -->

				<div class="header-rightpart">

					<?php if (get_option('atp_topbar') != "on" && is_active_sidebar( 'topbarleft') || is_active_sidebar( 'topbarright')) { ?>
					<div class="topbar">
							<div class="topbar-left">
								<?php  if ( is_active_sidebar( 'topbarleft' ) ) : dynamic_sidebar('topbarleft');  endif; ?>
							</div><!-- /one_half -->
							<div class="topbar-right">
								<?php  if ( is_active_sidebar( 'topbarright' ) ) : dynamic_sidebar('topbarright');  endif; ?>	
							</div><!-- /one_half last -->
					</div><!-- /topbar -->
					<div class="clear"></div>
					<?php } ?>

					<div class="primarymenu menuwrap">
						<?php
						// Enable mega menu
						$iva_menu_type = get_option('atp_mm_visible'); 
						if( $iva_menu_type === 'on'){
							get_template_part( 'framework/includes/mega','menu' ); 
						}else{
							// Primary menu
							atp_generator( 'atp_primary_menu' ); 
						}
						?>
						<?php if (has_nav_menu( 'primary-menu' ) ) {  ?> <a href="#" class="iva-mobile-dropdown"></a> <?php } ?>
					</div>
					<div class="icn_wrap_align">			
						<div id="ivaSearch" class="ivaSearch icnalign"><i class="fa fa-search fa-1"></i></div>
					</div>
				</div>
					
				<?php
				// Mobile menu
				atp_generator( 'atp_mobile_menu' );
				?>
			</div> <!-- #header-area2 end -->
		</div><!-- .header end -->
	</header><!-- .header-style4 -->

	<div id="ivaSearchbar" class="act">
		<div class="inner">
			<form role="search" method="get" id="searchform" action="<?php echo home_url( '/' ); ?>">				
				<input type="text" value="" name="s" id="s" placeholder="Search here..." class="ivaInput headerSearch" />
				<span class="search-close"><i class="fa fa-close fa-1"></i></span>				
			</form>
		</div>
	</div>

</div><!-- .header_wrapper-->