<?php
	/*
	 * Add new taxonomy, NOT hierarchical (like tags)
	 * posttype = Offers
	 * object type = slide (Name of the object type for the Offers object)
	 */
	if ( !function_exists( 'iva_at_cpt_offers' ) ) {
		function iva_at_cpt_offers() {
	 		$labels = array(
				'name'				=> __( 'Special Offers', 'aivah_core' ),
				'singular_name'		=> __( 'Special Offer', 'aivah_core' ),
				'menu_name' 		=> __( 'Special Offers', 'aivah_core' ),
				'add_new'			=> __( 'Add New Special Offer', 'aivah_core' ),
				'add_new_item'		=> __( 'Add New Special Offer', 'aivah_core' ),
				'edit_item'			=> __( 'Edit Special Offer', 'aivah_core' ),
				'new_item'			=> __( 'New Special Offer', 'aivah_core' ),
				'view_item'			=> __( 'View Special Offers', 'aivah_core' ),
				'search_items'		=> __( 'Search Special Offers', 'aivah_core' ),
				'not_found'			=> __( 'Nothing found', 'aivah_core' ),
				'not_found_in_trash'=> __( 'Nothing found in Trash', 'aivah_core' ),
				'parent_item_colon'	=> '',
				'all_items' 		=>  __( 'All Special Offers', 'aivah_core' )
			);

			$iva_offers_slug = get_option( 'iva_ofrs_slug' ) ?  get_option( 'iva_ofrs_slug' ) : 'offers';

			$args = array(
				'labels'			=> $labels,
				'public'			=> true,
				'publicly_queryable' => true,
				'exclude_from_search'=> false,
				'show_ui'			=> true,
				'show_in_menu'       => true,
				'capability_type'	=> 'post',
				'hierarchical'		=> false,
				'rewrite'			=> array('slug'=> $iva_offers_slug, 'with_front' => true ),
				'query_var'			=> true,
				'menu_position'		=> null,	
				'menu_icon'			=> AIVAH_CPT_URI  . 'assets/images/offers-icon.png',
				'supports'			=> array('editor', 'title', 'thumbnail', 'excerpt', 'custom-meta' ,'comments', 'page-attributes'  )
			); 
			register_post_type( 'offers' , $args );
		}
		add_action( 'init', 'iva_at_cpt_offers' );
	}
	
	// 
	if ( !function_exists( 'iva_at_cpt_edit_offers_columns' ) ) {
		function iva_at_cpt_edit_offers_columns($columns) {
			$columns['post_id']	  = __( 'ID\'s', 'aivah_core' );
			$columns['post_thumbs'] = __( 'Thumbnail', 'aivah_core' );
			return $columns;
		}
		add_filter('manage_edit-offers_columns', 'iva_at_cpt_edit_offers_columns');
	}	
	//
	if ( !function_exists( 'iva_at_cpt_custom_offers_columns' ) ) {	
		function iva_at_cpt_custom_offers_columns($name) {
			global $wpdb, $wp_query,$post;
			switch ($name) {
				case 'post_id':
					echo get_the_id();
					break;
				case 'post_thumbs':
					echo the_post_thumbnail(array(50,50));
					break;
			}
		}
		add_action('manage_posts_custom_column', 'iva_at_cpt_custom_offers_columns', 10, 2);
	}	
?>