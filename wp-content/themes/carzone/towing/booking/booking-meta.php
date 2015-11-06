<?php
	/**
	 * Page Metabox
	 */
	$prefix = 'iva_';	
	/**
	 * defines custom sidebar widget based on custom option
	 */
	$default_date 		= get_option('atp_date_format') ? get_option('atp_date_format') :'Y/m/d';	
	$this->meta_box[] = array(
		'id'		=> 'booking-meta-box',
		'title'		=> __('&nbsp;Meta Options','iva_theme_admin'),
		'context'	=> 'normal',
		'page'		=> array('booking'),
		'priority'	=> 'core',
		'fields'	=> array(	
			array(
				'name'	=> __('Phone No','iva_theme_admin'),
				'desc'	=> __('Enter Phoneno.','iva_theme_admin'),
				'id'	=> $prefix.'bk_phoneno',
				'class' => '',
				'std'	=> '',
				'type'	=> 'text'
			),
			array(
				'name'	=> __('Email','iva_theme_admin'),
				'desc'	=> __('Enter Email.','iva_theme_admin'),
				'id'	=> $prefix.'bk_email',
				'class' => '',
				'std'	=> '',
				'type'	=> 'text'
			),
			array(
				'name'	=> __('Method Of Contact','iva_theme_admin'),
				'desc'	=> __('Choose Method Of Contact.','iva_theme_admin'),
				'id'	=> $prefix.'bk_pcontact',
				'class' => 'select300',
				'std'	=> 'phonecall',
				'type'	=> 'select',
				'options'=> array( 
								'phonecall' => __('Phonecall','iva_theme_admin'),
								'sms'		=> __('SMS','iva_theme_admin'),
								'mail'		=> __('Email','iva_theme_admin'),


							),
			),			
			array(
				'name'	=> __('Make','iva_theme_admin'),
				'desc'	=> __('Enter Make.','iva_theme_admin'),
				'id'	=> $prefix.'bk_make',
				'class' => '',
				'std'	=> '',
				'type'	=> 'text'
			),
			array(
				'name'	=> __('Model','iva_theme_admin'),
				'desc'	=> __('Enter Model.','iva_theme_admin'),
				'id'	=> $prefix.'bk_model',
				'class' => '',
				'std'	=> '',
				'type'	=> 'text'
			),
			array(
				'name'	=> __('Year','iva_theme_admin'),
				'desc'	=> __('Enter Year.','iva_theme_admin'),
				'id'	=> $prefix.'bk_year',
				'class' => '',
				'std'	=> '',
				'type'	=> 'text'
			),
			array(
				'name'	=> __('Service Request','iva_theme_admin'),
				'desc'	=> __('Request A Service.','iva_theme_admin'),
				'id'	=> $prefix.'bk_service',
				'class' => '',
				'std'	=> '',
				'type'	=> 'textarea'
			),
			array(
				'name'	=> __('Date','iva_theme_admin'),
				'desc'	=> __('Choose Date.','iva_theme_admin'),
				'id'	=> $prefix.'bk_date',
				'class' => '',
				'std'	=>  date($default_date),
				'type'	=> 'dateformat',
				'inputsize' => ''
			),
			array(
				'name'	=> __('Time','iva_theme_admin'),
				'desc'	=> __('Choose Time.','iva_theme_admin'),					

				'id'	=> $prefix.'bk_timings',
				'class' => '',
				'std'	=> '',
				'type'	=> 'add_timings',
			),
			array(
				'name'	=> __('Offers','iva_theme_admin'),
				'desc'	=> __('Choose Offers.','iva_theme_admin'),				
				'id'	=> $prefix.'bk_offers',
				'class' => 'select300',
				'std'	=> '',
				'type'	=> 'multiselect',
				'options'=>$this->atp_variable('offers'),
			),
			
			array(
				'name'	=> __('Booking Status','iva_theme_admin'),
				'desc'	=> '',
				'id'	=> $prefix.'bk_status',
				'type'	=> 'select',
				'class'	=> 'select300',
				'std'	=> 'confirmed',
				'options'=> array(
					'unconfirmed'  => __('UnConfirmed','iva_theme_admin'),
					'confirmed'    => __('Confirmed','iva_theme_admin'),
					'cancelled'    => __('Cancelled','iva_theme_admin'),
				),
			),
		),
	);
?>