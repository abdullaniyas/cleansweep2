<?php
add_filter('customlocalization_themeoptions','iva_customlocalization_themeoptions');
function iva_customlocalization_themeoptions( $iva_of_options ) {	
	global $iva_of_options;	
		$shortname = 'iva';
		
		// Form Labels	
		//---------------------------------------------------------------------------------------------------
		$iva_of_options[] = array( 'name'	=> __('Form Labels','iva_theme_admin'), 'desc' => __('<h3>Form Labels</h3> Text translation for the Booking form section.','iva_theme_admin'), 'type' => 'subnav');
		//---------------------------------------------------------------------------------------------------
		$iva_of_options[] = array( 'name'	=> __('Name Text','iva_theme_admin'),
									'desc'	=> __('Custom text which appears on Booking Form','iva_theme_admin'),
									'id'	=> $shortname.'_bk_fnametxt',
									'std'	=> '',
									'type'	=> 'text',
									'inputsize'=> '300'
							);
							
		$iva_of_options[] = array( 'name'	=> __('Phone Number Text','iva_theme_admin'),
									'desc'	=> __('Custom text which appears on Booking Form','iva_theme_admin'),
									'id'	=> $shortname.'_bk_phonetxt',
									'std'	=> '',
									'type'	=> 'text',
									'inputsize'=> '300'
							);
							
		$iva_of_options[] = array( 'name'	=> __('Email Text','iva_theme_admin'),
									'desc'	=> __('Custom text which appears on Booking Form','iva_theme_admin'),
									'id'	=> $shortname.'_bk_emailtxt',
									'std'	=> '',
									'type'	=> 'text',
									'inputsize'=> '300'
							);

		$iva_of_options[] = array( 'name'	=> __('Special Offers Text','iva_theme_admin'),
									'desc'	=> __('Custom text which appears on Booking Form','iva_theme_admin'),
									'id'	=> $shortname.'_bk_splofr_txt',
									'std'	=> '',
									'type'	=> 'text',
									'inputsize'=> '300'
							);
							
		$iva_of_options[] = array( 'name'	=> __('Method Of Contact Text','iva_theme_admin'),
									'desc'	=> __('Custom text which appears on Booking Form','iva_theme_admin'),
									'id'	=> $shortname.'_bk_mthdtxt',
									'std'	=> '',
									'type'	=> 'text',
									'inputsize'=> '300'
							);

		$iva_of_options[] = array( 'name'	=> __('Phone Call Text','iva_theme_admin'),
									'desc'	=> __('Custom text which appears on Booking Form','iva_theme_admin'),
									'id'	=> $shortname.'_bk_phonecalltxt',
									'std'	=> '',
									'type'	=> 'text',
									'inputsize'=> '300'
							);
							
		$iva_of_options[] = array( 'name'	=> __('Date Text','iva_theme_admin'),
									'desc'	=> __('Custom text which appears on Booking shortcode and manage_booking template','iva_theme_admin'),
									'id'	=> $shortname.'_bk_date_txt',
									'std'	=> '',
									'type'	=> 'text',
									'inputsize'=> '300'
							);
							 
		$iva_of_options[] = array( 'name'	=> __('SMS Text','iva_theme_admin'),
									'desc'	=> __('Custom text which appears on Booking Form','iva_theme_admin'),
									'id'	=> $shortname.'_bk_smstxt',
									'std'	=> '',
									'type'	=> 'text',
									'inputsize'=> '300'
							);
							
		$iva_of_options[] = array( 'name'	=> __('Email','iva_theme_admin'),
									'desc'	=> __('Custom text which appears on Booking Form','iva_theme_admin'),
									'id'	=> $shortname.'_bk_mailtxt',
									'std'	=> '',
									'type'	=> 'text',
									'inputsize'=> '300'
							);	
								
		$iva_of_options[] = array( 'name'	=> __('Year Text','iva_theme_admin'),
									'desc'	=> __('Custom text which appears on Booking Form','iva_theme_admin'),
									'id'	=> $shortname.'_bk_yeartxt',
									'std'	=> '',
									'type'	=> 'text',
									'inputsize'=> '300'
							);
							
		$iva_of_options[] = array( 'name'	=> __('Make Text','iva_theme_admin'),
									'desc'	=> __('Custom text which appears on Booking Form','iva_theme_admin'),
									'id'	=> $shortname.'_bk_maketxt',
									'std'	=> '',
									'type'	=> 'text',
									'inputsize'=> '300'
							);
							
		$iva_of_options[] = array( 'name'	=> __('Model Text','iva_theme_admin'),
									'desc'	=> __('Custom text which appears on Booking Form','iva_theme_admin'),
									'id'	=> $shortname.'_bk_modeltxt',
									'std'	=> '',
									'type'	=> 'text',
									'inputsize'=> '300'
							);
		$iva_of_options[] = array( 'name'	=> __('Services Text','iva_theme_admin'),
									'desc'	=> __('Custom text which appears on Booking Form','iva_theme_admin'),
									'id'	=> $shortname.'_bk_servicestxt',
									'std'	=> '',
									'type'	=> 'text',
									'inputsize'=> '300'
							);	
		$iva_of_options[] = array( 'name'	=> __('Time Text','iva_theme_admin'),
									'desc'	=> __('Custom text which appears on Booking Form','iva_theme_admin'),
									'id'	=> $shortname.'_bk_timetxt',
									'std'	=> '',
									'type'	=> 'text',
									'inputsize'=> '300'
							);
							
		$iva_of_options[] = array( 'name'		=> __('Select Time Text','iva_theme_admin'),
									'desc'		=> __('Custom text which appears on Booking Form','iva_theme_admin'),
									'id'		=> $shortname.'_bk_time_select_txt',
									'std'		=> '',
									'type'		=> 'text',
									'inputsize'	=> '300'
								);		
		$iva_of_options[] = array( 'name'	=> __('Closed Message','iva_theme_admin'),
									'desc'	=> __('Custom text which appears on Booking Form','iva_theme_admin'),
									'id'	=> $shortname.'_bk_closedmsgtxt',
									'std'	=> '',
									'type'	=> 'text',
									'inputsize'=> '300'
							);
		$iva_of_options[] = array( 'name'	=> __('Form Heading1 Text','iva_theme_admin'),
									'desc'	=> __('Custom text which appears on Booking Form','iva_theme_admin'),
									'id'	=> $shortname.'_bk_heading1_txt',
									'std'	=> '',
									'type'	=> 'text',
									'inputsize'=> '300'
							);	
							
		$iva_of_options[] = array( 'name'	=> __('Form Heading2 Text','iva_theme_admin'),
									'desc'	=> __('Custom text which appears on Booking Form','iva_theme_admin'),
									'id'	=> $shortname.'_bk_heading2_txt',
									'std'	=> '',
									'type'	=> 'text',
									'inputsize'=> '300'
							);	
		$iva_of_options[] = array( 'name'	=> __('Form Heading3 Text','iva_theme_admin'),
									'desc'	=> __('Custom text which appears on Booking Form','iva_theme_admin'),
									'id'	=> $shortname.'_bk_heading3_txt',
									'std'	=> '',
									'type'	=> 'text',
									'inputsize'=> '300'
							);	

		$iva_of_options[] = array( 'name'		=> __('Booking Button Text','iva_theme_admin'),
									'desc'		=> __( 'The text which appears in booking template page and booking single page.','iva_theme_admin'),
									'id'		=> $shortname.'_bk_buttontxt',
									'std'		=> '',
									'inputsize' => '300',
									'type'		=> 'text'
							);	
		$iva_of_options[] = array( 'name'	=> __('Booking Details text','iva_theme_admin'),
									'desc'	=> __('Text which appears in template page : manage_booking','iva_theme_admin'),
									'id'	=> $shortname.'_bk_details_txt',
									'std'	=> '',
									'type'	=> 'text',
									'inputsize'=> '300');
		
		$iva_of_options[] = array( 'name'	=> __('View Results text','iva_theme_admin'),
									'desc'	=> __('Text which appears in booking single page','iva_theme_admin'),
									'id'	=> $shortname.'_bk_view_results_txt',
									'std'	=> '',
									'type'	=> 'text',
									'inputsize'=> '300');
		
		$iva_of_options[] = array( 'name'	=> __('Booking Confirm text','iva_theme_admin'),
									'desc'	=> __('Text which appears in template page : manage_booking','iva_theme_admin'),
									'id'	=> $shortname.'_bk_confirm_txt',
									'std'	=> '',
									'type'	=> 'text',
									'inputsize'=> '300');

		$iva_of_options[] = array( 'name'	=> __('Booking Cancelled text','iva_theme_admin'),
									'desc'	=> __('Text which appears in template page : manage_booking','iva_theme_admin'),
									'id'	=> $shortname.'_bk_cancelled_txt',
									'std'	=> '',
									'type'	=> 'text',
									'inputsize'=> '300');

		$iva_of_options[] = array( 'name'	=> __('Booking Update text','iva_theme_admin'),
									'desc'	=> __('Text which appears in template page : manage_booking','iva_theme_admin'),
									'id'	=> $shortname.'_bk_update_txt',
									'std'	=> '',
									'type'	=> 'text',
									'inputsize'=> '300');

		$iva_of_options[] = array( 'name'	=> __('Booking Cancel text','iva_theme_admin'),
									'desc'	=> __('Text which appears in template page : manage_booking','iva_theme_admin'),
									'id'	=> $shortname.'_bk_cancel_txt',
									'std'	=> '',
									'type'	=> 'text',
									'inputsize'=> '300');

		$iva_of_options[] = array( 'name'	=> __('Booking ago text','iva_theme_admin'),
									'desc'	=> __( 'Type the text which you want to display at the place of ago text in the front end','iva_theme_admin'),
									'id'	=> $shortname.'_bk_ago_txt',
									'std'	=> '',
									'type'	=> 'text',
									'inputsize'=> '300');

		$iva_of_options[] = array( 'name'	=> __('Booking for text','iva_theme_admin'),
									'desc'	=> __( 'Type the text which you want to display at the place of for text in the front end','iva_theme_admin'),
									'id'	=> $shortname.'_bk_for_txt',
									'std'	=> '',
									'type'	=> 'text',
									'inputsize'=> '300');
	
		$iva_of_options[] = array( 'name'	=> __('Booking Placed text','iva_theme_admin'),
									'desc'	=> __( 'Type the text which you want to display at the place of Placed text in the front end','iva_theme_admin'),
									'id'	=> $shortname.'_bk_placed_txt',
									'std'	=> '',
									'type'	=> 'text',
									'inputsize'=> '300');
		
		$iva_of_options[] = array( 'name'	=> __('Booking By text','iva_theme_admin'),
									'desc'	=> __( 'Type the text which you want to display at the place of By text in the front end','iva_theme_admin'),
									'id'	=> $shortname.'_bk_by_txt',
									'std'	=> '',
									'type'	=> 'text',
									'inputsize'=> '300');

		$iva_of_options[] = array( 'name'	=> __('Booking Cancelled','iva_theme_admin'),
									'desc'	=> __( 'Text which appears in the Admin area as Booking Cancelled','iva_theme_admin'),
									'id'	=> $shortname.'_bk_cancel',
									'std'	=> '',
									'type'	=> 'text',
									'inputsize'=> '300');
									
		$iva_of_options[] = array( 'name'	=> __('Booking Confirmed','iva_theme_admin'),
									'desc'	=> __( 'Text which appears in the Admin area as Booking Confirmed','iva_theme_admin'),
									'id'	=> $shortname.'_bk_confirm',
									'std'	=> '',
									'type'	=> 'text',
									'inputsize'=> '300');
									
		$iva_of_options[] = array( 'name'	=> __('Booking UnConfirmed','iva_theme_admin'),
									'desc'	=> __( 'Text which appears in the Admin area as Booking UnConfirmed','iva_theme_admin'),
									'id'	=> $shortname.'_bk_unconfirm',
									'std'	=> '',
									'type'	=> 'text',
									'inputsize'=> '300');	
		
			$iva_of_options[] = array( 'name'	=> __('Address text','iva_theme_admin'),
										'desc'	=> __('Text which appears in location single page','iva_theme_admin'),
										'id'	=> $shortname.'_loc_address_txt',
										'std'	=> '',
										'type'	=> 'text',
										'inputsize'=> '490');
									
			$iva_of_options[] = array( 'name'	=> __('Phone number text','iva_theme_admin'),
										'desc'	=> __('Text which appears in location single page','iva_theme_admin'),
										'id'	=> $shortname.'_loc_phone_txt',
										'std'	=> '',
										'type'	=> 'text',
										'inputsize'=> '490');	
									
			$iva_of_options[] = array( 'name'	=> __('Services text','iva_theme_admin'),
										'desc'	=> __('Text which appears in location single page','iva_theme_admin'),
										'id'	=> $shortname.'_loc_services_txt',
										'std'	=> '',
										'type'	=> 'text',
										'inputsize'=> '490');	
									
			$iva_of_options[] = array( 'name'	=> __('No Results text','iva_theme_admin'),
										'desc'	=> __('Text which appears in location single page','iva_theme_admin'),
										'id'	=> $shortname.'_loc_no_results_txt',
										'std'	=> '',
										'type'	=> 'text',
										'inputsize'=> '490');

			$iva_of_options[] = array( 'name' => __('Select location text','iva_theme_admin'),
										'desc'	=> __('Text which appears in location template page','iva_theme_admin'),
										'id'	=> $shortname.'_loc_select_location_txt',
										'std'	=> '',
										'type'	=> 'text',
										'inputsize'=> '490');	
									
			$iva_of_options[] = array( 'name'	=> __('Select City text','iva_theme_admin'),
										'desc'	=> __('Text which appears in location template page','iva_theme_admin'),
										'id'	=> $shortname.'_loc_select_city_txt',
										'std'	=> '',
										'type'	=> 'text',
										'inputsize'=> '490');						
		
	return $iva_of_options;
}	
?>