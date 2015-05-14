<?php
/*
Plugin Name: SIS Google Map
Plugin URI: http://wordpress.org/plugins/sis-google-map
Description: Add google map into your website.
Version: 2.0.0
Author: sayful
Author URI: http://sayful.net
License: GPLv2 or later
*/

/* Adding Latest jQuery for Wordpress plugin */
function sis_google_map_plugin_scripts() {
	global $post;
	if( is_a( $post, 'WP_Post' ) && has_shortcode( $post->post_content, 'sis_google_map') ) {

    wp_enqueue_script( 'google-maps', ( is_ssl() ? 'https' : 'http' ) . '://maps.googleapis.com/maps/api/js?v=3.exp&sensor=false' );
	}
}
add_action('wp_enqueue_scripts', 'sis_google_map_plugin_scripts');


if( ! function_exists( 'sis_google_map') ) :
/**
 * Google Map Shortcode
 *
 * @since 2.0.0
 */
function sis_google_map( $atts ) {
    extract( shortcode_atts( array(
        'lat'    => '37.42200',
        'long'   => '-122.08395',
        'width'  => '100%',
        'height' => '350px',
        'zoom'   => 15,
        'style'  => 'none'
    ), $atts ) );

    $map_styles = array(
        'none'             => '[]',
        'mixed'            => '[{"featureType":"landscape","stylers":[{"hue":"#00dd00"}]},{"featureType":"road","stylers":[{"hue":"#dd0000"}]},{"featureType":"water","stylers":[{"hue":"#000040"}]},{"featureType":"poi.park","stylers":[{"visibility":"off"}]},{"featureType":"road.arterial","stylers":[{"hue":"#ffff00"}]},{"featureType":"road.local","stylers":[{"visibility":"off"}]}]',
        'pale_dawn'        => '[{"featureType":"landscape","stylers":[{"saturation":-100},{"lightness":65},{"visibility":"on"}]},{"featureType":"poi","stylers":[{"saturation":-100},{"lightness":51},{"visibility":"simplified"}]},{"featureType":"road.highway","stylers":[{"saturation":-100},{"visibility":"simplified"}]},{"featureType":"road.arterial","stylers":[{"saturation":-100},{"lightness":30},{"visibility":"on"}]},{"featureType":"road.local","stylers":[{"saturation":-100},{"lightness":40},{"visibility":"on"}]},{"featureType":"transit","stylers":[{"saturation":-100},{"visibility":"simplified"}]},{"featureType":"administrative.province","stylers":[{"visibility":"off"}]},{"featureType":"water","elementType":"labels","stylers":[{"visibility":"on"},{"lightness":-25},{"saturation":-100}]},{"featureType":"water","elementType":"geometry","stylers":[{"hue":"#ffff00"},{"lightness":-25},{"saturation":-97}]}]',
        'greyscale'        => '[{"featureType":"all","stylers":[{"saturation":-100},{"gamma":0.5}]}]',
        'bright_bubbly'    => '[{"featureType":"water","stylers":[{"color":"#19a0d8"}]},{"featureType":"administrative","elementType":"labels.text.stroke","stylers":[{"color":"#ffffff"},{"weight":6}]},{"featureType":"administrative","elementType":"labels.text.fill","stylers":[{"color":"#e85113"}]},{"featureType":"road.highway","elementType":"geometry.stroke","stylers":[{"color":"#efe9e4"},{"lightness":-40}]},{"featureType":"road.arterial","elementType":"geometry.stroke","stylers":[{"color":"#efe9e4"},{"lightness":-20}]},{"featureType":"road","elementType":"labels.text.stroke","stylers":[{"lightness":100}]},{"featureType":"road","elementType":"labels.text.fill","stylers":[{"lightness":-100}]},{"featureType":"road.highway","elementType":"labels.icon"},{"featureType":"landscape","elementType":"labels","stylers":[{"visibility":"off"}]},{"featureType":"landscape","stylers":[{"lightness":20},{"color":"#efe9e4"}]},{"featureType":"landscape.man_made","stylers":[{"visibility":"off"}]},{"featureType":"water","elementType":"labels.text.stroke","stylers":[{"lightness":100}]},{"featureType":"water","elementType":"labels.text.fill","stylers":[{"lightness":-100}]},{"featureType":"poi","elementType":"labels.text.fill","stylers":[{"hue":"#11ff00"}]},{"featureType":"poi","elementType":"labels.text.stroke","stylers":[{"lightness":100}]},{"featureType":"poi","elementType":"labels.icon","stylers":[{"hue":"#4cff00"},{"saturation":58}]},{"featureType":"poi","elementType":"geometry","stylers":[{"visibility":"on"},{"color":"#f0e4d3"}]},{"featureType":"road.highway","elementType":"geometry.fill","stylers":[{"color":"#efe9e4"},{"lightness":-25}]},{"featureType":"road.arterial","elementType":"geometry.fill","stylers":[{"color":"#efe9e4"},{"lightness":-10}]},{"featureType":"poi","elementType":"labels","stylers":[{"visibility":"simplified"}]}]',
        'subtle_grayscale' => '[{"featureType":"landscape","stylers":[{"saturation":-100},{"lightness":65},{"visibility":"on"}]},{"featureType":"poi","stylers":[{"saturation":-100},{"lightness":51},{"visibility":"simplified"}]},{"featureType":"road.highway","stylers":[{"saturation":-100},{"visibility":"simplified"}]},{"featureType":"road.arterial","stylers":[{"saturation":-100},{"lightness":30},{"visibility":"on"}]},{"featureType":"road.local","stylers":[{"saturation":-100},{"lightness":40},{"visibility":"on"}]},{"featureType":"transit","stylers":[{"saturation":-100},{"visibility":"simplified"}]},{"featureType":"administrative.province","stylers":[{"visibility":"off"}]},{"featureType":"water","elementType":"labels","stylers":[{"visibility":"on"},{"lightness":-25},{"saturation":-100}]},{"featureType":"water","elementType":"geometry","stylers":[{"hue":"#ffff00"},{"lightness":-25},{"saturation":-97}]}]'
    );

    $map_id = 'map'. rand(0, 99);

    ?>

    <script type="text/javascript">
        jQuery(window).load(function(){
            var options = {
                id: "<?php echo $map_id; ?>",
                styles: <?php echo $map_styles[$style]; ?>,
                zoom: <?php echo $zoom; ?>,
                center: {
                    lat: "<?php echo $lat; ?>",
                    long: "<?php echo $long; ?>"
                }
            };
            Shaplatools.Map.init(options);
        });
    </script>

    <?php

    return "<section id='{$map_id}' class='shapla-section google-map' style='width:{$width};height:{$height};'></section>";
}
endif;

add_shortcode( 'sis_google_map', 'sis_google_map' );
add_shortcode( 'google-map', 'sis_google_map' );

add_filter('widget_text', 'do_shortcode');
add_filter( 'the_excerpt', 'do_shortcode');




// Hooks your functions into the correct filters
function sis_google_map_add_mce_button() {
    // check user permissions
    if ( !current_user_can( 'edit_posts' ) && !current_user_can( 'edit_pages' ) ) {
        return;
    }
    // check if WYSIWYG is enabled
    if ( 'true' == get_user_option( 'rich_editing' ) ) {
        add_filter( 'mce_external_plugins', 'sis_google_map_add_tinymce_plugin' );
        add_filter( 'mce_buttons', 'sis_google_map_register_mce_button' );
    }
}
add_action('admin_head', 'sis_google_map_add_mce_button');

// Declare script for new button
function sis_google_map_add_tinymce_plugin( $plugin_array ) {
    $plugin_array['sis_google_map_mce_button'] = plugin_dir_url( __FILE__ ) .'/mce-button.js';
    return $plugin_array;
}

// Register new button in the editor
function sis_google_map_register_mce_button( $buttons ) {
    array_push( $buttons, 'sis_google_map_mce_button' );
    return $buttons;
}