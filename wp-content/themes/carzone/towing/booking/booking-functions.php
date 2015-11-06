<?php
/**
 * function iva_bk_form_insert
 * function that inserts appointment form data into database and sends mail to admin email,user email
 * @param 'str' inpput string
 * @param 'arr' If the second parameter arr is present, variables are stored in this variable as array elements instead. 
 * @return No value is returned. 
 */
add_action('wp_ajax_iva_bk_form_insert', 'iva_bk_form_insert');
add_action('wp_ajax_nopriv_iva_bk_form_insert', 'iva_bk_form_insert');
function iva_bk_form_insert(){
	$postForm = isset( $_POST['data'] ) ? $_POST['data'] :'';

	/**
	 * function parse_str
	 * @param 'str' inpput string
	 * @param 'arr' If the second parameter arr is present, variables are stored in this variable as array elements instead. 
	 * @return No value is returned. 
	 **/
	global $iva_templateid;	
	parse_str( $postForm, $formdata );	

	$iva_bk_fname = $iva_bk_phoneno = $iva_bk_email = $iva_bk_offers = $iva_bk_pcontact = $iva_bk_make = $iva_bk_model = $iva_bk_year = $iva_bk_service = $iva_bk_date = $iva_time = $iva_bk_status ='';	
	$post  = ( !empty( $_POST ) ) ? true : false;

	$iva_bk_fname    = isset( $formdata['bk_name'] ) ? $formdata['bk_name'] :''; 
	$iva_bk_phoneno  = isset( $formdata['bk_phoneno'] ) ? $formdata['bk_phoneno'] :''; 
	$iva_bk_email  	 = isset( $formdata['bk_email'] ) ? $formdata['bk_email'] :'';
	$iva_bk_ofr  	 = isset( $formdata['bk_ofr'] ) ? $formdata['bk_ofr'] :'';
	$iva_bk_pcontact = isset( $formdata['bk_pcontact'] ) ? $formdata['bk_pcontact'] :'';	
	$iva_bk_make     = isset( $formdata['bk_make'] ) ? $formdata['bk_make'] :'';
	$iva_bk_model    = isset( $formdata['bk_model'] ) ? $formdata['bk_model'] :'';
	$iva_bk_year     = isset( $formdata['bk_year'] ) ? $formdata['bk_year'] :'';
	$iva_bk_service  = isset( $formdata['bk_service'] ) ? $formdata['bk_service'] :'';
	$iva_bk_date     = isset( $formdata['dateselect'] ) ? $formdata['dateselect'] :''; 
	$iva_bk_timings  = isset( $formdata['bk_timings'] ) ? $formdata['bk_timings'] :''; 
	$iva_bk_status   = isset( $formdata['bk_status'] ) ? $formdata['bk_status'] :'';


	$iva_format = get_option( 'iva_time_format')? get_option( 'iva_time_format') :'12';
	if( $iva_format == '12'){
      $timeformat     = "h:i A";
    }elseif( $iva_format == '24'){
      $timeformat     = "H:i";
    }else{
      $timeformat     = "h:i A";
    }

	$iva_time = date( $timeformat ,strtotime( $iva_bk_timings ));

	/**
	* If error occurs display it, otherwise send the email 
	*/
	if( $iva_bk_fname && $iva_bk_phoneno && $iva_bk_email && $iva_bk_pcontact && $iva_bk_make && $iva_bk_model && $iva_bk_year && $iva_bk_service && $iva_bk_date && $iva_bk_timings && $iva_bk_status ){

		/**
		* Prepare and store appointment post data and update its meta data
		*/
		$bk_data =  array(
			'post_title' => $formdata['bk_name'], 
			'post_type'  => 'booking',                                            
			'post_status'=> 'publish'
		);
		
		// Inserts post 
		$bk_data_id = wp_insert_post( $bk_data ); 
		
		$bk_fields =  array( 
			'bk_phoneno', 
			'bk_email',
			'bk_pcontact',			
			'bk_make',
			'bk_model',
			'bk_year',
			'bk_service'
		   );
		foreach( $bk_fields as $bk_field ){
			if( isset( $formdata[$bk_field]) ){
			  update_post_meta( $bk_data_id,'iva_'.$bk_field,$formdata[$bk_field] );
			}
		}
		update_post_meta( $bk_data_id,'iva_bk_timings', $iva_bk_timings );
		update_post_meta( $bk_data_id,'iva_bk_date',strtotime( $formdata['dateselect'] ) );
		update_post_meta( $bk_data_id,'iva_bk_status',$iva_bk_status );
		update_post_meta( $bk_data_id,'iva_bk_offers',$iva_bk_ofr );

		$offr_titles =array();
		if( !empty( $iva_bk_ofr ) ){
			foreach ($iva_bk_ofr as $key => $value) {
				$offr_data_id = get_post($value);
				$offr_titles[] = $offr_data_id->post_title;
			}
		}	
		if(!empty($offr_titles)){
			$iva_bk_offers = implode(',',$offr_titles);
		}
		
		/**
		 * Client Notification message
		 */ 
		$iva_usr_placeholders  = array(
									'[first_name]',
									'[phone_no]',
									'[email]',
									'[offer]',
									'[method_of_contact]',									
									'[make]',
									'[model]',
									'[year]',
									'[service_request]',
									'[booking_date]',
									'[booking_time]',
									'[booking_status]'
								 );
		$iva_usr_values  = array( 
								$iva_bk_fname, 
								$iva_bk_phoneno, 
								$iva_bk_email,
								$iva_bk_offers,
								$iva_bk_pcontact, 								 
								$iva_bk_make, 
								$iva_bk_model, 
								$iva_bk_year,
								$iva_bk_service,
								$iva_bk_date, 
								$iva_time, 
								$iva_bk_status
							);

		$page_link= get_page_link($iva_templateid);
		$page_link_perma= true;

		if ( strpos($page_link, '?')!==false ) $page_link_perma= false;
	

		$iva_client_notify_msg  	= get_option('iva_bk_client_notify_msg'); //get email message	
		$iva_client_notify_em_msg   = str_replace( $iva_usr_placeholders,$iva_usr_values,$iva_client_notify_msg ); // Replace the placeholders
		$iva_client_notify_em_msg 	.=  $page_link.( ($page_link_perma?'?':'&') ).'email='.urlencode($iva_bk_email).'&key='.md5($iva_bk_email);
	
		/**
		 * Admin Notification message
		 */
		 $iva_admin_placeholders  = array(
									'[first_name]',
									'[phone_no]',
									'[email]',
									'[offer]',
									'[method_of_contact]',									
									'[make]',
									'[model]',
									'[year]',
									'[service_request]',
									'[booking_date]',
									'[booking_time]',
									'[booking_status]'
								 );
		$iva_admin_values  = array( 
								$iva_bk_fname, 
								$iva_bk_phoneno, 
								$iva_bk_email,
								$iva_bk_offers, 
								$iva_bk_pcontact, 								
								$iva_bk_make, 
								$iva_bk_model, 
								$iva_bk_year, 
								$iva_bk_service,
								$iva_bk_date, 
								$iva_time, 
								$iva_bk_status
							);
		$iva_admin_notify_msg 		= get_option('iva_admin_notification_msg'); // Get email message
		$iva_admin_notify_em_msg    = str_replace( $iva_admin_placeholders,$iva_admin_values,$iva_admin_notify_msg ); // Replace the placeholders

		/**
		 * Notification Subject
		 */
		$iva_client_notify_sub 		= get_option('iva_bk_client_notify_subject');
		$iva_subj_placeholders      = array('[booking_id]');
		$iva_subj_values            = array( $bk_data_id );
		$iva_notify_email_subject	= str_replace( $iva_subj_placeholders,$iva_subj_values,$iva_client_notify_sub ); // Replace the placeholders

		/** 
		 * Send email
		 */
		$iva_client_email = $iva_bk_email;
		$iva_admin_email  = get_option('iva_admin_emailid');   

		/**
		 * Headers
		 */
		$iva_bk_headers_msg = get_option('iva_bk_headers_msg') ? get_option('iva_bk_headers_msg'): get_option('blogname');
		$client_headers = 'From: ' . $iva_bk_headers_msg . ' Booking <' .$iva_admin_email. '>' . "\r\n\\";
		$admin_headers = 'From: ' . $iva_bk_headers_msg . ' Booking <' .$iva_client_email. '>' . "\r\n\\";

		/**
		 * Sends mail to user mail
		 */
		wp_mail( $iva_bk_email,$iva_notify_email_subject, $iva_client_notify_em_msg,$client_headers );

		/**
		 * Sends mail to admin email
		 */
		wp_mail( $iva_admin_email,$iva_notify_email_subject, $iva_admin_notify_em_msg,$admin_headers );

		$iva_bk_msg  			= get_option('iva_bk_thankyou_msg') ? get_option('iva_bk_thankyou_msg'): __( 'Thank you for booking appointment','iva_theme_front');
		$iva_bk_placeholders	= array('[first_name]');
		$iva_bk_values 			= array( $iva_bk_fname);
		$iva_bk_thanku_message 	= str_replace( $iva_bk_placeholders,$iva_bk_values,$iva_bk_msg ); // Replace the placeholders
		$iva_bk_response 		= '<div id="bk_msg" class="iva_message_box success iva-box-solid iva-box-normal clearfix"><div class="iva_message_box_content">'.$iva_bk_thanku_message.'</div></div>';
	}else{ 
		/**
		 * If error occurs in validation
		 */
		$iva_bk_response = '<div id="bk_msg" class="iva_message_box error iva-box-solid iva-box-normal clearfix"><div class="iva_message_box_content">'.__('error','iva_theme_front').'</div></div>';
	}
	echo $iva_bk_response;
	die();
}

