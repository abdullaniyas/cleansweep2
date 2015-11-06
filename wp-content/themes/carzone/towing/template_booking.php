<?php
/**
 * The template for displaying pages
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages and that
 * other "pages" on your WordPress site will use a different template.
 *
 * @package WordPress
 * @subpackage CarZone
 * @since Autotow 1.0.0
*/
/*
 Template Name: Booking
*/
get_header(); 
?>
<div id="primary" class="pagemid">
  <div class="inner">   
    <main class="content-area" role="main">
      <div class="entry-content-wrapper clearfix">
		
		<?php 
		// Get the content from page template.
		if ( have_posts() ) : 
			while ( have_posts() ) : the_post(); 
				the_content();
			endwhile; 
		endif;
		?>

       <?php 
			global $atp_defaultdate,$atp_theme;
			$iva_weather_location = get_option( 'iva_weather_loc' ) ? get_option( 'iva_weather_loc' ) : 'Hyderabad,IN';
			$iva_weather_unit 	  = get_option( 'iva_weather_unit' ) ? get_option( 'iva_weather_unit' ) : 'f';
			$iva_firstday			  = get_option( 'iva_first_day' );
			$iva_disable_days  		=  get_option('iva_disable_days') ? get_option('iva_disable_days'):'';
			$iva_disable_weekdays   =  get_option('iva_disable_weekdays') ? get_option('iva_disable_weekdays'):'';
			if( !empty( $iva_disable_weekdays ) ){
				$iva_disable_weekdays = implode(',',$iva_disable_weekdays);
			}
			
			$iva_name_txt		  = get_option( 'iva_bk_fnametxt' ) ? get_option( 'iva_bk_fnametxt' ) : __( 'Name:','iva_theme_front');
			$iva_phone_txt		  = get_option( 'iva_bk_phonetxt' ) ? get_option( 'iva_bk_phonetxt' ) : __( 'Phone Number:','iva_theme_front');
			$iva_email_txt		  = get_option( 'iva_bk_emailtxt' ) ? get_option( 'iva_bk_emailtxt' ) : __( 'Email:','iva_theme_front');
			$iva_methd_txt		  = get_option( 'iva_bk_mthdtxt' ) ? get_option( 'iva_bk_mthdtxt' ) : __( 'Preferred Method Of Contact:','iva_theme_front');
			$iva_services_txt	  = get_option( 'iva_bk_servicestxt' ) ? get_option( 'iva_bk_servicestxt' ) : __( 'Service Request:','iva_theme_front');
			$iva_year_txt		  = get_option( 'iva_bk_yeartxt' ) ? get_option( 'iva_bk_yeartxt ') : __( 'Year:','iva_theme_front');
			$iva_make_txt		  = get_option( 'iva_bk_maketxt' ) ? get_option( 'iva_bk_maketxt' ) : __( 'Make:','iva_theme_front');
			$iva_model_txt	      = get_option( 'iva_bk_modeltxt' ) ? get_option( 'iva_bk_modeltxt' ) : __('Model:','iva_theme_front');
			$iva_frm_heading1_txt = get_option( 'iva_bk_heading1_txt') ? get_option('iva_bk_heading1_txt') : __('Booking Information', 'iva_theme_front');
			$iva_frm_heading2_txt = get_option( 'iva_bk_heading2_txt') ? get_option('iva_bk_heading2_txt') : __('Special Offers', 'iva_theme_front');
			$iva_frm_heading3_txt = get_option( 'iva_bk_heading3_txt') ? get_option('iva_bk_heading3_txt') : __('Vehicle Information', 'iva_theme_front');
			$iva_phonecall_txt 	  = get_option( 'iva_bk_phonecalltxt' ) ? get_option( 'iva_bk_phonecalltxt' ) : __('Phone Call','iva_theme_front');
			$iva_sms_txt  		  = get_option( 'iva_bk_smstxt' ) ? get_option( 'iva_bk_smstxt' ) :__( 'SMS','iva_theme_front');
			$iva_mail_txt 		  = get_option( 'iva_bk_mailtxt' ) ? get_option( 'iva_bk_mailtxt' ) : __( 'Email','iva_theme_front');
			$iva_btn_txt		  = get_option( 'iva_bk_buttontxt' ) ? get_option( 'iva_bk_buttontxt' ) : __( 'Submit', 'iva_theme_front');
			$iva_btn_color 		  = get_option( 'iva_bk_btn_color' ) ? get_option('iva_bk_btn_color') :__('black','iva_theme_front');
			$datepicker_language = get_option( 'iva_datepicker_language');
			$iva_offers = $atp_theme->atp_variable('offers');
		    $iva_offers_array  = get_option('iva_offers');

			$iva_bk_name	 =  isset( $_POST['iva_bk_name'] ) ? $_POST['iva_bk_name'] : '';
			$iva_bk_email	 =  isset( $_POST['iva_bk_email'] )? $_POST['iva_bk_email'] :'';
			$iva_bk_phone	 =  isset( $_POST['phone'] )? $_POST['phone'] :'';
			$iva_bk_offer_id =  isset( $_POST['bk_offer_id'] )? $_POST['bk_offer_id'] :'';
			?>	
	
		<script type="text/javascript">
			jQuery(document).ready(function($) { 

			var date_monthNames = '';
			<?php if( $datepicker_language !='' ){  ?>
				$.datepicker.setDefaults($.datepicker.regional[ '<?php echo $datepicker_language; ?>' ] );
				var date_monthNames = $.datepicker.regional[ '<?php echo $datepicker_language; ?>' ].monthNames;
			<?php } ?>
				// Simple Weather
				jQuery.simpleWeather({
					location: '<?php echo esc_js( $iva_weather_location ); ?>',
					woeid: '',
					unit: '<?php echo esc_js( $iva_weather_unit ); ?>',
					success: function(weather) {
						html = '<h2><span class="wi icon-'+weather.code+'"></span> '+weather.temp+'&deg;'+weather.units.temp+'</h2>';
						html += '<ul><li>'+weather.city+', '+weather.region+'</li>';
						html += '<li class="currently">'+weather.currently+'</li>';
						html += '<li>'+weather.wind.direction+' '+weather.wind.speed+' '+weather.units.speed+'</li></ul>';
						$("#iva_weather").html(html);
					},
					error: function(error) {
						$("#iva_weather").html('<p>'+error.message+'</p>');
					}
				}); 
				// Callender Date,Month,Year
				var iva_cur_date      = new Date();
				//  language added Since 1.3
				if( date_monthNames != '' ){
					var iva_months = date_monthNames;
				}else{
					var	iva_months 		= [ "January", "February", "March", "April", "May", "June", "July", "August", "September", "October", "November", "December" ];
				}
				var iva_current_date  = iva_cur_date.getDate(); 
				var iva_current_month = iva_months[iva_cur_date.getMonth()]; 
				var iva_current_year  = iva_cur_date.getFullYear(); 
				
				// Callender Date,Month,Year
				jQuery('.iva-calDate').html(iva_current_date);
				jQuery('.iva-calMonth').html(iva_current_month);
				jQuery('.iva-calYear').html(iva_current_year);
				
				// Disable Specific Days:
				function iva_disable_specificdays(date) {
					// disable selected dates
					<?php if( isset( $iva_disable_days ) && !empty( $iva_disable_days ) ) { ?>
					var disabledDays = <?php echo str_replace('\\/', '/', json_encode( $iva_disable_days )); ?>;
					var m 			 = date.getMonth();
					var d 			 = date.getDate();
					var y 			 = date.getFullYear();
					var current_date = (m + 1) + '/' + d + '/' + y ;
					for ( var k = 0; k < disabledDays.length; k++ ) {					
						if ($.inArray(current_date, disabledDays) != -1 ) {
						return [0];
						}
					}
					<?php } ?>
					// disable week days
					<?php if( isset( $iva_disable_weekdays ) && !empty( $iva_disable_weekdays ) ) { ?>	
					var disableweekDay = [ <?php echo $iva_disable_weekdays; ?> ];						
					var day = date.getDay();
					for ( j = 0; j < disableweekDay.length; j++ ) {
						if ($.inArray(day, disableweekDay) != -1) {
						   return [0];
						}
					}   
					<?php } ?>
					return [1];	 
				}
				
				// Callender 
				jQuery("#booking_date").datepicker({
					showOtherMonths: true,
					selectOtherMonths: true,
					nextText: "<?php echo __('Next', 'iva_theme_front'); ?>",
					prevText: "<?php echo __('Prev', 'iva_theme_front'); ?>",
					beforeShowDay : iva_disable_specificdays,
					dateFormat:'<?php echo esc_js( $atp_defaultdate ); ?>', 
					minDate: 0,
					firstDay: <?php echo ( $iva_firstday !='' ) ? esc_js(  $iva_firstday ) :'0';?>,
					altField: "#dateselect",
					<?php 
					if( isset( $_POST['bookingdate']) ){ ?>defaultDate: '<?php echo esc_js( $_POST['bookingdate'] ); ?>',<?php } ?>
					onSelect: iva_booking_timings,
				});
				<?php if(isset( $iva_bk_name ) && isset( $iva_bk_email ) && isset( $iva_bk_phone ) ){ ?>
				jQuery( '[name="bk_name"]' ).attr('value','<?php echo esc_js( $iva_bk_name ); ?>');
				jQuery( '[name="bk_email"]' ).attr('value','<?php echo esc_js ( $iva_bk_email ); ?>');
				jQuery( '[name="bk_phoneno"]' ).attr('value','<?php echo esc_js ( $iva_bk_phone ); ?>');
				<?php } ?>       

				<?php if( isset( $_POST['bk_offer_id']) ){ ?>
				jQuery( '[name="bk_ofr"]' ).attr('value','<?php echo esc_js ( $_POST['bk_offer_id'] ); ?>');
				<?php } ?>

				
				iva_booking_timings();

				function iva_booking_timings(){
					var iva_bk_date = jQuery("#booking_date").datepicker('getDate');
					var iva_bk_day  = iva_bk_date.getDay();
					var iva_day     = iva_bk_date.getDate();  
					var iva_month   = iva_bk_date.getMonth() + 1;  
					var iva_year    = iva_bk_date.getFullYear();    
					$.ajax({
						url: iva_panel.ajaxurl,
						type: 'post',
						dataType: 'html',
						data: {
						  'action'  : 'iva_get_bk_timings',
						  'week_day': iva_bk_day,
						  'get_date': iva_day + '-' + iva_month + '-' + iva_year,
						},
						success: function(response) { 
						  // Shows bookings list
						  jQuery('.bookingtime').html(response).show();
						}
					}); // ajax function closed
				  }
			 });
		</script>  
		
		<?php

		echo '<div id="formstatus"></div>';

		echo '<form id="iva-bk-form" class="clearfix iva-form" name="bk_form">';

		echo '<div class="one_third">';?>

		<div class="iva-date-wrap">
			<div class="col_half nomargin">
				<div class="iva-date">
					<span class="iva-calDate"></span><span class="iva-calMonth"></span><span class="iva-calYear"></span>
				</div>
			</div>

			<div class="col_half nomargin end">
				<div id="iva_weather"></div>
			</div>
		</div>
		<?php
	

		// Calender Field 
		echo '<div id="booking_date" name="booking_date"></div>';
		echo '<input type="hidden" name="dateselect" id="dateselect" value="">';
		echo '</div>';// One_half ends here end

		echo '<div class="one_third">'; 
		echo '<h4>'.$iva_frm_heading1_txt.'</h4>';

		// Name		
		echo '<div class="iva_bk_name">';
		echo '<label for="bk_name" class="bk_req">'.$iva_name_txt.'</label>';
		echo '<input type="text" id="bk_name" name="bk_name" value="" size="25" class="bk_name" />';
		echo '</div>';

		// Phone
		echo '<div class="iva_bk_phoneno">';
		echo '<label for="bk_phoneno" class="bk_req">'.$iva_phone_txt.'</label>';
		echo '<input type="text" id="bk_phoneno" name="bk_phoneno" value="" size="25" class="bk_phoneno" />';
		echo '</div>';

		// Email
		echo '<div class="iva_bk_email">';
		echo '<label for="bk_email" class="bk_req">'.$iva_email_txt.'</label>';
		echo '<input type="email" id="bk_email" name="bk_email" value="" size="25" class="bk_email"/>';
		echo '</div>';	

		// Preferred Method Of Contact
		echo '<div class="iva_bk_contact" id="bk_pcontact">';
		echo '<div class="">'.$iva_methd_txt.'</div>';
		echo '<label for="phonecall"><input type="radio" class="iva_bk_pcontact" id="phonecall" name="bk_pcontact" value="phonecall" checked="checked">'.$iva_phonecall_txt.'</label>';
		echo '<label for="sms"><input type="radio" class="iva_bk_pcontact" id="sms" name="bk_pcontact" value="sms">'.$iva_sms_txt.'</label>';
		echo '<label for="mail"><input type="radio" class="iva_bk_pcontact" id="mail" name="bk_pcontact" value="mail">'.$iva_mail_txt.'</label>';			
		echo '</div>';						
		echo '<hr>';

		// Offers
		$iva_ofrs_posts = $atp_theme->atp_variable('offers');
		if( isset( $iva_ofrs_posts ) ){
			echo '<div class="bk_field">';
			echo '<h4>'.$iva_frm_heading2_txt.'</h4>';
			echo '<div class="check-wrap">';
			foreach ( $iva_ofrs_posts as $ofr_postid => $ofr_title ) { 
				$iva_ofr_post = get_post($ofr_postid); 
				$checked = '';
				if( $iva_bk_offer_id == $ofr_postid ){
					$checked = 'checked="checked"';
				}
				echo '<div class="iva_bk_ofr">
				<span class="iva_ofr_checkbox">
				<input type="checkbox" multiple="multiple" name="bk_ofr[]" id="bk_ofr'.$ofr_postid . '"  class="bk_ofr" value='. $ofr_postid . ' '.$checked.'>' ;
				echo '<label for="bk_ofr'. $ofr_postid . '">'. $ofr_title.'</label></span>';
				echo '</div>';
		    }
		   echo '</div>';
		   echo '</div>';


		}
						
		echo '</div>'; // one_third end
		echo '<div class="one_third last">';
		echo '<h4>'.$iva_frm_heading3_txt.'</h4>';	

		// Make	
		echo '<div class="iva_bk_make">';
		echo '<label for="bk_make" class="bk_req">'.$iva_make_txt.'</label>';
		echo '<input type="text" id="bk_make" name="bk_make" value="" size="25" class="bk_make" />';
		echo '</div>';		

		// Model
		echo '<div class="iva_bk_model">';
		echo '<label for="bk_model" class="bk_req">'.$iva_model_txt.'</label>';
		echo '<input type="text" id="bk_model" name="bk_model" value="" size="25" class="bk_model" />';
		echo '</div>';

		// Year
		echo '<div class="iva_bk_year">';
		echo '<label for="bk_year" class="bk_req">'.$iva_year_txt.'</label>';
		echo '<input type="text" id="bk_year" name="bk_year" value="" size="25" class="bk_year" />';
		echo '</div>';
		
		// Service
		echo '<div class="iva_bk_service">';
		echo '<label for="bk_service" class="bk_req">'.$iva_services_txt.'</label>';
		echo '<textarea id="bk_service" class="bk_service" name="bk_service" rows="3" cols="30"></textarea>';
		echo '</div>';

		// Timings
		echo '<div class="bookingtime" style="display:none;"></div>';

		// Submit
		echo '<div class="iva_subbtn">';
		echo '<input type="button" name="submit" value="'.$iva_btn_txt.'" size="25" id="iva_bk_submit" class="btn medium '.$iva_btn_color.' iva_submit"/>';
		echo '<div>';
		
		// Booking Status
		echo '<input type="hidden" name="bk_status" id="status" value="unconfirmed" />'; 
	echo '</div>';
	echo '</form>';
	edit_post_link( __( 'Edit', 'iva_theme_front' ), '<span class="edit-link">', '</span>' );
	?>        
        </div><!-- .content-area -->

      </main><!-- main -->    
     	<?php if ( $sidebar_layout!= "fullwidth" ){ get_sidebar(); } ?>		
	</div><!-- inner -->	
</div><!-- #primary.pagemid -->
<?php get_footer(); ?>