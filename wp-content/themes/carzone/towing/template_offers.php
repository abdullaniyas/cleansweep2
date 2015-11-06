<?php
/*
Template Name: Offers
*/

/** 
 * The Header for our theme.
 * Includes the header.php template file. 
 */

get_header(); ?>
	<div id="primary" class="pagemid">
		<div class="inner">		
		<main class="content-area" role="main">
			<div class="entry-content-wrapper clearfix">
			
		
			
			<?php
			$orderby = get_option('iva_ofr_orderby') ? get_option('iva_ofr_orderby') : 'date';
			$order   = get_option('iva_ofr_order') ? get_option('iva_ofr_order') : 'ASC';
			
			$iva_ofr_btn_color 	= get_option('iva_ofr_btn_color') ? get_option('iva_ofr_btn_color') : __('blue', 'iva_theme_front');
			$iva_ofr_btn_txt 	= get_option('iva_ofr_btn_txt') ? get_option('iva_ofr_btn_txt') : __('Read more', 'iva_theme_front');
			
			if ( get_query_var('paged') ) {
				$paged = get_query_var('paged');
			} elseif ( get_query_var('page') ) {
				$paged = get_query_var('page');
			} else {
				$paged = 1;  
			}

			$pagination = get_option('iva_ofr_pagination');
			if( $pagination == 'on' ){
				$ofr_limit = get_option( 'iva_ofr_limits' );
			}else{
				$ofr_limit = '-1' ;
			}
			
			$args = array(
					'post_type' 	 => 'offers',
					'posts_per_page' => $ofr_limit, 
					'paged' 		 => $paged,
					'orderby'		 =>	$orderby,
					'order'			 =>	$order,
					
			);
			$wp_query = new WP_Query( $args );
				
			if ( $wp_query->have_posts()) : while (  $wp_query->have_posts()) :  $wp_query->the_post();  ?>

		
			<div id="post-<?php the_ID(); ?>" <?php post_class('offers-entry');?>>

				<?php
				$img_alt_title 	= get_the_title($post->ID);
				
				echo '<div class="special_offers_item">';
				echo '<div class="one_third nomargin">';
				echo '<div class="offer-photo">';
				if ( has_post_thumbnail() ) {
					echo '<div class="offer-img"><figure>'. atp_resize( $post->ID, '', '480', '566', '') .'</figure></div>'; 
				} 
				echo '</div></div>'; // End of one_third 

				echo '<div class="two_third nomargin">';
				echo '<div class="offers-content">';
				echo '<h2 class="entry-title"><a href="'.get_permalink().'">'.$img_alt_title.'</a></h2>'; 
				the_excerpt();
				//echo substr( $post->post_content , 0, 150 );
				echo '<div class="offer-btn">';
				echo '<a href="'.get_permalink().'" class=" btn  medium   dark  border '. $iva_ofr_btn_color.' ">';
				echo '<span>'.$iva_ofr_btn_txt.'</span>';
				echo '</a>';
				echo '</div>';
				echo '</div>';
				echo '</div>'; 
				echo '</div>';// End of two_third	?>	

			</div><!-- .offers-entry -->
			
			<?php endwhile; ?>	

			<div class="clear"></div>

			<?php if ( $pagination == 'on' ) { echo iva_pagination(); }?>
			<?php wp_reset_postdata(); ?>
			<?php else : ?>

			<p><?php _e( 'Apologies, but no results were found for the requested archive. Perhaps searching will help find a related post.', 'iva_theme_front' ); ?></p>

			<?php get_search_form(); ?>
			
			<?php endif;?>
				
			</div><!-- .content-area -->
			</main><!-- main -->		
			<?php if ( $sidebar_layout!= "fullwidth" ){ get_sidebar(); } ?>		
		</div><!-- inner -->	
	</div><!-- #primary.pagemid -->
<?php get_footer(); ?>