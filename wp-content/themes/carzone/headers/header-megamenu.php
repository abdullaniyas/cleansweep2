<?php
/* Header Mega Menu Style */
?>
<?php if (get_option('atp_topbar') != "on" && is_active_sidebar( 'topbarleft') || is_active_sidebar( 'topbarright')) { ?>
<div class="topbar">
	<div class="inner">
		
		<div class="one_half ">
			<?php  if ( is_active_sidebar( 'topbarleft' ) ) : dynamic_sidebar('topbarleft');  endif; ?>
		</div>
		<div class="one_half last">		
			<?php  if ( is_active_sidebar( 'topbarright' ) ) : dynamic_sidebar('topbarright');  endif; ?>
		</div>
	</div><!-- /inner -->
</div><!-- /topbar -->
<?php } ?>
<header class="header-style1">
	<div class="header">
		<div class="header-area">
			<div class="logo">
				<?php atp_generator( 'atp_dark_logo' ); ?>
			</div><!-- /logo -->
			<div class="primarymenu menuwrap">
				<?php
				// Enable mega menu
				get_template_part( 'framework/includes/mega','menu' ); 
				?>
				<?php if (has_nav_menu( 'primary-menu' ) ) {  ?> <a href="#" class="iva-mobile-dropdown"></a> <?php } ?>
			</div>
		</div>
	<?php
	// Mobile menu
	atp_generator( 'atp_mobile_menu' );
	?>
	</div>
</header><!-- #header -->