//Update
add_action('wp_ajax_iva_bk_form_update', 'iva_bk_form_update');
add_action('wp_ajax_nopriv_iva_bk_form_update', 'iva_bk_form_update');

function iva_bk_form_update(){
	
	global $iva_templateid;

	$postForm = isset( $_POST['data'] ) ? $_POST['data'] :'';

   /**
	* function parse_str
	* @param 'str' inpput string
	* @param 'arr' If the second parameter arr is present, variables are stored in this variable as array elements instead. 
	* @return No value is returned. 
	**/
	parse_str( $postForm, $formdata );
	$iva_bk_fname = $iva_bk_phoneno = $iva_bk_email = $iva_bk_offers = $iva_bk_pcontact = $iva_bk_make = $iva_bk_model = $iva_bk_year = $iva_bk_service = $iva_bk_date = $iva_time = $iva_bk_status ='';
	$post  = ( !empty( $_POST ) ) ? true : false;

	$iva_bk_fname    = isset( $formdata['bk_name'] ) ? $formdata['bk_name'] :''; 
	$iva_bk_phoneno  = isset( $formdata['bk_phoneno'] ) ? $formdata['bk_phoneno'] :''; 
	$iva_bk_email  	 = isset( $formdata['bk_email'] ) ? $formdata['bk_email'] :'';
	$iva_bk_ofr      = isset( $formdata['bk_ofr'] ) ? $formdata['bk_ofr'] :'';
	$iva_bk_pcontact = isset( $formdata['bk_pcontact'] ) ? $formdata['bk_pcontact'] :'';	
	$iva_bk_make     = isset( $formdata['bk_make'] ) ? $formdata['bk_make'] :'';
	$iva_bk_model    = isset( $formdata['bk_model'] ) ? $formdata['bk_model'] :'';
	$iva_bk_year     = isset( $formdata['bk_year'] ) ? $formdata['bk_year'] :'';
	$iva_bk_service  = isset( $formdata['bk_service'] ) ? $formdata['bk_service'] :'';
	$iva_bk_date     = isset( $formdata['dateselect'] ) ? $formdata['dateselect'] :''; 
	$iva_bk_timings	 = isset( $formdata['bk_timings'] ) ? $formdata['bk_timings'] :''; 
	$iva_bk_status   = isset( $formdata['bk_status'] ) ? $formdata['bk_status'] :''; 

	$iva_format = get_option( 'iva_time_format')? get_option( 'iva_time_format') :'12';
	if( $iva_format == '12'){
      $timeformat     = "h:i A";
    }elseif( $iva_format == '24'){
      $timeformat     = "H:i";
    }else{
      $timeformat     = "h:i A";
    }

	$iva_time = date( $timeformat ,strtotime( $iva_bk_timings ));

	$bk_data_id = isset($_POST['upost_id']) ? $_POST['upost_id'] : '' ;
	
	/**
	* If error occurs display it, otherwise send the email 
	*/
	if( $iva_bk_fname && $iva_bk_phoneno && $iva_bk_email && $iva_bk_pcontact && $iva_bk_make && $iva_bk_model && $iva_bk_year && $iva_bk_service && $iva_bk_date && $iva_time && $iva_bk_status ){

		/**
		* Prepare and store appointment post data and update its meta data
		*/
		 $bk_data =  array(
				'post_title' => $formdata['bk_name'], 
				'post_type'  => 'booking',  
				'ID'         => $bk_data_id,		
				'post_status'=> 'publish'
		  );
		 wp_update_post( $bk_data );
		 
		$bk_fields =  array( 
			'bk_phoneno', 
			'bk_email',
			'bk_pcontact',			
			'bk_make',
			'bk_model',
			'bk_year',
			'bk_service'
		   );
		foreach( $bk_fields as $bk_field ){
			if( isset( $formdata[$bk_field]) ){
			  update_post_meta( $bk_data_id,'iva_'.$bk_field,$formdata[$bk_field] );
			}
		}
		update_post_meta( $bk_data_id,'iva_bk_timings', $iva_bk_timings );
		update_post_meta( $bk_data_id,'iva_bk_date',strtotime( $formdata['dateselect'] ) );
		update_post_meta( $bk_data_id,'iva_bk_status',$iva_bk_status ); 
		update_post_meta( $bk_data_id,'iva_bk_offers',$iva_bk_ofr );
		
		$offr_titles =array();
		if( !empty( $iva_bk_ofr ) ){
			foreach ($iva_bk_ofr as $key => $value) {
				$offr_data_id = get_post($value);
				$offr_titles[] = $offr_data_id->post_title;
			}
		}
		if(!empty($offr_titles)){
			$iva_bk_offers = implode(',',$offr_titles);
		}
		/**
		 * Client Notification message
		 */ 
		$iva_usr_placeholders  = array(
									'[first_name]',
									'[phone_no]',
									'[email]',
									'[offer]',
									'[method_of_contact]',									
									'[make]',
									'[model]',
									'[year]',
									'[service_request]',
									'[booking_date]',
									'[booking_time]',
									'[booking_status]'
								 );
		$iva_usr_values  = array( 
								$iva_bk_fname, 
								$iva_bk_phoneno, 
								$iva_bk_email,
								$iva_bk_offers,
								$iva_bk_pcontact, 								 
								$iva_bk_make, 
								$iva_bk_model, 
								$iva_bk_year,
								$iva_bk_service,
								$iva_bk_date, 
								$iva_time, 
								$iva_bk_status
							);
		/** 
		 * Prepare confirmation email to send 
		 */
		$page_link= get_page_link($iva_templateid);
		$page_link_perma= true;

		if ( strpos($page_link, '?')!==false )
		$page_link_perma= false;

		$iva_client_notify_msg  	= get_option('iva_bk_client_notify_msg'); //get email message		
		$iva_client_notify_em_msg   = str_replace( $iva_usr_placeholders,$iva_usr_values,$iva_client_notify_msg ); // Replace the placeholders
		$iva_client_notify_em_msg 	.=  $page_link.( ($page_link_perma?'?':'&') ).'email='.urlencode($iva_bk_email).'&key='.md5($iva_bk_email);
	
		/**
		 * Admin Notification message
		 */
		 $iva_admin_placeholders  = array(
									'[first_name]',
									'[phone_no]',
									'[email]',
									'[offer]',
									'[method_of_contact]',									
									'[make]',
									'[model]',
									'[year]',
									'[service_request]',
									'[booking_date]',
									'[booking_time]',
									'[booking_status]'
								 );
		$iva_admin_values  = array( 
								$iva_bk_fname, 
								$iva_bk_phoneno, 
								$iva_bk_email,
								$iva_bk_offers,
								$iva_bk_pcontact, 								
								$iva_bk_make, 
								$iva_bk_model, 
								$iva_bk_year, 
								$iva_bk_service,
								$iva_bk_date, 
								$iva_time, 
								$iva_bk_status
							);
		$iva_admin_notify_msg 		= get_option('iva_admin_notification_msg'); // Get email message
		$iva_admin_notify_em_msg    = str_replace( $iva_admin_placeholders,$iva_admin_values,$iva_admin_notify_msg ); // Replace the placeholders

		/**
		 * Notification Subject
		 */
		$iva_client_notify_sub 		= get_option('iva_bk_client_notify_subject');
		$iva_subj_placeholders      = array('[booking_id]');
		$iva_subj_values            = array( $bk_data_id );
		$iva_notify_email_subject	= str_replace( $iva_subj_placeholders,$iva_subj_values,$iva_client_notify_sub ); // Replace the placeholders

		/** 
		 * Send email
		 */
		$iva_client_email = $iva_bk_email;
		$iva_admin_email  = get_option('iva_admin_emailid');   

		/**
		 * Headers
		 */
		$iva_bk_headers_msg = get_option('iva_bk_headers_msg') ? get_option('iva_bk_headers_msg'): get_option('blogname');
		$client_headers = 'From: ' . $iva_bk_headers_msg . ' Booking <' .$iva_admin_email. '>' . "\r\n\\";
		$admin_headers = 'From: ' . $iva_bk_headers_msg . ' Booking <' .$iva_client_email. '>' . "\r\n\\";

		/**
		 * Sends mail to user mail
		 */
		wp_mail( $iva_client_email,$iva_notify_email_subject, $iva_client_notify_em_msg,$client_headers );

		/**
		 * Sends mail to admin email
		 */
		wp_mail( $iva_admin_email,$iva_notify_email_subject, $iva_admin_notify_em_msg,$admin_headers );

		$iva_bk_msg  			= get_option('iva_bk_thankyou_msg') ? get_option('iva_bk_thankyou_msg'): __( 'Thank you for booking appointment','iva_theme_front');
		$iva_bk_placeholders	= array('[first_name]');
		$iva_bk_values 			= array( $iva_bk_fname);
		$iva_bk_thanku_message 	= str_replace( $iva_bk_placeholders,$iva_bk_values,$iva_bk_msg ); // Replace the placeholders
		$iva_bk_response 		= '<div id="bk_msg" class="iva_message_box success iva-box-solid iva-box-normal clearfix"><div class="iva_message_box_content">'.$iva_bk_thanku_message.'</div></div>';
	}else{ 
		/**
		 * If error occurs in validation
		 */
		$iva_bk_response = '<div id="bk_msg" class="iva_message_box error iva-box-solid iva-box-normal clearfix"><div class="iva_message_box_content">'.__('error','iva_theme_front').'</div></div>';
	}
	echo $iva_bk_response;
	die();
}

