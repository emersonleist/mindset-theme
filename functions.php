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
}
add_action( 'wp_enqueue_scripts', 'mindset_enqueues' );

function mindset_setup() {
    add_editor_style( get_stylesheet_uri() );
}
add_action( 'after_setup_theme', 'mindset_setup' );