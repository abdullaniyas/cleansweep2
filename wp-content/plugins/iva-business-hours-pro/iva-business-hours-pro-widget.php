<?php
	// Register Widget 
	function iva_businesshours() {
		register_widget( 'iva_bhrs_widget' );
	}
	
	// Define the Widget as an extension of WP_Widget
	class iva_bhrs_widget extends WP_Widget {
	
		/* constructor */
		public function __construct() {
		
				
			/* Widget settings. */
			$widget_ops = array(
				'classname'		=> 'ivabh-businesshours',
				'description'	=> __('Display Business Hours.', 'iva_business_hours')
			);
			
			/* Widget control settings. */
			$control_ops = array(
				'width'		=> 300,
				'height'	=> 350,
				'id_base'	=> 'iva_business_hrs'
			);
			/* Create the widget. */
			parent::__construct( 'iva_business_hrs','Business Hours Pro', $widget_ops, $control_ops );
			
		}

		function widget( $args, $instance ) {
		
			extract( $args );
			
			/* Our variables from the widget settings. */
			
			$iva_bhrs_title 	= $instance['iva_bhrs_title'];
			$iva_bhrs_id 	 	= $instance['iva_bhrs_id'];
			$iva_bhrs_class 	= isset( $instance['iva_bhrs_class'] ) ? $instance['iva_bhrs_class'] : '';
			$iva_grouping_hrs   = isset( $instance['iva_grouping_hrs'] ) ? $instance['iva_grouping_hrs'] : '';
			
			// Fetch Data
			global $wpdb;

			$ivbh_title = $ivbh_day_open = $ivbh_day_close = $output = $today_output = $out = $hrs_css = '';
			
				
			$iva_bh_class = 'show'.rand('10','100');
			
		
			$iva_bh_sql 		= "SELECT * FROM $wpdb->iva_businesshours where id='".$iva_bhrs_id."'" ;
			$iva_bh_results 	= $wpdb->get_results( $iva_bh_sql,ARRAY_A ); 
			$iva_bh_time_format = get_option('iva_bh_time_format')?get_option('iva_bh_time_format') : 'H:i';
			$iva_see_more_text 	= get_option('iva_seemore_text')?get_option('iva_seemore_text'):__( 'See more','iva_business_hours');
			$iva_today_text 	= get_option('iva_today_text')?get_option('iva_today_text'):__( 'Today','iva_business_hours');
			
			$iva_oc_img = $iva_oc_text = '';
			
			if( $iva_bh_results ){
				
				foreach ( $iva_bh_results as $iva_bh_data ) {
			
					$iva_descripion_prefix = $iva_descripion_enable = $iva_descripion = $iva_todaydate_enable = $iva_grouping_enable = $iva_closed_bg_color = $iva_current_day_color ='';
					$iva_toggle_enable = $cssextras = $iva_open_image = $iva_close_image = $iva_oc_img = $iva_bh_start_hrs = $iva_bh_end_hrs = $iva_oc_text = '';
					
					$iva_today_timings = $iva_bh_oc_timings = array();
					
					$iva_bh_title = $iva_bh_data['title'];
				
					if( $iva_bh_data['closedtext'] ){
						$iva_closed_text = $iva_bh_data['closedtext'];
					}else{
						$iva_closed_text = __('Closed','iva_business_hours');
					}
					if( $iva_bh_data['opentext'] ){
						$iva_open_text = $iva_bh_data['opentext'];
					}else{
						$iva_open_text = __('Open','iva_business_hours');
					}
					if( $iva_bh_data['timeseparator'] ){
						$iva_time_separator	 = $iva_bh_data['timeseparator'];
					}else{
						$iva_time_separator	 = '-';
					}
					if( $iva_bh_data['description'] ){
						$iva_descripion	 = $iva_bh_data['description'];
					}
					if( $iva_bh_data['descriptionprefix'] ){
						$iva_descripion_prefix	 = $iva_bh_data['descriptionprefix'];
					}
					if( $iva_bh_data['descriptionenable'] ){
						$iva_descripion_enable	 = $iva_bh_data['descriptionenable'];
					}
					if( $iva_bh_data['todaydate'] ){
						$iva_todaydate_enable	 = $iva_bh_data['todaydate'];
					}
					
					if( isset( $iva_bh_data['grouping_enable'] ) ){
						$iva_grouping_enable = $iva_bh_data['grouping_enable'];
					}
					if( isset( $iva_bh_data['closed_bg_color'] ) ){
						$iva_closed_bg_color = $iva_bh_data['closed_bg_color'];
					}
					if( isset( $iva_bh_data['open_bg_color'] ) ){
						$iva_open_bg_color = $iva_bh_data['open_bg_color'];
					}
					if( isset( $iva_bh_data['current_day_color'] ) ){
						$iva_current_day_color = $iva_bh_data['current_day_color'];
					}
					if( isset( $iva_bh_data['toggle_enable'] ) ){
						$iva_toggle_enable = $iva_bh_data['toggle_enable'];
					}
					if( isset( $iva_bh_data['open_image'] ) ){
						$iva_open_image = $iva_bh_data['open_image'];
					}
					if( isset( $iva_bh_data['close_image'] ) ){
						$iva_close_image = $iva_bh_data['close_image'];
					}
					// Open Close Image
					$iva_current_day  	=  date_i18n( 'N', strtotime( date('N') )) ;
					$iva_weekday 		= 'weekday'.$iva_current_day;
					$iva_today_data 	= json_decode( $iva_bh_data[$iva_weekday] );
					
					if( !empty( $iva_today_data ) ){
						foreach( $iva_today_data as $key => $value){
							$iva_today_timings = $value;
						}
						if( !empty( $iva_today_data ) ){
							foreach ( $iva_today_timings as $key => $value){
								$iva_bh_oc_timings['open'][] = $value->open;
								$iva_bh_oc_timings['close'][] = $value->close;
							}
							
							$max_value 			= max( $iva_bh_oc_timings['close'] );
							$min_value 			= min( $iva_bh_oc_timings['open'] );
							$iva_curent_time 	= get_date_from_gmt ( date( 'Y-m-d H:i:s', time() ), 'H:i' );
							
							if(!empty($iva_bh_oc_timings)) {
								// Open text and image
								if ( ( strtotime( $iva_curent_time ) >=  strtotime( $min_value ) ) || ( strtotime( $iva_curent_time ) <= strtotime( $max_value ) )){
									$iva_oc_text = $iva_open_text;
									if(  $iva_open_image !=''){
										$iva_oc_img = '<figure><img class="ivabh_open_img" src="'.$iva_open_image.'" width="470" height="300"></figure>';
									}
								}
								// Close text and image
								if( ( strtotime( $iva_curent_time ) <  strtotime( $min_value ) ) || ( strtotime( $iva_curent_time ) > strtotime( $max_value ) ) ){
									$iva_oc_text = $iva_closed_text;
									if(  $iva_close_image !=''){
										$iva_oc_img = '<figure><img class="ivabh_close_img" src="'.$iva_close_image.'" width="470" height="300"></figure>';
									}
								}
							}
						}
						
					}
					// Open Close Image
				
					$j = $k = 0;
					$select_today 	= $cssextras = '';
					$ivbh_hrs_array = array();
					
					$closed_bgcolor = isset( $iva_closed_bg_color ) ? 'background-color:'.$iva_closed_bg_color.';':'';
					$open_bgcolor 	= isset( $iva_open_bg_color ) ? 'background-color:'.$iva_open_bg_color.';':'';
					
					$cssextras 		= ( $closed_bgcolor!='' ) ? ' style="'.$closed_bgcolor.'"':'';
					$open_css 		= ( $open_bgcolor!='') ? ' style="'.$open_bgcolor.'"':'';
					
					$hrs_css 		= ( $iva_toggle_enable == 'on' )  ?'style="display:none;"':'';

					$today_color =  isset( $iva_current_day_color ) ? 'color:'.$iva_current_day_color.';' : '';
					
					if( isset( $iva_grouping_hrs ) && $iva_grouping_hrs!='' ){
						$iva_grouping_enable = $iva_grouping_hrs;
					}
					
					if( $iva_descripion_enable != 'on'){
						if( $iva_descripion_prefix == 'on' ){
							$out.='<div class="ivabh-desc">'.$iva_descripion.'</div>';
						}
					}
					$out.='<div class="ivabh-hours '.$iva_bh_class.'" '.$hrs_css.'>';
			
					foreach ( iva_bh_getWeekdays() as $key => $day ) {
					
						$week_day_key = 'weekday'.$key;
						$iva_bh_day = json_decode( $iva_bh_data[$week_day_key] );
						$iva_bh_hrs = array();
						
						foreach( $iva_bh_day as $key => $value ){
						
							$iva_row_count =  count( $value );
							foreach( $value as $time){
								
								$ivbh_day_open	 = iva_bh_formatTime( $time->open,$iva_bh_time_format );
								$ivbh_day_close	 = iva_bh_formatTime( $time->close,$iva_bh_time_format );
								$ivbh_day_start  = isset( $time->starttime ) ? $time->starttime :'';
								$ivbh_day_end    = isset( $time->latetime ) ? $time->latetime :'';

								if( $ivbh_day_start != '' ) {
									$ivbh_day_start = '<span class="iva-bh-stext">'.$ivbh_day_start.'</span>';
								}
								if( $ivbh_day_end != '' ) {
									$ivbh_day_end = '<span class="iva-bh-etext">'.$ivbh_day_end.'</span>';
								}

								
								//	 Today hours array
								if( ( $ivbh_day_open =='') && ( $ivbh_day_close =='') && ( $ivbh_day_end == '') && ( $ivbh_day_start == '') ){
									$ivbh_today_hrs_array[$day] = '<span class="closed" '.$cssextras.'>'.$iva_closed_text.'</span>';
								}elseif( ( $ivbh_day_open !='' || $ivbh_day_start != '') && ( $ivbh_day_close !='' || $ivbh_day_end != '') ){
									$ivbh_today_hrs_array[$day] = $ivbh_day_open.$ivbh_day_start.$iva_time_separator.$ivbh_day_close.$ivbh_day_end;
								}
								//
								// with out group hours array 
								if( ( $ivbh_day_open =='') && ( $ivbh_day_close=='') && ( $ivbh_day_end == '') && ( $ivbh_day_start == '') ){
									$ivbh_arr[$day] = '<span class="closed" '.$cssextras.'>'.$iva_closed_text.'</span>';
								}elseif( ( $ivbh_day_open !='' || $ivbh_day_start != '') && ( $ivbh_day_close !='' || $ivbh_day_end != '') ){
									
									// Start hours
									if( $ivbh_day_open && $ivbh_day_start ){
										$iva_bh_start_hrs = $ivbh_day_open .$ivbh_day_start;
									}else{
										if( $ivbh_day_open != '' ){
											$iva_bh_start_hrs = $ivbh_day_open;
										}elseif( $ivbh_day_start != '' ){
											$iva_bh_start_hrs = $ivbh_day_start;
										}
									}
									
									// End hours
									if( $ivbh_day_close && $ivbh_day_end ){
										$iva_bh_end_hrs = $ivbh_day_close . $ivbh_day_end;
									}else{
										if( $ivbh_day_close !='' ){
											$iva_bh_end_hrs = $ivbh_day_close;
										}elseif( $ivbh_day_end !=''){
											$iva_bh_end_hrs = $ivbh_day_end;
										}
									}
									$ivbh_arr[$day] = $iva_bh_start_hrs . $iva_time_separator .$iva_bh_end_hrs;;
								}
								//	
								if( $iva_toggle_enable == 'on'){
						
									// Today result
									$iva_bh_today  =  date_i18n( 'l', strtotime( date('l') )) ;
	
												
									if( $iva_bh_today === $day){
					
										if( $k == 0 ) {
											$today_output .= '<div class="today-result">';
											$today_output .= '<p><span class="days">'.$iva_today_text.'<span class="iva-bh-oc-text" '.$open_css.'>'.$iva_oc_text.'</span></span>';
										}
										if( ( $ivbh_day_open =='') && ( $ivbh_day_close=='') && ( $ivbh_day_end == '') && ( $ivbh_day_start == '') ){
											$today_output .= '<span class="hours"><span class="closed" '.$cssextras.'>'.$iva_closed_text.'</span></span>';
										}else{
											$today_output .= '<span class="hours">'. $ivbh_today_hrs_array[$iva_bh_today].'</span>';
											$k++;
											if( $iva_row_count == $k ){
												$k=0;
												$today_output.='</p>';
											}
										}
										
										if( $k == 0 ) {
											$today_output .='<div id="'.$iva_bh_class.'" class="iva-bh-tg">';
											$today_output .='<span class="ivbh-seemore"> '.$iva_see_more_text.'<span class="arrow"></span></span>';
											$today_output .='</div>';//iva-bh-tg
											$today_output .= '</div>'; //.today-result
										}
									}
								}
								if( $iva_grouping_enable != 'on'){
									
									if( $j == '0' ) { 
										$out.='<p>';
										$iva_bh_day = '&nbsp;'.$day;
									}else { 
										$iva_bh_day = '';
									}
									
									if( $iva_bh_day !=''){
										// Get Current day
										$iva_bh_today  =  date_i18n( 'l', strtotime( date('l') )) ;
									
										if( $iva_bh_today === $day && $iva_todaydate_enable == 'on' ){
											$select_today = 'select-today';
											$today_css 		= ($today_color!='') ? ' style="'.$today_color.'"':'';
										}
										else {
											$select_today = $today_css ='';
										}
										$out.='<span class="days '.$select_today.'" '.$today_css.'>'.$iva_bh_day .'</span>';
									}
									// with out group hours array 
									$out.='<span class="hours '.$select_today.'" '.$today_css.'>'. $ivbh_arr[$day].'</span>';
									
									$j++;
									if( $iva_row_count == $j ){
										$j=0;
										$out.='</p>';
									}
								}else{
									// grouping hours array
									if( ( $ivbh_day_open == '') && ( $ivbh_day_close == '') && ( $ivbh_day_end == '') && ( $ivbh_day_start == '') ){
										$iva_bh_hrs[] = '<span class="closed" '.$cssextras.'>'.$iva_closed_text.'</span>';
									}elseif( ( $ivbh_day_open !='' || $ivbh_day_start != '') && ( $ivbh_day_close !='' || $ivbh_day_end != '') ){
												
										// Start hours
										if( $ivbh_day_open && $ivbh_day_start ){
											$iva_bh_start_hrs = $ivbh_day_open .'&nbsp;'.$ivbh_day_start;
										}else{
											if( $ivbh_day_open !='' ){
												$iva_bh_start_hrs = $ivbh_day_open;
											}elseif( $ivbh_day_start !=''){
												$iva_bh_start_hrs = $ivbh_day_start;
											}
										}
										
										// End hours
										if( $ivbh_day_close && $ivbh_day_end ){
											$iva_bh_end_hrs = $ivbh_day_close .'&nbsp;'.$ivbh_day_end;
										}else{
											if( $ivbh_day_close !=''){
												$iva_bh_end_hrs = $ivbh_day_close;
											}elseif( $ivbh_day_end !=''){
												$iva_bh_end_hrs = $ivbh_day_end;
											}
										}
										$iva_bh_hrs[] = $iva_bh_start_hrs.$iva_time_separator.$iva_bh_end_hrs;
									}
									$ivbh_hours_array[$day] = $iva_bh_hrs;
								}
							}
						}
					}
				
					if( $iva_grouping_enable == 'on'){
					
						$out.= iva_bh_grouping_hours( $ivbh_hours_array ,$iva_todaydate_enable,$today_color);
					}
					$out.='</div>';
					
					if( $iva_descripion_enable != 'on'){
						if( $iva_descripion_prefix != 'on' ){
							$out.='<div class="ivabh-desc">'.$iva_descripion.'</div>';
						}
					}
				}	
			}
		
			$before_widget = preg_replace('/class="/', 'class="'.$iva_bhrs_class.' ',  $before_widget);
			echo $before_widget;
			if( $iva_bhrs_title !='' ) { 
				echo $before_title.$iva_bhrs_title.$after_title; 
			}
			if(  $iva_oc_img !=''){
				echo $iva_oc_img;	
			}
			echo $today_output;
			echo $out;
			echo $after_widget;
		}
		//processes widget options to be saved

		function update( $new_instance, $old_instance ) {
		
			$instance = $old_instance;
			
			/* Strip tags for title and name to remove HTML (important for text inputs). */
			$instance['iva_bhrs_title']  	= strip_tags( $new_instance['iva_bhrs_title'] );
			$instance['iva_bhrs_id'] 	 	= strip_tags( $new_instance['iva_bhrs_id'] );
			$instance['iva_bhrs_class'] 	= strip_tags( $new_instance['iva_bhrs_class'] );
			$instance['iva_grouping_hrs']   = strip_tags($new_instance['iva_grouping_hrs']);
			
			return $instance;
		}
		
		// Outputs the options form on admin
		function form( $instance ) {
		
			/* Set up some default widget settings. */
			$instance = wp_parse_args( (array) $instance, 
										array( 
											'iva_bhrs_title'  	=> '',
											'iva_bhrs_id' 	  	=> '',
											'iva_bhrs_class' 	=> '',
											'iva_grouping_hrs' 	=> '',
											)  
						);
			$iva_bhrs_title  = strip_tags( $instance['iva_bhrs_title'] );
			$iva_bhrs_id 	 = strip_tags( $instance['iva_bhrs_id'] );
			$iva_bhrs_class  = strip_tags( $instance['iva_bhrs_class'] );
			$iva_grouping_hrs = strip_tags( $instance['iva_grouping_hrs'] );
			?>
			<p>
				<label for="<?php echo $this->get_field_id( 'iva_bhrs_title' ); ?>"><?php _e('Title', 'iva_business_hours'); ?></label>
				<input id="<?php echo $this->get_field_id( 'iva_bhrs_title' ); ?>" name="<?php echo $this->get_field_name( 'iva_bhrs_title' ); ?>" value="<?php echo $iva_bhrs_title; ?>" type="text" style="width:100%;" />
			</p>
				
			<?php
			global $wpdb;
			$ivbh_select_query  = "SELECT title,id FROM $wpdb->iva_businesshours" ;
			$ivbh_fetch_results = $wpdb->get_results( $ivbh_select_query ); 
			
			if( $ivbh_fetch_results ){
				echo '<p><label for="'.$this->get_field_id( 'iva_bhrs_id' ).'">'.__('Select Hours:', 'iva_business_hours').'</label> ';
				echo '<select id="'.$this->get_field_id( 'iva_bhrs_id' ).'" name="'.$this->get_field_name( 'iva_bhrs_id' ).'">';
	
				foreach ( $ivbh_fetch_results as $value ) {
				
					if( $iva_bhrs_id == $value->id ) { 
						$selected = 'selected="selected"';
					}else{
						$selected ='';
					}
					echo'<option value="'.$value->id.'" '.$selected.'>'.$value->title.'</option>';
				}
				
				echo '</select></p>';
			}
			?>
						<p>
				<input class="checkbox" value="on" type="checkbox"  <?php  if( $iva_grouping_hrs == "on") { echo "checked"; } ?> id="<?php echo $this->get_field_id( 'iva_grouping_hrs'); ?>" name="<?php echo $this->get_field_name( 'iva_grouping_hrs' ); ?>" />
				<label for="<?php echo $this->get_field_id( 'iva_grouping_hrs' ); ?>"><?php _e( 'Check this if you wish to group the hours if timings are same.','iva_theme_admin' ); ?></label>
			</p>
			<p>
				<label for="<?php echo $this->get_field_id( 'iva_bhrs_class' ); ?>"><?php _e('CSS: Additional CSS Class Name', 'iva_business_hours'); ?></label>
				<input id="<?php echo $this->get_field_id( 'iva_bhrs_class' ); ?>" name="<?php echo $this->get_field_name( 'iva_bhrs_class' ); ?>" value="<?php echo $iva_bhrs_class; ?>" type="text" style="width:100%;" />
			</p>
			

			<?php
		} 
	}
	/* Add our function to the widgets_init hook. */
	add_action( 'widgets_init', 'iva_businesshours' );
?>