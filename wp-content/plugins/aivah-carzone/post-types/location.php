<?php
	/*
	 * Add new taxonomy, NOT hierarchical (like tags)
	 * posttype = Locations
	 * object type = slide (Name of the object type for the Location object)
	 */
	if ( !function_exists( 'iva_at_cpt_location' ) ) {
		function iva_at_cpt_location() {
	 		$labels = array(
				'name'				=> __( 'Locations', 'aivah_core' ),
				'singular_name'		=> __( 'Location', 'aivah_core' ),
				'menu_name' 		=> __( 'Locations', 'aivah_core' ),
				'add_new'			=> __( 'Add New Location', 'aivah_core' ),
				'add_new_item'		=> __( 'Add New Location', 'aivah_core' ),
				'edit_item'			=> __( 'Edit Location', 'aivah_core' ),
				'new_item'			=> __( 'New Location', 'aivah_core' ),
				'view_item'			=> __( 'View Locations', 'aivah_core' ),
				'search_items'		=> __( 'Search Locations', 'aivah_core' ),
				'not_found'			=> __( 'Nothing found', 'aivah_core' ),
				'not_found_in_trash'=> __( 'Nothing found in Trash', 'aivah_core' ),
				'parent_item_colon'	=> '',
				'all_items' 		=>  __( 'All Locations', 'aivah_core' )
			);
			$iva_locations_slug = get_option( 'iva_locations_slug' ) ?  get_option( 'iva_locations_slug' ) : 'location';
			$args = array(
				'labels'			=> $labels,
				'public'			=> true,
				'exclude_from_search'=> false,
				'show_ui'			=> true,
				'capability_type'	=> 'post',
				'hierarchical'		=> false,
				'query_var'			=> false,	
				'menu_icon'			=> AIVAH_CPT_URI  . 'assets/images/location-icon.png',
				'supports'			=> array( 'page-attributes', 'title', 'thumbnail', 'comments' ),
				'taxonomies'		=> array( 'cities' )
			); 
			register_post_type( 'location' , $args );
		}
		add_action( 'init', 'iva_at_cpt_location' ); 
	} 
	// Registering Cities Taxonomy
	if ( !function_exists( 'iva_at_create_cities_taxonomies' ) ) {
		function iva_at_create_cities_taxonomies() {
			register_taxonomy( 'cities', 'location', array(
				'hierarchical'		=> true,
				'labels' 			=> array(
										'name' 				=> __( 'city', 'aivah_core' ),
										'singular_name' 	=> __( 'city', 'aivah_core' ),
										'search_items' 		=> __( 'Search cities', 'aivah_core' ),
										'all_items' 		=> __( 'All cities', 'aivah_core' ),
										'parent_item' 		=> __( 'Parent city', 'aivah_core' ),
										'parent_item_colon' => __( 'Parent cities:', 'aivah_core' ),
										'edit_item' 		=> __( 'Edit city', 'aivah_core' ),
										'update_item' 		=> __( 'Update city', 'aivah_core' ),
										'add_new_item' 		=> __( 'Add city ', 'aivah_core' ),
										'new_item_name' 	=> __( 'New city', 'aivah_core' ),
										'menu_name' 		=> __( 'Cities', 'aivah_core' ),
								      ),
				'show_ui'			=> true,
				'query_var'			=> true,
				'rewrite'			=> false,
			));	
		}
		add_action('init', 'iva_at_create_cities_taxonomies');
	}
?>