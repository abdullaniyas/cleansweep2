<?php 
/**
 * This class extends ATP_Theme.
 */
if(!class_exists('ATP_theme_towing')){
    class ATP_theme_towing extends ATP_Theme { 

		function _construct() {
			add_action( 'after_setup_theme', array($this,'atp_theme_setup' ));
		}

		/**
	     * load custom meta.
	     */	
		function atp_custom_meta(){
	
			parent::atp_custom_meta();
			require_once( AUTOTOW_DIR . 'location/location-meta.php');
			require_once( AUTOTOW_DIR . 'booking/booking-meta.php');
		}
		
		/**
		 * Loads Booking Widget.. 
		 */
		function atp_widgets(){
		
			parent::atp_widgets();
			require_once( AUTOTOW_DIR . 'widgets/booking.php');
		}

		 /**
	      * retrieves the terms in a taxonomy or list of taxonomies.
	      */ 
	    function atp_variable( $type ) {
	    
	      $iva_of_options = parent::atp_variable( $type );
	      
			switch( $type ) {
				/**
				 * get posts id and name  
				 */ 
				case 'offers': // Get offers Name/Id
				  $args = array(
					'posts_per_page'   => -1,
					'offset'           => 0,
					'orderby'          => 'post_date',
					'order'            => 'DESC',
					'post_type'        => 'offers',
					'post_status'      => 'publish',
					'suppress_filters' => true 
				  ); 
				  $atp_entries = get_posts( $args );
				  foreach ( $atp_entries as $key => $entry ) {
					 $iva_of_options[$entry->ID] = $entry->post_title;
				  }
				  break;
	        }
	        return $iva_of_options;
	      }
  	}
	$atp_theme = new ATP_theme_towing();
	$url =  FRAMEWORK_URI . 'admin/images/';
}

/**
 * Require Functions
 */
require_once( AUTOTOW_DIR . 'additional-meta.php');
require_once( AUTOTOW_DIR . 'posttype-labeloptions.php' );
require_once( AUTOTOW_DIR . 'additional-themeoptions.php' );
require_once( AUTOTOW_DIR . 'location/loc_functions.php');
require_once( AUTOTOW_DIR . 'booking/booking-functions.php');

/**
 * Manage Booking page id
 */
$iva_templateid = '';
$page_query = new WP_Query(
	array(
		 'post_type'  => 'page',
		 'meta_key'   => '_wp_page_template',
		 'meta_value' => 'towing/template_manage_booking.php'
	)
);
if ( $page_query->have_posts()) : $page_query->the_post();
	$iva_templateid = get_the_id();
endif;

/**
 * single post types
 */
if(!function_exists('iva_single_posttypes')){
	function iva_single_posttypes() {
	
		global $wp_query, $post;  
		$customtype = $post->post_type;
		
		if( file_exists( AUTOTOW_DIR .$customtype.'/'. 'single-'.$customtype.'.php') ){
			return AUTOTOW_DIR . $customtype.'/'. 'single-'.$customtype.'.php';
		}
		elseif(file_exists( THEME_DIR . '/single-'.$customtype.'.php')){
			return THEME_DIR . '/single-'.$customtype.'.php';
		}else{
			return THEME_DIR .'/single.php';
		}
	}
	add_filter('single_template', 'iva_single_posttypes');
}

//Retrieve path of taxonomy template in current or parent template. 
if(!function_exists('iva_taxonomy_posttypes')){
	function iva_taxonomy_posttypes(){
	
		global $wp_query, $post;  
		$customtype = $post->post_type;
		$name 		= get_queried_object()->taxonomy;
		
		if(file_exists( AUTOTOW_DIR .$customtype.'/'. 'taxonomy-'.$name.'.php')){
			return AUTOTOW_DIR . $customtype.'/'. 'taxonomy-'.$name.'.php';
		}elseif(file_exists( THEME_DIR . '/taxonomy-'.$name.'.php')){
			return THEME_DIR . '/taxonomy-'.$name.'.php';
		}else{
			return THEME_DIR .'/archive.php';
		} 
	}
	add_filter('taxonomy_template', 'iva_taxonomy_posttypes');
}

/**
 * function iva_admin_enqueue_custom_scripts()
 * admin enqueue styles and scripts
 */
if(!function_exists('iva_admin_enqueue_custom_scripts')){
	function iva_admin_enqueue_custom_scripts(){
	/**
	 * enqueue the admin scripts and css here.
	 */
	global $pagenow,$typenow;;
	if( is_admin() &&  $typenow =='location' && (  $pagenow == 'post-new.php' || $pagenow=='post.php' )  ) {
			wp_enqueue_script('iva-map', AUTOTOW_URI . 'js/admin_map.js', false,false,'all' );
		}
		wp_enqueue_style('iva-map-css', AUTOTOW_URI . 'css/mapping.css', '','','all' ); 

	}
	add_action( 'admin_enqueue_scripts', 'iva_admin_enqueue_custom_scripts' );
}

/**
 * Function iva_enqueue_custom_scripts()
 * frontend enqueue styles and scripts
 */