add_action('wp_ajax_iva_get_bk_timings','iva_get_bk_timings');
add_action('wp_ajax_nopriv_iva_get_bk_timings','iva_get_bk_timings');
function iva_get_bk_timings(){
  
    global $default_date;

    // Gets weekday,date values
    $iva_weekday    		= isset( $_POST['week_day'] ) ? esc_html( $_POST['week_day'] ) :'';  
    $iva_time_txt   		= get_option('iva_bk_timetxt') ? get_option('iva_bk_timetxt') : __('Time','iva_theme_front');
    $iva_weekdays   		= array('sunday','monday','tuesday','wednesday','thursday','friday','saturday');
    $iva_hrs        		= get_option( 'iva_'.$iva_weekdays[$iva_weekday] );      
    $iva_interval   		= get_option('iva_time_interval') ? get_option('iva_time_interval'):'15';
    $iva_format     		= get_option( 'iva_time_format')? get_option( 'iva_time_format') :'12';
	$iva_time_select_txt	= get_option('iva_bk_time_select_txt') ? get_option('iva_bk_time_select_txt') : __('Select Time','iva_theme_front');
	$iva_closed_txt 		= get_option('iva_bk_closedmsgtxt') ? get_option('iva_bk_closedmsgtxt') : __('Sorry we are closed this day', 'iva_theme_front');   

    if( $iva_format == '12'){
      $timeformat     = "h:i A";
    }elseif( $iva_format == '24'){
      $timeformat     = "H:i";
    }else{
      $timeformat     = "h:i A";
    }

    $iva_time_interval = '+'.$iva_interval.'minutes';
    $open_hrs          =  strtotime( $iva_hrs['opening'] );
    $close_hrs         =  strtotime( $iva_hrs['closing']);
    $closed_hrs        =  $iva_hrs['close'];
    $iva_bk_hours      =  get_option('iva_hrs') ? get_option('iva_hrs'):'';
	
	if( isset( $iva_bk_hours) &&  $iva_bk_hours!='' ){
		$hide_hours = $iva_bk_hours[$iva_weekday];
	}
	if( $closed_hrs == 'off' ){
		echo '<label for="bk_timings" class="bk_req">'.$iva_time_txt.'</label>';
		echo '<div class="iva_bk_timings">';
		echo '<select name="bk_timings" id="bk_timings">';
		echo '<option value="">'.$iva_time_select_txt.'</option>';
		while( $open_hrs < $close_hrs ){
			$iva_time_hrs = date( $timeformat,$open_hrs );
			if( !empty( $iva_bk_hours ) && ( $iva_bk_hours !='' ) ){
				if( @!in_array( $iva_time_hrs , $hide_hours  )) { 
					echo '<option value="'.date( 'H:i',$open_hrs ).'">'.$iva_time_hrs.'-'.date( $timeformat,strtotime( $iva_time_interval, $open_hrs ) ).'</option>'; 
				}
			}else{
				echo '<option value="'.date( 'H:i',$open_hrs) .'">'.$iva_time_hrs.'-'.date( $timeformat,strtotime( $iva_time_interval, $open_hrs ) ).'</option>'; 
			}
			$open_hrs = strtotime( $iva_time_interval, $open_hrs );	
		}
		echo '</select>';
		echo '</div>';			
	}else{ 
		echo '<label for="bk_timings" class="bk_req">'.$iva_time_txt.'</label>';
		echo '<div class="iva_bk_timings">';
		echo '<select name="bk_timings" id="bk_timings">';
		echo '<option value="">'.$iva_closed_txt.'</option>';
		echo '</select>';
		echo '</div>';
	}
    exit; // This is required to end AJAX requests properly.
}

