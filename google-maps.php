<?php
/*
Plugin Name: SIS Google Map
Plugin URI: http://wordpress.org/plugins/sis-google-map
Description: Add google map into your website.
Version: 1.0
Author: sayful
Author URI: http://sayful.net
License: GPLv2 or later
*/

// Set up our WordPress Plugin
function sis_gmaps_check_WP_ver()
{
	$options_array = array(
      	'mapwidth' => '100%',
      	'mapheight' => '200px',
      	'latitude' => '0',
        'longitude' => '0',
        'zoom' => '0',
      	'zoomcontrol' => 'true',
      	'zoomcontroloptions' => 'DEFAULT',
        'maptypecontrol' => 'true',
        'maptypecontrolstyle' => 'DEFAULT',
      	'maptypecontrolposition' => 'TOP_RIGHT',
      	'maptypeid' => 'ROADMAP',
        'infowindow' => '',
    );
	if ( get_option( 'sis_gmaps_settings' ) !== false ) {
		// The option already exists, so we just update it.
      	update_option( 'sis_gmaps_settings', $options_array );
   } else{
   		// The option hasn't been added yet. We'll add it with $autoload set to 'no'.
   		add_option( 'sis_gmaps_settings', $options_array );
   }
}
register_activation_hook( __FILE__, 'sis_gmaps_check_WP_ver' );


//register settings
function sis_gmaps_settings_init(){
    register_setting( 'sis_gmaps_settings', 'sis_gmaps_settings' );
}
add_action( 'admin_init', 'sis_gmaps_settings_init' );

//add settings page to menu
function sis_gmaps_add_settings_page() {
add_menu_page( __( 'Google Map Settings' ), __( 'Google Map' ), 'manage_options', 'sis_gmap_settings', 'sis_gmaps_settings_page','dashicons-location-alt');
}
add_action( 'admin_menu', 'sis_gmaps_add_settings_page' );


