<?php
/**
 * Plugin Name: Movies
 * Plugin URI: 
 * Description: A plugin to manage movies.
 * Version: 1.0.0
 * Author: Melita Poropat
 * License: GPL2
 */

// Register the Movies custom post type
function movies_register_post_type() {
    $args = array(
        'public' => true,
        'label'  => 'Movies',
        'supports' => array(
            'title',
            'editor',
            'thumbnail',
            'excerpt',
            'custom-fields',
        ),
        'menu_icon' => 'dashicons-format-video',
    );
    register_post_type( 'movies', $args );
}
add_action( 'init', 'movies_register_post_type' );

// Add the "movie_title" post meta field to the Movies custom post type
function movies_add_movie_title_meta_box() {
    add_meta_box(
        'movie_title',
        'Movie Title',
        'movies_movie_title_meta_box_callback',
        'movies',
        'normal',
        'default'
    );
}
add_action( 'add_meta_boxes_movies', 'movies_add_movie_title_meta_box' );

function movies_movie_title_meta_box_callback( $post ) {
    // Use nonce for verification
    wp_nonce_field( basename( __FILE__ ), 'movie_title_nonce' );

    // Get the current value of the "movie_title" post meta field
    $movie_title = get_post_meta( $post->ID, '_movie_title', true );

    // Output the field
    echo '<label for="movie_title_field">Movie Title</label>';
    echo '<input type="text" id="movie_title_field" name="movie_title_field" value="' . esc_attr( $movie_title ) . '">';
}

function movies_save_movie_title_meta_box_data( $post_id ) {
    // Verify the nonce
    if ( !isset( $_POST['movie_title_nonce'] ) || !wp_verify_nonce( $_POST['movie_title_nonce'], basename( __FILE__ ) ) ) {
        return;
    }

    // Update the "movie_title" post meta field
    if ( isset( $_POST['movie_title_field'] ) ) {
        update_post_meta( $post_id, '_movie_title', sanitize_text_field( $_POST['movie_title_field'] ) );
    }
}
add_action( 'save_post_movies', 'movies_save_movie_title_meta_box_data' );