if(!function_exists('iva_enqueue_custom_scripts')){
	function iva_enqueue_custom_scripts(){
		/**
		 * Enqueue the front end scripts and css here.
		 */
		if( is_page_template( 'towing/template_booking.php' ) || is_singular('booking') ) {
	        wp_enqueue_script('jquery-ui-datepicker');
			
			$datepicker_language = get_option( 'iva_datepicker_language'); 
			if( $datepicker_language != '')
			{
				//wp_enqueue_script('datepicker_language', THEME_URI . '/js/i18n/datepicker-'.$datepicker_language.'.js', false,false,'all' );
			}
		}
		wp_enqueue_script('iva-custom-script', AUTOTOW_URI . 'js/form.js', false,false,'all' ); 
		wp_enqueue_script('iva-simpleweather', AUTOTOW_URI . 'js/jquery.simpleWeather.min.js', false,false,'all' );
    	wp_enqueue_script('iva-weather'); 
    	$iva_protocol = is_ssl() ? 'https' : 'http';
    	wp_enqueue_script('iva-gmap',  $iva_protocol.'://maps.googleapis.com/maps/api/js?v=3.exp&signed_in=false&libraries=places','jquery','','');
		wp_enqueue_script('iva_loc_map', AUTOTOW_URI .'js/frontend_map.js','','','');
	}
	add_action( 'wp_enqueue_scripts', 'iva_enqueue_custom_scripts' );
}

// Get Post status from metagenerator
$iva_status = isset( $_POST['iva_bk_status'] ) ? $_POST['iva_bk_status'] : '';
if( $iva_status ) { 
	switch( $iva_status ){
		case 'cancelled':
		  $status_txt = get_option('iva_bk_cancel') ? get_option('iva_bk_cancel') : __('Cancelled','iva_theme_admin');
		  break;
		case 'unconfirmed':
		  $status_txt = get_option('iva_bk_unconfirm') ? get_option('iva_bk_unconfirm') : __('UnConfirmed','iva_theme_admin');
		  break;
		case 'confirmed':
		  $status_txt = get_option('iva_bk_confirm') ? get_option('iva_bk_confirm') : __('Confirmed','iva_theme_admin');
		  break;
	}
	$iva_bookingtime = $iva_bk_offers = $iva_bk_date = '';
	
	//
	$iva_format = get_option( 'iva_time_format')? get_option( 'iva_time_format') :'12';
	if( $iva_format == '12'){
		$timeformat     = "h:i A";
    }elseif( $iva_format == '24'){
		$timeformat     = "H:i";
    }else{
		$timeformat     = "h:i A";
    }
	
	// Time
	$iva_bookingtime  = get_post_meta( $_POST['post_ID'],'iva_bk_timings',true );
	if( !empty( $iva_bookingtime ) ){
		$iva_bookingtime  = date( $timeformat, strtotime( $iva_bookingtime ));
	}
	
	// Offers
	$iva_bk_ofr  = get_post_meta( $_POST['post_ID'],'iva_bk_offers',true );
	$iva_offer_titles = array();
	if( !empty( $iva_bk_ofr ) ){
		foreach ($iva_bk_ofr as $key => $value) {
			$offr_data_id = get_post($value);
			$iva_offer_titles[] = $offr_data_id->post_title;
		}
	}
	if( !empty( $iva_offer_titles ) ){
		$iva_bk_offers = implode(',',$iva_offer_titles);
	}
	
	// Date 
	global $default_date;
	if( $default_date ){
		$iva_bk_date =  date( $default_date, get_post_meta( $_POST['post_ID'],'iva_bk_date', true) );
	}

  // Assigns message details for booking

  $placeholders =  array(
                    '[name]',
                    '[phoneno]',
                    '[email]',                 
                    '[method_contact]',
                    '[make]',
                    '[model]',
                    '[year]',   
					'[offer]',					
                    '[servicerequest]',
                    '[booking_date]',
                    '[booking_time]',
                    '[booking_status]'
                  );
  $values           =  array(
                    get_the_title( $_POST['post_ID'] ),                    
                    $_POST['iva_bk_phoneno'],
                    $_POST['iva_bk_email'],
                    $_POST['iva_bk_pcontact'],          
                    $_POST['iva_bk_make'],
                    $_POST['iva_bk_model'],
                    $_POST['iva_bk_year'],  
					$iva_bk_offers,
                    $_POST['iva_bk_service'],                  
                    $iva_bk_date,                    
                    $iva_bookingtime,
                    $_POST['iva_bk_status']
                  );  
	// Sending admin notification email
	$iva_admin_status_chng_msg 		= get_option('iva_admin_status_chng_msg');
	$iva_admin_status_chng_em_msg   = str_replace( $placeholders,$values,$iva_admin_status_chng_msg ); //replace the placeholders
	$iva_admin_status_chng_sub      = get_option('iva_admin_status_chng_sub');

	// Assigns subject for booking
	$iva_bk_placeholders 	= array('[booking_id]' );     
	$iva_bk_values        	= array( $_POST['post_ID'] );  
	$iva_bk_subject			= str_replace( $iva_bk_placeholders,$iva_bk_values,$iva_admin_status_chng_sub); //replace the placeholders  
	$iva_bk_email 			= isset( $_POST['iva_bk_email'] ) ? $_POST['iva_bk_email'] :'';  
	
	/**
	 * Headers
	 */
	$iva_bk_headers_msg = get_option('iva_bk_headers_msg') ? get_option('iva_bk_headers_msg') :get_option('blogname');
	$iva_bk_headers 	  = 'From: ' . $iva_bk_headers_msg . ' Appointment <' .get_option('iva_admin_emailid'). '>' . "\r\n\\";
  
	// Sends email
	wp_mail( $iva_bk_email, $iva_bk_subject, $iva_admin_status_chng_em_msg, $iva_bk_headers );
}
if( !function_exists('aivah_towing_add_query_vars_filter')){ 
	function aivah_towing_add_query_vars_filter( $vars ){
	  $vars[] = "email";
	  return $vars;
	}
	add_filter( 'query_vars', 'aivah_towing_add_query_vars_filter' );
}
?>