<?php
/**
 * Plugin Name: SVG Icon Library for Elementor
 * Description: Adds a custom SVG icon library as a new tab in Elementor's icon picker.
 * Version: 1.0.0
 * Author: Shakil Ansary
 * License: GPL-2.0-or-later
 * Text Domain: svg-icon-library-elementor
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

define( 'SILE_PLUGIN_VERSION', '1.0.0' );
define( 'SILE_PLUGIN_FILE', __FILE__ );
define( 'SILE_PLUGIN_URL', plugin_dir_url( __FILE__ ) );
define( 'SILE_PLUGIN_PATH', plugin_dir_path( __FILE__ ) );

function sile_admin_notice_missing_elementor() {
	if ( isset( $_GET['activate'] ) ) {
		unset( $_GET['activate'] );
	}
	$class = 'notice notice-error';
	$message = esc_html__( 'SVG Icon Library for Elementor requires Elementor to be installed and activated.', 'svg-icon-library-elementor' );
	printf( '<div class="%1$s"><p>%2$s</p></div>', esc_attr( $class ), esc_html( $message ) );
}

add_action( 'plugins_loaded', function() {
	if ( ! did_action( 'elementor/loaded' ) ) {
		add_action( 'admin_notices', 'sile_admin_notice_missing_elementor' );
		return;
	}

	add_filter( 'elementor/icons_manager/additional_tabs', 'sile_register_svg_icon_library' );
} );

function sile_register_svg_icon_library( $tabs ) {
	$tabs['sile-svg'] = array(
		'name'          => 'sile-svg',
		'label'         => __( 'SILE Icons', 'svg-icon-library-elementor' ),
		'url'           => false,
		'enqueue'       => array(),
		'prefix'        => 'sile-',
		'displayPrefix' => 'sile',
		'labelIcon'     => 'eicon-favorite',
		'ver'           => SILE_PLUGIN_VERSION,
		'render_type'   => 'svg',
		'fetchJson'     => SILE_PLUGIN_URL . 'assets/sile-icons.json?ver=' . SILE_PLUGIN_VERSION,
		'native'        => false,
	);

	return $tabs;
}

add_action( 'wp_ajax_sile_icons_json', 'sile_ajax_icons_json' );
add_action( 'wp_ajax_nopriv_sile_icons_json', 'sile_ajax_icons_json' );

function sile_ajax_icons_json() {
	$icons_directory = trailingslashit( SILE_PLUGIN_PATH ) . 'assets/svg';
	$prefix = 'sile';
	$icons = array();

	if ( is_dir( $icons_directory ) ) {
		$files = glob( $icons_directory . '/*.svg' );
		if ( is_array( $files ) ) {
			foreach ( $files as $file_path ) {
				$icon_name = sanitize_title( basename( $file_path, '.svg' ) );
				$svg_markup = @file_get_contents( $file_path );
				if ( false === $svg_markup ) {
					continue;
				}
				$parsed = sile_parse_svg( $svg_markup );
				if ( $parsed && ! empty( $parsed['body'] ) ) {
					$icons[ $icon_name ] = array(
						'body'   => $parsed['body'],
						'width'  => $parsed['width'],
						'height' => $parsed['height'],
					);
				}
			}
		}
	}

	$data = array(
		'prefix' => $prefix,
		'icons'  => $icons,
	);

	wp_send_json( $data );
}

function sile_parse_svg( $svg_markup ) {
	$width  = 24;
	$height = 24;

	if ( preg_match( '/viewBox="([\d\.\s]+)"/i', $svg_markup, $match ) ) {
		$parts = preg_split( '/\s+/', trim( $match[1] ) );
		if ( count( $parts ) === 4 ) {
			$vb_width  = (float) $parts[2];
			$vb_height = (float) $parts[3];
			if ( $vb_width > 0 && $vb_height > 0 ) {
				$width  = $vb_width;
				$height = $vb_height;
			}
		}
	}

	$body = '';
	if ( preg_match( '/<svg[^>]*>([\s\S]*?)<\/svg>/i', $svg_markup, $match ) ) {
		$body = trim( $match[1] );
	} else {
		$body = trim( $svg_markup );
	}

	$body = preg_replace( '/<script[\s\S]*?<\/script>/i', '', $body );
	$body = preg_replace( '/<\?xml[\s\S]*?\?>/i', '', $body );

if ( $body === '' ) {
return null;
}

return array(
'body' => $body,
'width' => $width,
'height' => $height,
);
}