<?php
/**
 * Plugin Name: Aivah VC Addons
 * Plugin URI: http://aivahthemes.com/
 * Description: Ultimate Addons for Visual Composer from AivahThemes
 * Version: 1.0.0
 * Author: AivahThemes
 * Author URI: URI: http://themeforest.net/user/AivahThemes
 */

// don't load directly
if (!defined('ABSPATH')) die('-1');
if(!class_exists('iva_vc_extends'))
{
	class iva_vc_extends
	{
	  function __construct() {
	  
	  $this->module_dir = plugin_dir_path( __FILE__ ).'modules';
	  add_action('after_setup_theme',array($this,'iva_init'));
	  
	  }
	  
	  function iva_init()
	  {
	  //  vc addons shortcodes files directory
	  foreach(glob($this->module_dir."/*.php") as $module)
			{
			
				require_once($module);
			}
	  }

	} // class end
	
new iva_vc_extends;
} // end class check