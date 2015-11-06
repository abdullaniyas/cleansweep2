jQuery(document).ready(function($) {
	// on change function start
	jQuery( "#iva_cities" ).change(function() {

        var iva_city	= jQuery( '#iva_cities' ).val();
		var iva_loc_dir_txt = jQuery( '#iva_loc_dir_txt' ).val();

        // ajax calling function start
		$.ajax({
			url: iva_panel.ajaxurl,
			type: 'post',
			dataType: 'json',
			data: {
				action   : 'iva_get_locations_by_cat', //get cities dropdown list function
				cat_slug : iva_city,
			},
			// success function start
			success: function( response ) { 
				var loc_details = '';
				jQuery('.iva_loc_display').html(loc_details).show();
				for ( var j in response ) {
					var p1 = response[j];
					var start_address 	= jQuery( '#iva_loc_dir_start_address' ).val();

		
					var iva_protocol	= jQuery( '#iva_protocol' ).val();

					loc_details = loc_details + '<div class="iva_loc_list" data-lat="'+ p1[0]+'" data-lng="'+ p1[1]+'" data-addr="'+ p1[3]+'">';
					if( start_address ) {
					loc_details = loc_details + '<span class="iva_get_direction"><a href="'+iva_protocol+'://maps.google.com/maps?saddr='+start_address+'&daddr='+p1[3]+'" target="_blank"><i class="fa fa-external-link-square fa-lg fa-fw"></i></a></span>';
					}else{
					loc_details = loc_details + '<span class="iva_get_direction"><a href="'+iva_protocol+'://maps.google.com/maps?saddr=Current+Location&daddr='+p1[3]+'" target="_blank"><i class="fa fa-external-link-square fa-lg fa-fw"></i></a></span>';
					}
					if( p1[2] ){
						loc_details = loc_details + '<span class="iva_loc_title">' + p1[2] + '</span>';
					}
					if( p1[3] ){
						loc_details = loc_details + '<span class="iva_loc_address"><i class="fa fa-map-marker fa-fw"></i>' + p1[3] + '</span>';
					}
					if( p1[4] ){
						loc_details = loc_details + '<span class="iva_loc_phoneno"><i class="fa fa-phone fa-fw"></i>' + p1[4]+ '</span>';
					}
					if( p1[5] ){
						loc_details = loc_details + '<span class="iva_loc_services"><i class="fa fa-cog fa-fw"></i>' + p1[5]+ '</span>';
					}
					loc_details = loc_details + '</div>';
				} // for loop closing
				
				jQuery('.iva_loc_display').html(loc_details).show();
			
				// particular city click function 
                jQuery( ".iva_loc_list" ).click(function() {
					jQuery('.iva_loc_list').removeClass('iva_loc_active');
					var  lattitudes 		 =  jQuery(this).attr('data-lat');
					var  longitudes 		 =  jQuery(this).attr('data-lng');
					var  content 		     =  jQuery(this).attr('data-addr');
					var  wopen  			 =  'true';
					
					var  LocationData   	 =  [
						[lattitudes,longitudes ,content,wopen ],
					];
					jQuery(this).addClass('iva_loc_active');
		            initialize(LocationData);
				 }); //click function closing

                // initialize function start
				function initialize(LocationData) {
					var length_array = LocationData.length;
					var map = new google.maps.Map(document.getElementById('iva_map_canvas'));
					map.setOptions({ draggable: false, zoomControl: false, scrollwheel: false, disableDoubleClickZoom: true, disableDefaultUI: true });
					var bounds = new google.maps.LatLngBounds();
					var infowindow = new google.maps.InfoWindow();

					if(length_array == 1){          
						var zoom = 14;
					} else if (length_array >= 2) {
						var zoom = 5;
					} else {
						var zoom = 14;
					}

					var boundsListener = google.maps.event.addListener((map), 'bounds_changed', function(event) {
						this.setZoom(zoom);
						google.maps.event.removeListener(boundsListener);
					});

					for (var i in LocationData){
						var p      =  LocationData[i];
						var latlng =  new google.maps.LatLng(p[0], p[1]);
						bounds.extend(latlng);
						var  title1 = '<div class="iva_address">'+p[2]+'</div>'; 
						var marker =  new google.maps.Marker({
							position: latlng,
							map: map,
							title:title1,
							icon: iva_panel.directory_uri+'/images/marker-icon.png'
						});
						if( p[3] == 'true') {

							var infowindow = new google.maps.InfoWindow();
							infowindow.setContent(title1);
							infowindow.open(map, marker);
						}else {
							google.maps.event.addListener(marker, 'click', function() {
							infowindow.setContent(this.title);
							infowindow.open(map, this);
						});
						}
						
					} // for loop closing
			        map.fitBounds(bounds);
				} // initialize function closing

			   initialize(response);// deafult city and selected city function
		    } // success function closing

		}); // ajax calling function closing

	}).change(); // on change function closing

}); // document  ready function closing
