<?php
/**
 * GeneratePress child theme functions and definitions.
 *
 * Add your custom PHP in this file.
 * Only edit this file if you have direct access to it on your server (to fix errors if they happen).
 */

/**
 * Method: enqueue_styles_scripts
 * Enqueue Extra scripts and styles inside child theme 
 *
 * @since   1.0.0
 * @return 	void
 * 
 */
function enqueue_styles_scripts() {
	wp_enqueue_script(
		'newkids-script',
		get_stylesheet_directory_uri() . '/functions.js',
		[],
		null,
		['in_footer' => true]
	);
}

add_action('wp_enqueue_scripts', 'enqueue_styles_scripts', 99);

/**
 * Method: upload_file_mime
 * Add Extra mime types
 *
 * @since   1.0.0
 * @param	array $mimes
 * @return 	array
 * 
 */
function upload_file_mime ( $mimes ) {
    $mimes['woff']  = 'application/x-font-woff';
    $mimes['woff2'] = 'font/woff2'; 
    $mimes['ttf']   = 'application/x-font-ttf';
    $mimes['svg']   = 'image/svg+xml';
    $mimes['eot']   = 'application/vnd.ms-fontobject';

    return $mimes;
}

add_filter( 'upload_mimes', 'upload_file_mime' );

/**
 * Method: custom_class
 * Adds an extra class depending of the selected header option on page.
 *
 * @since   1.0.0
 * @param   array $classes
 * @return 	array
 * 
 */
function custom_class( $classes ) {
	$current_header = get_post_meta(get_the_ID(), 'header_color_mode', true);
	$classes[] = ($current_header === 'dark') ? 'header-dark' : 'header-light';
	return $classes;
}

add_filter('body_class', 'custom_class');

/**
 * Method: custom_class
 * Adds an extra class depending of the selected header option on page.
 *
 * @since   1.0.0
 * @param   array $classes
 * @return 	array
 * 
 */
add_filter( 'block_editor_settings_all', function( $editor_settings ) {
    $css = wp_get_custom_css_post()->post_content;
    $editor_settings['styles'][] = array( 'css' => $css );

    return $editor_settings;
} );

add_filter( 'generate_editor_styles', function( $editor_styles ) {
    $editor_styles[] = get_stylesheet_directory_uri() . '/style.css';

    return $editor_styles;
} );

/**
 * Method: new_kids_custom_copyright
 * Adds a custom copyright message
 *
 * @since   1.0.0
 * @return 	string
 * 
 */
function new_kids_custom_copyright() {
    echo esc_html('&copy; 2024 NEW KIDS ON THE DOCK');    
}

add_filter( 'generate_copyright', 'new_kids_custom_copyright' );