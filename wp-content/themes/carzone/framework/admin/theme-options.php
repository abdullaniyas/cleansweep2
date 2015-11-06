<?php
add_action('init','atp_options');
// Get theme version from style.css
	
	if ( !function_exists( 'atp_options' ) ) {
		$iva_of_options = array();
		function atp_options(){
		global $iva_of_options,$shortname,$atp_theme ;
			//More Options
			$uploads_arr = wp_upload_dir();
			$all_uploads_path = $uploads_arr['path'];
			$all_uploads = get_option('atp_uploads');
	
			$iva_colors = array();
			if(is_dir(THEME_DIR . "/colors/")) {
				if($style_dirs = opendir(THEME_DIR . "/colors/")) {
					while(($color = readdir($style_dirs)) !== false) {
						if(stristr($color, ".css") !== false) {
							$iva_colors[$color] = $color;
						}
					}
				}
			}
			$iva_colors_select = $iva_colors;
			array_unshift($iva_colors_select,'Default Color');

			$iva_fontface = array(
				' ' 									=> 'Select a font',
				'Arial'									=> 'Arial',
				'Verdana'								=> 'Verdana',
				'Tahoma'								=> 'Tahoma',
				'Sans-serif'							=> 'Sans-serif',
				'Lucida Grande'							=> 'Lucida Grande',
				'Georgia,serif'							=> 'Georgia',
				'Trebuchet MS,Tahoma,sans-serif'		=> 'Trebuchet',
				'Times New Roman,Geneva,sans-serif'		=> 'Times New Roman',
				'Palatino,Palatino Linotyp,serif'		=> 'Palatino',
				'Helvetica Neue,Helvetica,sans-serif'	=> 'Helvetica'
			);


					
			// GENERAL 
			//-----------------------------------------------------------------------------------------------
			$iva_of_options[] = array( 'name' => __('General','iva_theme_admin'),'icon' => ADMIN_URI.'/images/cog-icon.png','type' => 'heading');
			//-----------------------------------------------------------------------------------------------
			
				$iva_of_options[] = array(  
										'name'	=> __('One Click Demo Content','iva_theme_admin'),
										'desc'	=> __('This will import the following content from a WordPress export file included in package:<br>
File Location : theme/framework/admin/iva-importer/data<br>
<br>
&bull;Posts, pages and other custom post types<br>
&bull;Comments<br>
&bull;Custom fields and post meta<br>
&bull;Categories, tags and terms from custom taxonomies<br>
&bull;Authors<br>

										','iva_theme_admin'),
										'id'	=> $shortname.'_importdata',
										"std" 	=> '',
										'class' => 'atp-importdata',
										'type'	=> 'importsampledata'
									); 
			 		
				$iva_of_options[] = array( 'name'	=> __('Custom Logo','iva_theme_admin'),
									'desc'	=> __('Select the Logo style you wish to use title or image.','iva_theme_admin'),
									'id'	=> $shortname.'_logo',
									'std'	=> 'title',
									'class' => 'select300',
									'options' => array( 'title' => 'Title', 'logo' => 'Logo',),
									'type'	=> 'select'
									);

				$iva_of_options[] = array( 'name'	=> __('Dark Logo Image','iva_theme_admin'),
									'desc'	=> __('Upload a dark colored logo for your theme which will be displayed in white background areas, or specify the image url of your online logo. (http://yoursite.com/logo.png)','iva_theme_admin'),
									'id'	=> $shortname.'_header_dark_logo',
									'std'	=> '',
									'class' => 'atplogo logo',
									'type'	=> 'upload'
									);
									
									
				$iva_of_options[] = array( 'name'	=> __('Light Logo Image','iva_theme_admin'),
									'desc'	=> __('Upload a light colored logo for your theme which will be displayed in dark background areas, or specify the image url of your online logo. (http://yoursite.com/logo.png)','iva_theme_admin'),
									'id'	=> $shortname.'_header_light_logo',
									'std'	=> '',
									'class' => 'atplogo logo',
									'type'	=> 'upload'
									);


				$iva_of_options[] = array( 'name'	=> __('Admin Login Logo','iva_theme_admin'),
									'desc'	=> __('Upload a logo for your wordpress admin area which displays only when the login screen appears.','iva_theme_admin'),
									'id'	=> $shortname.'_admin_logo',
									'std'	=> '',
									'class' => 'atplogo logo',
									'type'	=> 'upload'
									);

				$iva_of_options[] = array( 'name'	=> 'Logo Background Color',
									'desc'	=> 'Logo Background Color for Header Style 4.',
									'id'	=> $shortname.'_header_logo_bgcolor',
									'std'	=> '',
									'class' => 'atplogo logo',
									'type'	=> 'color'
									);

				$iva_of_options[] = array(	'name'	=> __('Site Title','iva_theme_admin'),
									'desc'	=> __('Site Title Color Properties','iva_theme_admin'),
									'id'	=> $shortname.'_logotitle',
									'std'	=> array('size' => '', 'lineheight' => '', 'style' => '', 'fontvariant' =>''),
									'class' => 'atplogo title',
									'type'	=> 'typography'
									);
				$iva_of_options[] = array(	'name'	=> __('Site Description','iva_theme_admin'),
									'desc'	=> __('Site Description Color and properties','iva_theme_admin'),
									'id'	=> $shortname.'_tagline',
									'std'	=> array('size' => '', 'lineheight' => '', 'style' => '', 'fontvariant' =>''),
									'class' => 'atplogo title',
									'type'	=> 'typography'
									);
				$iva_of_options[] = array( 'name'	=> __('Custom Favicon','iva_theme_admin'),
									'desc'	=> __('Upload a 16px x 16px ICO icon format that will represent your website favicon.','iva_theme_admin'),
									'id'	=> $shortname.'_custom_favicon',
									'std'	=> '',
									'type'	=> 'upload'
									); 
				$iva_of_options[] = array( 'name' 	=> __('Subheader Content Alignment','iva_theme_admin'),
									'desc'	=> __('Select subheader content alignment. Choose between 1, 2 or 3 position layout.','iva_theme_admin'),
									'id'	=> $shortname.'_sub_styling',
									'std'	=> 'left',
									'type'  	=> 'images',
									'options' 	=> array(
										   'left'   =>  FRAMEWORK_URI . 'admin/images/columns/sh-left.png', 
										   'center' =>  FRAMEWORK_URI . 'admin/images/columns/sh-center.png',
										   'right'  =>  FRAMEWORK_URI . 'admin/images/columns/sh-right.png')
									);
				$iva_of_options[] = array( 'name'	=> __('Subheader Teaser','iva_theme_admin'),
									'desc'	=> __('Teaser call out for the subheader section of the theme.','iva_theme_admin'),
									'id'	=> $shortname.'_teaser',
									'std'	=> 'default',
									'class' => 'select300',
									'options' => array( 
											'default'	=> 'Default (post title)',
											'twitter'   => 'Twitter Tweets',
											'disable'	=> 'Disable Subheader'),
									'type'	=> 'select'
									);
				$iva_of_options[] = array( 'name'	=> __('Breadcrumbs','iva_theme_admin'),
									'desc'	=> __('Check this if you wish to disable the breadcrumbs for the theme which appears in the subheader. If you wish to disable the breadcrumb for a specific page then go to edit page and select option in from there.','iva_theme_admin'),
									'id'  	=> $shortname.'_breadcrumbs',
									'std' 	=> 'true',
									'type' 	=> 'checkbox'
									);	
				$iva_of_options[] = array( 'name'	=> __('Slider Single Page Slug','iva_theme_admin'),
									'desc'	=> __('For example if you enter "my-slider" the link to the post will display as <strong>/my-slider/post-name</strong><br/><br/>Do not use this same slug anywere else on your website.','iva_theme_admin'),
									'id'	=> $shortname.'_sliderslug',
									'std'	=> '',
									'type'	=> 'text',
									'inputsize'=> ''
									);
				$iva_of_options[] = array( 'name'	=> __('Testimonial Single Page Slug','iva_theme_admin'),
									'desc'	=> __('For example if you enter "my-clients" the link to the post will display as <strong>/my-clients/post-name</strong><br/><br/>Do not use this same slug anywere else on your website.','iva_theme_admin'),
									'id'	=> $shortname.'_testimonialslug',
									'std'	=> '',    
									'type'	=> 'text',
									'inputsize'=> ''
									);
				$iva_of_options[] = array( 'name'	=> __('Date Format','iva_theme_admin'),
									'desc'	=> __('This date format is used only for jQuery DatePicker whick appears in Appointment form calender','iva_theme_admin'),
									'id'	=> $shortname.'_date_format',
									'std'	=> '',
									'type'	=> 'select',
									'class'	=> 'select300',
									'options'	=> array(
														'Y/m/d'  => date("Y/m/d"),
														'm/d/Y'  => date("m/d/Y"),
														'd-m-Y'  => date("d-m-Y"),
												 	),
				);
				

			// TWITER 
			//---------------------------------------------------------------------------------------------------
			$iva_of_options[] = array( 'name' => __('Twitter API','iva_theme_admin'),'icon' => ADMIN_URI.'/images/twitter-icon.png','type' => 'heading');
			//---------------------------------------------------------------------------------------------------

				$iva_of_options[] = array( 'name'	=> __('Twitter Username','iva_theme_admin'),
									'desc'	=> __('Enter Twitter username to display tweets in subheader area of the theme. <br>You will need to visit <a href="https://dev.twitter.com/apps/" target="_blank">https://dev.twitter.com/apps/</a>, sign in with your account and create your own keys.','iva_theme_admin'),
									'id'	=> $shortname.'_teaser_twitter',
									'std'	=> '',
									'inputsize' => '300',
									'type'	=> 'text'
									);
				$iva_of_options[] = array( "name"	=> __("Twitter API key",'iva_theme_admin'),
									"desc"	=> __("Twitter Consumer key",'iva_theme_admin'),
									"id"	=> $shortname."_consumerkey",
									'inputsize' => '300',
									"std"	=> "",
									"type"	=> "text");
				$iva_of_options[] = array( "name"	=> __("Twitter API secret",'iva_theme_admin'),
									"desc"	=> __("Twitter Consumer secret",'iva_theme_admin'),
									"id"	=> $shortname."_consumersecret",
									'inputsize' => '300',
									"std"	=> "",
									"type"	=> "text");
				$iva_of_options[] = array( "name"	=> __("Twitter Access token",'iva_theme_admin'),
									"desc"	=> __("Twitter Access token",'iva_theme_admin'),
									"id"	=> $shortname."_accesstoken",
									'inputsize' => '300',
									"std"	=> "",
									"type"	=> "text");
				$iva_of_options[] = array( "name"	=> __("Twitter Token secret",'iva_theme_admin'),
									"desc"	=> __("Twitter Access secret",'iva_theme_admin'),
									"id"	=> $shortname."_accesstokensecret",
									'inputsize' => '300',
									"std"	=> "",
									"type"	=> "text");
										
			// HEADER STYLE #########################################################################################
			//---------------------------------------------------------------------------------------------------
			$iva_of_options[] = array( 'name' => __('Headers','iva_theme_admin'),'icon' => ADMIN_URI.'/images/header-icon.png','type' => 'heading');
			//---------------------------------------------------------------------------------------------------
				
						$iva_of_options[] = array( "name"	=> __("Header Style",'iva_theme_admin'),
												"desc"	=> __('Select the style you wish to choose for the Header.','iva_theme_admin'),
												"id"	=> $shortname."_headerstyle",
												"std"	=> "",
												'class' => 'select300',
												"options" => array(
													'' => 'Choose Header Style',
													'headerstyle1' => 'Header Style1',
													'headerstyle2' => 'Header Style2',
													'headerstyle3' => 'Header Style3',
													'headerstyle4' => 'Header Style4',
													'fixedheader'  => 'Fixed Header',
													),
												"type"	=> "select");

						$iva_of_options[] = array(	'name'	=> __('Header Background Properties','iva_theme_admin'),
											'desc'	=> __('Select the Background Image for Header and assign its Properties according to your requirements.','iva_theme_admin'),
											'id'	=> $shortname.'_headerproperties',
											'std'	=> array(
															'image'		=> '',
															'color'		=> '',
															'style' 	=> 'repeat',
															'position'	=> 'center top',
															'attachment'=> 'scroll'),
											'type'	=> 'background');

						$iva_of_options[] = array( "name"	=> __("Topbar Background Color",'iva_theme_admin'),
											"desc"	=> __("This will apply the background color to the topbar.",'iva_theme_admin'),
											"id"	=> $shortname."_topbar_bgcolor",
											"std"	=> "",
											"type"	=> "color");

						$iva_of_options[] = array(	'name'	=> __('Topbar Text Color','iva_theme_admin'),
												'desc'	=> __('This will apply text color to the topbar','iva_theme_admin'),
												'id'	=> $shortname.'_topbar_text',
												'std'	=> '', 
												'type'	=> 'color');

						$iva_of_options[] = array(	'name'	=> __('Topbar Link Color','iva_theme_admin'),
												'desc'	=> __('This will apply link color in the topbar.','iva_theme_admin'),
												'id'	=> $shortname.'_topbar_link',
												'std'	=> '', 
												'type'	=> 'color');

						$iva_of_options[] = array( "name"	=> __("Top Bar",'iva_theme_admin'),
											"desc"	=> __('Check this if you wish to disable the Top Bar.','iva_theme_admin'),
											"id"	=> $shortname."_topbar",
											"std"	=> "",
											"type"	=> "checkbox");

			// COLORS ###########################################################################################
			//---------------------------------------------------------------------------------------------------
			$iva_of_options[] = array( 'name' => __('Styling','iva_theme_admin'), 'icon' => ADMIN_URI.'/images/colors-icon.png','type' => 'heading');
			//---------------------------------------------------------------------------------------------------
			
						//---------------------------------------------------------------------------------------------------
						$iva_of_options[] = array( 'name'	=> __('General Elements','iva_theme_admin'), 'type' => 'subnav');
						//---------------------------------------------------------------------------------------------------

						$iva_of_options[] = array( 'name' 		=> __('Layout Option','iva_theme_admin'),
											'desc'	=> __('Select the layout option BOXED/STRETCHED','iva_theme_admin'),
											'id'	=> $shortname.'_layoutoption',
											'std' 		=> 'stretched',
											'type'  	=> 'images',
											'class' => 'select300',
											'options' 	=> array(
												   'stretched' 	=>  FRAMEWORK_URI . 'admin/images/columns/stretched.png',
												   'boxed'  	=>  FRAMEWORK_URI . 'admin/images/columns/boxed.png')
											);			
						
						$iva_of_options[] =array(	'name'	=> __('Colors','iva_theme_admin'),
											'desc'	=> __('Select your themes alternative color scheme for this Theme Current theme has no extra custom made skins','iva_theme_admin'),
											'id'	=> $shortname.'_style',
											'std'	=> '', 
											'class' => 'select300',
											'options'=> $iva_colors_select,
											'type'	=> 'select');


						$iva_of_options[] = array(	'name'	=> __('Theme Color','iva_theme_admin'),
											'desc'	=> __('Theme Color set to default with theme if you choose color from here it will change all the links and backgrounds used in the theme.','iva_theme_admin'),								
											'id'	=> $shortname.'_themecolor',
											'std'	=> '', 
											'type'	=> 'color');


						$iva_of_options[] = array(	'name'	=> __('Body Background Properties','iva_theme_admin'),
											'desc'	=> __('Select the Background Image for Body and assign its Properties according to your requirements.','iva_theme_admin'),
											'id'	=> $shortname.'_bodyproperties',
											'std'	=> array(
															'image'		=> '',
															'color'		=> '',
															'style' 	=> '',
															'position'	=> '',
															'attachment'=> ''),
											'type'	=> 'background');
			
						$iva_of_options[] = array( 'name' => __('Background Pattern Images','iva_theme_admin'),
											'desc' => __('Patter overlay on the body background color or image, displays on if the layout is selected as boxed in General Options Panel','iva_theme_admin'),
											'id'   => $shortname.'_overlayimages',
											'std'  => '',
											'type' => 'images',
											'options' => array(
															''			 => THEME_URI . '/images/patterns/no-pat.png',
															'pat_01.png' => THEME_URI . '/images/patterns/pattern-1-Preview.jpg',
															'pat_02.png' => THEME_URI . '/images/patterns/pattern-2-Preview.jpg',
															'pat_03.png' => THEME_URI . '/images/patterns/pattern-3-Preview.jpg',
															'pat_04.png' => THEME_URI . '/images/patterns/pattern-4-Preview.jpg',
															'pat_05.png' => THEME_URI . '/images/patterns/pattern-5-Preview.jpg',
															'pat_06.png' => THEME_URI . '/images/patterns/pattern-6-Preview.jpg',
															'pat_07.png' => THEME_URI . '/images/patterns/pattern-7-Preview.jpg',
															'pat_08.png' => THEME_URI . '/images/patterns/pattern-8-Preview.jpg',
														),
													);
					

						$iva_of_options[] = array(	'name'	=> __('Subheader Background Properties','iva_theme_admin'),
											'desc'	=> __('Select the Background Image for Subheader and assign its Properties according to your requirements.','iva_theme_admin'),
											'id'	=> $shortname.'_subheaderproperties',
											'std'	=> array(
															'image'		=> '',
															'color'		=> '',
															'style' 	=> 'repeat',
															'position'	=> 'center top',
															'attachment'=> 'scroll'),
											'type'	=> 'background');

						$iva_of_options[] = array(	'name'	=> __('Subheader','iva_theme_admin'),
											'desc'	=> __('Subheader Text Color','iva_theme_admin'),
											'id'	=> $shortname.'_subheader_textcolor',
											'std'	=> '', 
											'type'	=> 'color');



						$iva_of_options[] = array(	'name'	=> __('Footer Background','iva_theme_admin'),
											'desc'	=> __('Footer background properties includes the sidebar footer widgets area as well. If you wish to disable footer area you can go to Footer Tab and do that..','iva_theme_admin'),
											'id'	=> $shortname.'_footerbg',
											'std'	=> array(
															'image'		=> '',
															'color'		=> '',
															'style' 	=> 'repeat',
															'position'	=> 'center top',
															'attachment'=> 'scroll'),
											'type'	=> 'background');

					
						$iva_of_options[] = array(	'name'	=> __('Content Area Background Color','iva_theme_admin'),
											'desc'	=> __('This will apply color to the primary content area of theme.','iva_theme_admin'),
											'id'	=> $shortname.'_wrapbg',
											'std'	=> '', 
											'type'	=> 'color');

						$iva_of_options[] = array(	'name'	=> __('Breadcrumb','iva_theme_admin'),
											'desc'	=> __('Breadcrumb Text Color.','iva_theme_admin'),
											'id'	=> $shortname.'_breadcrumbtext',
											'std'	=> '', 
											'type'	=> 'color');
	
						//---------------------------------------------------------------------------------------------------
						$iva_of_options[] = array( 'name' => __('Menu','iva_theme_admin'), 'type' => 'subnav');
						//---------------------------------------------------------------------------------------------------

						$iva_of_options[] = array( 'name'  => __('Menu Background','iva_theme_admin'),
											'desc'  => __('This applies the background color for Header Style2 and Header Styl3 only .','iva_theme_admin'),
											'id'    => $shortname.'_mmenu',
											'std'   => '', 
											'type'  => 'color');			

						$iva_of_options[] = array(	'name'	=> __('Menu Font and Link Color','iva_theme_admin'),
											'desc'	=> __('Select the Color and Font Properties for Menu Parent Lists.','iva_theme_admin'),
											'id'	=> $shortname.'_topmenu',
											'std'	=> array(
															'size' 		=> '',
															'lineheight'=> '',
															'fontvariant' => '',
															'style' 	=> '',
															'color' 	=> ''),
											'type'	=> 'typography');
						
						$iva_of_options[] = array( 'name'  => __('Menu Hover BG','iva_theme_admin'),
											'desc'  => __('Select the Color for Menu Hover BG.','iva_theme_admin'),
											'id'    => $shortname.'_topmenu_hoverbg',
											'std'   => '', 
											'type'  => 'color');			
										
						$iva_of_options[] = array(	'name'	=> __('Menu Hover Text','iva_theme_admin'),
											'desc'	=> __('Select the Color for Menu Hover Text.','iva_theme_admin'),
											'id'	=> $shortname.'_topmenu_linkhover',
											'std'	=> '', 
											'type'	=> 'color');

						$iva_of_options[] = array(	'name'	=> __('Menu Dropdown Background Color','iva_theme_admin'),
											'desc'	=> __('Select the Color for Dropdown Menu Background Color','iva_theme_admin'),
											'id'	=> $shortname.'_topmenu_sub_bg',
											'std'	=> '', 
											'type'	=> 'color');

						$iva_of_options[] = array(	'name'	=> __('Menu Dropdown Text Color','iva_theme_admin'),
											'desc'	=> __('Select the Color for Dropdown Menu Text Color','iva_theme_admin'),
											'id'	=> $shortname.'_topmenu_sub_link',
											'std'	=> '', 
											'type'	=> 'color');
			
						$iva_of_options[] = array(	'name'	=> __('Menu Dropdown Text Hover Color','iva_theme_admin'),
											'desc'	=> __('Select the Color for Dropdown Menu Text Hover Color','iva_theme_admin'),
											'id'	=> $shortname.'_topmenu_sub_linkhover',
											'std'	=> '', 
											'type'	=> 'color');

						$iva_of_options[] = array(	'name'	=> __('Menu Dropdown Hover Background Color','iva_theme_admin'),
											'desc'	=> __('Select the Color for Dropdown Menu Hover Background Color','iva_theme_admin'),
											'id'	=> $shortname.'_topmenu_sub_hoverbg',
											'std'	=> '', 
											'type'	=> 'color');

						$iva_of_options[] = array(	'name'	=> __('Menu Active Link Color','iva_theme_admin'),
											'desc'	=> __('Select the Color for Active Link Color','iva_theme_admin'),
											'id'	=> $shortname.'_topmenu_active_link',
											'std'	=> '', 
											'type'	=> 'color');

						$iva_of_options[] = array(	'name'	=> __('Menu Dropdown Border Color','iva_theme_admin'),
											'desc'	=> __('Select the Color for Menu Dropdown Border Color','iva_theme_admin'),
											'id'	=> $shortname.'_menu_dropdown_border_color',
											'std'	=> '', 
											'type'	=> 'color');

						//---------------------------------------------------------------------------------------------------
						$iva_of_options[] = array( 'name' => __('Link Colors','iva_theme_admin'), 'type' => 'subnav');
						//---------------------------------------------------------------------------------------------------

						$iva_of_options[] = array(	'name'	=> __('Link Color','iva_theme_admin'),
											'desc'	=> __('Select the Color for Theme links','iva_theme_admin'),
											'id'	=> $shortname.'_link',
											'std'	=> '', 
											'type'	=> 'color');
				
						$iva_of_options[] = array(	'name'	=> __('Link Hover Color','iva_theme_admin'),
											'desc'	=> __('Select the Color for Theme links hover','iva_theme_admin'),
											'id'	=> $shortname.'_linkhover',
											'std'	=> '', 
											'type'	=> 'color');
				
						$iva_of_options[] = array(	'name'	=> __('Subheader Link Color','iva_theme_admin'),
											'desc'	=> __('Links under subheader section','iva_theme_admin'),
											'id'	=> $shortname.'_subheaderlink',
											'std'	=> '', 
											'type'	=> 'color');

						$iva_of_options[] = array(	'name'	=> __('Subheader Link Hover Color','iva_theme_admin'),
											'desc'	=> __('Links Hover under subheader section','iva_theme_admin'),
											'id'	=> $shortname.'_subheaderlinkhover',
											'std'	=> '', 
											'type'	=> 'color');

						$iva_of_options[] = array(	'name'	=> __('Footer Link Color','iva_theme_admin'),
											'desc'	=> __('Footer containing links under widget or text widget, (link color).','iva_theme_admin'),
											'id'	=> $shortname.'_footerlinkcolor',
											'std'	=> '', 
											'type'	=> 'color');
				
						$iva_of_options[] = array(	'name'	=> __('Footer Link Hover Color','iva_theme_admin'),
											'desc'	=> __('Footer content containing any links under widget or text widget, (link hover color).','iva_theme_admin'),
											'id'	=> $shortname.'_footerlinkhovercolor',
											'std'	=> '', 
											'type'	=> 'color');

						$iva_of_options[] = array(	'name'	=> __('Copyright Link Color','iva_theme_admin'),
											'desc'	=> __('Copyright content containing any links color. (link color).','iva_theme_admin'),
											'id'	=> $shortname.'_copylinkcolor',
											'std'	=> '', 
											'type'	=> 'color');

						//---------------------------------------------------------------------------------------------------
						$iva_of_options[] = array( 'name'	=> __('Typography','iva_theme_admin'), 'type' => 'subnav');
						//---------------------------------------------------------------------------------------------------
						//---------------------------------------------------------------------------------------------------
						$iva_of_options[] = array( 'name'	=> __('Google Font','iva_theme_admin'), 'desc' => __('<br>Select the fonts you wish to use for the website fonts or google webfonts. If you select the headings font it will replace all the heading font family for the whole theme including footer and sidebar widget titles.','iva_theme_admin'), 'type' => 'subsection');
						//---------------------------------------------------------------------------------------------------
						
						$iva_of_options[] = array( 
												'name' 		=> __('Body Font Family','iva_theme_admin'),
												'desc' 		=> __('Select a font family for body content','iva_theme_admin'),
												'id' 		=>  $shortname.'bodyfont',
												'class'		=> '',
												'preview' 	=>  array(
																	'text' => 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s',
																	'size' => '13px'
																),
												'options' 	=> $iva_fontface,
												'type' 		=> 'atpfontfamily'
											);

						$iva_of_options[] = array( 
												'name' 		=> __('Headings Font Family','iva_theme_admin'),
												'desc' 		=> __('Select a font family for Headings ( h1, h2, h3, h4, h5, h6 )','iva_theme_admin'),
												'id' 		=> $shortname.'_headings',
												'class'		=> '',
												'preview' 	=>	array(
																	'text' => 'This is font preview text!',
																	'size' => '25px'
																),
												'options' 	=> $iva_fontface,
												'type' 		=> 'atpfontfamily'
											);
											
						$iva_of_options[] = array( 
												'name' 		=> __('Menu Font Family','iva_theme_admin'),
												'desc' 		=> __('Select a font family for Top Navigation Menu','iva_theme_admin'),
												'id' 		=>  $shortname.'_mainmenufont',
												'class'		=> '',
												'preview' 	=>  array(
																	'text' => 'This is font preview text!',
																	'size' => '25px'
																),
												'options'	=> $iva_fontface,
												'type' 		=> 'atpfontfamily'
											);

						$iva_of_options[] = array( 
												'name' 		=> __('CountDown Font Family','iva_theme_admin'),
												'desc' 		=> __('Select a font for the CountDown Shortcode','iva_theme_admin'),
												'id' 		=>  $shortname.'_countdown_font',
												'class'		=> '',
												'preview' 	=>  array(
																	'text' => '0123456789 - DAYS - MONTHS - MIN - SECS',
																	'size' => '25px'
																),
												'options'	=> $iva_fontface,
												'type' 		=> 'atpfontfamily'
											);

						//---------------------------------------------------------------------------------------------------
						$iva_of_options[] = array( 'name'	=> __('Various Font Properties','iva_theme_admin'), 'desc' => __('<br>Select the front properties like font size, line-height, font-style and font-weight for various elements used in the theme.','iva_theme_admin'), 'type' => 'subsection');
						//---------------------------------------------------------------------------------------------------										

						$iva_of_options[] = array(	'name'	=> __('Body','iva_theme_admin'),
											'desc'	=> __('Select the Color and Font Properties for Body Font.','iva_theme_admin'),
											'id'	=> $shortname.'_bodyp',
											'std'	=> array(
															'color'		=> '',
															'size'		=> '',	
															'lineheight'=> '',
															'style'		=> '',
															'fontvariant' => ''),
											'type'	=> 'typography');


						$iva_of_options[] = array(	'name'	=> __('H1','iva_theme_admin'),
											'desc'	=> __('Select the Color and Font Properties for H1 Heading.','iva_theme_admin'),
											'id'	=> $shortname.'_h1',
											'std'	=> array(
															'color'		=> '',
															'size' 		=> '',
															'lineheight'=> '',
															'style' 	=> '',
															'fontvariant' => ''),
											'type'	=> 'typography');

						$iva_of_options[] = array(	'name'	=> __('H2','iva_theme_admin'),
											'desc'	=> __('Select the Color and Font Properties for H2 Heading.','iva_theme_admin'),
											'id'	=> $shortname.'_h2',
											'std'	=> array(
															'color'		=> '',
															'size' 		=> '',
															'lineheight'=> '',
															'style'		=> '',
															'fontvariant' => ''),
											'type'	=> 'typography');

						$iva_of_options[] = array(	'name'	=> __('H3','iva_theme_admin'),
											'desc'	=> __('Select the Color and Font Properties for H3 Heading.','iva_theme_admin'),
											'id'	=> $shortname.'_h3',
											'std'	=> array(
															'color'		=> '',
															'size' 		=> '',
															'lineheight'=> '',
															'style' 	=> '',
															'fontvariant' => ''),
											'type'	=> 'typography');

						$iva_of_options[] = array(	'name'	=> __('H4','iva_theme_admin'),
											'desc'	=> __('Select the Color and Font Properties for H4 Heading.','iva_theme_admin'),
											'id'	=> $shortname.'_h4',
											'std'	=> array(
															'color'		=> '',
															'size' 		=> '',
															'lineheight'=> '',
															'style' 	=> '',
															'fontvariant' => ''),
											'type'	=> 'typography');

						$iva_of_options[] = array(	'name'	=> __('H5','iva_theme_admin'),
											'desc'	=> __('Select the Color and Font Properties for H5 Heading.','iva_theme_admin'),
											'id'	=> $shortname.'_h5',
											'std'	=> array(
															'color'		=> '',
															'size'		=> '',
															'lineheight'=> '',
															'style'		=> '',
															'fontvariant' => ''),
											'type'	=> 'typography');

						$iva_of_options[] = array(	'name'	=> __('H6','iva_theme_admin'),
											'desc'	=> __('Select the Color and Font Properties for H6 Heading.','iva_theme_admin'),
											'id'	=> $shortname.'_h6',
											'std'	=> array(
															'color'		=> '',
															'size'		=> '',
															'lineheight'=> '',
															'style'		=> '',
															'fontvariant' => ''),
											'type'	=> 'typography');

						$iva_of_options[] = array(	'name'	=> __('Sidebar Widget Titles','iva_theme_admin'),
											'desc'	=> __('Select the Color and Font Properties for sidebar Widget Titles.','iva_theme_admin'),
											'id'	=> $shortname.'_sidebartitle',
											'std'	=> array(
															'color'		=> '',
															'size'		=> '',
															'lineheight'=> '',
															'style'		=> '',
															'fontvariant' => ''),
											'type'	=> 'typography');

						$iva_of_options[] = array(	'name'	=> __('Footer Widget Titles','iva_theme_admin'),
											'desc'	=> __('Select the Color and Font Properties for Footer Widget Titles.','iva_theme_admin'),
											'id'	=> $shortname.'_footertitle',
											'std'	=> array(
															'color'		=> '',
															'size'		=> '',
															'lineheight'=> '',
															'style'		=> '',
															'fontvariant' => ''),
											'type'	=> 'typography');

		
						$iva_of_options[] = array(	'name'	=> __('Footer Text','iva_theme_admin'),
											'desc'	=> __('Select the Color &amp; Font Properties for Footer Section','iva_theme_admin'),
											'id'	=> $shortname.'_footertext',
											'std'	=> array(
															'color'		=> '',
															'size'		=> '',
															'lineheight'=> '',
															'style'		=> '',
															'fontvariant' => ''),
											'type'	=> 'typography');

						$iva_of_options[] = array(	'name'	=> __('Copyright Text','iva_theme_admin'),
											'desc'	=> __('Select the Color &amp; Font Properties for Copyright Section.','iva_theme_admin'),
											'id'	=> $shortname.'_copyrights',
											'std'	=> array(
															'color'		=> '',
															'size'		=> '',
															'lineheight'=> '',
															'style'		=> '',
															'fontvariant' => ''),
											'type'	=> 'typography');
						//---------------------------------------------------------------------------------------------------
						$iva_of_options[] = array( 'name' => __('Custom Font','iva_theme_admin'), 'type' => 'subnav');
						//---------------------------------------------------------------------------------------------------

						$iva_of_options[] = array(	'name'	=> __('Custom Font <strong>.woff</strong>','iva_theme_admin'),
											'desc'	=> __('Upload Custom Font .woff.','iva_theme_admin'),
											'id'	=> $shortname.'_fontwoff',
											'std'	=> '', 
											'type'	=> 'upload');

						$iva_of_options[] = array(	'name'	=> __('Custom Font <strong>.ttf</strong>','iva_theme_admin'),
											'desc'	=> __('Upload Custom Font .ttf','iva_theme_admin'),
											'id'	=> $shortname.'_fontttf',
											'std'	=> '', 
											'type'	=> 'upload');

						$iva_of_options[] = array(	'name'	=> __('Custom Font <strong>.svg</strong>','iva_theme_admin'),
											'desc'	=> __('Upload Custom Font .svg','iva_theme_admin'),
											'id'	=> $shortname.'_fontsvg',
											'std'	=> '', 
											'type'	=> 'upload');

						$iva_of_options[] = array(	'name'	=> __('Custom Font <strong>.eot</strong>','iva_theme_admin'),
											'desc'	=> __('Upload Custom Font .eot','iva_theme_admin'),
											'id'	=> $shortname.'_fonteot',
											'std'	=> '', 
											'type'	=> 'upload');

						$iva_of_options[] = array(	'name'	=> __('Font Name','iva_theme_admin'),
											'desc'	=> __('Enter Font Name Select the name as mentioned in fontface css in the downloaded readme file of your custom font','iva_theme_admin'),
											'id'	=> $shortname.'_fontname',
											'std'	=> '', 
											'inputsize' => '300',
											'type'	=> 'text');

						$iva_of_options[] = array(	'name'	=> __('Custom Fonts Headings and class Names','iva_theme_admin'),
											'desc'	=> __('Enter your own custom elements to which you want to assign this custom font. Ex: h1,h2,h3, .class1,.class2','iva_theme_admin'),
											'id'	=> $shortname.'_fontclass',
											'std'	=> '', 
											'inputsize' => '',
											'type'	=> 'textarea');


						//---------------------------------------------------------------------------------------------------
						$iva_of_options[] = array( 'name' => __('Custom CSS','iva_theme_admin'), 'type' => 'subnav');
						//---------------------------------------------------------------------------------------------------

						$iva_of_options[] = array( 'name'	=> __('Custom CSS','iva_theme_admin'),
											'desc'	=> __('Quickly add some CSS of your own choice to this theme by adding it in this block.','iva_theme_admin'),
											'id'	=> $shortname.'_extracss',
											'std'	=> '',
											'type'	=> 'textarea');
		
			// S L I D E R S
			//------------------------------------------------------------------------
			$iva_of_options[] = array( 'name'	=> __('Sliders','iva_theme_admin'),
								'icon'	=> ADMIN_URI.'/images/slider-icon.png',
								'type'	=> 'heading');

					$iva_of_options[]=	array(	'name'	=> __('Frontpage Slider','iva_theme_admin'),
										'desc'	=> __('Check this if you wish to disable the Slider','iva_theme_admin'),
										'id'	=> $shortname.'_slidervisble',
										'std'	=> '',
										'type'	=> 'checkbox');	

										

					$iva_of_options[] = array( 'name'	=> __('Select Slider Type','iva_theme_admin'),
										'desc'	=> __('Select which slider you want to use for the Frontpage of the theme.','iva_theme_admin'),
										'id'	=> $shortname.'_slider',
										'std'	=> 'flexslider',
										'class' => 'select300',
										'options' => $atp_theme->atp_variable('slider_type'),
										'type'	=> 'select');

					$iva_of_options[] = array( 'name'	=> __('Slider Category','iva_theme_admin'),
										'desc'	=> __('Select Slider Categories to hold the slides from.','iva_theme_admin'),
										'id'	=> $shortname.'_flexslidercat',
										'class' => 'atpsliders flexslider',
										'std'	=> 'flexslider',
										'options' => $atp_theme->atp_variable('slider'),
										'type'	=> 'multiselect');

					$iva_of_options[] = array( 'name'	=> __('Slides Limits','iva_theme_admin'),
										'desc'	=> __('Enter the limit for Slides you want to hold on the Flex Slider','iva_theme_admin'),
										'id'	=> $shortname.'_flexslidelimit',
										'std'	=> '',
										'class' => 'atpsliders flexslider',
										'type'	=> 'text',
										'inputsize' => '');

					$iva_of_options[] = array( 'name'	=> __('Slides Speed','iva_theme_admin'),
										'desc'	=> __('Select the slide speed you want to set','iva_theme_admin'),
										'id'	=> $shortname.'_flexslidespeed',
										'std'	=> '500',
										'class' => 'atpsliders flexslider',
										'type'	=> 'text',
										'inputsize' => ''
										);

					$iva_of_options[] = array( 'name'	=> __('Slider Effect','iva_theme_admin'),
										'desc'	=> __('Select your animation type, "fade" or "slide"','iva_theme_admin'),
										'id'	=> $shortname.'_flexslideffect',
										'std'	=> 'flexslider',
										'class' => 'atpsliders flexslider select300',
										'options' => array( 
														'fade'	=> 'Fade',
														'slide'	=> 'Slide'
													),
										'type'	=> 'select');

					$iva_of_options[] = array( 'name'	=> __('Direction Nav','iva_theme_admin'),
										'desc'	=> __('Navigation for previous/next arrows','iva_theme_admin'),
										'id'	=> $shortname.'_flexslidednav',
										'class' => 'atpsliders flexslider select300',
										'std'	=> '',
										'options' => array( 
														'true'	=> 'True',
														'false'	=> 'False'
													),
										'type'	=> 'select');
										
					$iva_of_options[] = array( 'name'	=> __('Static Image','iva_theme_admin'),
										'desc'	=> __('Upload the image size 1920 x 750 pixels to display on the homepage instead of slider.','iva_theme_admin'),
										'id'	=> $shortname.'_static_image_upload',
										'std'	=> '',
										'class' => 'atpsliders static_image',
										'type'	=> 'upload');

					$iva_of_options[] = array( 'name'	=> __('Custom Slider','iva_theme_admin'),
										'desc'	=> __('Use in Your custom slider Plugin shortcodes Example : [revslider id="1"]','iva_theme_admin'),
										'id'	=> $shortname.'_customslider',
										'std'	=> '',
										'class' => 'atpsliders customslider',
										'type'	=> 'textarea',
										'inputsize' => '');
										
			// P O S T   O P T I O N S 
			//------------------------------------------------------------------------
			$iva_of_options[] = array( 'name'	=> __('Post Options','iva_theme_admin'),
								'icon'	=> ADMIN_URI.'/images/post-icon.png',
								'type'	=> 'heading');

					$iva_of_options[] = array( 'name'	=> __('Blog Page Categories','iva_theme_admin'),
										'desc'	=> __('Selected categories will hold the posts to display in blog page template. ( template : template_blog.php)','iva_theme_admin'),
										'id'	=> $shortname.'_blogacats',
										'std'	=> '',
										'type'	=> 'multicheck',
										'options'	=> $atp_theme->atp_variable('categories'));

					$iva_of_options[] = array(	'name'	=> __('About Author','iva_theme_admin'),
										'desc'	=> __('Check this if you wish to disable the Author Info in post single page','iva_theme_admin'),
										'id'	=> $shortname.'_aboutauthor',
										'std'	=> '',
										'type'	=> 'checkbox');	

					$iva_of_options[] = array(	'name'	=> __('Related Posts','iva_theme_admin'),
										'desc'	=> __('Check this if you wish to disable the related posts in post single page (based on tags).','iva_theme_admin'),
										'id'	=> $shortname.'_relatedposts',
										'std'	=> '',
										'type'	=> 'checkbox');	

					$iva_of_options[] = array(	'name'	=> __('Comments','iva_theme_admin'),
										'desc'	=> __('Select where you wish to display comments on posts or pages.','iva_theme_admin'),
										'id'	=> $shortname.'_commentstemplate',
										'std'	=> 'fullpage',
										'class'	=> 'select300',
										'options'	=> array(
														'posts'	=> 'Posts Only',
														'pages'	=> 'Pages Only', 
														'both'	=> 'Pages/posts',
														'none'	=> 'None'),
										'type'	=> 'select');

					$iva_of_options[] = array(	'name'	=> __('Post Pagination','iva_theme_admin'),
										'desc'	=> __('Check this if you wish to disable <strong>Next / Previous</strong> Post Pagination','iva_theme_admin'),
										'id'	=> $shortname.'_singlenavigation',
										'std'	=> '',
										'type'	=> 'checkbox');

					$iva_of_options[] = array(	"name"	=> __("Single Page Featured Image",'iva_theme_admin'),
										"desc"	=> __('Check this if you wish to disable Featured Image on Post Single Page','iva_theme_admin'),
										"id"	=> $shortname."_blogfeaturedimg",
										"std"	=> "",
										"type"	=> "checkbox");
		
					$iva_of_options[] = array(	"name"	=> __("Blog Post Meta",'iva_theme_admin'),
										"desc"	=> __('Check this if you wish to disable Meta Data in Blog Posts and Single Page','iva_theme_admin'),
										"id"	=> $shortname."_postmeta",
										"std"	=> "",
										"type"	=> "checkbox");

															
			// C U S T O M   S I D E B A R 
			//------------------------------------------------------------------------
			$iva_of_options[] = array( 'name'	=> __('Sidebars','iva_theme_admin'),
								'icon'	=> ADMIN_URI.'/images/sidebar-icon.png',
								'type'	=> 'heading');

					$iva_of_options[] = array( 'name'	=> __('Custom Sidebars','iva_theme_admin'),
										'desc'	=> __('Create the custom sidebars and go to <strong>Appearance > Widgets</strong> to see the newly sidebar you have created. After assigning the widgets in the prefered sidebar you can assign specific sidebar to specific pages/posts in Options below the wordpress content editor of each page/post.','iva_theme_admin'),
										'id'	=> $shortname.'_customsidebar',
										'std'	=> '',
										'type'	=> 'customsidebar');
										
					$iva_of_options[] = array( 'name' 	=> __('Sidebars Layout','iva_theme_admin'),
										'desc' 			=> __('Select the Layout style you wish to use for the page, 
															Left Sidebar, Right Sidebar or Full Width.','iva_theme_admin'),
										'id' 			=> $shortname.'_defaultlayout',
										'std' 			=> 'rightsidebar',
										'type'  		=> 'images',
										'options' 		=> array(
											   'rightsidebar'	=>  FRAMEWORK_URI . 'admin/images/columns/rightsidebar.png', 
											   'leftsidebar' 	=>  FRAMEWORK_URI . 'admin/images/columns/leftsidebar.png',
											   'fullwidth'  	=>  FRAMEWORK_URI . 'admin/images/columns/fullwidth.png')
										);							

			// F O O T E R 
			//------------------------------------------------------------------------
			$iva_of_options[] = array( 'name'	=> __('Footer','iva_theme_admin'),
								'icon'	=> ADMIN_URI.'/images/footer-icon.png',
								'type'	=> 'heading');										

					$iva_of_options[] = array(	'name'	=> __('Footer Sidebar',	'iva_theme_admin'),
										'desc'	=> __('Check this if you wish to disable the Footer Sidebar','iva_theme_admin'),
										'id'	=> $shortname.'_footer_sidebar',
										'std'	=> '',
										'type'	=> 'checkbox');
				
					$iva_of_options[] = array( 'name' => __('Footer Columns','iva_theme_admin'),
										'desc' => __('Select the Columns Layout Style from the styles shown to display footer sidebar area. After selecting save the options and go to your <strong>Appearance > Widgets</strong> to assign the widgets in each footer column.','iva_theme_admin'),
										'id'   => $shortname.'_footerwidgetcount',
										'std'  => '4',
										'type' => 'images',
										'options' => array(
														'1' => ADMIN_URI.'/images/columns/1col.png',
														'2' => ADMIN_URI.'/images/columns/2col.png',
														'3' => ADMIN_URI.'/images/columns/3col.png',
														'4' => ADMIN_URI.'/images/columns/4col.png',
														'5' => ADMIN_URI.'/images/columns/5col.png',
														'6' => ADMIN_URI.'/images/columns/6col.png',
														'half_one_half'		=> ADMIN_URI.'/images/columns/half_one_half.png',
														'half_one_third'	=> ADMIN_URI.'/images/columns/half_one_third.png',
														'one_half_half'		=> ADMIN_URI.'/images/columns/one_half_half.png',
														'one_third_half'	=> ADMIN_URI.'/images/columns/one_third_half.png')
											);
			
			
			// S O C I A B L E S
			//------------------------------------------------------------------------
				$iva_of_options[] = array( 'name'	=> __('Sociables','iva_theme_admin'),
								'icon'	=> ADMIN_URI.'/images/link-icon.png',
								'type'	=> 'heading');

				$iva_of_options[] = array(	'name'	=> __('Sociables','iva_theme_admin'),	
										'desc'	=> __('Click Add New to add sociables where you can edit/add/delete.<br> If you want to have a different icon please you icon png or gif file in sociables directory located in theme images directory','iva_theme_admin'),
										'id'	=> $shortname.'_social_bookmark',
										'std'	=> '',
										'type'	=> 'custom_socialbook_mark');
			//Sticky Bar
			// -----------------------------------------------------------------------
			
				$iva_of_options[] = array( 'name'	=> __('Sticky Bar','iva_theme_admin'),
								'icon'	=> ADMIN_URI.'/images/sticky-icon.png',
								'type'	=> 'heading');
			
				$iva_of_options[] = array( 'name'	=> __('Sticky Notice Bar','iva_theme_admin'),
									'desc'	=> __('Check this if you wish to hide the sticky bar on top.','iva_theme_admin'),
									'id'	=> $shortname.'_stickybar',
									'std'	=> '',
									'type'	=> 'checkbox');
	
				$iva_of_options[] = array( 'name'	=> __('Sticky Bar Background Color','iva_theme_admin'),
									'desc'	=> __('Select the color you want to assign for the Sticky Bar','iva_theme_admin'),
									'id'	=> $shortname.'_stickybarcolor',
									'std'	=> '',
									'type'	=> 'color');
			
				$iva_of_options[] = array( 'name'	=> __('Sticky Bar Text Color','iva_theme_admin'),
									'desc'	=> __('Select the text color you want to assign for the Sticky Bar','iva_theme_admin'),
									'id'	=> $shortname.'_stickybartext',
									'std'	=> '',
									'type'	=> 'color');
											
		

		//Sharelink Options
		//--------------------------------------------------------------------------------------------------
		$iva_of_options[] = array( 'name' => __('Sharelinks','iva_theme_admin'),'icon' => ADMIN_URI.'/images/link-icon.png', 'type' => 'heading' );
		//--------------------------------------------------------------------------------------------------
		$iva_of_options[] = array(
								'name'	=> __('Google+','iva_theme_admin'),
								'desc'	=> __('Check this to enable Google+ Icon for Post Sharing','iva_theme_admin'),
								'id'	=> $shortname.'_google_enable',
								'std'	=> '',
								'type'	=> 'checkbox',
							);
		$iva_of_options[] = array(
								'name'	=> __('Facebook','iva_theme_admin'),
								'desc'	=> __('Check this to enable Facebook Icon for Post Sharing','iva_theme_admin'),
								'id'	=> $shortname.'_facebook_enable',
								'std'	=> '',
								'type'	=> 'checkbox',
							);
							
		$iva_of_options[] = array(
								'name'	=> __('LinkedIn','iva_theme_admin'),
								'desc'	=> __('Check this to enable LinkedIn Icon for Post Sharing','iva_theme_admin'),
								'id'	=> $shortname.'_linkedIn_enable',
								'std'	=> '',
								'type'	=> 'checkbox',
							);
							
		$iva_of_options[] = array(
								'name'	=> __('Digg','iva_theme_admin'),
								'desc'	=> __('Check this to enable Digg Icon for Post Sharing','iva_theme_admin'),
								'id'	=> $shortname.'_digg_enable',
								'std'	=> '',
								'type'	=> 'checkbox',
							);
							
		$iva_of_options[] = array(
								'name'	=> __('StumbleUpon','iva_theme_admin'),
								'desc'	=> __('Check this to enable StumbleUpon Icon for Post Sharing','iva_theme_admin'),
								'id'	=> $shortname.'_stumbleupon_enable',
								'std'	=> '',
								'type'	=> 'checkbox',
							);
							
		$iva_of_options[] = array(
								'name'	=> __('Pinterest','iva_theme_admin'),
								'desc'	=> __('Check this to enable Pinterest Icon for Post Sharing','iva_theme_admin'),
								'id'	=> $shortname.'_pinterest_enable',
								'class'	=> 'pinterest_sharing',
								'std'	=> '',
								'type'	=> 'checkbox',
							);
							
		$iva_of_options[] = array(
								'name'	=> __('Twitter','iva_theme_admin'),
								'desc'	=> __('Check this to enable Twitter Icon for Post Sharing','iva_theme_admin'),
								'id'	=> $shortname.'_twitter_enable',
								'std'	=> '',
								'type'	=> 'checkbox',
							);
		
		$iva_of_options[] = array(
								'name'	=> __('Tumblr','iva_theme_admin'),
								'desc'	=> __('Check this to enable Tumblr Icon for Post Sharing','iva_theme_admin'),
								'id'	=> $shortname.'_tumblr_enable',
								'std'	=> '',
								'type'	=> 'checkbox',
							);
		$iva_of_options[] = array(
								'name'	=> __('Email','iva_theme_admin'),
								'desc'	=> __('Check this to enable Email Icon for Post Sharing','iva_theme_admin'),
								'id'	=> $shortname.'_email_enable',
								'std'	=> '',
								'type'	=> 'checkbox',
							);

		$iva_of_options[] = array(
								'name'	=> __('Reddit','iva_theme_admin'),
								'desc'	=> __('Check this to enable reddit Icon for Post Sharing','iva_theme_admin'),
								'id'	=> $shortname.'_reddit_enable',
								'std'	=> '',
								'type'	=> 'checkbox',
							);
		

		// M E G A M E N U  S E T T I N G S
		//-----------------------------------------------------------------------------------------------

		$iva_of_options[] = array( 'name'	=> __('Megamenu Settings','iva_theme_admin'),'icon'=> ADMIN_URI.'/images/lang-icon.png','type'	=> 'heading');

		$iva_of_options[] = array( 'name'	=> __('Megamenu Settings','iva_theme_admin'), 'desc' => __('Mega Menu Settings.','iva_theme_admin'), 'type' => 'subsection');

		$iva_of_options[] = array(  'name'	=> __('Enable Megamenu','iva_theme_admin'),
									'desc'	=> __('Check this if you wish to enable megamenu and below are some more options for megamenu so do accordingly','iva_theme_admin'),
									'id'	=> $shortname.'_mm_visible',
									'std'	=> 'false',
									'type'	=> 'checkbox'
							);	
							
		$iva_of_options[] = array(	'name'	=> __('Number of Columns Per Row','iva_theme_admin'),
									'desc'	=> __('Select number of columns per row to be used for the megamenu default set to be 4 columns','iva_theme_admin'),
									'id'	=> $shortname.'_mm_rowItems',
									'std'	=> '4',
									'class'	=> 'select300',
									'options'=> array(
													'1'	=> '1',
													'2'	=> '2', 
													'3'	=> '3',
													'4'	=> '4',
													'5'	=> '5',
												),
									'type'	=> 'select'
							);
		
		$iva_of_options[] = array(	'name'	=> __('Mouse Event','iva_theme_admin'),
									'desc'	=> __('Select onclick or on hover event for the megamenu default:hover','iva_theme_admin'),
									'id'	=> $shortname.'_mm_event',
									'std'	=> 'hover',
									'class'	=> 'select300',
									'options'=>  array(
														'hover'	=> 'Hover',
														'click'	=> 'Click', 
													),
									'type'	=> 'radio'
							);
							
		$iva_of_options[] = array(	'name'	=> __('Animation Effect','iva_theme_admin'),
									'desc'	=> __('Select the animation for the megamenu dropdown default:fade','iva_theme_admin'),
									'id'	=> $shortname.'_mm_effect',
									'std'	=> 'fade',
									'class'	=> 'select300',
									'options'=> array(
													'fade'	=> 'Fade',
													'slide'	=> 'Slide Down', 
													),
									'type'	=> 'select'
							);
							
		$iva_of_options[] = array(	'name'	=> __('Animation Speed','iva_theme_admin'),
									'desc'	=> __('Select the speed of animation default:normal','iva_theme_admin'),
									'id'	=> $shortname.'_mm_speed',
									'std'	=> 'normal',
									'class'	=> 'select300',
									'options'	=>  array(
														'0'		=> 'No Animation',
														'fast'	=> 'Fast',
														'normal'=> 'Normal', 
														'slow'	=> 'Slow',
													),
									'type'	=> 'select'
							);

		$iva_of_options[] = array(  'name'	=> __('Set Sub Menu To Full Width','iva_theme_admin'),
									'desc'	=> __('Check this if you wish to select the dropdown as stretched to the header inner area','iva_theme_admin'),
									'id'	=> $shortname.'_mm_fullwidth',
									'std'	=> 'false',
									'type'	=> 'checkbox'
							);
							
		$iva_of_options[] = array( 'name' => __('Megamenu background properties','iva_theme_admin'),
								   'desc' => __('Below are the parent menu items where if you wish to use the background image for the dropdown corners as shown in the image below and in documentation.
								   	Make sure you use the smaller image should not exceed the size 300kb', 'iva_theme_admin'),
								   'type' => 'subsection');


		$iva_menu_id = get_nav_menu_locations();
				
		if( isset( $iva_menu_id['primary-menu'] ) ) {
	
			$iva_menu_items = wp_get_nav_menu_items( $iva_menu_id['primary-menu'] );
							
			if( isset( $iva_menu_items ) && !empty($iva_menu_items) ){
				foreach ( $iva_menu_items as $iva_item ) {
				
					$iva_itemid 	= $iva_item->ID;
					$iva_itemparent = $iva_item->menu_item_parent;
				
					if ( $iva_item->menu_item_parent === '0' ) {
					
						$iva_of_options[] = array(
							'name' 	=>  $iva_item->title .'-'. __('MM menu option ', 'iva_theme_admin'),
							'id' 	=> 'mm_menu_bg_' . $iva_item->object_id,
							'desc' 	=> '',
							'class' => "mpcth_image_opt",
							'type' 	=> "mmenu_ancestor" 
						);
					}
				}
			}	
		}
		
	
			//Import and Export
			//---------------------------------------------------------------------------------------------------						
			$iva_of_options[] = array( 'name'=> __('Import/Export','iva_theme_admin'),'icon'	=> ADMIN_URI.'/images/cog-icon.png', 'type' => 'heading');
			//---------------------------------------------------------------------------------------------------
			
			$iva_of_options[] = array( 'name'=> __('Options Backup','iva_theme_admin'), 'desc' => __('Import,Export Backup options.','iva_theme_admin'), 'type' => 'subsection');

			
			$iva_of_options[] = array(  
								'name'	=> __('Export Backup Options','iva_theme_admin'),
								'desc'	=> __('Export Backup Options','iva_theme_admin'),
								'id'	=> $shortname.'_export_backup_options',
								'std' 	=> '',
								'class' => 'atp-backup-options',
								'type'	=> 'export_backupoptions'
							); 
							
			
			$iva_of_options[] = array(  
								'name'	=> __('Import Backup Options','iva_theme_admin'),
								'desc'	=> __('Import Backup Options','iva_theme_admin'),
								'id'	=> $shortname.'_import_backup_options',
								'std'	=> '',
								'class' => 'atp-backup-options',
								'type'	=> 'import_backupoptions'
							); 

			//-----------------------------------------------------------------------------------------------
			$iva_of_options = apply_filters('custompost_themeoptions',$iva_of_options);
			//-----------------------------------------------------------------------------------------------
	
			//-----------------------------------------------------------------------------------------------
			$iva_of_options = apply_filters('customlocalization_themeoptions',$iva_of_options);
			//-----------------------------------------------------------------------------------------------


		return $iva_of_options;	
	}
}
?>