jQuery(function($){ 

    var infowindow  = new google.maps.InfoWindow(); 
  	if( document.getElementById("iva_loc_lat") !== null ){
		var latField  = document.getElementById("iva_loc_lat").value;
	}
	if( document.getElementById("iva_loc_lng") !== null ){
		var lngField  =  document.getElementById("iva_loc_lng").value; 
	}
	if( document.getElementById("iva_loc_address") !== null ){
		var adrField =  document.getElementById("iva_loc_address").value;
	}
	//
    initialize();
    function initialize() {      
		autocomplete = new google.maps.places.Autocomplete(( document.getElementById('iva_loc_address')),{ types: ['geocode'] });     
		google.maps.event.addListener(autocomplete, 'place_changed', function() { fillInAddress(); });
    }
    var componentForm   = {
              street_number: 'short_name',
              route: 'long_name',
              locality: 'long_name',
              administrative_area_level_1: 'short_name',
              country: 'long_name',
              postal_code: 'short_name'
        };
	//
	function fillInAddress() {     
		var place = autocomplete.getPlace();
		for (var i = 0; i < place.address_components.length; i++) {
			var addressType = place.address_components[i].types[0];
			if (componentForm[addressType]) {
				var val = place.address_components[i][componentForm[addressType]];
				document.getElementById(addressType).value = val;
			}
		}
	}
	//
    if( latField != '' && lngField != '' ) { 
        var lat = latField,
			lng = lngField,
            latlng = new google.maps.LatLng(lat, lng);         
			
        var mapOptions = {           
            center: latlng,           
            zoom: 13,           
            mapTypeId: google.maps.MapTypeId.ROADMAP         
        },
        map = new google.maps.Map(document.getElementById('iva_loc_map_canvas'), mapOptions),
        marker = new google.maps.Marker({ position: latlng, map: map, }); 
        infowindow.open( map, marker );
        infowindow.setContent( adrField );
     }else {
        var lat = 17.387140,
			lng = 78.491684,
			latlng = new google.maps.LatLng(lat, lng),
			image = '';
			
        var mapOptions = {           
            center: new google.maps.LatLng(lat, lng),           
            zoom: 2,           
            mapTypeId: google.maps.MapTypeId.ROADMAP         
        },
		
        map = new google.maps.Map(document.getElementById('iva_loc_map_canvas'), mapOptions),
        marker = new google.maps.Marker({
            position: latlng,
            map: map,           
         }); 
        marker.setMap(null);
     }
	var input = document.getElementById('iva_loc_address');         
	var autocomplete = new google.maps.places.Autocomplete(input, {
		types: ["geocode"]
	});
	
	//
    autocomplete.bindTo('bounds', map); 
    google.maps.event.addListener(autocomplete, 'place_changed', function() {
        infowindow.close();
        var place = autocomplete.getPlace();
        if( place.geometry.viewport ) {
            map.fitBounds(place.geometry.viewport);
        } else {
            map.setCenter(place.geometry.location);
            map.setZoom(13);  
        }
		//
        moveMarker( input.value, place.geometry.location ); 
        marker.setMap( map );
		//
        fillInAddress();       
        $("#iva_loc_lat").val(place.geometry.location.lat());
        $("#iva_loc_lng").val(place.geometry.location.lng());
    });  
    
    jQuery("input").focusin(function ($) {
           
        var firstResult = jQuery(".pac-container .pac-item:first").text();        
        var geocoder = new google.maps.Geocoder();
        geocoder.geocode({"address":firstResult }, function(results, status) {

            if (status == google.maps.GeocoderStatus.OK) {

                var lat = results[0].geometry.location.lat(),
                    lng = results[0].geometry.location.lng(),
                    placeName = results[0].address_components[0].long_name,
                    latlng = new google.maps.LatLng(lat, lng);
					
                var addr  =  document.getElementById("iva_loc_address").value;
				//
                moveMarker( addr,latlng );
				
				//
                jQuery("#iva_loc_address").val(firstResult);
				
				//
                fillInAddress();
            }
        });
    });
     
    function moveMarker(placeName, latlng){     
        marker.setPosition(latlng);
        marker.setVisible(true);
        infowindow.setContent(placeName);
        infowindow.open(map, marker);
     }
});