<?php
/**
 * The template for displaying posts in the Audio post format
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
	<header class="entry-header">

		<?php 
		if ( is_single() ) :
			the_title( '<h2 class="entry-title">', '</h2>' );
		else :
			the_title( '<h2 class="entry-title"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h2>' );
		endif;
		?>

		<?php if (get_option('atp_postmeta') != "on" ){ ?>
		<div class="entry-meta">
			<?php iva_post_metadata(); ?>
			<?php edit_post_link( __( 'Edit', 'iva_theme_front' ), '<span class="edit-link">', '</span>' ); ?>
		</div><!-- .entry-meta -->
		<?php } ?>

	</header><!-- .entry-header -->

	<div class="entry-content">
	<?php
		if ( has_excerpt() && !is_single() ) {
		the_excerpt();
		echo '<a class="more-link btn medium dark border" href="'.esc_url( get_permalink() ) .'">'. __("<span>Continue reading</span>","iva_theme_front") .'</a>';
	}else{
		the_content( __( '<span>Continue reading</span>', 'iva_theme_front' ) );
		
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