//start settings page
function sis_gmaps_settings_page() {

	?>
	<div class="wrap">
	    <h2><?php _e('Google Map Settings') ?></h2>

		<form method="post" action="options.php">

			<?php settings_fields( 'sis_gmaps_settings' ); ?>
			<?php $options = get_option( 'sis_gmaps_settings' ); ?>

			<table class="form-table">
				<!-- Option 1: Test Width -->
				<tr valign="top">
                    <th scope="row">
                        <label><?php _e('Map Width') ?></label>
                    </th>
                    <td>
                        <input type="text" name="sis_gmaps_settings[mapwidth]" id="mapwidth" value="<?php esc_attr_e($options['mapwidth']); ?>" class="">
                        <p class="description"><?php _e('Write map width in pixels. Example:300px') ?></p>
                    </td>
                </tr>
				<!-- Option 2: Test Height -->
				<tr valign="top">
                    <th scope="row">
                        <label><?php _e('Map Height') ?></label>
                    </th>
                    <td>
                        <input type="text" name="sis_gmaps_settings[mapheight]" id="mapheight" value="<?php esc_attr_e($options['mapheight']); ?>" class="">
                        <p class="description"><?php _e('Write map height in pixels. Example:300px') ?></p>
                    </td>
                </tr>
				<!-- Option 3: Text Latitude -->
				<tr valign="top">
                    <th scope="row">
                        <label><?php _e('Latitude') ?></label>
                    </th>
                    <td>
                        <input type="text" name="sis_gmaps_settings[latitude]" id="latitude" value="<?php esc_attr_e($options['latitude']); ?>" class="">
                        <p class="description"><?php _e('Do not know Latitude and Longitude? <a target="_blank" href="http://universimmedia.pagesperso-orange.fr/geo/loc.htm">Get it from here.</a>') ?></p>
                    </td>
                </tr>
				<!-- Option 4: Text Longitude -->
				<tr valign="top">
                    <th scope="row">
                        <label><?php _e('Longitude') ?></label>
                    </th>
                    <td>
                        <input type="text" name="sis_gmaps_settings[longitude]" id="longitude" value="<?php esc_attr_e($options['longitude']); ?>" class="">
                        <p class="description"><?php _e('Do not know Latitude and Longitude? <a target="_blank" href="http://universimmedia.pagesperso-orange.fr/geo/loc.htm">Get it from here.</a>') ?></p>
                    </td>
                </tr>
				<!-- Option 5: Text Zoom -->
				<tr valign="top">
                    <th scope="row">
                        <label><?php _e('Zoom') ?></label>
                    </th>
                    <td>
                        <input type="text" name="sis_gmaps_settings[zoom]" id="zoom" value="<?php esc_attr_e($options['zoom']); ?>" class="">
                        <p class="description"><?php _e('Control Map Zoom lavel from 0 to 20.') ?></p>
                    </td>
                </tr>
				<!-- Option 6: Radio Zoom Control -->
				<tr valign="top">
                    <th scope="row">
                        <label><?php _e('Show zoom control bar?') ?></label>
                    </th>
                    <td>
                        <input type="radio" name="sis_gmaps_settings[collapsible]" value="true" <?php checked( $options['collapsible'], 'true' ); ?> />Yes
                        <input type="radio" name="sis_gmaps_settings[collapsible]" value="false" <?php checked( $options['collapsible'], 'false' ); ?> />No
                        <p class="description"><?php _e('If you want user can control zoom, check Yes or No if you do not want user can control zoom.') ?></p>
                    </td>
                </tr>
				<!-- Option 7: Select Zoom Control Style -->
				<tr valign="top">
                    <th scope="row">
                        <label><?php _e('Select zoom control bar style') ?></label>
                    </th>
                    <td>
                        <select name="sis_gmaps_settings[zoomcontroloptions]">
                            <option value="DEFAULT" <?php selected( $options['zoomcontroloptions'], 'DEFAULT' ); ?>>DEFAULT</option>
                            <option value="LARGE" <?php selected( $options['zoomcontroloptions'], 'LARGE' ); ?>>LARGE</option>
                            <option value="SMALL" <?php selected( $options['zoomcontroloptions'], 'SMALL' ); ?>>SMALL</option>
                        </select>
                        <p class="description"><?php _e('Select Zoom Control Bar Style. You also require to select Show zoom control bar as yes.') ?></p>
                    </td>
                </tr>
				<!-- Option 8: Map Type Control -->
				<tr valign="top">
                    <th scope="row">
                        <label><?php _e('Map Type Control') ?></label>
                    </th>
                    <td>
                        <input type="radio" name="sis_gmaps_settings[maptypecontrol]" value="true" <?php checked( $options['maptypecontrol'], 'true' ); ?> />Yes
                        <input type="radio" name="sis_gmaps_settings[maptypecontrol]" value="false" <?php checked( $options['maptypecontrol'], 'false' ); ?> />No
                        <p class="description"><?php _e('If you want user can control map type, check Yes or No if you do not want user can control map type.') ?></p>
                    </td>
                </tr>
				<!-- Option 9: Select Map Type Control Style -->
				<tr valign="top">
                    <th scope="row">
                        <label><?php _e('Select Map Type Control bar style') ?></label>
                    </th>
                    <td>
                        <select name="sis_gmaps_settings[maptypecontrolstyle]">
                            <option value="DEFAULT" <?php selected( $options['maptypecontrolstyle'], 'DEFAULT' ); ?>>DEFAULT</option>
                            <option value="DROPDOWN_MENU" <?php selected( $options['maptypecontrolstyle'], 'DROPDOWN_MENU' ); ?>>DROPDOWN MENU</option>
                            <option value="HORIZONTAL_BAR" <?php selected( $options['maptypecontrolstyle'], 'HORIZONTAL_BAR' ); ?>>HORIZONTAL BAR</option>
                        </select>
                        <p class="description"><?php _e('Select Zoom Control Bar Style. You also require to select Show zoom control bar as yes.') ?></p>
                    </td>
                </tr>
				<!-- Option 10: Select Map Type Control Position -->
				<tr valign="top">
                    <th scope="row">
                        <label><?php _e('Select Map Type Control Bar Position') ?></label>
                    </th>
                    <td>
                        <select name="sis_gmaps_settings[maptypecontrolposition]">
                            <option value="TOP_RIGHT" <?php selected( $options['maptypecontrolposition'], 'TOP_RIGHT' ); ?>>TOP RIGHT</option>
                            <option value="TOP_CENTER" <?php selected( $options['maptypecontrolposition'], 'TOP_CENTER' ); ?>>TOP CENTER</option>
                        </select>
                        <p class="description"><?php _e('Select Map Type Control Bar Position') ?></p>
                    </td>
                </tr>
				<!-- Option 11: Select Map Type Id -->
				<tr valign="top">
                    <th scope="row">
                        <label><?php _e('Select Map Type ID') ?></label>
                    </th>
                    <td>
                        <select name="sis_gmaps_settings[maptypeid]">
                            <option value="ROADMAP" <?php selected( $options['maptypeid'], 'ROADMAP' ); ?>>ROADMAP</option>
                            <option value="SATELLITE" <?php selected( $options['maptypeid'], 'SATELLITE' ); ?>>SATELLITE</option>
                            <option value="HYBRID" <?php selected( $options['maptypeid'], 'HYBRID' ); ?>>HYBRID</option>
                            <option value="TERRAIN" <?php selected( $options['maptypeid'], 'TERRAIN' ); ?>>TERRAIN</option>
                        </select>
                        <p class="description"><?php _e('Select Select Map Type ID.') ?></p>
                    </td>
                </tr>
				<!-- Option 12: Textarea -->
				<tr valign="top">
                    <th scope="row">
                        <label><?php _e('Write Information About Place') ?></label>
                    </th>
                    <td>
                        <textarea name="sis_gmaps_settings[infowindow]" rows="5" cols="36"><?php esc_attr_e( $options['infowindow'] ); ?></textarea>
                        <p class="description"><?php _e('Write about your place. Do not press enter to break line. You can use any html tag.') ?></p>
                    </td>
                </tr>
			</table>
			<p class="submit"><input type="submit" value="<?php _e('Save Changes') ?>" class="button button-primary" id="submit" name="submit"></p>
		</form>

	</div><!-- END wrap -->

<?php
}


