<?php
/**
 * The default template for displaying content
 *
 * Used for both single and index/archive/search.
 *
 * @package WordPress
 */
global $more;
if ( !is_single() ) {
	$more = 0; 
}
?>
<?php
$postclass ='';
if ( is_single() ){
	$postclass = 'singlepost';
}
?>
<article id="post-<?php the_ID(); ?>" <?php post_class($postclass); ?>>
	<div class="entry-content">
		<?php
		if ( has_excerpt() && !is_single() ) {
			the_excerpt();
			echo '<a class="more-link btn medium dark" href="'. esc_url( get_permalink() ) .'">'. __("<span>Read more</span>","iva_theme_front") .'</a>';
		}else{
			the_content( __( '<span>Read more</span>', 'iva_theme_front' ) );
			
			wp_link_pages( array(
				'before'      => '<div class="page-links"><span class="page-links-title">' . __( 'Pages:', 'iva_theme_front' ) . '</span>',
				'after'       => '</div>',
				'link_before' => '<span>',
				'link_after'  => '</span>',
			));
		} ?>
		<?php if ( is_single() ) { the_tags(); } ?>
		
		<footer class="entry-footer">
		<?php if ( get_option('atp_postmeta') != "on" ){ ?>
		<div class="entry-meta">
			<?php iva_post_metadata(); ?>
			<?php edit_post_link( __( 'Edit', 'iva_theme_front' ), '<span class="edit-link">', '</span>' ); ?>
		</div><!-- .entry-meta -->
		<?php } ?>

		</footer><!-- .entry-footer -->
		
	</div><!-- .entry-content -->
</article><!-- /post-<?php the_ID();?> -->