<?php

/*
 * Add-on Name: Location for Visual Composer
 */

if ( !class_exists( 'iva_location' ) )
{
	class iva_location
	{

		// Constructor
		function __construct()
		{
			add_action( 'init', array( $this, 'location_init' ) );
			add_shortcode( 'location', array( $this, 'location_shortcode' )  );
		}
		
		// Initialize the location function
		function location_init()
		{
			if ( function_exists( 'vc_map' ) )
			{
				// VC Map
				vc_map(
					array(
					   "name" => __( "Location", "iva_theme_admin" ),
					   "base" => "location",
					   "class" => "",
					   "icon" => "",
					   "category" => "Aivah VC Addons",
					   "description" => __( "Location Details - This works only for the Carzone WP Theme from AivahThemes", "iva_theme_admin"),
					   "params" => array(

							array(
								"type" 			=> "textfield",
								"class" 		=> "",
								"heading" 		=> __( "Title",  "iva_theme_admin" ),
								"param_name" 	=> "loc_title",
								"value" 		=> "",
								"description" 	=> __( "Enter the title.", "iva_theme_admin" ),
							),
							
							array(
								"type"			 => "textfield",
								"class" 		 => "",
								"heading" 		 => __( "Post Id", "iva_theme_admin" ),
								"param_name" 	 => "post_id",
								"value" 		 => "",
								"description" 	 => __( "Enter the Location Post-ID with comma separated if you wish to display more than one post in shortcode page.", "iva_theme_admin" ),
							),
							array(
								"type" 			=> "dropdown",
								"class" 		=> "",
								"heading" 		=> __("Location OrderBy", "iva_theme_admin"),
								"param_name" 	=> "loc_orderby",
								"value" 		=> array(
														__( 'ID', 'iva_theme_admin') 		=> 'ID',
														__( 'Title', 'iva_theme_admin') 	=> 'title',
														__( 'Date', 'iva_theme_admin') 		=> 'date',
														__( 'Menu Order', 'iva_theme_admin') => 'menu_order',										
													),							
								"description"  => __( "Select the orderby  which you want to use  Id ,title,date or menu order in Location shortcode page.", "iva_theme_admin" )
							 ),
							array(
								"type" 			=> "dropdown",
								"class"			=> "",
								"heading" 		=> __( "Location Order", "iva_theme_admin" ),
								"param_name" 	=> "loc_order",
								 "value" 		=> array(
													__( 'Ascending', 'iva_theme_admin' ) => 'ASC',
													__( 'Descending', 'iva_theme_admin' ) => 'DSC',										
													),							
								"description" => __( "Select the order which you wish to display in Location in shortcode page.", "iva_theme_admin" )
							),
							
						),
					)
				);
			}
		}
		// Shortcode handler function for Location
		function location_shortcode($atts)
		{			
			extract(shortcode_atts( array(
				'loc_title' => '',
				'post_id' 	=> '',
				'loc_orderby' => '',
				'loc_order' => '',
				
			),$atts));			 
			
			if($post_id!=''){
				$postid_array = array();
				$postid_array = explode(',',$post_id);
				$query = array(
					'post_type'	=> 'location', 
					'post__in'	=>  $postid_array,
					'orderby'   =>	$loc_orderby,
					'order'     =>	$loc_order,
				);
		    }
			query_posts($query); //get the results
			$output  = '';
			$column_index = 0; 
			$columns = 3;
			$class = 'col_third';	
			
			$output .= '<div class="'.$class.'">';
			$output .= '<span class="iva_loc_sc_title">'.$loc_title .'</span>';
			
			global $post;
			if(have_posts()) : while(have_posts()) : the_post();
			
				$column_index++;
				$last				 = ( $column_index == $columns && $columns != 1 ) ? 'end ' : '';
				$iva_loc_address 	 = '';
				$iva_loc_map_details = get_post_meta( $post->ID, 'iva_loc_map', true );
				
				if( !empty( $iva_loc_map_details ) ){
					
					$iva_protocol 			= is_ssl() ? 'https' : 'http';
					$iva_title          	= get_the_title( $post->ID );
					$iva_loc_address 		= $iva_loc_map_details['0']['address'];	    			
					$iva_loc_phno     		= get_post_meta( $post->ID, 'iva_loc_phno', true );
					$iva_loc_services 		= get_post_meta( $post->ID, 'iva_loc_services', true ); 
					$iva_loc_dir_startadd 	= get_option("iva_loc_dir_start_address") ? get_option("iva_loc_dir_start_address") : '';
					
					$output .= '<div class="iva_loc_list">';
					$output .= '<span class="iva_loc_title">'.$iva_title .'</span>';
					$output .= '<span class="iva_loc_address"><i class="fa fa-map-marker fa-1"></i>' .$iva_loc_address. '</span>';					
					$output .= '<span class="iva_loc_phoneno"><i class="fa fa-phone fa-1"></i>'.$iva_loc_phno. '</span>';					
					$output .= '<span class="iva_loc_services"><i class="fa fa-cog fa-1"></i>' .$iva_loc_services. '</span>';
					if( !empty($iva_loc_dir_startadd) )  {
						$output .= '<a href="'.$iva_protocol.'://maps.google.com/maps?saddr='.$iva_loc_dir_startadd.'&daddr='.$iva_loc_address.'" target="_blank">direction</a>';
					} else {
							$output .= '<a href="'.$iva_protocol.'://maps.google.com/maps?saddr=Current+Location&daddr='.$iva_loc_address.'" target="_blank">direction</a>';
					}
					$output .= '</div>';					
					
				}
				if( $column_index == $columns ){
					$column_index = 0;
					$output .= '<div class="clear"></div>';
				}
			endwhile;			
			wp_reset_query();
			endif;
			$output .= '</div>';					
			echo  $output; 			
		}
	}
}
if(class_exists('iva_location'))
{
	$IVA_Location = new iva_location;
}
if ( class_exists( 'WPBakeryShortCode' ) ) {
    class WPBakeryShortCode_location extends WPBakeryShortCode {
    }
}