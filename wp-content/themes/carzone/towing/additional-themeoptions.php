<?php
add_filter('custompost_themeoptions','iva_custompost_themeoptions');
function iva_custompost_themeoptions( $iva_of_options ) {
	global $url, $iva_of_options,$atp_theme;
		$shortname = 'iva';
		// Location	 
		//---------------------------------------------------------------------------------------------------
		$iva_of_options[] = array( 'name' => __('Location','iva_theme_admin'), 'icon' => $url.'booking-icon.png','type' => 'heading');
		//---------------------------------------------------------------------------------------------------


				$iva_of_options[] = array(	'name'	=> __('Location  Background','iva_theme_admin'),
											'desc'	=> __('location  background properties.','iva_theme_admin'),
											'id'	=> $shortname.'_locationbg',
											'std'	=> array(
															'image'		=> '',
															'color'		=> '',
															'style' 	=> 'repeat',
															'position'	=> 'center top',
															'attachment'=> 'scroll'),
											'type'	=> 'background');

				$iva_of_options[] = array(	'name'	=> __('Location  Text Color','iva_theme_admin'),
											'desc'	=> __('Location Text Color','iva_theme_admin'),
											'id'	=> $shortname.'_location_textcolor',
											'std'	=> '', 
											'type'	=> 'color');

											
				$iva_of_options[] = array( 'name'	=> __('Locations Direction Start Address','iva_theme_admin'),
											'desc' 	=> __( 'Start Address which shows in google map for directions', 'iva_theme_admin' ),
											'id' 	=> $shortname.'_loc_dir_start_address',
											'std' 	=> '',
											'type' 	=> 'text',
											'inputsize'=> '330'
									   );

		// Bookings	 
		//--------------------------------------------------------------------------------------------
		$iva_of_options[] = array( 'name' => __('Bookings','iva_theme_admin'), 'icon' => $url.'booking-icon.png','type' => 'heading');
		//-------------------------------------------------------------------------------------------

		// General Settings
		//---------------------------------------------------------------------------------------------------
		$iva_of_options[] = array( 'name'	=> __('General Settings','iva_theme_admin'), 'type' => 'subnav');
		//---------------------------------------------------------------------------------------------------
		$iva_of_options[] = array( 'name'	=> __('Booking Slug','iva_theme_admin'),
									'desc'	=> __( 'Slugs are meant to be used with permalinks as they help describe what you wish to have at the URL.', 'iva_theme_admin' ),
									'id'	=> $shortname.'_booking_slug',
									'std'	=> '',
									'type'	=> 'text',
									'inputsize'=> '330'
							);
		$iva_of_options[] = array( 'name'	=> __('Offers Slug','iva_theme_admin'),
									'desc'	=> __( 'Slugs are meant to be used with permalinks as they help describe what you wish to have at the URL.', 'iva_theme_admin' ),
									'id'	=> $shortname.'_ofrs_slug',
									'std'	=> '',
									'type'	=> 'text',
									'inputsize'=> '330'
							);
		$iva_of_options[] = array( 'name'	=> __('Logo Showcase Slug','iva_theme_admin'),
									'desc'	=> __( 'Slugs are meant to be used with permalinks as they help describe what you wish to have at the URL.', 'iva_theme_admin' ),
									'id'	=> $shortname.'_logosc_slug',
									'std'	=> '',
									'type'	=> 'text',
									'inputsize'=> '330'
							);
		$iva_of_options[] = array( 'name'	=> __('Gallery Slug','iva_theme_admin'),
									'desc'	=> __( 'Slugs are meant to be used with permalinks as they help describe what you wish to have at the URL.', 'iva_theme_admin' ),
									'id'	=> $shortname.'_gallery_slug',
									'std'	=> '',
									'type'	=> 'text',
									'inputsize'=> '330'
							);
		$iva_of_options[] = array( 'name'	=> __('Locations Slug','iva_theme_admin'),
									'desc'	=> __( 'Slugs are meant to be used with permalinks as they help describe what you wish to have at the URL.', 'iva_theme_admin' ),
									'id'	=> $shortname.'_locations_slug',
									'std'	=> '',
									'type'	=> 'text',
									'inputsize'=> '330'
							);
		$iva_of_options[] = array( 'name'	=> __('Calendar Language','iva_theme_admin'),
									'desc'	=> __('Calendar Language','iva_theme_admin'),
									'id'	=> $shortname.'_datepicker_language',
									'std'	=> '',
									'type'	=> 'select',
									'class'	=> 'select300',
									'options'	=> array(
														''  		=> 'English',
														'sq'		=> 'Albanian',
														'ar' 		=> 'Arabic',
														'bg'		=> 'Bulgarian',
														'zh-CN'		=> 'Chinese',
														'zh-TW'  	=> 'Chinese Traditiona',
														'da'		=> 'Danish',
														'fr'  		=> 'French',
														'fa'  		=> 'Farsi',	
														'fi'		=> 'Finnish',
														'de'		=> 'German',
														'ka'		=> 'Georgian',
														'he'  		=> 'Hebrew',
														'id'		=> 'Indonesian',
														'is'		=> 'Icelandic',
														'it'		=> 'Italian',
														'ja'		=> 'Japanese',
														'lt'		=> 'Lithuanian',
														'lv'		=> 'Latvian',
														'ms'		=> 'Malaysian',
														'ml'		=> 'Malayalam',
														'mk'		=> 'Macedonian',
														'nn'		=> 'Norwegian Nynorsk',
														'no'		=> 'Norwegian',
														'pl'		=> 'Polish',
														'pt'		=> 'Portuguese',
														'pt-BR'		=> 'Brazilian',
														'rm'		=> 'Romansh',
														'ro'		=> 'Romanian',
														'ru'		=> 'Russian',
														'sk' 		=> 'Slovak',
														'sl'		=> 'Slovenian',
														'sr' 		=> 'Serbian',
														'sv'		=> 'Swedish',
														'ta'		=> 'Tamil',
														'th'		=> 'Thai',
														'tj'		=> 'Tajiki',
														'tr'		=> 'Turkish',
														'uk'		=> 'Ukrainian',
														'vi'		=> 'Vietnamese'
														),
							);

							
		$iva_of_options[] = array( 'name'	=> __('Time Interval','iva_theme_admin'),
									'desc'	=> __( 'Please select the Time Interval.', 'iva_theme_admin' ),
									'id'	=> $shortname.'_time_interval',
									'std'	=> '',
									'class' => 'select300',
									'type'	=> 'select',
									'options'	=> array( '60' => '1 Hour',
														  '30' => '30 Minutes',
														  '15' => '15 Minutes',
												),
							);
		$iva_of_options[] = array( 'name'	=> __('Time Format','iva_theme_admin'),
									'desc'	=> __( 'Please select the Time Format.', 'iva_theme_admin' ),
									'id'	=> $shortname.'_time_format',
									'std'	=> '',
									'class' => 'select300',
									'type'	=> 'select',
									'options'	=> array( '24' => '24 Hours',
														  '12' => '12 Hours',
												),
							);
					
		$iva_of_options[] = array( 'name'	=> __('Calendar Week Start Day','iva_theme_admin'),
									'desc'	=> __( 'Set the first day of the week: Sunday is 0, Monday is 1, etc.', 'iva_theme_admin' ),
									'id'	=> $shortname.'_first_day',
									'std'	=> '',
									'class' => 'select300',
									'type'	=> 'select',
									'options'	=> array(
													'0' => 'Sunday',
													'1' => 'Monday',
													'2' => 'Tuesday',
													'3' => 'Wednesday',
													'4' => 'Thursday',
													'5' => 'Friday',
													'6' => 'Saturday',
												 ),
							);				
		$iva_of_options[] = array( 'name'	  => __('Weather Location','iva_theme_admin'),
									'desc'	  => __( 'Location of the weather like New York, USA. This is used on Bookings Page above the calendar', 'iva_theme_admin' ),
									'id'	   => $shortname.'_weather_loc',
									'std'	   => '',
									'type'	   => 'text',
									'inputsize'=> '330'
							);
		$iva_of_options[] = array( 'name'		=> __('Weather Unit','iva_theme_admin'),
									'desc'		=> __( 'Select the weather unit. This is used on Bookings Page above the calendar', 'iva_theme_admin' ),
									'id'		=> $shortname.'_weather_unit',
									'std'		=> 'f',
									'type'		=> 'radio',
									'class'		=> '',
									'inputsize'	=> '',
									'options'   => array( 
													'f' => 'Fahrenheit',
													'c'	=> 'Celsius'
												   )
								);
		$iva_of_options[] = array( 
								'name'	=> __('Disable Calender Days Using Date Picker','iva_theme_admin'),
								'desc'	=> __('Use the following generator to disable certain dates from the calendar. Disabled dates will not be available for booking. Please do not manually edit the date text. Use the datepicker to enter the date.','iva_theme_admin'),
								'id'	=> $shortname.'_disable_days',
								'std'	=> '',
								'type'	=> 'add_custom_dates'
							);

		$iva_of_options[] = array( 'name'	=> __('Disable Calender Week Days','iva_theme_admin'),
									'desc'	=> __('Select the days you wish to make it off by default in the calendar. This is used on appointments page above the calendar','iva_theme_admin'),
									'id'	=> $shortname.'_disable_weekdays',
									'std'	=> '',
									'type'	=> 'multiselect',
									'inputsize'=> '330',
									'options'	=> array(
												'0' => 'Sunday',
												'1' => 'Monday',
												'2' => 'Tuesday',
												'3' => 'Wednesday',
												'4' => 'Thursday',
												'5' => 'Friday',
												'6' => 'Saturday',
											),
						);
				
		$iva_of_options[] = array( 'name'		=> __('Bookings Page','iva_theme_admin'),
									'desc'	 	=> __( 'Please select the page that is to display the Booking Form.', 'iva_theme_admin' ),
									'id'		=> $shortname.'_bk_template_page',
									'std'		=> '',
									'options' 	=> $atp_theme->atp_variable('pages'),
									'class' 	=> 'select300',
									'type'		=> 'select'
							);					
									
		$iva_of_options[] = array( 'name' => __('Bookings List Limit','iva_theme_admin'),
									'desc'		=> __('Type the limits you wish to limit on the Manage Bookings Page. (Example: 5)','iva_theme_admin'),
									'id'		=> $shortname.'_bk_list_limit',
									'std'		=> '',
									'type'		=> 'text',
									'inputsize'	=> '330'
							);
		$iva_of_options[] = array( 'name'	=> __('Booking Page Button Color','iva_theme_admin'),
									'desc'	=> __( 'Button Color  which appears on Booking Single Page, Booking Template Page', 'iva_theme_admin' ),
									'id'	=> $shortname.'_bk_btn_color',
									'std'	=> '',
									'class' => 'select300',
									'type'	=> 'select',
									'options'	=> array(
												''		=> 'Choose one...',
												'gray'		=> 'Gray',
												'brown'		=> 'Brown',
												'cyan'		=> 'Cyan',
												'orange'	=> 'Orange',
												'red'		=> 'Red',
												'magenta'	=> 'Magenta',
												'yellow'	=> 'Yellow',
												'blue'		=> 'Blue',
												'pink'		=> 'Pink',
												'green'		=> 'Green',
												'black'		=> 'Black',
												'white'		=> 'White',
												),
									'inputsize'=> '330'
							);
		// Business Hours Setup		
		//----------------------------------------------------------------------------------------
		$iva_of_options[] = array( 'name'	=> __('Business Hours','iva_theme_admin'), 'type' => 'subnav');
		//----------------------------------------------------------------------------------------
		$iva_of_options[] = array(	'name'	=> __('Sunday','iva_theme_admin'),
									'desc'	=> '',
									'id'	=> $shortname.'_sunday',
									'std'	=> '',
									'type'	=> 'businesshours'
							);
		$iva_of_options[] = array(	'name'	=> __('Monday','iva_theme_admin'),
									'desc'	=> '',
									'id'	=> $shortname.'_monday',
									'std'	=> '',
									'type'	=> 'businesshours'
							);
		$iva_of_options[] = array(	'name'	=> __('Tuesday','iva_theme_admin'),
									'desc'	=> '',
									'id'	=> $shortname.'_tuesday',
									'std'	=> '',
									'type'	=> 'businesshours'
							);
		$iva_of_options[] = array(	'name'	=> __('Wednesday','iva_theme_admin'),
									'desc'	=> '',
									'id'	=> $shortname.'_wednesday',
									'std'	=> '',
									'type'	=> 'businesshours'
							);
		$iva_of_options[] = array(	'name'	=> __('Thursday','iva_theme_admin'),
									'desc'	=> '',
									'id'	=> $shortname.'_thursday',
									'std'	=> '',
									'type'	=> 'businesshours'
							);
		$iva_of_options[] = array(	'name'	=> __('Friday','iva_theme_admin'),
									'desc'	=> '',
									'id'	=> $shortname.'_friday',
									'std'	=> '',
									'type'	=> 'businesshours'
							);
		$iva_of_options[] = array(	'name'	=> __('Saturday','iva_theme_admin'),
									'desc'	=> '',
									'id'	=> $shortname.'_saturday',
									'std'	=> '',
									'type'	=> 'businesshours'
							);

		// Closed Hours Setup		
		//----------------------------------------------------------------------------------------
		$iva_of_options[] = array( 'name'	=> __('Closed Hours','iva_theme_admin'), 'type' => 'subnav');
		//-------------------------------------------------------------------------------------	
		$iva_of_options[] = array(	'name'	=> __("We're closed on these hours",'iva_theme_admin'),
									'desc'	=> '',
									'id'	=> $shortname.'_hrs',						
									'std'	=> '',
									'type'	=> 'closehours'
							);

	
		// Email Setup 
		//------------------------------------------------------------------------------------------------
		$iva_of_options[] = array( 'name'	=> __('Front end E-mails Setup','iva_theme_admin'), $url.'booking-icon.png', 'type' => 'subnav');
		//------------------------------------------------------------------------------------------------					
		$iva_of_options[] = array(  'name'	=> __('Shortcodes for Email Setup','iva_theme_admin'),
									'desc'	=> __('Custom shortcodes defined for this theme in use for the Email Message systems<br><br> 
												[first_name] 		- <em>First Name of the Customer </em><br>
												[phone_no]	 		- <em>Contact Number of the Customer </em><br>
												[email]		 		- <em>Email of the Customer </em><br>
												[method_of_contact]	- <em>Customer\'s Method Of Contact </em><br>
												[make]				- <em>Making Of Vehicle </em><br>
												[model]				- <em>Model Of Vehicle</em><br>
												[year]				- <em>Year Of Vehicle </em><br>
												[service_request]	- <em>Request A Service</em><br>
												[booking_date]		- <em>Date of booking </em><br>
												[booking_time]		- <em>Time of booking </em><br>','iva_theme_admin'),
									'type'	=> 'subsection'
							);
	
		
		$iva_of_options[] = array(	'name'	=> __('Booking Form Thank You Message','iva_theme_admin'),
									'desc'	=> __('Message which displays when Booking form has been submitted successfully.', 'iva_theme_admin' ),
									'id'	=> $shortname.'_bk_thankyou_msg',
									'std'	=> 'Thank you! [first_name], Your Booking has been scheduled and you will be notified soon for confirmation by our consultant.',
									'type'	=> 'textarea'
							);		
							
		$iva_of_options[] = array(	'name'	=> __('Booking Notification Subject','iva_theme_admin'),
									'desc'	=> __('Subject for the Booking Confirmation Email Message.', 'iva_theme_admin' ),
									'id'	=> $shortname.'_bk_client_notify_subject',
									'std'	=>' : Booking ID - [booking_id]',
									'type'	=> 'text',
									'inputsize'	=> '330'
							);
							
		$iva_of_options[] = array(	'name'	=> __('Booking Notification message','iva_theme_admin'),
									'desc'	=> __('Email Message which appears when a user gets a confirmation for the Booking he fixed.','iva_theme_admin'),
									'id'	=> $shortname.'_bk_client_notify_msg',
									'std'	=>'Dear [first_name]
												Thank you for making an booking  for [first_name] at [booking_time] on [booking_date]. The last thing we require from you is to please confirm your booking.
												Sincerely,',
									'type'	=> 'textarea'
							);

		$iva_of_options[] = array(	'name'	=> __('User Cancelled Subject Message','iva_theme_admin'),
									'desc'	=> __('Subject for the User Booking Cancelled Email Message.','iva_theme_admin'),
									'id'	=> $shortname.'_usr_cancelled_subject',
									'std'	=> '[first_name] : Booking Request ID [booking_id].',
									'type'	=> 'text',
									'inputsize'	=> '330');
							
	
	
		$iva_of_options[] = array(	'name'	=> __('User Cancelled E-mail Message','iva_theme_admin'),
									'desc'	=> __('User Booking Cancelled notification email message which goes to Client/Patient.','iva_theme_admin'),
									'id'	=> $shortname.'_usr_cancelled_em_msg',
									'std'	=> 'Dear [first_name],
											This is a courtesy e-mail to inform you that the status of your 
											booking at [first_name] at [booking_time] on [booking_date] 
											has been updated.
											The new booking status is "[booking_status]".
											Sincerely,
											The staff at [first_name].',
									'type'	=> 'textarea');

	
		$iva_of_options[] = array(	'name'	=> __('User Confirmed Subject','iva_theme_admin'),
									'desc'	=> '',
									'id'	=> $shortname.'_usr_confirmed_subject',
									'std'	=> ' : booking ID - [booking_id]',
									'type'	=> 'text',
									'inputsize'	=> '330'
							);


		$iva_of_options[] = array(	'name'	=> __('User Confirmed E-mail Message','iva_theme_admin'),
									'desc'	=> '',
									'id'	=> $shortname.'_usr_confirmed_em_msg',
									'std'	=> 'Dear [first_name],
									This is a courtesy e-mail to inform you that the status of your 
									Booking at [first_name] at [booking_time] on [booking_date] 
									has been updated.
									The New Booking Status is "[booking_status]".
									Sincerely,
									The staff at [first_name].',
									'type'	=> 'textarea');

		//------------------------------------------------------------------------------------------------
		$iva_of_options[] = array( 'name'	=> __('Admin E-mails Setup','iva_theme_admin'), $url.'booking-icon.png', 'type' => 'subnav');
		//------------------------------------------------------------------------------------------------
		$iva_of_options[] = array(  'name'	=> __('Shortcodes for Email Setup','iva_theme_admin'),
									'desc'	=> __('Custom shortcodes defined for this theme in use for the Email Message systems<br><br> 
												[first_name] 		- <em>First Name of the Customer </em><br>
												[phone_no]	 		- <em>Contact Number of the Customer </em><br>
												[email]		 		- <em>Email of the Customer </em><br>
												[method_of_contact]	- <em>Customer\'s Method Of Contact </em><br>
												[make]				- <em>Making Of Vehicle </em><br>
												[model]				- <em>Model Of Vehicle</em><br>
												[year]				- <em>Year Of Vehicle </em><br>
												[service_request]	- <em>Request A Service</em><br>
												[booking_date]		- <em>Date of booking </em><br>
												[booking_time]		- <em>Time of booking </em><br>','iva_theme_admin'),
									'type'	=> 'subsection'
							);


		$iva_of_options[] = array(	'name'		=> __('Admin Email ID','iva_theme_admin'),
									'desc'		=> __('Email id where you want to get all the Booking requests.','iva_theme_admin'),
									'id'		=> $shortname.'_admin_emailid',
									'std'		=>'',
									'type'		=> 'text',
									'inputsize'	=> '330'
							);

		$iva_of_options[] = array(	'name'	=> 'Booking Form Headers Message',
									'desc'	=> __('Message which displays when booking form has been submitted successfully.','iva_theme_admin'),
									'id'	=> $shortname.'_bk_headers_msg',
									'std'	=>'',
									'type'	=> 'textarea'
							);


		$iva_of_options[] = array(	'name'	=> __('Admin Notification Email Message','iva_theme_admin'),
									'desc'	=> __('Email message format which goes to Admin when a new Booking is requested. For admin email-ID please see the field below <strong>booking Email</strong>','iva_theme_admin'),
									'id'	=> $shortname.'_admin_notification_msg',
									'std'	=> 'Name : [first_name]
												Email : [email]
												You have a New booking Scheduled to for [first_name] at [booking_time] on [booking_date].
												For more information to contact [first_name] you can make a call on [phone_no].

												Regards
												Admin',
									'type'	=> 'textarea'
							);	

		$iva_of_options[] = array(	'name'	=> __('Status Changed E-mail Subject','iva_theme_admin'),
									'desc'	=> __('Subject for the Booking Status changed notification email message.','iva_theme_admin'),
									'id'	=> $shortname.'_admin_status_chng_sub',
									'std'	=> ' : Booking ID - [booking_id] Status Changed',
									'type'	=> 'text',
									'inputsize'	=> '330'
							);

		$iva_of_options[] = array(	'name'	=> __('Status Changed E-mail Message','iva_theme_admin'),
									'desc'	=> __('Booking Status change notification Email Message which goes to Client/Patient.','iva_theme_admin'),
									'id'	=> $shortname.'_admin_status_chng_msg',
									'std'	=> 'Dear [first_name],
												This is a courtesy e-mail to inform you that the status of your booking with  for [first_name] at [booking_time] on [booking_date] has been updated.
												The new booking status is "[booking_status]".
												
												Sincerely,',
									'type'	=> 'textarea'
							);	
							
							
							
		$iva_of_options[] = array(	'name'	=> __('User Confirmed E-mail Message To Admin','iva_theme_admin'),
									'desc'	=> __('User booking Cancelled Notification Email Message which goes to admin.','iva_theme_admin'),
									'id'	=> $shortname.'_usr_confirmed_em_msg_to_admin',
									'std'	=> 'Dear Admin,
												This is a courtesy e-mail to inform you that the status of [first_name] 
												booking at [first_name] at [booking_time] on [booking_date] 
												has been updated.
												The new booking status is "[booking_status]".
												Sincerely,
												[first_name].',
												'type'	=> 'textarea');
									
					
		$iva_of_options[] = array(	'name'	=> __('User Cancelled E-mail Message To Admin','iva_theme_admin'),
									'desc'	=> __('User booking Cancelled Notification Email Message which goes to admin.','iva_theme_admin'),
									'id'	=> $shortname.'_usr_cancelled_em_msg_to_admin',
									'std'	=> 'Dear Admin,
												This is a courtesy e-mail to inform you that the status of [first_name] 
												booking at [first_name] at [booking_time] on [booking_date] 
												has been updated.
												The new booking status is "[booking_status]".
												Sincerely,
												[first_name].',
									'type'	=> 'textarea');

		//---------------------------------------------------------------------------------------------------
		$iva_of_options[] = array('name'	=> __('Offers Properties','iva_theme_admin'), 'type' => 'subnav');
		//---------------------------------------------------------------------------------------------------
		
		$iva_of_options[] = array( 'name'	=> __('Offers Single Page Button Color','iva_theme_admin'),
									'desc'	=> __( 'Custom text which appears in Button Color on Offers Single Page', 'iva_theme_admin' ),
									'id'	=> $shortname.'_ofr_btn_color',
									'std'	=> '',
									'class' => 'select300',
									'type'	=> 'select',
									'options'	=> array(
												''		=> 'Choose one...',
												'gray'		=> 'Gray',
												'brown'		=> 'Brown',
												'cyan'		=> 'Cyan',
												'orange'	=> 'Orange',
												'red'		=> 'Red',
												'magenta'	=> 'Magenta',
												'yellow'	=> 'Yellow',
												'blue'		=> 'Blue',
												'pink'		=> 'Pink',
												'green'		=> 'Green',
												'black'		=> 'Black',
												'white'		=> 'White',
												),
									'inputsize'=> '330'
							);
		$iva_of_options[] = array(
								'name'			=> __('Offers Orderby','iva_theme_admin'),
								'desc'			=> __( 'Select the orderby  which you want to use Id , title, date or menu order in Offers Page Template', 'iva_theme_admin' ),
								'id'			=> $shortname.'_ofr_orderby',
								'class'			=> 'ofr_orderby',
								'std'			=> 'date',
								'type'			=> 'select',
								'class'			=> 'select300',
								'inputsize'		=> '',
								'options'		=> array( 
														'' 			    => 'Choose Options',
														'ID' 			=> 'ID',
														'title'			=> 'Title',
														'date' 			=> 'Date',
														'menu_order'	=> 'Menu Order'
													)
							);
		$iva_of_options[] = array(
								'name'			=> __('Offers Order','iva_theme_admin'),
								'desc'			=> __( 'Select the order which you wish to display in Offers Page Template', 'iva_theme_admin' ),
								'id'			=> $shortname.'_ofr_order',
								'class'			=> 'ofr_order',
								'std'			=> 'DESC',
								'type'			=> 'radio',
								'class'			=> '',
								'inputsize'		=> '',
								'options'		=> array( 
														'ASC' 	=> 'Ascending',
														'DSC'	=> 'Descending'
													)
							);
		$iva_of_options[] = array(
								'name'			=> __('Offers Page Template Pagination','iva_theme_admin'),
								'desc'			=> __( 'Check this if you wish to Enable/Disable ( Default: Disable ) the pagination in Offers Page Template.', 'iva_theme_admin' ),
								'id'			=> $shortname.'_ofr_pagination',
								'class'			=> '',
								'std'			=> '',
								'type'			=> 'checkbox',
							);							
		$iva_of_options[] = array(
								'name'			=> __('Offers Page Template Limits','iva_theme_admin'),
								'desc'			=> __( 'Type the limits for Gallery you wish to limit on the Offers Template Page. (Example: 5)', 'iva_theme_admin' ),
								'id'			=> $shortname.'_ofr_limits',
								'class'			=> '',
								'std'			=> '',
								'inputsize'		=> '',
								'type'			=> 'text',
							);	
		$iva_of_options[] = array(
								'name'			=> __('Comments Enable/Disable','iva_theme_admin'),
								'desc'			=> __( 'Check this if you wish to Enable/Disable ( Default: Disable ).', 'iva_theme_admin' ),
								'id'			=> $shortname.'_ofr_comments',
								'class'			=> '',
								'std'			=> 'disable',
								'options'		=> array('enable' => 'Enable','disable' => 'Disable'),
								'type'			=> 'radio',
							);
		$iva_of_options[] = array( 'name'	=> __('Offers Button Text','iva_theme_admin'),
									'desc'	=>  __( 'Offers Button Text which appears on Offers Single Page, Booking Template Page', 'iva_theme_admin' ),
									'id'	=> $shortname.'_ofr_btn_txt',
									'std'	=> '',
									'type'	=> 'text',
									'inputsize'=> '300'
							);
							
		$iva_of_options[] = array(
								'name'			=> __('Disable Offers Button','iva_theme_admin'),
								'desc'			=> __( 'Check this if you wish to Disable Button in Offers Single Page.', 'iva_theme_admin' ),
								'id'			=> $shortname.'_ofr_disable_btn',
								'class'			=> '',
								'std'			=> '',
								'type'			=> 'checkbox',
							);		

		return $iva_of_options;		
	}			
?>