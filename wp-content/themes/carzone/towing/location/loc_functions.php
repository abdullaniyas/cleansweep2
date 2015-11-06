<?php
add_action( 'wp_ajax_iva_get_locations_by_cat', 'iva_get_locations_by_cat' );
add_action( 'wp_ajax_nopriv_iva_get_locations_by_cat', 'iva_get_locations_by_cat' );
function iva_get_locations_by_cat(){
	$iva_loc_cat = $_POST['cat_slug'] ;
	if( $iva_loc_cat !='' ) {
		// Start the loop.
		$args = array( 
			'post_type' => 'location', 
			'posts_per_page' => -1,
			'tax_query' => array(
				array(
					'taxonomy' => 'cities',
					'field'    => 'slug',
					'terms'    => $iva_loc_cat,
					'post_status'   => 'publish',
				),
			),
		);

	} else {
        $args = array( 
			'post_type'      => 'location', 
			'posts_per_page' => -1,
			'post_status'    => 'publish',
		);
	}
	
	$loop = new WP_Query( $args );
	if( $loop->have_posts() ) : while ( $loop->have_posts() ) : $loop->the_post();
		global $post;

		 $iva_loc_address 		= $iva_loc_lattitudes = $iva_loc_longitudes = '';
		 $iva_loc_map_details 	= get_post_meta( $post->ID, 'iva_loc_map', true );
		 $iva_loc_posttitle 	= get_the_title( $post->ID );

 
		if( !empty( $iva_loc_map_details ) ){
		    $iva_loc_address 	  = $iva_loc_map_details['0']['address'];	    
			$iva_loc_lattitudes   = $iva_loc_map_details['0']['lat'];
			$iva_loc_longitudes   = $iva_loc_map_details['0']['lng'];
		}
		
		$iva_loc_phno     	= get_post_meta( $post->ID, 'iva_loc_phno', true );
		$iva_loc_services 	= get_post_meta( $post->ID, 'iva_loc_services', true );

        $iva_loc_all_info[]  = array(       	
			$iva_loc_lattitudes, 
			$iva_loc_longitudes,
			$iva_loc_posttitle,	
			$iva_loc_address,
			$iva_loc_phno,
			$iva_loc_services
        );
	endwhile;
	else :
		echo $iva_no_results_txt;
	endif;
	if( !empty( $iva_loc_all_info ) ){
		echo json_encode( $iva_loc_all_info );
    }	 		
	wp_reset_query(); 
	exit;
}
?>