<?php
/*
Template Name: Manage Bookings
*/
get_header();
?>
<div id="primary" class="pagemid">
	<div class="inner">
		<main class="content-area" role="main">
			<div class="entry-content-wrapper clearfix">

		<?php
		if ( get_query_var('paged') ) {
			$paged = get_query_var('paged');
		}
		elseif ( get_query_var('page') ) {
			$paged = get_query_var('page');
		} else {
			$paged = 1;  
		}

		global $default_date,$iva_templateid;
		
		if ( get_query_var('email') ) {
			$iva_bk_email  =  get_query_var('email');
		}
		$iva_bk_key 	= isset($_GET['key']) ?  $_GET['key'] : '';
		
		if( isset( $iva_bk_email ) && md5( $iva_bk_email ) == $iva_bk_key ){

			$iva_emai_id = trim( $iva_bk_email,"" );
			$iva_bk_limit = get_option('iva_bk_list_limit') ?  get_option('iva_bk_list_limit') : '-1';

			$args = array(
				'post_type' 	=> 'booking',
				'order'    		=> 'ASC',
				'tax_query' => array(
					'relation' => 'OR',
				),
				'posts_per_page'=> $iva_bk_limit, 
				'paged' 		=> $paged,
				'meta_query' 	=> array(
					'relation' 		=> 'AND',
					array(
						'key' 		=> 'iva_bk_email',
						'value' 	=> $iva_emai_id,
						'compare' 	=> '='),
				)
			);
			query_posts( $args );

			$out ='';
			
			$iva_booking_date		= get_option('iva_bk_date_txt') ? get_option('iva_bk_date_txt') : __('Booking Date','iva_theme_front');
			$iva_booking_time		= get_option('iva_bk_timetxt') ? get_option('iva_bk_timetxt') : __('Booking Time','iva_theme_front');
			$iva_booking_details	= get_option('iva_bk_details_txt') ? get_option('iva_bk_details_txt') : __('Booking Details','iva_theme_front');
			$iva_booking_confirm	= get_option('iva_bk_confirm_txt') ? get_option('iva_bk_confirm_txt') : __('Confirm','iva_theme_front');
			$iva_booking_cancelled	= get_option('iva_bk_cancelled_txt') ? get_option('iva_bk_cancelled_txt') : __('Cancelled','iva_theme_front');
			$iva_booking_update		= get_option('iva_bk_update_txt') ? get_option('iva_bk_update_txt') : __('Update','iva_theme_front');
			$iva_booking_cancel		= get_option('iva_bk_cancel_txt') ? get_option('iva_bk_cancel_txt') : __('Cancel','iva_theme_front');
			$iva_booking_ago		= get_option('iva_bk_ago_txt') ? get_option('iva_bk_ago_txt') : __('ago','iva_theme_front');
			$iva_booking_for		= get_option('iva_bk_for_txt') ? get_option('iva_bk_for_txt') : __('for','iva_theme_front');
			$iva_booking_placed		= get_option('iva_bk_placed_txt') ? get_option('iva_bk_placed_txt') : __('Placed','iva_theme_front');
			$iva_booking_by			= get_option('iva_bk_by_txt') ? get_option('iva_bk_by_txt') : __('by','iva_theme_front');
			$iva_admin_email 		= get_option('iva_admin_emailid')? get_option('iva_admin_emailid'):'';	
			
			$iva_booking_action = isset($_GET['action']) ? $_GET['action'] : '';
			
			if($iva_booking_action == 'confirm'){
				
				$booking_id 	=  	$_GET['id'] ?  $_GET['id'] : '';
				$default_date 	=  	get_option('atp_date_format');
				
				$iva_client_email 	= get_post_meta( $booking_id,'iva_bk_email', true )?get_post_meta( $booking_id,'iva_bk_email', true ):'';			
				$iva_bk_fname       = get_the_title( $booking_id );
				$iva_bk_phoneno 	= get_post_meta( $booking_id ,'iva_bk_phoneno',true );
				$iva_bk_email 		= get_post_meta( $booking_id ,'iva_bk_email',true );
				$iva_bk_pcontact 	= get_post_meta( $booking_id ,'iva_bk_pcontact',true );
				$iva_bk_offers 		= get_post_meta( $booking_id ,'iva_bk_offers',true );
				$iva_bk_make 		= get_post_meta( $booking_id ,'iva_bk_make',true );
				$iva_bk_model 		= get_post_meta( $booking_id ,'iva_bk_model',true );
				$iva_bk_year 		= get_post_meta( $booking_id ,'iva_bk_year',true );
				$iva_bk_service 	= get_post_meta( $booking_id ,'iva_bk_service',true );
				$iva_bk_date 		= get_post_meta( $booking_id ,'iva_bk_date',true );
				$iva_bk_timings 	= get_post_meta( $booking_id ,'iva_bk_timings',true );
				$iva_bk_status 		= get_post_meta( $booking_id ,'iva_bk_status',true );
				
				
				$iva_format = get_option( 'iva_time_format')? get_option( 'iva_time_format') :'12';
				if( $iva_format == '12'){
					$timeformat     = "h:i A";
				}elseif( $iva_format == '24'){
					$timeformat     = "H:i";
				}else{
					$timeformat     = "h:i A";
				}
				$iva_time = date( $timeformat,strtotime( $iva_bk_timings ));
				
				// Offers
				$iva_offer_titles = array();
				if( !empty( $iva_bk_offers ) ){
					foreach( $iva_bk_offers as $key => $value) {
						$offr_data_id = get_post($value);
						$iva_offer_titles[] = $offr_data_id->post_title;
					}
				}
				if( !empty( $iva_offer_titles ) ){
					$iva_bk_offers = implode(',',$iva_offer_titles);
				}
				
				//
				update_post_meta( $booking_id,'iva_bk_status','confirmed' );

				// Subject
				$iva_usr_confrm_subject 		= get_option('iva_usr_confirmed_subject')?get_option('iva_usr_confirmed_subject'):'';
				$iva_usr_confrm_placeholders 	= array('[booking_id]');
				$iva_usr_confrm_values 			= array( $booking_id );
				$iva_usr_confrm_email_subject 	= str_replace( $iva_usr_confrm_placeholders,$iva_usr_confrm_values,$iva_usr_confrm_subject ); //replace the placeholders
				
				
				/** Prepare confirmation email to send **/
				$iva_usr_placeholders  = array(
											'[first_name]',
											'[phone_no]',
											'[email]',
											'[method_of_contact]',
											'[year]',
											'[make]',
											'[model]',
											'[offer]',		
											'[service_request]',
											'[booking_date]',
											'[booking_time]',
											'[booking_status]'
										 );
				$iva_usr_values  = array( 
										$iva_bk_fname, 
										$iva_bk_phoneno, 
										$iva_bk_email,
										$iva_bk_pcontact, 
										$iva_bk_year, 
										$iva_bk_make, 
										$iva_bk_model, 
										$iva_bk_offers,
										$iva_bk_service,
										$iva_bk_date, 
										$iva_time, 
										$iva_bk_status
									);
										
				$iva_usr_confrm_msg 		= get_option('iva_usr_confirmed_em_msg') ? get_option('iva_usr_confirmed_em_msg') : ''; //get email message
				$iva_usr_confrm_email_msg 	= str_replace( $iva_usr_placeholders,$iva_usr_values,$iva_usr_confrm_msg ); //replace the placeholders
				$iva_client_headers			= 'From: ' . get_option('blogname') . ' Booking <' .$iva_admin_email. '>' . "\r\n\\";
				wp_mail( $iva_client_email,$iva_usr_confrm_email_subject, $iva_usr_confrm_email_msg,$iva_client_headers);
			
				// admin Notification message
				$iva_admin_placeholders  = array(
											'[first_name]',
											'[phone_no]',
											'[email]',
											'[method_of_contact]',
											'[year]',
											'[make]',
											'[model]',
											'[offer]',	
											'[service_request]',
											'[booking_date]',
											'[booking_time]',
											'[booking_status]'
										 );
				$iva_admin_values   = array( 
											$iva_bk_fname, 
											$iva_bk_phoneno, 
											$iva_bk_email,
											$iva_bk_pcontact, 
											$iva_bk_year, 
											$iva_bk_make, 
											$iva_bk_model, 
											$iva_bk_offers,
											$iva_bk_service,
											$iva_bk_date, 
											$iva_time, 
											$iva_bk_status
										);
										
				$iva_usr_confrm_msg_to_admin 		= get_option('iva_usr_confirmed_em_msg_to_admin'); //get email message
				$iva_usr_confrm_email_msg_to_admin 	= str_replace( $iva_admin_placeholders,$iva_admin_values,$iva_usr_confrm_msg_to_admin); //replace the placeholders
			
			
				// Emails
				$iva_admin_headers 	= 'From: ' . get_option('blogname') . ' Booking <' .$iva_client_email. '>' . "\r\n\\";
		
				
				
				// send mail to admin
				wp_mail( $iva_admin_email,$iva_usr_confrm_email_subject, $iva_usr_confrm_email_msg_to_admin,$iva_admin_headers);
			
				
				$response = '<div class="iva_message_box success iva-box-solid iva-box-normal"><div class="messagebox_content">'.__('Your Booking is  Confirmed', 'iva_theme_front').'</div></div>';
		
				echo $response;
				
			}
			if( $iva_booking_action == 'cancel'){
				
				$booking_id = $_GET['id'] ?  $_GET['id'] : '';
				$default_date = get_option('atp_date_format');
			
				
				$iva_bk_fname       = get_the_title( $post->ID );
				$iva_bk_phoneno 	= get_post_meta( $post->ID,'iva_bk_phoneno',true );
				$iva_bk_email 		= get_post_meta( $post->ID,'iva_bk_email',true );
				$iva_bk_pcontact 	= get_post_meta( $post->ID,'iva_bk_pcontact',true );
				$iva_bk_offers 		= get_post_meta( $post->ID,'iva_bk_offers',true );
				$iva_bk_make 		= get_post_meta( $post->ID,'iva_bk_make',true );
				$iva_bk_model 		= get_post_meta( $post->ID,'iva_bk_model',true );
				$iva_bk_year 		= get_post_meta( $post->ID,'iva_bk_year',true );
				$iva_bk_service 	= get_post_meta( $post->ID,'iva_bk_service',true );
				$iva_bk_date 		= get_post_meta( $post->ID,'iva_bk_date',true );
				$iva_bk_timings 	= get_post_meta( $post->ID,'iva_bk_timings',true );
				$iva_bk_status 		= get_post_meta( $post->ID,'iva_bk_status',true );
				
				$iva_format = get_option( 'iva_time_format')? get_option( 'iva_time_format') :'12';
				if( $iva_format == '12'){
					$timeformat     = "h:i A";
				}elseif( $iva_format == '24'){
					$timeformat     = "H:i";
				}else{
					$timeformat     = "h:i A";
				}
				$iva_time = date( $timeformat,strtotime( $iva_bk_timings ));
				
				// Offers
				$iva_offer_titles = array();
				if( !empty( $iva_bk_offers ) ){
					foreach( $iva_bk_offers as $key => $value) {
						$offr_data_id = get_post($value);
						$iva_offer_titles[] = $offr_data_id->post_title;
					}
				}
				if( !empty( $iva_offer_titles ) ){
					$iva_bk_offers = implode(',',$iva_offer_titles);
				}
				
				update_post_meta( $booking_id,'iva_bk_status','cancelled' );
				

				/** Prepare cancelled email to send **/
				$iva_usr_placeholders = array(
											'[first_name]',
											'[phone_no]',
											'[email]',
											'[method_of_contact]',
											'[year]',
											'[make]',
											'[model]',
											'[offer]',
											'[service_request]',
											'[booking_date]',
											'[booking_time]',
											'[booking_status]'
										 );
				$iva_usr_values  = array( 
										$iva_bk_fname, 
										$iva_bk_phoneno, 
										$iva_bk_email,
										$iva_bk_pcontact, 
										$iva_bk_year, 
										$iva_bk_make, 
										$iva_bk_model, 
										$iva_bk_offers,
										$iva_bk_service,
										$iva_bk_date, 
										$iva_time, 
										$iva_bk_status
								);
										
				$iva_usr_cancel_msg 		= get_option('iva_usr_cancelled_em_msg') ? get_option('iva_usr_cancelled_em_msg') : ''; //get email message
				$iva_usr_cancel_email_msg 	= str_replace( $iva_usr_placeholders,$iva_usr_values,$iva_usr_cancel_msg ); //replace the placeholders
		
				// admin Notification message
				$iva_admin_placeholders = array(
											'[first_name]',
											'[phone_no]',
											'[email]',
											'[method_of_contact]',
											'[year]',
											'[make]',
											'[model]',
											'[offer]',
											'[service_request]',
											'[booking_date]',
											'[booking_time]',
											'[booking_status]'
										 );
				$iva_admin_values  = array( 
										$iva_bk_fname, 
										$iva_bk_phoneno, 
										$iva_bk_email,
										$iva_bk_pcontact, 
										$iva_bk_year, 
										$iva_bk_make, 
										$iva_bk_model, 
										$iva_bk_offers,
										$iva_bk_service,
										$iva_bk_date, 
										$iva_time, 
										$iva_bk_status
									);
										
				$iva_usr_cancel_msg_to_admin 		= get_option('iva_usr_cancelled_msg_to_admin'); //get email message
				$iva_usr_cancel_email_msg_to_admin 	= str_replace($iva_admin_placeholders,$iva_admin_values,$iva_usr_cancel_msg_to_admin); //replace the placeholders
			
			
				// Subject
				$iva_usr_cancel_subject 		= get_option('iva_usr_cancelled_subject')?get_option('iva_usr_cancelled_subject'):'';
				$iva_usr_cancel_placeholders 	= array('[booking_id]');
				$iva_usr_cancel_values 			= array( $booking_id );
				$iva_usr_cancel_email_subject 	= str_replace( $iva_usr_cancel_placeholders,$iva_usr_cancel_values,$iva_usr_cancel_subject ); //replace the placeholders
				
				// Emails
				$iva_client_email 	= get_post_meta( $booking_id,'iva_bk_email', true )?get_post_meta( $booking_id,'iva_bk_email', true ):'';
				$iva_admin_email 	= get_option('iva_admin_emailid')?get_option('iva_admin_emailid'):'';
				
				// Headers
				$iva_client_headers = 'From: ' . get_option('blogname') . ' Booking <' .$iva_admin_email. '>' . "\r\n\\";
				$iva_admin_headers 	= 'From: ' . get_option('blogname') . ' Booking <' .$iva_client_email. '>' . "\r\n\\";
		
				
				// send mail to user
				wp_mail( $iva_client_email,$iva_usr_cancel_email_subject, $iva_usr_cancel_email_msg,$iva_client_headers);
				
				// send mail to admin
				wp_mail( $iva_admin_email,$iva_usr_cancel_email_subject, $iva_usr_cancel_email_msg_to_admin,$iva_admin_headers);
				
				$response = '<div class="iva_message_box success iva-box-solid iva-box-normal"><div class="messagebox_content">'.__('Your booking is Cancelled', 'iva_theme_front').'</div></div>';
				echo $response;
			}

			$out .= '<table class="iva_rev_table fancy_table" width="100%" border="1px">';

			$out .= '<thead><tr>';
			$out .= '<th class="iva_booking_date">'.$iva_booking_date.'</th>';
			$out .= '<th class="iva_booking_time">'.$iva_booking_time.'</th>';
			$out .= '<th class="iva_booking_details">'.$iva_booking_details.'</th>';
			$out .= '<th class="iva_ucd"></th>';
			$out .= '</tr></thead>';

			if ( have_posts() ) : while ( have_posts() ) : the_post(); 
				$title           =  get_the_title( $post->ID );
				$permalink       =  get_permalink( get_the_id() );
				$iva_published_date =  human_time_diff( get_the_time('U'), current_time('timestamp') ).' '.$iva_booking_ago;
				$iva_book_email  =	get_post_meta( $post->ID,'iva_bk_email',true );
				$iva_book_date   = 	get_post_meta( $post->ID,'iva_bk_date',true );
				$iva_book_status = 	get_post_meta( $post->ID,'iva_bk_status',true );
				$iva_book_time 	 =  get_post_meta( $post->ID,'iva_bk_timings',true );
				$iva_booked_date =  date( $default_date,$iva_book_date );
				$current_date 	 =  strtotime( date('Y-m-d') );

				$out .= '<tr><tbody>';
				if( $iva_book_date !='' ){
					$out .= '<td class="iva_booking_date_val">'.$iva_booked_date.'</td>';
				}
				if($iva_book_time !=''){
					if( get_option('iva_time_format') == '12' ){
						$data_booking = date('h:i A',strtotime( $iva_book_time ));
						$out .= '<td class="iva_booking_time_val">'.$data_booking.'</td>';
					}else{
						$out .= '<td class="iva_booking_time_val">'.date("H:i", strtotime( $iva_book_time )).'</td>';
					}
				}
		
				if($iva_book_status !=''){
					$out .= '<td class="iva_booking_details_val">'.$iva_booking_placed.' <strong>'.$iva_published_date.'</strong>'.' '.$iva_booking_by.'<strong> '.$title.'</strong>-<span class="status status_'.$iva_book_status.'">'.$iva_book_status.'</span></td>';
				}
				$out .='<td class="iva_ucd_val">';
				$out .= '<input type="hidden" name="iva_postid" id="iva_post_id" value="'.$post->ID.'">';
		
				//
				if( $iva_book_status != "cancelled") { 
					$out .='<a class="update btn blue small mr10" href="'.get_permalink( $post->ID ).'" >'.$iva_booking_update.'</a>'; 
					if( $iva_book_status != "confirmed" && $iva_book_status == "unconfirmed" ) { 
						$out .= '<a class="confirm btn green small mr10" href="'.get_page_link($iva_templateid).'/?email='.urlencode($iva_book_email).'&key='.md5($iva_book_email).'&action=confirm&id='.get_the_id().'">'.$iva_booking_confirm.'</a>';
					
					} 
				}
				if( $iva_book_status != "cancelled") { 
					$out .='<a class="cancel btn red small mr10" href="'.get_page_link($iva_templateid).'/?email='.urlencode($iva_book_email).'&key='.md5($iva_book_email).'&action=cancel&id='.get_the_id().'" >'.$iva_booking_cancel.'</a>';
				}else{
					$out .= '<span class="btn red small mr10">'.$iva_booking_cancelled.'</span>';
				}
				$out .='</td>';
				$out .= '</tr></tbody>';
			endwhile; 
			if( function_exists('iva_pagination') ){ 
				$out .= '<tr><td colspan="6">';	
				$out .= iva_pagination();
				$out .= '</td></tr>';
			}
			wp_reset_query();
			endif; 
			$out .= '</table>'; 
			echo $out;
		}
		?>
		<div class="clear"></div>
		</div><!-- .entry-content-wrapper -->
		</main><!-- .content-area -->		
		<div class="clear"></div>
	</div><!-- .inner -->
</div><!-- .pagemid -->
<?php get_footer(); ?>