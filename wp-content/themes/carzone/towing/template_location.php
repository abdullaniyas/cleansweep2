<?php
/**
 * Template Name: Locations
 **/
get_header(); ?>

<div id="primary" class="pagemid">
  <div class="inner">   
    <main class="content-area" role="main">
      <div class="entry-content-wrapper clearfix">
		<?php 
			// Get the content from page template.
			if ( have_posts() ) : 
				while ( have_posts() ) : the_post(); 
					the_content();
				endwhile; 
			endif;
			?>
			<?php
			$iva_select_loc_txt  = get_option( 'iva_loc_select_location_txt' ) ? get_option( 'iva_loc_select_location_txt' ) : __( 'Select Location', 'iva_theme_front' );
			$iva_select_city_txt = get_option( 'iva_loc_select_city_txt' ) ? get_option( 'iva_loc_select_city_txt' ) : __( 'Select City', 'iva_theme_front' );
		
			//
			$iva_loc_dir_start_address = get_option('iva_loc_dir_start_address') ? get_option('iva_loc_dir_start_address') : '';
	        echo '<input type="hidden" id="iva_loc_dir_start_address" value="'.$iva_loc_dir_start_address.'" />'; 

			//
			$iva_protocol = is_ssl() ? 'https' : 'http';
			echo  '<input type="hidden" id="iva_protocol" value="'.$iva_protocol.'" />'; 

			$categories = get_categories( 'taxonomy=cities' );
			echo '<div class="iva-loc-wrapper" >';

			echo '<div class="iva_loc_cities">';
			echo '<h4>'.$iva_select_loc_txt.'</h4>';

			echo '<div class="select-style">';
			echo '<select name="iva_cities" id="iva_cities" class="postform">';
			echo '<option value="">'.$iva_select_city_txt.'</option>';
			foreach ( $categories as $category ) {
				if ( $category->count > 0 ) {
			      echo '<option value="'.$category->slug.'" >'.$category->name.'</option>';
				}
			}	
			echo '</select>';
			echo '</div>';
			
			echo '</div>';//.iva_loc_cities
			
			
			echo '<div class="one_third nomargin">';
			echo '<div class="iva_loc_display" style="display:none;"></div>'; 
			echo '</div>';//.one_third
			
			echo '<div class="two_third nomargin">';
			echo '<div id="iva_map_canvas" style="height:500px; "></div>';
			echo '</div>';//.two_third
			
			echo '</div>';//.iva-loc-wrapper
			?> 

			</div><!-- .content-area -->
      </main><!-- main -->    
      <?php if ( atp_generator( 'sidebaroption', $post->ID) != "fullwidth" ){ get_sidebar(); } ?>
	</div><!-- inner -->  
    </div>
<?php get_footer(); ?>