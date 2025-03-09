<?php
function mindset_enqueues() {
    // Load styles.css on the front-end
    // Parameters: unique handle, source, dependencies, version number, media
    wp_enqueue_style(
        'mindset-style',
        get_stylesheet_uri(),
        array(),
        wp_get_theme()->get( 'version' ),
        'all'
    );

    // Load normalize.css
    wp_enqueue_style(
        'mindset-normalize',
        'https://unpkg.com/@csstools/normalize.css',
        array(),
        '12.1.0'
    );

    //load scroll-to-top.js
    wp_enqueue_script(
        'mindset-scroll-to-top', 
        get_theme_file_uri( 'assets/js/scroll-to-top.js' ), 
        array(), 
        wp_get_theme()->get( 'Version' ), 
        array( 'strategy' => 'defer' ) 
    );

    //load contact.js
    if ( is_page( 14 ) ) {
        wp_enqueue_script(
            'mindset-contact-scripts', 
            get_theme_file_uri( 'assets/js/contact.js' ), 
            array( 'mindset-scroll-to-top' ), //dependency
            wp_get_theme()->get( 'Version' ), 
            array( 'strategy' => 'defer' ) 
        );
    }
}
add_action( 'wp_enqueue_scripts', 'mindset_enqueues' );

function mindset_setup() {
    add_editor_style( get_stylesheet_uri() );

    // Add image sizes
    // Crop images to 400px by 500px
add_image_size( '400x500', 400, 500, true );

// Crop images to 200px by 250px
add_image_size( '200x250', 200, 250, true );
// Crop images to 400px by 200px
add_image_size( '400x200', 400, 200, true );
// Crop images to 800px by 400px
add_image_size( '800x400', 800, 400, true );
}
add_action( 'after_setup_theme', 'mindset_setup' );

// Make custom sizes selectable from WordPress admin.
function mindset_add_custom_image_sizes( $size_names ) {
	$new_sizes = array(
		'400x500' => __( '400x500', 'mindset-theme' ),
		'200x250' => __( '200x250', 'mindset-theme' ),
        '400x200' => __( '400x200', 'mindset-theme' ),
		'800x400' => __( '800x400', 'mindset-theme' ),
	);
	return array_merge( $size_names, $new_sizes );
}
add_filter( 'image_size_names_choose', 'mindset_add_custom_image_sizes' );

//load custom blocks
require get_theme_file_path() . '/mindset-blocks/mindset-blocks.php';

/**
* Custom Post Types & Custom Taxonomies
*/
require get_template_directory() . '/inc/post-types-taxonomies.php';

function mindset_rewrite_flush() {
    mindset_register_custom_post_types();
    flush_rewrite_rules();
}
add_action( 'after_switch_theme', 'mindset_rewrite_flush' );