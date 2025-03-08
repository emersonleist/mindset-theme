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

}
add_action( 'wp_enqueue_scripts', 'mindset_enqueues' );

function mindset_setup() {
    add_editor_style( get_stylesheet_uri() );

    // Add image sizes
    // Crop images to 400px by 500px
add_image_size( '400x500', 400, 500, true );

// Crop images to 200px by 250px
add_image_size( '200x250', 200, 250, true );
}
add_action( 'after_setup_theme', 'mindset_setup' );