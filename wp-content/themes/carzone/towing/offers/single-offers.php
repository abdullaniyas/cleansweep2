<?php get_header(); ?>

<div id="primary" class="pagemid">
	<div class="inner">
		<main class="content-area" role="main">
			<div class="entry-content-wrapper clearfix">

			<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>

			<div id="post-<?php the_ID(); ?>" <?php post_class('offers-entry');?>>

			<?php			
			$width = ( atp_generator('sidebaroption',$post->ID) != "fullwidth" ) ? '470':'470';
			$iva_ofr_btn_txt 	= get_option('iva_ofr_btn_txt') ? get_option('iva_ofr_btn_txt') :__('Book This Offer','iva_theme_front');
			$iva_ofr_btn_color 	= get_option('iva_ofr_btn_color') ? get_option('iva_ofr_btn_color') :__('blue','iva_theme_front');
			$iva_ofr_disable_btn = get_option('iva_ofr_disable_btn');

			$no_image = THEME_URI.'/images/no_image.jpg';

			/**
			 * Custom Query to pull page id for template_offers.php
			 */
			$iva_ofr_templateid = '';
			$page_query = new WP_Query(
				array(
					'post_type'  => 'page',  /* overrides default 'post' */
					'meta_key'   => '_wp_page_template',
					'meta_value' => 'towing/template_offers.php'
				)
			);
	
			if ( $page_query->have_posts()) : while (  $page_query->have_posts()) :  $page_query->the_post();
			$iva_ofr_templateid = $post->ID;
			endwhile;
			endif;
			wp_reset_query();
			?>
			
			<div class="iva-np-headwrap">
			<?php
			if( $iva_ofr_templateid ){
				echo '<div class="iva-np-allitems"><a href="'.get_page_link( $iva_ofr_templateid ).'"><i class="fa fa-th fa-2x"></i></a></div>';
			}
			echo '<div class="iva-np-title"><h2 class="entry-title">'.get_the_title() .'</h2></div>';
			?>			
			<div class="iva-np-navs">
				<div class="iva-np-pagination">
					<?php previous_post_link( $link = '%link','<i class="fa fa-angle-left fa-2x"></i>'); ?>
					<?php next_post_link( $link = '%link', '<i class="fa fa-angle-right fa-2x"></i>') ?>
				</div>
			</div>
			</div><!-- .iva-headwrap -->
			
			<?php 
			echo '<div class="offers-wrap">'; 				
			echo '<div class="offers-photo">';
			if ( has_post_thumbnail() ) {
				echo '<figure>'. atp_resize( $post->ID, '', $width, '', 'alignleft', '') .'</figure>'; 
			} else {
				echo '<figure>'. atp_resize( '', $no_image, $width, '', 'alignleft', '') .'</figure>';
			}
			echo '</div>'; 					

			echo '<div class="content-wrap">';	
			the_content(); 
			echo '</div>'; //.content-wrap

			echo '</div>'; //.offers-photo
			echo '</div>';//.offers-wrap	
			?>

			</div><!-- #post-<?php the_ID(); ?> -->

			<?php endwhile; else: ?>
			<?php '<p>'.__('Sorry, no posts matched your criteria.', 'iva_theme_front').'</p>';?>
			<?php endif; ?>

			<?php
			$comments = get_option('iva_ofr_comments');
			if ( $comments == 'enable'  ) { comments_template( '', true );  } ?>

			</div><!-- .entry-content-wrapper -->

			</main><!-- main -->		

			<?php if ( $sidebar_layout!= "fullwidth" ){ get_sidebar(); } ?>		
		</div><!-- inner -->	
	</div><!-- #primary.pagemid -->
<?php get_footer(); ?>