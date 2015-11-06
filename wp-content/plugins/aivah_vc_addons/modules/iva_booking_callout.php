<?php
/*
* Add-on Name: Booking Calloutbox
*/
if(!class_exists('iva_bk_callout'))
{
	class iva_bk_callout {

		function __construct()
		{
			add_action( 'init', array( $this, 'booking_init' ) );
			add_action( 'wp_enqueue_scripts', array($this, 'register_booking_assets' ), 1 );
			add_shortcode( 'booking_callout', array($this, 'iva_booking_callout' ) );
		}
		
		
		/**
		 * Proper way to enqueue scripts and styles
		 */
		function register_booking_assets()
		{
			// Enqueues datepicker script from WP Core
			wp_enqueue_script( 'jquery-ui-datepicker' );
			$datepicker_language = get_option( 'iva_datepicker_language'); 
			if( $datepicker_language != '')
			{
				wp_enqueue_script('datepicker_language', get_template_directory_uri() . '/js/i18n/datepicker-'.$datepicker_language.'.js', false,false,'all' );
			}
		}

		// Initialize the mapping function
		function booking_init()
		{
		
			if ( function_exists( 'vc_map' ) )
			{

				vc_map( array(
					  "name"        => __( "Booking CallOut", "iva_theme_admin" ),
					  "base"        => "booking_callout",
					  "description" => __( "Booking Callout", "iva_theme_admin" ),
					  "class"       => "",
					  "controls"    => "full",
					  "category"    => "Aivah VC Addons",
					  "params"      => array(

						 array(
							"type" 		  => "textfield",
							"holder"	  => "div",
							"class" 	  => "",
							"heading"	  => __( "CallOut Title", "iva_theme_admin" ),
							"param_name"  => "title",
							"value" 	  => __( "Title", "my-text-domain" ),
							"description" => __( "Enter the Title.", "iva_theme_admin" )
						 ),
						 
						 array(
							"type" 		  => "textfield",
							"holder" 	  => "div",
							"class" 	  => "",
							"heading" 	  => __( "Short Summary", "iva_theme_admin" ),
							"param_name"  => "shortinfo",
							"value" 	  => __( "Short Summary", "iva_theme_admin" ),
							"description" => __( "Type the short summary.", "iva_theme_admin" )
						 ),
						 
						 array(
							"type" 		  => "textfield",
							"holder"      => "div",
							"class"       => "",
							"heading"     => __( "CallOut Button Text", "iva_theme_admin" ),
							"param_name"  => "buttontext",
							"value"       => __( "Button Text", "iva_theme_admin" ),
							"description" => __( "Type the CallOut button text.", "iva_theme_admin" )
						 ),

						 array(
							"type" 		  => "colorpicker",
							"class"       => "",
							"heading"     => __( "Background Color", "iva_theme_admin" ),
							"param_name"  =>  "bgcolor",
							"value" 	  => "" , 
							"description" => __( "Select the background color for the booking teaser", "iva_theme_admin" )
						 ),
						 
						 array(
							"type"        => "colorpicker",
							"class"       => "",
							"heading"     => __( "Text Color", "iva_theme_admin" ),
							"param_name"  => "textcolor",
							"value"       => "", //Default Red color
							"description" => __( "Select the color for the booking teaserr", "iva_theme_admin" )
						 ),	 

						array(
							"type"        => "dropdown",
							"class"       => "",
							"heading"     => __("Button Color", "iva_theme_admin"),
							"param_name"  => "buttoncolor",
							"value"        => array(
											__( "None","iva_theme_admin") 			=> "",
											__( "Gray", "iva_theme_admin") 		=> "gray",
											__( "brown", "iva_theme_admin") 	=> "brown",
											__( "cyan", "iva_theme_admin") 		=> "cyan",
											__( "orange" , "iva_theme_admin") 	=> "orange",
											__( "red" , "iva_theme_admin") 	 	=> "red",
											__( "magenta" , "iva_theme_admin")	=> "magenta",
											__( "yellow" ,"iva_theme_admin")	=> "yellow",
											__( "blue" ,"iva_theme_admin")		=> "blue",
											__( "pink" ,"iva_theme_admin")		=> "pink",
											__( "green" ,"iva_theme_admin")		=> "green",
											__( "black" ,"iva_theme_admin")		=> "black",
											__( "white" ,"iva_theme_admin") 	=> "white",											
											),
							"description" => __("We have given three quick preset if you are in a hurry. Otherwise, create your own with various options.", "iva_theme_admin"),
							//"dependency" => Array("element" => "icon_type","value" => array("selector")),
						),

						 array(
							"type" 		 => "textfield",
							"holder"     => "div",
							"class"      => "",
							"heading"    => __( "Margin Top", "iva_theme_admin" ),
							"param_name" => "margintop",
							"value"      => __( "", "iva_theme_admin" ),
							"description" => __( "Enter the Margin.", "iva_theme_admin" )
						 ),
						 
					)
				) );
				
			}

		}
		
		function iva_booking_callout($atts)
		{

			extract( shortcode_atts( array(
				'title'			=> '',
				'textcolor'		=> '',
				'buttoncolor'	=> 'yellow',
				'bgcolor'		=> '',
				'margintop'		=> '',
				'buttontext'	=> '',
				'shortinfo'		=> '',

			), $atts )); 
		
			// Defines null value
			$out = '';
		global $atp_defaultdate;
			// Define variable default values
			$iva_textcolor	= $textcolor ? 'color:'.$textcolor.';':'';
			$iva_bgcolor 	= $bgcolor ? 'background-color:'.$bgcolor.';':'';
			$iva_buttoncolor = $buttoncolor ? 'color:'.$buttoncolor.';':'';
			$iva_margintop = $margintop ? 'margin-top: '. $margintop .';':'';
			$iva_buttontext =  $buttontext ? $buttontext : __('Booking', 'aivah_shortcodes');
			$iva_callouttitle =  $title ? $title :'';
			$iva_disable_days  		=  get_option('iva_disable_days') ? get_option('iva_disable_days'):'';
			$iva_cal_fstday			=  get_option('iva_firstday')? get_option('iva_firstday'):'0';
			// Adds inline styles to iva_bk_section class output
			if ( !empty( $iva_textcolor ) || !empty( $iva_bgcolor ) ||  !empty( $iva_margintop ) ) {
				$iva_styles = ' style="'. $iva_bgcolor.$iva_textcolor.$iva_margintop .'"';
			} else {
				$iva_styles = '';
			}

			global $iva_default_date;
			$iva_disabled_days = '';
			
			$iva_lbl_name 	  = __( 'Name','aivah_shortcodes' );
			$iva_lbl_date 	  = __( 'Date','aivah_shortcodes' );
			$iva_lbl_email	  = __( 'Email','aivah_shortcodes' );
			$iva_lbl_phone	  = __( 'Phone Number','aivah_shortcodes' ); 

			$out .= '<script type="text/javascript">
					jQuery(document).ready(function($) {
							
						var disabledDays 	= ['.$iva_disable_days.'];
					
						// Disabled specific days:
						function disable_specificdays(date) {
							var m = date.getMonth() + 1, d = date.getDate(), y = date.getFullYear();
						
							for ( var i = 0; i < disabledDays.length; i++ ) {
								if ( date.getDate() == disabledDays[i] ) {
									return [0];
								}
							}
							return [1];
						}
						
						jQuery( "#dateselect" ).datepicker({ 
							dateFormat: "'. esc_js( $atp_defaultdate ).'",
							showOtherMonths: true,
							selectOtherMonths: true,
							beforeShowDay : disable_specificdays,
							minDate: 0,
							firstDay:"'. esc_js( $iva_cal_fstday ).'"
						});
						
						jQuery("#button_submit").on("click",function(){
							var bk_name  = jQuery("#iva_bk_name").val();
							var bk_date  = jQuery("#dateselect").val();
							var bk_email = jQuery("#iva_bk_email").val();
							var bk_phone = jQuery("#iva_bk_phone").val();
							
							var proceed = true;
							
							filter = /^[A-Z0-9._%+-]+@([A-Z0-9-]+\.)+[A-Z]{2,4}$/i;
							if( filter.test( bk_email ) ){
							 jQuery(".iva_email").removeClass("error"); 
							  proceed = true;
							}else{
							 jQuery(".iva_email").addClass("error");
							   proceed = false;
							}
							if( bk_name === "" ) {
							  jQuery(".iva_name").addClass("error");
							  proceed = false;
							}
							if(bk_name){
								jQuery(".iva_name").removeClass("error"); 
							}

							if(bk_phone === "" ){
							  jQuery(".iva_phone").addClass("error");
							  proceed = false;
							}
							if(bk_phone){
								jQuery(".iva_phone").removeClass("error"); 
							}

							if(bk_date ===""){
							  jQuery(".iva_date").addClass("error");
							  proceed = false;
							}

							if(bk_date){
								jQuery(".iva_date").removeClass("error"); 
							}

							if(proceed){
							  return true;
							}else{
							  return false;
							}
						});
					});
					</script>';

			// Booking callout form
			if ( $title == '' && $shortinfo == '' ) { $class="fullwidth"; }else{
				$class = 'two_third mb0 last';
			}

			$out .= '<div class="iva_bk_section" '.$iva_styles.'>';
			$out .= '<div class="iva_bk_inner"><div class="iva_bk_content">';
			if ( $title != '' ||  $shortinfo != ''  ) {
				$out .= '<div class="one_third mb0">';
				if ($title) {
					$out .= '<div class="fancyheading">';
					$out .= '<h1 class="fancy-title large"><span>'.$iva_callouttitle.'<br>';
					$out .= '</span>';
					if ($shortinfo) {
						$out .= '<small>'.$shortinfo.'</small>';
					}
					$out .= '</h1></div>';
				}
				$out .= '</div>';
			}
			$out .= '<div class="'.$class.'">';

			$out .= '<div class="iva_bkform_wrap">';
			$out .= '<form name="iva_bkform" method="post" action="'.esc_url(get_permalink(get_option('iva_bk_template_page'))).'">';
			$out .= '<div class="one_half form_col"><input type="text" name="iva_bk_name" id="iva_bk_name" value="" placeholder="'.$iva_lbl_name.'" class="iva_name"></div>';
			$out .= '<div class="one_half form_col last"><input type="text" name="iva_bk_email" value="" placeholder="'.$iva_lbl_email.'"  id="iva_bk_email" class="iva_email"></div>';
			$out .= '<div class="one_half form_col"><input type="text" name="bookingdate" readonly="readyonly" value="" placeholder="'.$iva_lbl_date.'" id="dateselect" class="iva_date"></div>';
			$out .= '<div class="one_half form_col last"><input type="text" name="phone" id="iva_bk_phone" value="" placeholder="'.$iva_lbl_phone.'" class="iva_phone"></div>';
			$out .= '<div class="clear"></div>';
			$out .= '<button id="button_submit" type="submit" class="mb0 btn '.$buttoncolor.'  large"><span>'.$iva_buttontext.'</span></button>';
			$out .= '</form>';
			$out .= '</div>';

			$out .= '</div>';

			$out .= '</div></div>';
			$out .= '</div>';
		
			// Returns output
			return $out;
		
		}

	} // class end

	$iva_bk_callout = new iva_bk_callout;

} 

// WPBakeryShortCode class checking
if ( class_exists( 'WPBakeryShortCode' ) ) {
    class WPBakeryShortCode_booking_callout extends WPBakeryShortCode {
    }
}