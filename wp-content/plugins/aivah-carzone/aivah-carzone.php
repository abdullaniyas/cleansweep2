<?php
/**
 * Plugin Name: Aivah CarZone
 * Plugin URI: http://aivahthemes.net/
 * Description: A brief description of the plugin.
 * Version: 1.0.0
 * Author: AivahThemes
 * Author URI: URI: http://themeforest.net/user/AivahThemes
 * Text Domain: Optional. Plugin's text domain for localization. Example: mytextdomain
 * Domain Path: Optional. Plugin's relative directory path to .mo files. Example: /locale/
 * Network: Optional. Whether the plugin can only be activated network wide. Example: true
 * License: GNU General Public License v2 or later
 * License URI: http://www.gnu.org/licenses/gpl-2.0.html
 */

/**
 * ATP_Theme class.
 */
if ( !class_exists( 'Aivah_CarZone_Plugin' ) ) {
    
    class Aivah_Carzone_Plugin
    {
        public function __construct()
        {
            define('AIVAH_CPT_URI', plugin_dir_url( __FILE__ ));
			define('AIVAH_CPT_DIR', plugin_dir_path( __FILE__ ));
		
			//
            $this->aivah_post_types();   
		}

        /**
         * load custom post types templates
         * @files slider, testimonials
         */
        function aivah_post_types(){
            
           require_once( AIVAH_CPT_DIR .'/post-types/slider.php' );
           require_once( AIVAH_CPT_DIR .'/post-types/booking.php' );
           require_once( AIVAH_CPT_DIR .'/post-types/location.php' );
           require_once( AIVAH_CPT_DIR .'/post-types/offers.php' );
      
        }

	}
}
$aivah_carzone_plugin = new Aivah_Carzone_Plugin();

/**
 * function iva_cpt_admin_init
 * 
 */
if( !function_exists('iva_at_cpt_admin_init') ){
	function iva_at_cpt_admin_init() {
	   wp_enqueue_media();
	   wp_enqueue_script('aivah-cpt-custom-script', AIVAH_CPT_URI . 'assets/js/custom_script.js', false, '', false );
	}
	add_action('admin_enqueue_scripts','iva_at_cpt_admin_init');   
}
//
if ( !function_exists( 'iva_at_cpt_get_attachment_id_from_src' ) ) {
     function iva_at_cpt_get_attachment_id_from_src( $image_src ) {
        global $wpdb;
        $id = $wpdb->get_var( $wpdb->prepare( "SELECT * FROM $wpdb->posts WHERE guid = %s", $image_src ) );
        return $id;
    }
}
?>