<?php
add_filter('add_googlemap','iva_googlemap');
function iva_googlemap( $iva_meta_options ){

	$output = '';
	$lat = $lng = $address = $streetno = $route =$city =$state = $zip_code = $country = '';
	$fieldid 	= $iva_meta_options['field_id'];
	$meta 		= $iva_meta_options['meta'];

	if ( !empty( $meta ) ) {
		$lat 			= $meta['0']['lat'];
		$lng			= $meta['0']['lng'];
		$address		= $meta['0']['address'];
		$streetno  		= $meta['0']['streetno'];
		$route			= $meta['0']['route'];
		$city	        = $meta['0']['city'];
		$state			= $meta['0']['state'];
		$zip_code       = $meta['0']['zip_code'];
		$country		= $meta['0']['country'];
	}

	$output .= '<div class ="mapdisplay">';  
	$output .= '<div id="gmap_errormessage"></div>';	

	$output .= '<label class="loc_labels">'.__('Address','iva_theme_admin').'</label>';
	$output .= '<div class="loc_input">';
	$output .= '<input type="text" id="iva_loc_address"  name="'.$fieldid.'_address" value="'.$address.'" size="30"/>';
	$output .= '</div>';

	$output .= '<div id="iva_loc_map_canvas" style="width:800px;height:450px;border:1px solid #999;"></div>';
	
	$output .= '<input type="hidden" id="iva_loc_lat" name="'.$fieldid.'_lat" value="'.$lat.'" readonly />';
	$output .= '<input type="hidden"  id="iva_loc_lng" name="'.$fieldid.'_lng" value="'.$lng.'" readonly />';
	$output .= '</div>';//.mapdisplay

	$output .= '<label class="loc_labels">'.__('Street Number','iva_theme_admin').'</label>';
	$output .= '<div class="loc_input">';
	$output .= '<input class="field" type="text" id="street_number" name="'.$fieldid.'_streetno" value="'.$streetno.'" size="30" readonly/>';   
	$output .= '</div>';
	
	$output .= '<label class="loc_labels">'.__('Route','iva_theme_admin').'</label>';
	$output .= '<div class="loc_input">';
	$output .= '<input class="field" type="text" id="route" name="'.$fieldid.'_route" value="'.$route.'" size="30" readonly/>';  
	$output .= '</div>';

  	$output .= '<label class="loc_labels">'.__('City','iva_theme_admin').'</label>';
	$output .= '<div class="loc_input">';
	$output .= '<input class="field" type="text" id="locality" name="'.$fieldid.'_city" value="'.$city.'" size="30" readonly/>';
	$output .= '</div>';

	$output .= '<label class="loc_labels">'.__('State','iva_theme_admin').'</label>';
	$output .= '<div class="loc_input">';      
	$output .= '<input class="field" type="text" id="administrative_area_level_1" name="'.$fieldid.'_state" value="'.$state.'" size="30" readonly/>';
	$output .= '</div>';	

	$output .= '<label class="loc_labels">'.__('Country','iva_theme_admin').'</label>';
	$output .= '<div class="loc_input">';  
	$output .= '<input class="field" type="text" id="country" name="'.$fieldid.'_country" value="'.$country.'" size="30" readonly/>';
	$output .= '</div>';

	$output .= '<label class="loc_labels">'.__('Zip Code','iva_theme_admin').'</label>';
	$output .= '<div class="loc_input">';   
	$output .= '<input class="field" type="text" id="postal_code" name="'.$fieldid.'_zipcode" value="'.$zip_code.'" size="30"  readonly/>';
	$output .= '</div>';   
	
	echo $output;
}
// add timings
add_filter('add_timings','iva_add_timings');
function iva_add_timings( $options  ){

	global $post,$default_date;
	
	$output  = '';
	$fieldid = $options['field_id'];
	$post_id = $post->ID;
	$meta 	 = $options['meta'] ?  $options['meta'] :'';	
	
	echo "<script>
	jQuery(document).ready(function($){
		'use strict';
		$('#iva_bk_date').change(function () {
			var iva_bk_date = jQuery('#iva_bk_date').datepicker('getDate');
			var iva_bk_day  = iva_bk_date.getDay();
			$.ajax({
				url: admin_ajax_url,
				type: 'post',
				dataType: 'html',
				data: {
					'action': 'iva_get_booking_timings',
					'week_day': iva_bk_day,
					'post_id': $post_id,
					'field_id': '".esc_js( $fieldid )."',
					'field_meta': '".esc_js(  $meta )."',
				},
				success: function(response){ 
					jQuery('.iva_bk_timings').html(response).show();
				}
			});
		}).change();	
	});
	</script>";
	echo '<div class="iva_bk_timings"></div>';
}
	//
	add_action('wp_ajax_iva_get_booking_timings', 'iva_get_booking_timings');
	add_action( 'wp_ajax_nopriv_iva_get_booking_timings', 'iva_get_booking_timings' );
	function iva_get_booking_timings(){	
	
		global $default_date,$post;
	
		$output 	  = '';
		$iva_week_day 	= esc_html( $_POST['week_day'] );
		$fieldid 	  	= $_POST['field_id'];
		$post_id 	  	= $_POST['post_id'];
		$field_meta   	= $_POST['field_meta'];

		// Gets weekday,date values
		$iva_weekdays 	=  array('sunday','monday','tuesday','wednesday','thursday','friday','saturday');
		$iva_hrs 		= get_option( 'iva_'.$iva_weekdays[$iva_week_day] );
		$iva_interval 	= get_option( 'iva_time_interval' ) ? get_option( 'iva_time_interval' ):'15';
		$iva_format   	= get_option( 'iva_time_format' )? get_option( 'iva_time_format' ) :'12';
		
		if( $iva_format == '12'){
			$timeformat = "h:i A";
		}elseif( $iva_format == '24'){
			$timeformat = "H:i";
		}else{
			$timeformat = "h:i A";
		}
		
		$iva_time_interval  = '+'.$iva_interval.'minutes';
		$open_hrs     	    =  strtotime( $iva_hrs['opening'] );
		$close_hrs 	   		=  strtotime( $iva_hrs['closing'] );
		$closed_hrs   	    =  $iva_hrs['close'];		
		$iva_bk_hours 	    = get_option( 'iva_hrs' ) ? get_option( 'iva_hrs' ):'';
		
		// Hide hours
		if( isset( $iva_bk_hours ) &&  $iva_bk_hours!='' ){
			$hide_hours = $iva_bk_hours[$iva_week_day];
		}
		
		if( $closed_hrs == 'off' ){
			$output .='<div class="bk_timings">';
			$output .='<select name="'.$fieldid.'" id="'.$fieldid.'">';
			$output .='<option value="">'.__('Select Timings','iva_theme_admin').'</option>';
			while( $open_hrs < $close_hrs ){
				$iva_time_hrs = date( $timeformat,$open_hrs );
				if( $field_meta == date( 'H:i',$open_hrs ) ){
					$selected  = 'selected="selected"'; 
				}else{
					$selected = ''; 
				}
				if( !empty( $iva_bk_hours ) && ( $iva_bk_hours !='' ) ){
					if( @!in_array( $iva_time_hrs , $hide_hours  )) { 
						$output .= '<option value="'.date( 'H:i',$open_hrs ).'" '.$selected.'>'.$iva_time_hrs.'-'.date( $timeformat,strtotime( $iva_time_interval, $open_hrs ) ).'</option>'; 
					}
					$open_hrs = strtotime( $iva_time_interval, $open_hrs );	
				}
			}
			$output .='</select>';
			$output .='</div>';
		}else{ 
			$iva_closed_txt = get_option('iva_bk_closedmsgtxt') ? get_option('iva_bk_closedmsgtxt') : __('Sorry we are closed this day', 'iva_theme_admin');   
			$output .='<div class="bk-closed">';
			$output .= $iva_closed_txt;
			$output .='</div>';
		}	
		echo $output;
		exit;
	}	
?>