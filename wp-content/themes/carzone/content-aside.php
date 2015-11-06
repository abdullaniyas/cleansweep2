<?php
/**
 * The template for displaying posts in the Aside post format
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
	}else{
		echo '<div class="iva-aside">';
		the_content( __( '<span>Continue reading</span>', 'iva_theme_front' ) );
		echo '</div>';
		
		wp_link_pages( array(
			'before'      => '<div class="page-links"><span class="page-links-title">' . __( 'Pages:', 'iva_theme_front' ) . '</span>',
			'after'       => '</div>',
			'link_before' => '<span>',
			'link_after'  => '</span>',
		));
	} ?>
	<?php if ( is_single() ) { the_tags(); } ?>
	</div><!-- .entry-content -->
</article><!-- /post-<?php the_ID();?> -->