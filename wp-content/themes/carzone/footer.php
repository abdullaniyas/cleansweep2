<?php
/* Footer Sidebar
 * Footer 
 * Google Analytics
 */
?>
</div><!-- #main -->
	
	<?php if ( get_option( 'atp_footer_sidebar' ) != 'on' ) { ?>
	
		<?php
				// Get footer sidebar widgets
				if ( get_option( 'atp_footer_sidebar' ) != 'on' 
					&& is_active_sidebar( 'footercolumn1')
					|| is_active_sidebar( 'footercolumn2')
					|| is_active_sidebar( 'footercolumn3')
					|| is_active_sidebar( 'footercolumn4')
					|| is_active_sidebar( 'footercolumn5')
					|| is_active_sidebar( 'footercolumn6')
				) {
			echo '<div id="footer">';
			echo '<div class="inner">';
					get_template_part( 'sidebar', 'footer' );
			echo '</div>';
			echo '<div id="back-top" class="" ><a href="#header"><span><i class="fa fa-angle-double-up fa-2x"></i></span></a></div>';
			echo '</div>'; // Footer
				}
	
		 } ?>
	
	<?php if( is_active_sidebar( 'footer_leftcopyright') || is_active_sidebar( 'footer_rightcopyright')) {  ?>
	<div class="copyright">
		<div class="inner">
			<div class="copyright_left">
				<?php
				if ( is_active_sidebar( 'footer_leftcopyright' ) ) : dynamic_sidebar('footer_leftcopyright');  endif;
				?>
			</div>
			<div class="copyright_right">
				<?php if ( is_active_sidebar( 'footer_rightcopyright' ) ) : dynamic_sidebar('footer_rightcopyright');  endif; ?>
			</div>

		</div><!-- .inner -->
	</div><!-- .copyright -->
	<?php } ?>

</div><!-- #wrapper -->
</div><!-- #layout -->

<?php wp_footer();?>

</body>
</html>