<?php
/**
 * Theme functions and definitions
 *
 * @package HelloElementor
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

define( 'PATO_BRANCO_VERSAO', '1.0.0' );

if ( ! isset( $content_width ) ) {
	$content_width = 800; // Pixels.
}

if ( ! function_exists( 'pato-branco_setup' ) ) {
	/**
	 * Set up theme support.
	 *
	 * @return void
	 */
	function pato_branco_setup() {
		if ( is_admin() ) {
			pato_branco_maybe_update_theme_version_in_db();
		}

		$hook_result = apply_filters_deprecated( 'elementor_pato_branco_theme_load_textdomain', [ true ], '2.0', 'pato_branco_load_textdomain' );
		if ( apply_filters( 'pato_branco_load_textdomain', $hook_result ) ) {
			load_theme_textdomain( 'pato-branco', get_template_directory() . '/languages' );
		}

		$hook_result = apply_filters_deprecated( 'elementor_pato_branco_theme_register_menus', [ true ], '2.0', 'pato_branco_register_menus' );
		if ( apply_filters( 'pato_branco_register_menus', $hook_result ) ) {
			register_nav_menus( [ 'menu-1' => __( 'Header', 'pato-branco' ) ] );
			register_nav_menus( [ 'menu-2' => __( 'Footer', 'pato-branco' ) ] );
		}

		$hook_result = apply_filters_deprecated( 'elementor_pato_branco_theme_add_theme_support', [ true ], '2.0', 'pato_branco_add_theme_support' );
		if ( apply_filters( 'pato_branco_add_theme_support', $hook_result ) ) {
			add_theme_support( 'post-thumbnails' );
			add_theme_support( 'automatic-feed-links' );
			add_theme_support( 'title-tag' );
			add_theme_support(
				'html5',
				[
					'search-form',
					'comment-form',
					'comment-list',
					'gallery',
					'caption',
					'script',
					'style',
				]
			);
			add_theme_support(
				'custom-logo',
				[
					'height'      => 100,
					'width'       => 350,
					'flex-height' => true,
					'flex-width'  => true,
				]
			);

			/*
			 * Editor Style.
			 */
			add_editor_style( 'classic-editor.css' );

			/*
			 * Gutenberg wide images.
			 */
			add_theme_support( 'align-wide' );

			/*
			 * WooCommerce.
			 */
			$hook_result = apply_filters_deprecated( 'elementor_pato_branco_theme_add_woocommerce_support', [ true ], '2.0', 'pato_branco_add_woocommerce_support' );
			if ( apply_filters( 'pato_branco_add_woocommerce_support', $hook_result ) ) {
				// WooCommerce in general.
				add_theme_support( 'woocommerce' );
				// Enabling WooCommerce product gallery features (are off by default since WC 3.0.0).
				// zoom.
				add_theme_support( 'wc-product-gallery-zoom' );
				// lightbox.
				add_theme_support( 'wc-product-gallery-lightbox' );
				// swipe.
				add_theme_support( 'wc-product-gallery-slider' );
			}
		}
	}
}
add_action( 'after_setup_theme', 'pato_branco_setup' );

function pato_branco_maybe_update_theme_version_in_db() {
	$theme_version_option_name = 'pato_branco_theme_version';
	// The theme version saved in the database.
	$pato_branco_theme_db_version = get_option( $theme_version_option_name );

	// If the 'pato_branco_theme_version' option does not exist in the DB, or the version needs to be updated, do the update.
	if ( ! $pato_branco_theme_db_version || version_compare( $pato_branco_theme_db_version, HELLO_ELEMENTOR_VERSION, '<' ) ) {
		update_option( $theme_version_option_name, HELLO_ELEMENTOR_VERSION );
	}
}

if ( ! function_exists( 'pato_branco_scripts_styles' ) ) {
	/**
	 * Theme Scripts & Styles.
	 *
	 * @return void
	 */
	function pato_branco_scripts_styles() {
		$enqueue_basic_style = apply_filters_deprecated( 'elementor_pato_branco_theme_enqueue_style', [ true ], '2.0', 'pato_branco_enqueue_style' );
		$min_suffix          = defined( 'SCRIPT_DEBUG' ) && SCRIPT_DEBUG ? '' : '.min';

		if ( apply_filters( 'pato_branco_enqueue_style', $enqueue_basic_style ) ) {
			wp_enqueue_style(
				'pato-branco',
				get_template_directory_uri() . '/style' . $min_suffix . '.css',
				[],
				HELLO_ELEMENTOR_VERSION
			);
		}

		if ( apply_filters( 'pato_branco_enqueue_theme_style', true ) ) {
			wp_enqueue_style(
				'pato-branco-theme-style',
				get_template_directory_uri() . '/theme' . $min_suffix . '.css',
				[],
				HELLO_ELEMENTOR_VERSION
			);
		}
	}
}
add_action( 'wp_enqueue_scripts', 'pato_branco_scripts_styles' );

if ( ! function_exists( 'pato_branco_register_elementor_locations' ) ) {
	/**
	 * Register Elementor Locations.
	 *
	 * @param ElementorPro\Modules\ThemeBuilder\Classes\Locations_Manager $elementor_theme_manager theme manager.
	 *
	 * @return void
	 */
	function pato_branco_register_elementor_locations( $elementor_theme_manager ) {
		$hook_result = apply_filters_deprecated( 'elementor_pato_branco_theme_register_elementor_locations', [ true ], '2.0', 'pato_branco_register_elementor_locations' );
		if ( apply_filters( 'pato_branco_register_elementor_locations', $hook_result ) ) {
			$elementor_theme_manager->register_all_core_location();
		}
	}
}
add_action( 'elementor/theme/register_locations', 'pato_branco_register_elementor_locations' );

if ( ! function_exists( 'pato_branco_content_width' ) ) {
	/**
	 * Set default content width.
	 *
	 * @return void
	 */
	function pato_branco_content_width() {
		$GLOBALS['content_width'] = apply_filters( 'pato_branco_content_width', 800 );
	}
}
add_action( 'after_setup_theme', 'pato_branco_content_width', 0 );

if ( is_admin() ) {
	require get_template_directory() . '/includes/admin-functions.php';
}

/**
 * If Elementor is installed and active, we can load the Elementor-specific Settings & Features
*/

// Allow active/inactive via the Experiments
require get_template_directory() . '/includes/elementor-functions.php';

/**
 * Include customizer registration functions
*/
function pato_branco_register_customizer_functions() {
	if ( is_customize_preview() ) {
		require get_template_directory() . '/includes/customizer-functions.php';
	}
}
add_action( 'init', 'pato_branco_register_customizer_functions' );

if ( ! function_exists( 'pato_branco_check_hide_title' ) ) {
	/**
	 * Check hide title.
	 *
	 * @param bool $val default value.
	 *
	 * @return bool
	 */
	function pato_branco_check_hide_title( $val ) {
		if ( defined( 'ELEMENTOR_VERSION' ) ) {
			$current_doc = Elementor\Plugin::instance()->documents->get( get_the_ID() );
			if ( $current_doc && 'yes' === $current_doc->get_settings( 'hide_title' ) ) {
				$val = false;
			}
		}
		return $val;
	}
}
add_filter( 'pato_branco_page_title', 'pato_branco_check_hide_title' );

/**
 * Wrapper function to deal with backwards compatibility.
 */
if ( ! function_exists( 'pato_branco_body_open' ) ) {
	function pato_branco_body_open() {
		if ( function_exists( 'wp_body_open' ) ) {
			wp_body_open();
		} else {
			do_action( 'wp_body_open' );
		}
	}
}
