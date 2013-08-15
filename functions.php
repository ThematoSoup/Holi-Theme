<?php

/*
 * Adding Theme Customizer option
 */
function twentythirteen_rainbow_customize( $wp_customize ) {
	$wp_customize->add_setting(
		// ID
		'twentythirteen_scheme',
		// Arguments array
		array(
			'default' => 'green',
			'type' => 'theme_mod'
		)
	);
	$wp_customize->add_control(
		// ID
		'color_scheme_control',
		// Arguments array
		array(
			'type' => 'radio',
			'label' => __( 'Color Scheme', 'twentythirteen_rainbow' ),
			'section' => 'colors',
			'choices' => array(
				'orange'	=> __( 'Orange (default)', 'twentythirteen_rainbow' ),
				'green'		=> __( 'Green', 'twentythirteen_rainbow' ),
				'purple'	=> __( 'Purple', 'twentythirteen_rainbow' ),
				'pink'		=> __( 'Pink', 'twentythirteen_rainbow' ),
				'red'		=> __( 'Red', 'twentythirteen_rainbow' ),
				'blue'		=> __( 'Blue', 'twentythirteen_rainbow' ),
				/*
				'turquoise'	=> __( 'Turquoise', 'twentythirteen_rainbow' ),
				'yellow'	=> __( 'Yellow', 'twentythirteen_rainbow' ),
				'sepia'		=> __( 'Sepia', 'twentythirteen_rainbow' ),
				'gray'		=> __( 'Gray', 'twentythirteen_rainbow' )
				*/
			),
			// This last one must match setting ID from above
			'settings' => 'twentythirteen_scheme'
		)
	);
}
add_action( 'customize_register', 'twentythirteen_rainbow_customize' );


/*
 * Add color scheme body_class
 */
function twentythirteen_rainbow_body_classes( $classes ) {
	$classes[] = 'scheme-' . get_theme_mod( 'twentythirteen_scheme' );
	return $classes;	
}
add_filter( 'body_class', 'twentythirteen_rainbow_body_classes' );


/*
 * Replace header images based on active color scheme
 */
function twentythirteen_multicolor_custom_header_setup() {

	if ( '' != get_theme_mod( 'twentythirteen_scheme' ) ) :
		$color_scheme = get_theme_mod( 'twentythirteen_scheme' );
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


	// remove the ugly orange headers
	unregister_default_headers( array( 'circle', 'diamond', 'star' ) );

	// replace with nice blue ones
	register_default_headers( array(
		'circle' => array(
			'url'           => '%2$s/images/headers/' . $color_scheme . '/circle.png',
			'thumbnail_url' => '%2$s/images/headers/' . $color_scheme . '/circle-thumbnail.png',
			'description'   => _x( 'Circle', 'header image description', 'twentythirteen' )
		),
		'diamond' => array(
			'url'           => '%2$s/images/headers/' . $color_scheme . '/diamond.png',
			'thumbnail_url' => '%2$s/images/headers/' . $color_scheme . '/diamond-thumbnail.png',
			'description'   => _x( 'Diamond', 'header image description', 'twentythirteen' )
		),
		'star' => array(
			'url'           => '%2$s/images/headers/' . $color_scheme . '/star.png',
			'thumbnail_url' => '%2$s/images/headers/' . $color_scheme . '/star-thumbnail.png',
			'description'   => _x( 'Star', 'header image description', 'twentythirteen' )
		),
	) );
}
add_action( 'after_setup_theme', 'twentythirteen_multicolor_custom_header_setup', 11 );