/* Adding Latest jQuery for Wordpress front page */
function sis_gmaps_plugin_scripts() {
	wp_enqueue_script('sis_gmaps_script','https://maps.googleapis.com/maps/api/js?v=3.exp&sensor=true&language=en');
}
add_action('init', 'sis_gmaps_plugin_scripts');


function sis_gmaps_custom_script(){
	$options = get_option( 'sis_gmaps_settings' );
	?><script type="text/javascript">
		var map;
		var myCenter=new google.maps.LatLng(<?php echo $options['latitude']; ?>,<?php echo $options['longitude']; ?>);
		var marker;
		function initialize() {
		  	var mapOptions = {
		    	zoom: <?php echo $options['zoom']; ?>,
		    	zoomControl:<?php echo $options['zoomcontrol']; ?>,
		    	zoomControlOptions: {
		      		style:google.maps.ZoomControlStyle.<?php echo $options['zoomcontroloptions']; ?>
		    	},
		    	mapTypeControl:<?php echo $options['maptypecontrol']; ?>,
				mapTypeControlOptions: {
		  			style:google.maps.MapTypeControlStyle.<?php echo $options['maptypecontrolstyle']; ?>,
		  			position:google.maps.ControlPosition.<?php echo $options['maptypecontrolposition']; ?>
				},
		    	center: myCenter,
		    	mapTypeId: google.maps.MapTypeId.<?php echo $options['maptypeid']; ?>
		    	//You can set map type as ROADMAP,SATELLITE,HYBRID,TERRAIN
		  	};

		  	map = new google.maps.Map(document.getElementById('map-canvas'),mapOptions);

		  	//Google Maps - Overlays with the Marker
		  	marker=new google.maps.Marker({
		  		position:myCenter
		  	});
		  	marker.setMap(map);

		  	var infowindow = new google.maps.InfoWindow({
			  	content:'<?php echo $options["infowindow"]; ?>'
			});
			infowindow.open(map,marker);
		}
		google.maps.event.addDomListener(window, 'load', initialize);
    </script><?php
}
add_action('wp_footer', 'sis_gmaps_custom_script');

function sis_gmaps_custom_style(){
	$options = get_option( 'sis_gmaps_settings' );
	?><style>
		#map-canvas {
			width:<?php echo $options['mapwidth']; ?>;
			height:<?php echo $options['mapheight']; ?>;
	        margin: 0px;
	        padding: 0px
      	}
    </style><?php
}
add_action('wp_head', 'sis_gmaps_custom_style');

// Add shortcode in text widgets
add_filter('widget_text', 'do_shortcode');

function sis_gmaps_shortcode( $atts, $content = null ) { 
        return '<div id="map-canvas"></div>';
}
add_shortcode( 'google-map', 'sis_gmaps_shortcode' );