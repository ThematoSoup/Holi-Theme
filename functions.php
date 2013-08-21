<?php

/*
 * Adding Theme Customizer option
 */
function twentythirteen_holi_customize( $wp_customize ) {
	$wp_customize->add_setting(
		// ID
		'twentythirteen_scheme',
		// Arguments array
		array(
			'default' => 'green',
			'type' => 'option'
		)
	);
	$wp_customize->add_control(
		// ID
		'color_scheme_control',
		// Arguments array
		array(
			'type' => 'radio',
			'label' => __( 'Color Scheme', 'holi' ),
			'section' => 'colors',
			'choices' => array(
				'orange'	=> __( 'Orange (original)', 'holi' ),
				'green'		=> __( 'Green', 'holi' ),
				'purple'	=> __( 'Purple', 'holi' ),
				'pink'		=> __( 'Pink', 'holi' ),
				'red'		=> __( 'Red', 'holi' ),
				'blue'		=> __( 'Blue', 'holi' ),
				'yellow'	=> __( 'Yellow', 'holi' ),
				'turquoise'	=> __( 'Turquoise', 'holi' ),
				'sepia'		=> __( 'Sepia', 'holi' ),
				'gray'		=> __( 'Gray', 'holi' )
			),
			// This last one must match setting ID from above
			'settings' => 'twentythirteen_scheme'
		)
	);
}
add_action( 'customize_register', 'twentythirteen_holi_customize' );


/*
 * Add color scheme body_class
 */
function twentythirteen_holi_body_classes( $classes ) {
	$classes[] = 'holi-color-scheme-' . get_option( 'twentythirteen_scheme' );
	return $classes;	
}
add_filter( 'body_class', 'twentythirteen_holi_body_classes' );


/**
* Adds color scheme class to Tiny MCE editor
*/
function twentythirteen_holi_tiny_mce_classes( $thsp_mceInit ) {
    $thsp_mceInit['body_class'] .= ' holi-color-scheme-' . get_option( 'twentythirteen_scheme' );
 
    return $thsp_mceInit;
}
add_filter( 'tiny_mce_before_init', 'twentythirteen_holi_tiny_mce_classes' );


/*
 * Replace header images based on active color scheme
 */
function twentythirteen_holi_custom_header_setup() {

	$holi_colors = array(
		'orange'		=> __( 'Orange', 'holi' ),
		'green'			=> __( 'Green', 'holi' ), 
		'purple'		=> __( 'Purple', 'holi' ),
		'pink'			=> __( 'Pink', 'holi' ),
		'red'			=> __( 'Red', 'holi' ),
		'blue'			=> __( 'Blue', 'holi' ),
		'yellow'		=> __( 'Yellow', 'holi' ),
		'turquoise'		=> __( 'Turquoise', 'holi' ),
		'sepia'			=> __( 'Sepia', 'holi' ),
		'gray'			=> __( 'Gray', 'holi' ),
	);
	
	if ( '' != get_option( 'twentythirteen_scheme' ) ) :
		$color_scheme = get_option( 'twentythirteen_scheme' );
	else :
		$color_scheme = 'green';
	endif;
	
	// remove the header support
	remove_theme_support( 'custom-header' );
	
	$args = array(
		// Text color and image (empty to use none).
		'default-text-color'     => '100e22',
		'default-image'          => '%2$s/images/headers/' . $color_scheme . '/circle.png',

		// Set height and width, with a maximum value for the width.
		'height'                 => 230,
		'width'                  => 1600,

		// Callbacks for styling the header and the admin preview.
		'wp-head-callback'       => 'twentythirteen_header_style',
		'admin-head-callback'    => 'twentythirteen_admin_header_style',
		'admin-preview-callback' => 'twentythirteen_admin_header_image',
	);

	// add it back, with changes
	add_theme_support( 'custom-header', $args );


	// remove the default headers
	unregister_default_headers( array( 'circle', 'diamond', 'star' ) );

	// replace with new ones
	$new_headers = array();
	foreach ( $holi_colors as $holi_color_value => $holi_color_name ) :
		$new_headers[$holi_color_value . '-circle'] = array(
			'url'           => '%2$s/images/headers/' . $holi_color_value . '/circle.png',
			'thumbnail_url' => '%2$s/images/headers/' . $holi_color_value . '/circle-thumbnail.png',
			'description'   => $holi_color_name
		);
		$new_headers[$holi_color_value . '-diamond'] = array(
			'url'           => '%2$s/images/headers/' . $holi_color_value . '/circle.png',
			'thumbnail_url' => '%2$s/images/headers/' . $holi_color_value . '/circle-thumbnail.png',
			'description'   => _x( 'Circle', 'header image description', 'twentythirteen' )
		);
		$new_headers[$holi_color_value . '-star'] = array(
			'url'           => '%2$s/images/headers/' . $holi_color_value . '/diamond.png',
			'thumbnail_url' => '%2$s/images/headers/' . $holi_color_value . '/diamond-thumbnail.png',
			'description'   => $holi_color_name
		);
	endforeach;
	register_default_headers( $new_headers );
}
add_action( 'after_setup_theme', 'twentythirteen_holi_custom_header_setup', 11 );


/**
 * Add postMessage support for site title and description for the Customizer.
 *
 * @since Holi 1.0.2
 */
function twentythirteen_holi_customize_register( $wp_customize ) {
	$wp_customize->get_setting( 'twentythirteen_scheme' )->transport = 'postMessage';
}
add_action( 'customize_register', 'twentythirteen_holi_customize_register' );


/**
 * Binds JavaScript handlers to make Customizer preview reload changes
 * asynchronously.
 *
 * @since Holi 1.0.2
 */
function twentythirteen_holi_customize_preview_js() {
	wp_enqueue_script( 'twentythirteen-holi-customizer', get_stylesheet_directory_uri() . '/js/theme-customizer.js', array( 'customize-preview' ), '1.0.2', true );
}
add_action( 'customize_preview_init', 'twentythirteen_holi_customize_preview_js' );