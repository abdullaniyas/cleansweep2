jQuery(document).ready(function(jQuery){

    jQuery('#iva_bk_submit').click(function(){
        validateForm();   
    });

    jQuery('#iva_update').click(function(){
        validateForm_update();   
    });
	function validateForm_update(){
        var nameReg      = /^[A-Za-z]+$/;
        var numberReg    =  /^[0-9]+$/;
        var emailReg     = /^[A-Z0-9._%+-]+@([A-Z0-9-]+\.)+[A-Z]{2,4}$/i;
        var iva_postid =  jQuery('#res_post_id').val();
        var iva_fname    = jQuery('#bk_name').val();   
        var iva_phone    = jQuery('#bk_phoneno').val();
        var iva_email    = jQuery('#bk_email').val();    
        var iva_make     = jQuery('#bk_make').val();
        var iva_model    = jQuery('#bk_model').val();
        var iva_year     = jQuery('#bk_year').val();
        var iva_service  = jQuery('#bk_service').val();
        var iva_timings  = jQuery('#bk_timings').val();
		
		var proceed 	= true;
	    
		// First name
        if( iva_fname == ""){
			jQuery("#bk_name").addClass("error");
			 proceed = false;
        } 
		if( iva_fname ){
			jQuery("#bk_name").removeClass("error");
		}
			
		// Phone number
		if( numberReg.test( iva_phone ) ){
			jQuery("#bk_phoneno").removeClass("error");
            proceed = true;
        }else{
		 	jQuery("#bk_phoneno").addClass("error");
			proceed = false;
		}

		// Email
		if( emailReg.test( iva_email ) ){
			jQuery("#bk_email").removeClass("error");
            proceed = true;
        }else{
		 	jQuery("#bk_email").addClass("error");
			proceed = false;
		}
			
		// Make
		if( iva_make == ""){
			jQuery("#bk_make").addClass("error");
			 proceed = false;
        } 
		if( iva_make){
            jQuery("#bk_make").removeClass("error");
			 proceed = true;
        } 

		// Model
		if( iva_model == ""){
			jQuery("#bk_model").addClass("error");
			 proceed = false;
        } 
		if( iva_model){
            jQuery("#bk_model").removeClass("error");
			 proceed = true;
        } 

		// year
		if( iva_year == ""){
			jQuery("#bk_year").addClass("error");
			 proceed = false;
        } 
		if( iva_year){
            jQuery("#bk_year").removeClass("error");
			 proceed = true;
        } 

		//Service
		if( iva_service == ""){
			jQuery("#bk_service").addClass("error");
			 proceed = false;
        } 
		if( iva_service){
            jQuery("#bk_service").removeClass("error");
			 proceed = true;
        } 

		// timings
        if( iva_timings == ""){
			jQuery("#bk_timings").addClass("error");
			 proceed = false;
        } 
		if( iva_timings ){
            jQuery("#bk_timings").removeClass("error");
			 proceed = true;
        } 
		// If  no error proceed
        if( proceed ){
            iva_bookings_update();
        }
  
    }   
    function iva_bookings_update() { 
    	var iva_postid =  jQuery('#res_post_id').val();  
        jQuery.ajax({
            url: iva_panel.ajaxurl,
            type: 'post',
            dataType: 'html',
            data: {
                action : 'iva_bk_form_update',
                upost_id : iva_postid,
                data : jQuery("#bk-form-update").serialize()
            },
			  success: function( response ){ 
                jQuery('#formstatus').html(response);
				if( jQuery( '#book_msg' ).hasClass( "success" ) ){
					document.bk_form_update.reset();
				}
           }
        });
    }
	
	function validateForm(){
        var nameReg      = /^[A-Za-z]+$/;
        var numberReg    =  /^[0-9]+$/;
        var emailReg     = /^[A-Z0-9._%+-]+@([A-Z0-9-]+\.)+[A-Z]{2,4}$/i;
       
        var iva_fname    = jQuery('#bk_name').val();   
        var iva_phone    = jQuery('#bk_phoneno').val();
        var iva_email    = jQuery('#bk_email').val();
        var iva_make     = jQuery('#bk_make').val();
        var iva_model    = jQuery('#bk_model').val();
        var iva_year     = jQuery('#bk_year').val();
        var iva_service  = jQuery('#bk_service').val();
        var iva_timings  = jQuery('#bk_timings').val();
		
		var proceed 	= true;
	    
		// First name
        if( iva_fname == ""){
			jQuery("#bk_name").addClass("error");
			 proceed = false;
        } 
		if( iva_fname ){
			jQuery("#bk_name").removeClass("error");
		}

		// Phone number
		if( numberReg.test( iva_phone ) ){
			jQuery("#bk_phoneno").removeClass("error");
            proceed = true;
        }else{
		 	jQuery("#bk_phoneno").addClass("error");
			proceed = false;
		}	

		// Email
		if( emailReg.test( iva_email ) ){
			jQuery("#bk_email").removeClass("error");
            proceed = true;
        }else{
		 	jQuery("#bk_email").addClass("error");
			proceed = false;
		}
		     	
		// Make
		if( iva_make == ""){
			jQuery("#bk_make").addClass("error");
			 proceed = false;
        } 
		if( iva_make){
            jQuery("#bk_make").removeClass("error");
			 proceed = true;
        } 

		// Model
		if( iva_model == ""){
			jQuery("#bk_model").addClass("error");
			 proceed = false;
        } 
		if( iva_model){
            jQuery("#bk_model").removeClass("error");
			 proceed = true;
        } 

		// year
		if( iva_year == ""){
			jQuery("#bk_year").addClass("error");
			 proceed = false;
        } 
		if( iva_year){
            jQuery("#bk_year").removeClass("error");
			 proceed = true;
        } 

		//Service
		if( iva_service == ""){
			jQuery("#bk_service").addClass("error");
			 proceed = false;
        } 
		if( iva_service){
            jQuery("#bk_service").removeClass("error");
			 proceed = true;
        }

		// timings
        if( iva_timings == ""){
			jQuery("#bk_timings").addClass("error");
			 proceed = false;
        } 
		if( iva_timings ){
            jQuery("#bk_timings").removeClass("error");
			 proceed = true;
        } 
		// If  no error proceed
        if( proceed ){
            iva_bookings();
        }
    }
	function iva_bookings(){ 
		 jQuery.ajax({
            url: iva_panel.ajaxurl,
            type: 'post',
            dataType: 'html',
            data: {
                action   : 'iva_bk_form_insert',
                data     : jQuery("#iva-bk-form").serialize()
            },
            success: function( response ){ 
                jQuery('#formstatus').html(response);
				if( jQuery('#book_msg').hasClass( "success" ) ){
					document.bk_form.reset();
				}
           }
        });
    }
});