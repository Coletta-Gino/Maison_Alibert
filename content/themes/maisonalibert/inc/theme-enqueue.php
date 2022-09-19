<?php 

if (!function_exists('maisonalibert_enqueue')) {
  function maisonalibert_enqueue() {
    // Styles
    wp_enqueue_style(
      'main-style',
      get_theme_file_uri('public/css/style.css'),
      [],
      '20220919'
    );

    // JavaScript
    wp_enqueue_script(
      'app',
      get_theme_file_uri('public/js/app.js'),
      [],
      '20220919',
      true
    );
  }
}

add_action('wp_enqueue_scripts', 'maisonalibert_enqueue');