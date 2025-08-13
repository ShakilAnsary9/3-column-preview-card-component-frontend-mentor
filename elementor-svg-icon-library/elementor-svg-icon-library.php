<?php
/**
 * Plugin Name: SVG Icon Library for Elementor
 * Description: Adds a custom SVG icon library as a new tab in Elementor's icon picker.
 * Version: 1.0.0
 * Author: Your Name
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
		'fetchJson'     => SILE_PLUGIN_URL . 'assets/icons.json',
		'native'        => false,
	);

	return $tabs;
}