<?php
/*
	 * Add new taxonomy, NOT hierarchical (like tags)
	 * posttype = Appointment
	 * object type = slide (Name of the object type for the Appointment object)
	 */
	if ( !function_exists( 'iva_at_cpt_booking' ) ) {
		function iva_at_cpt_booking() {
			$labels = array(
				'name'               => _x( 'Bookings', 'aivah_core' ),
				'singular_name'      => _x( 'Booking', 'aivah_core' ),
				'menu_name'          => _x( 'Bookings', 'aivah_core' ),
				'name_admin_bar'     => _x( 'Booking', 'aivah_core' ),
				'add_new'            => _x( 'Add New', 'aivah_core' ),
				'add_new_item'       => __( 'Add New Booking', 'aivah_core' ),
				'new_item'           => __( 'New Booking', 'aivah_core' ),
				'edit_item'          => __( 'Edit Booking', 'aivah_core' ),
				'view_item'          => __( 'View Booking', 'aivah_core' ),
				'all_items'          => __( 'All Booking', 'aivah_core' ),
				'search_items'       => __( 'Search Booking', 'aivah_core' ),
				'parent_item_colon'  => __( '' ),
				'not_found'          => __( 'No Booking found.', 'aivah_core' ),
				'not_found_in_trash' => __( 'No Booking found in Trash.', 'aivah_core' )
			);

			$iva_booking_slug = get_option('iva_booking_slug') ? get_option('iva_booking_slug') :'booking';

			$args = array(
				'labels'             => $labels,
				'public'             => true,
				'publicly_queryable' => true,
				'show_ui'            => true,
				'show_in_menu'       => true,
				'query_var'          => true,
				'rewrite'            => array( 'slug' => $iva_booking_slug, 'with_front' => true  ),
				'capability_type'    => 'post',
				'has_archive'        => true,
				'hierarchical'       => false,
				'menu_position'      => null,
				'menu_icon'			=> AIVAH_CPT_URI  . 'assets/images/booking-icon.png',
				'supports'           => array( 'title', 'page-attributes', 'editor', 'thumbnail', 'comments' )
			);
			register_post_type( 'booking', $args );
		}
		add_action( 'init', 'iva_at_cpt_booking' );
	}
	//
	if ( !function_exists( 'iva_at_cpt_edit_booking_columns' ) ) {
		function iva_at_cpt_edit_booking_columns($columns) {
			$columns['bk_date']   = __( 'Booking Date', 'aivah_core' );
			$columns['bk_time']   = __( 'Booking time', 'aivah_core' );
			$columns['bk_status'] = __( 'Booking Status', 'aivah_core' );
			
			return $columns;
		}
		add_filter( 'manage_edit-booking_columns', 'iva_at_cpt_edit_booking_columns' );
	}
	//
	if ( !function_exists( 'iva_at_cpt_custom_booking_columns' ) ) {
		function iva_at_cpt_custom_booking_columns($name) {
			global $wpdb, $wp_query,$post;
			switch ($name) {
				case 'bk_date':
						$default_date = get_option('atp_date_format') ? get_option('atp_date_format') :'Y/m/d';
						if( $default_date ){
							echo date( $default_date, get_post_meta( get_the_ID(), 'iva_bk_date', true) );
						}
						break;

				case 'bk_time':
						$iva_bk_time = get_post_meta( get_the_ID(), 'iva_bk_timings', true );
						$iva_format  = get_option( 'iva_time_format')? get_option( 'iva_time_format') :'12';
						if( $iva_format == '12'){
						  $timeformat     = "h:i A";
						}elseif( $iva_format == '24'){
						  $timeformat     = "H:i";
						}else{
						  $timeformat     = "h:i A";
						}
						if( $iva_bk_time ){
							echo  date( $timeformat,strtotime( $iva_bk_time ) );
						}
						break;	
			
				case 'bk_status':
						$status=get_post_meta( get_the_ID(), 'iva_bk_status', TRUE );
						switch($status){
							case 'unconfirmed':
								$unConfirmed = get_option( 'iva_bk_unconfirm' ) ? get_option( 'iva_bk_unconfirm' ) : 'UnConfirmed';
								echo '<p class="unconfirmed">'.$unConfirmed.'</p>';
								break;
							case 'confirmed':
								$confirmed = get_option( 'iva_bk_confirm' ) ? get_option( 'iva_bk_confirm' ) : 'Confirmed';
								echo '<p class="confirmed">'.$confirmed.'</p>';
								break;
							case 'cancelled':
								$cancellation = get_option( 'iva_bk_cancel' ) ? get_option( 'iva_bk_cancel' ) : 'Cancelled';
								echo '<p class="cancelled">'.$cancellation.'</p>';
								break;
						}

			}
		}
		add_action( 'manage_posts_custom_column', 'iva_at_cpt_custom_booking_columns', 10, 2 );
	}
?>