add_action('wp_ajax_iva_get_bk_single_timings','iva_get_bk_single_timings');
add_action('wp_ajax_nopriv_iva_get_bk_single_timings','iva_get_bk_single_timings');
function iva_get_bk_single_timings(){

	$iva_postid = isset($_POST['iva_postid']) ? $_POST['iva_postid'] : '' ;
	$iva_timings = get_post_meta($iva_postid ,'iva_bk_timings','true');

	// Gets weekday,date values
	$iva_weekday			= isset( $_POST['week_day'] ) ? esc_html( $_POST['week_day'] ) :'';
	$iva_time_txt			= get_option('iva_bk_timetxt') ? get_option('iva_bk_timetxt') : 'Time';
	$iva_time_select_txt	= get_option('iva_bk_time_select_txt') ? get_option('iva_bk_time_select_txt') : __('Select Time','iva_theme_front');
	$iva_closed_txt 		= get_option('iva_bk_closedmsgtxt') ? get_option('iva_bk_closedmsgtxt') : __('Sorry we are closed this day', 'iva_theme_front');   
	$iva_weekdays 			= array('sunday','monday','tuesday','wednesday','thursday','friday','saturday');
	$iva_hrs 				= get_option( 'iva_'.$iva_weekdays[$iva_weekday] );		
	$interval 				= get_option('iva_time_interval') ? get_option('iva_time_interval'):'15';
	$iva_format 			= get_option( 'iva_time_format')? get_option( 'iva_time_format') :'12';
	
	if( $iva_format == '12'){
		$timeformat = "h:i A";
	}elseif( $iva_format == '24'){
		$timeformat = "H:i";
	}else{
		$timeformat = "h:i A";
	}
	$iva_time_interval  = '+'.$interval.'minutes';
	$open_hrs   		=  strtotime( $iva_hrs['opening'] );
	$close_hrs 			=  strtotime( $iva_hrs['closing']);
	$closed_hrs 		=  $iva_hrs['close'];		
	$iva_bk_hours		=  get_option('iva_hrs') ? get_option('iva_hrs'):'';

	if( isset( $iva_bk_hours) &&  $iva_bk_hours!='' ){
		$hide_hours = $iva_bk_hours[$iva_weekday];
	}
	if( $closed_hrs == 'off' ){
		echo '<label for="bk_timings" class="bk_req">'.$iva_time_txt.'</label>';
		echo '<div class="iva_bk_timings">';
		echo '<select name="bk_timings" id="bk_timings">';
		echo '<option value="">'.$iva_time_select_txt.'</option>';
		while( $open_hrs < $close_hrs ){
			$iva_time_hrs = date( $timeformat,$open_hrs );
			$selected ='';
			echo $iva_timings;
			if( $iva_timings == date( 'H:i',$open_hrs )){ 
				$selected = 'selected = "selected"';
			}
			if( !empty( $iva_bk_hours ) && ( $iva_bk_hours !='' ) ){
				if( @!in_array( $iva_time_hrs , $hide_hours  )) { 
					echo '<option value="'.date( 'H:i',$open_hrs ).'" '.$selected.'>'.$iva_time_hrs.'-'.date( $timeformat,strtotime( $iva_time_interval, $open_hrs ) ).'</option>'; 
				}
			}else{
				echo '<option value="'.date( 'H:i',$open_hrs) .'" '.$selected.'>'.$iva_time_hrs.'-'.date( $timeformat,strtotime( $iva_time_interval, $open_hrs ) ).'</option>'; 
			}
			$open_hrs = strtotime( $iva_time_interval, $open_hrs );	
		}
		echo '</select>';
		echo '</div>';			
	}else{ 
		echo '<label for="bk_timings"  class="bk_req">'.$iva_time_txt.'</label>';
		echo '<div class="iva_bk_timings">';
		echo '<select name="bk_timings" id="bk_timings">';
		echo '<option value="">'.$iva_closed_txt.'</option>';
		echo '</select>';
		echo '</div>';
	}
	exit; // This is required to end AJAX requests properly.
}
?>