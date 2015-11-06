<?php
	// S L I D E R   M E T A B O X 
	//--------------------------------------------------------
	$prefix = '';

	$this->meta_box[]= array(
		'id'		=> 'slider-meta-box',
		'title'		=> __( 'Slider Options','iva_theme_admin' ),
		'page'		=> array('slider'),
		'context'	=> 'normal',
		'priority'	=> 'high',
		'fields'	=> array(

			array(
				'name'	=> __( 'Link for Slide Item','iva_theme_admin' ),
				'id'	=> $prefix . 'postlinktype_options',
				'desc'	=> __( 'The url that the slide post is linked to','iva_theme_admin' ),
				'type'	=> 'select',
				'std'	=>'nolink',
				'options' =>array(
						'linkpage'		=> 'Link to Page',
						'linktocategory'=> 'Link to Category', 
						'linktopost'	=> 'Link to Post',
						'linkmanually'	=> 'Link Manually',
						'nolink'		=> 'No Link'
				)	
			),
			
			array(
					'name'		=> __( 'Slider Page Link','iva_theme_admin' ),
					'desc'		=> __( 'Slider Page Link.','iva_theme_admin' ),
					'id'		=> $prefix.'linkpage',
					'class' 	=> 'linkoption linkpage',
					'options' 	=>	$this->atp_variable('pages'),
					'std'		=> '',
					'type'		=> 'select'
			),
			array(
					'name'	=> __( 'Link Category for Slider','iva_theme_admin' ),
					'desc'	=> __( 'Slider Description..','iva_theme_admin' ),
					'id'	=> $prefix.'linktocategory',
					'class' => 'linkoption linktocategory',
					'std'	=> '',
					'options' 	=>	$this->atp_variable('categories'),
					'type'	=> 'select'
			),
			array(
					'name'	=> __( 'Slider Post Link','iva_theme_admin' ),
					'desc'	=> __( 'Slider Description..','iva_theme_admin' ),
					'id'	=> $prefix.'linktopost',
					'class' => 'linkoption linktopost',
					'std'	=> '',
					'options' 	=>	$this->atp_variable('posts'),
					'type'	=> 'select'
			),
			array(
					'name'	=> __( 'Slider Link','iva_theme_admin' ),
					'desc'	=> __( 'Slider Description..','iva_theme_admin' ),
					'id'	=> $prefix.'linkmanually',
					'class' => 'linkoption linkmanually',
					'std'	=> '',
					'type'	=> 'text'
			),
			
			
			array(
					'name'	=> __( 'Slider Caption','iva_theme_admin' ),
					'desc'	=> __( 'Slider Caption not more than 100 characters','iva_theme_admin' ),
					'id'	=> $prefix.'slider_desc',
					'class' => '',
					'std'	=> '',
					'type'	=> 'textarea'
			),
			array(
					'name'	=> __( 'Caption Disable','iva_theme_admin' ),
					'desc'	=> __( 'Check this if you wish to disable caption for this slide','iva_theme_admin' ),
					'id'	=> $prefix.'slider_caption',
					'class' => '',
					'std'	=> '',
					'type'	=> 'checkbox'
			),
		),
	);
?>