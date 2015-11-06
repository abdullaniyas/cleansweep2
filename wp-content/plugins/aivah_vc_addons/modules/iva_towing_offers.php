<?php
/*
* Add-on Name: Offers for Visual Composer
*/
if( !class_exists( 'iva_Offers' ) )
{
	class iva_Offers
	{
		// constructor
		function __construct()
		{
			add_action( 'init', array($this,'iva_offers_init' ) );
			add_shortcode( 'iva_offers', array( $this, 'iva_offers_shortcode' ));
		}
		
		// initialize the mapping function
		function iva_offers_init()
		{
			if(function_exists( 'vc_map' ))
			{

				$iva_ofr_posts = get_posts( 'post_type=offers&numberposts=-1' );
				
				$iva_ofrs_array = array();
			  
		        foreach ( $iva_ofr_posts as $ofr_post ) {
		        	$iva_ofrs_array[$ofr_post->post_title] = $ofr_post->ID;
		        }
			
				vc_map(
					array(
					   "name" 	=> __( "Offers","iva_theme_admin" ),
					   "base" 	=> "iva_offers",
					   "class" 	=> "",
					   "icon" 	=> "",
					   "category" => "Aivah VC Addons",
					   "description" => __("Special Offers","iva_theme_admin"),
					   "params" => array(
				  			array(
								'type' 			=> 'checkbox',
								'heading'  	 	=> __( 'Offers Titles', 'iva_theme_admin' ),
								'param_name' 	=> 'offers_postid',
								'value' 	 	=>  $iva_ofrs_array,
								'description' 	=> __( 'Select Title.','iva_theme_admin' ),
							),

							array(
									'type' 			=> 'dropdown',
									'heading'  	 	=> __( 'Offers Orderby', 'iva_theme_admin' ),
									'param_name' 	=> 'offers_orderby',
									'value' 	 	=> array(
															'Choose Options' => '',
															'ID' 			 => 'ID',
															'Title' 		 => 'title',
															'Date' 			 => 'date',
															'Menu Order' 	 => 'menu_order',
														),
									'description' 	=> __( 'Select the orderby which you want to use Id , title, date or menu order in Offers Shortcode Page.', 'iva_theme_admin' ),
							),

							array(
									'type' 		 	=> 'dropdown',
									'heading' 	 	=> __( 'Offers Order', 'iva_theme_admin' ),
									'param_name' 	=> 'offers_order',
									'std'		 	=> 'DESC',
									'value'		 	=> array(
															'Ascending'  => 'ASC',
															'Descending' => 'DSC',
														),
									'description' => __( 'Select the order which you wish to display in Offers Shortcode Page.', 'iva_theme_admin' ),
							),

							array(
								'type' 		  => 'checkbox',
								'heading' 	  => __( 'Offers Page Template Pagination', 'iva_theme_admin' ),
								'param_name'  => 'offers_pagination',
								'description' => __( 'Check this if you wish to Enable/Disable ( Default: Disable ) the pagination in Offers Shortcode Page.', 'iva_theme_admin' ),
								'value'		  => array( __( 'Yes', 'iva_theme_admin' ) => 'yes' )
							),

							array(
								'type' 		  => 'textfield',
								'holder' 	  => 'div',
								'class'		  => '',
								'heading'     => __( 'Offers Page Template Limits', 'iva_theme_admin' ),
								'param_name'  => 'offers_limits',
								'description' => __( 'Type the limits you wish to limit on the Offers Shortcode Page.', 'iva_theme_admin' )
							 ),							
						),
					)
				);
			}
		}
		function iva_offers_shortcode($atts)
		{			
			extract(shortcode_atts( array(
				'offers_postid'	    => '',
				'offers_orderby' 	=> 'title',
				'offers_order' 		=> 'ASC',
				'offers_pagination' => '',
				'offers_limits' 	=> '1'				
			),$atts));

			global $post, $pagination, $atp_theme;

			$iva_ofr_btn_color 	= get_option('iva_ofr_btn_color') ? get_option('iva_ofr_btn_color') :__('blue','iva_theme_front');
			$iva_ofr_btn_txt 	= get_option('iva_ofr_btn_txt') ? get_option('iva_ofr_btn_txt') :__('Book This Offer','iva_theme_front');	
			
			if ( get_query_var('paged') ) {
				$paged = get_query_var('paged');
			} elseif ( get_query_var('page') ) {
				$paged = get_query_var('page');
			} else {
				$paged = 1;  
			}

			if( $offers_postid!=''){

				$postid_array = array();
				$postid_array = explode(',',$offers_postid );
		
				$args = array(
						'post_type'		 => 'offers', 
						'posts_per_page' => $offers_limits, 
						'post__in'		 => $postid_array,
						'paged' 		 => $paged,
						'orderby'		 =>	$offers_orderby,
						'order'			 =>	$offers_order,	
				);
			}else{
				$args = array(
						'post_type'		 => 'offers', 
						'posts_per_page' => $offers_limits, 
						'paged' 		 => $paged,
						'orderby'		 =>	$offers_orderby,
						'order'			 =>	$offers_order,	
				);
			}

			$iva_ofrs_query = query_posts( $args );

			// $wp_query = new WP_Query( $args );
			// if ( $wp_query->have_posts()) : while (  $wp_query->have_posts()) :  $wp_query->the_post(); 

			$out = '';

			if ( have_posts()) : while (  have_posts()) :  the_post();

				global $post;

				$img_alt_title 	= get_the_title($post->ID);
				
				$out .= '<div class="special_offers_item">';
				$out .= '<div class="one_third nomargin">';
				$out .= '<div class="offer-photo">';
				if ( has_post_thumbnail() ) {
					 $out .= '<div class="offer-img"><figure>'. atp_resize( $post->ID, '', '480', '566', '') .'</figure></div>'; 
				} 
				$out .= '</div>'; // End photo  div
				$out .= '</div>'; // End Of one_third

				$out .= '<div class="two_third nomargin">';
				$out .= '<div class="offers-content">';
				$out .= '<h2>'.get_the_title().'</h2>';
				$out .= '<h2><a href="'.get_permalink().'"></a></h2>'; 
				// $out .= the_excerpt();
				$out .=  substr( $post->post_content , 0, 150 );
				$out .= '<div class="offer-btn">';
				$out .= '<a href="'.get_permalink().'" class=" btn  medium   dark  border '. $iva_ofr_btn_color.' ">';
				$out .= '<span>'.$iva_ofr_btn_txt.'</span>';
				$out .= '</a>';
				$out .= '</div>'; // offer-btn
				$out .= '</div>'; // offers-content
				$out .= '</div>'; // End of two_third
				$out .= '</div>'; // special_offers_item 

				endwhile; 

				$out .='<div class="clear"></div>';

				//
				if( $offers_pagination == 'yes') { 
					if(function_exists('iva_pagination')){  
						$out .= iva_pagination();  	
					}
				}
				wp_reset_query();

				endif; 

				return $out;			
		}
	}
}
if(class_exists('iva_Offers')){
	$iva_Offers = new iva_Offers;
}
if ( class_exists( 'WPBakeryShortCode' ) ) {
	class WPBakeryShortCode_iva_offers extends WPBakeryShortCode {
	}
}