<?php
/**
 * Plugin Name: Booking Widget
 * Description: A widget used for displaying booking form.
 * Version: 1.0
 * Author: Fem Khan
 * Author URI: http://www.aivahthemes.com
 *
 */
 
	// Register Widget 
	function iva_booking_widget() {
		register_widget( 'iva_bk_widget' );
	}

	// Define the Widget as an extension of WP_Widget
	class iva_bk_widget extends WP_Widget {

		function __construct() {
			
			/* Widget settings. */
			$widget_ops = array( 
				'classname'		=> __('iva_bk_widget-wg','iva_theme_admin'),
				'description'	=> __('Booking form widget for sidebar.', 'iva_theme_admin')
			);
	
			/* Widget control settings. */
			$control_ops = array(
				'width'		=> 300,
				'height'	=> 350,
				'id_base'	=> 'iva_bk_widget'
			);

			/* Create the widget. */
			parent::__construct( 'iva_bk_widget',THEMENAME.' - Booking', $widget_ops, $control_ops );
			add_action("wp_enqueue_scripts", array($this, "register_booking_widget"),1);
		}
		function register_booking_widget() {
			wp_enqueue_script('jquery-ui-datepicker');
			$datepicker_language = get_option( 'iva_datepicker_language'); 
			if( $datepicker_language != '')
			{
				wp_enqueue_script('datepicker_language', THEME_JS . '/i18n/datepicker-'.$datepicker_language.'.js', false,false,'all' );
			}
		}

		// outputs the content of the widget
		function widget( $args, $instance ) {
			extract( $args );

			$iva_bk_title 	= $instance['iva_bk_title'];
			$iva_bk_desc  	= $instance['iva_bk_desc'];
			$iva_bk_btn_txt = $instance['iva_bk_btn_txt'];
		
			global $atp_defaultdate;
		
			$iva_lb_name 	= get_option('iva_bk_fnametxt') ? get_option('iva_bk_fnametxt') :__('Name','iva_theme_front');
			$iva_lb_date 	= get_option('iva_bk_date_txt') ? get_option('iva_bk_date_txt'):__('Date','iva_theme_front');
			$iva_lb_email	= get_option('iva_bk_emailtxt') ? get_option('iva_bk_emailtxt'):__('Email','iva_theme_front');
			$iva_lb_phone	= get_option('iva_bk_phonetxt') ? get_option('iva_bk_phonetxt'):__('Phone Number','iva_theme_front');
			
			$iva_cal_fstday			=  get_option('iva_firstday')? get_option('iva_firstday'):'0';
			$iva_cal_localize		=  get_option('iva_localizecal') ? get_option('iva_localizecal'):'';
			$iva_disable_days  		=  get_option('iva_disable_days') ? get_option('iva_disable_days'):'';
			$iva_disable_days  		=  get_option('iva_disable_days') ? get_option('iva_disable_days'):'';
			$iva_disable_weekdays   =  get_option('iva_disable_weekdays') ? get_option('iva_disable_weekdays'):'';
			
			if( !empty( $iva_disable_weekdays ) ){
				$iva_disable_weekdays = implode(',',$iva_disable_weekdays);
			}
			?>
			<script type="text/javascript">
				jQuery(document).ready(function($) {			
					// Disable Specific Days:
					function disable_specificdays(date) {
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
					
					jQuery("#dateselect").datepicker({ 
						dateFormat:'<?php echo $atp_defaultdate; ?>',
						showOtherMonths: true,
						selectOtherMonths: true,
						beforeShowDay : disable_specificdays,
						minDate: 0,
						firstDay: <?php echo ( $iva_cal_fstday !='' ) ? $iva_cal_fstday :'0';?>,
					});
					
					jQuery("#iva_bk_wg_submit").on("click",function(){
						var bk_name  = jQuery("#iva_bk_name").val();
					    var bk_date  = jQuery("#dateselect").val();
					    var bk_email = jQuery("#iva_bk_email").val();
						var bk_phone = jQuery("#iva_bk_phone").val();
						
					    var proceed = true;
						
					    filter = /^[A-Z0-9._%+-]+@([A-Z0-9-]+\.)+[A-Z]{2,4}$/i;
					    if( filter.test( bk_email ) ){
					     jQuery(".iva_bk_wg_email").removeClass("error"); 
					      proceed = true;
					    }else{
					     jQuery(".iva_bk_wg_email").addClass("error");
					       proceed = false;
					    }
					    if( bk_name ==="" ){
					      jQuery(".iva_bk_wg_name").addClass("error");
					      proceed = false;
					    }
						if( bk_name ){
							jQuery(".iva_bk_wg_name").removeClass("error"); 
						}

						if( bk_phone ==="" ){
					      jQuery(".iva_bk_wg_phone").addClass("error");
					      proceed = false;
					    }
						if( bk_phone ){
							jQuery(".iva_bk_wg_phone").removeClass("error"); 
						}

						if( bk_date ==="" ){
					      jQuery(".iva_bk_wg_date").addClass("error");
					      proceed = false;
					    }
						if( bk_date ){
							jQuery(".iva_bk_wg_date").removeClass("error"); 
						}
					    if(proceed){
					      return true;
					    }else{
					      return false;
					    }
					});
         		});
				</script>
			<?php 
			echo $before_widget;

			if ( $iva_bk_title ) {
				echo '<h3 class="widget-title">'.$iva_bk_title.'</h3>';
				if ( $iva_bk_desc ) {
					echo '<p>'.$iva_bk_desc.'</p>';
				}
			}

			$out = '';
			
			$out .='<div id="iva_booking_widget">';
			$out .='<form name="iva_bkform" method="post" action="'.esc_url( get_permalink( get_option( 'iva_bk_template_page' ) ) ).'">';
			$out .='<div class="iva_bk_vertical"><input type="text" name="iva_bk_name" id="iva_bk_name" value="" placeholder="'.$iva_lb_name.'" class="iva_bk_wg_name"></div>';
			$out .='<div class="iva_bk_vertical"><input type="text" name="iva_bk_email" value="" placeholder="'.$iva_lb_email.'"  id="iva_bk_email" class="iva_bk_wg_email"></div>';
			$out .='<div class="iva_bk_vertical"><input type="text" name="bookingdate" readonly="readyonly" value="" placeholder="'.$iva_lb_date.'" id="dateselect" class="iva_bk_wg_date"></div>';
			$out .='<div class="iva_bk_vertical"><input type="text" name="phone" id="iva_bk_phone" value="" placeholder="'.$iva_lb_phone.'" class="iva_bk_wg_phone"></div>';
			$out .='<div class="clear"></div>';
			$out .='<button id="iva_bk_wg_submit" type="submit" class="btn green full"><span>'.$iva_bk_btn_txt.'</span></button>';
			$out .='</form>';
			$out .='</div>';
			
			echo $out;
			
			echo $after_widget;
		}
		
		//processes widget options to be saved
		function update( $new_instance, $old_instance ) {

			$instance = $old_instance;

			/* Strip tags for title and name to remove HTML (important for text inputs). */
			$instance['iva_bk_title'] 	= strip_tags( $new_instance['iva_bk_title'] );
			$instance['iva_bk_desc'] 	= strip_tags( $new_instance['iva_bk_desc'] );
			$instance['iva_bk_btn_txt'] = strip_tags( $new_instance['iva_bk_btn_txt'] );
			
			return $instance;
		}
		
		// outputs the options form on admin
		function form( $instance ) {

			$instance = wp_parse_args( 
							(array) $instance,
							array( 
								'iva_bk_title' 	=> '',
								'iva_bk_desc' 	=>'',
								'iva_bk_btn_txt'  =>'Make Booking'
							) );

			$iva_bk_title   = strip_tags( $instance['iva_bk_title'] );
			$iva_bk_desc    = strip_tags( $instance['iva_bk_desc'] );
			$iva_bk_btn_txt = strip_tags( $instance['iva_bk_btn_txt'] );				
			?>
			<p>
				<label for="<?php echo $this->get_field_id( 'CallOut Title' ); ?>"><?php _e('Title:', 'iva_theme_admin'); ?></label>
				<input type="text" id="<?php echo $this->get_field_id( 'iva_bk_title' ); ?>" name="<?php echo $this->get_field_name( 'iva_bk_title' ); ?>" value="<?php echo $iva_bk_title; ?>" style="width:100%;" />
			</p>
			<p>
				<label for="<?php echo $this->get_field_id( 'iva_bk_desc' ); ?>"><?php _e('Short Info', 'iva_theme_admin'); ?></label>
				<input id="<?php echo $this->get_field_id( 'iva_bk_desc' ); ?>" name="<?php echo $this->get_field_name( 'iva_bk_desc' ); ?>" value="<?php echo $iva_bk_desc; ?>" type="text" style="width:100%;" />
			</p>
			<p>
				<label for="<?php echo $this->get_field_id( 'iva_bk_btn_txt' ); ?>"><?php _e('Button Text', 'iva_theme_admin'); ?></label>
				<input id="<?php echo $this->get_field_id( 'iva_bk_btn_txt' ); ?>" name="<?php echo $this->get_field_name( 'iva_bk_btn_txt' ); ?>" value="<?php echo $iva_bk_btn_txt; ?>" type="text" style="width:100%;" />
			</p>
				
		<?php 
		} 
	} 
	/* Add our function to the widgets_init hook. */
	add_action( 'widgets_init', 'iva_booking_widget' );
?>