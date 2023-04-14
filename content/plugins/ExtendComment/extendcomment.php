<?php

/*
Plugin Name: Extend Comment
Plugin URI: 
Description: A plugin to extend the commentary system functions.
Version: 1.0
Requires at least: 5.0
Requires PHP: 5.2
Author: XiaoDev
Author URI: 
License: GPLv2 or later
Text Domain: extendcomment
*/

// This function remove the website and cookies fields of the comment form 
function remove_fields( $fields ) {
  unset( $fields['url'] );
  unset( $fields['cookies']);
  return $fields;
}

add_filter( 'comment_form_default_fields', 'remove_fields' );

// This function change the cookies consent text
// Default text => 'Save my name, email, and website in this browser for the next time I comment.'
// function change_cookies_consent_text( $fields ) {
//   if ( !is_admin() ) {
//     $commenter = wp_get_current_commenter();
//     $consent   = empty( $commenter['comment_author_email'] ) ? '' : ' checked="checked"';
//     $fields['cookies'] = '<p class="comment-form-cookies-consent"><input id="wp-comment-cookies-consent" name="wp-comment-cookies-consent" type="checkbox" value="yes"' . $consent . ' />' . '<label for="wp-comment-cookies-consent">' . __(' Enregistrer mes informations pour mon prochain commentaire', 'textdomain').'</label></p>';
//   }

//   return $fields;
// }
  
// add_filter( 'comment_form_default_fields', 'change_cookies_consent_text' );

// Add custom meta (ratings) fields to the default comment form
// Default comment form includes name, email address and website URL
// Default comment form elements are hidden when user is logged in
function custom_fields($fields) {
  $commenter = wp_get_current_commenter();
  $req = get_option( 'require_name_email' );
  $aria_req = ( $req ? " required" : "" );

  $fields[ 'author' ] = '<p class="comment-form-author">' . '<label for="author">' . __( 'Name' ) . '</label>' . ( $req ? '<span class="required">*</span>' : "" ) . '<input id="author" name="author" type="text" value="' . esc_attr( $commenter['comment_author'] ) . '"' . $aria_req . ' /></p>';

  $fields[ 'email' ] = '<p class="comment-form-email">' . '<label for="email">' . __( 'Email' ) . '</label>' . ( $req ? '<span class="required">*</span>' : "" ) . '<input id="email" name="email" type="email" value="' . esc_attr( $commenter['comment_author_email'] ) . '"' . $aria_req . ' /></p>';

  // $fields[ 'url' ] = '<p class="comment-form-url">' . '<label for="url">' . __( 'Website' ) . '</label>' . '<input id="url" name="url" type="text" value="' . esc_attr( $commenter['comment_author_url'] ) . '" size="30" tabindex="3" /></p>';

  // $fields[ 'phone' ] = '<p class="comment-form-phone">' . '<label for="phone">' . __( 'Phone' ) . '</label>' . '<input id="phone" name="phone" type="text" size="30" tabindex="4" /></p>';

  return $fields;
}

add_filter('comment_form_default_fields', 'custom_fields');

// Add fields after default fields above the comment box, always visible
function additional_fields () {
  // echo '<p class="comment-form-title">' . '<label for="title">' . __( 'Comment Title' ) . '</label>' . '<input id="title" name="title" type="text" size="30" tabindex="5" /></p>';

  echo '<p class="comment-form-rating">' . '<label for="rating">' . __('Note') . '</label><span class="commentratingbox">';

  //Current rating scale is 1 to 5. If you want the scale to be 1 to 10, then set the value of $i to 10.
  for ($i=5; $i >= 1 ; $i--) 
  echo '<input type="radio" name="rating" id="rating-' . $i . '"' . 'value="' . $i . '"/><label for="rating-' . $i . '" class="fa fa-star"></label>';

  echo'</span></p>';
}

// add_action( 'comment_form_logged_in_after', 'additional_fields' );
add_action( 'comment_form_after_fields', 'additional_fields' );

// Save the comment meta data along with comment
function save_comment_meta_data( $comment_id ) {
  // if ( ( isset( $_POST['phone'] ) ) && ( $_POST['phone'] != "") )
  // $phone = wp_filter_nohtml_kses($_POST['phone']);
  // add_comment_meta( $comment_id, 'phone', $phone );

  // if ( ( isset( $_POST['title'] ) ) && ( $_POST['title'] != "") )
  // $title = wp_filter_nohtml_kses($_POST['title']);
  // add_comment_meta( $comment_id, 'title', $title );

  if ( ( isset( $_POST['rating'] ) ) && ( $_POST['rating'] != "") )
  $rating = wp_filter_nohtml_kses($_POST['rating']);
  add_comment_meta( $comment_id, 'rating', $rating );
}

add_action( 'comment_post', 'save_comment_meta_data' );

// Add the filter to check whether the comment meta data has been filled
// function verify_comment_meta_data( $commentdata ) {
//   if ( ! isset( $_POST['rating'] ) )
//   wp_die( __( 'Error: You did not add a rating. Hit the Back button on your Web browser and resubmit your comment with a rating.' ) );
//   return $commentdata;
// }

// add_filter( 'preprocess_comment', 'verify_comment_meta_data' );

// Add the comment meta (saved earlier) to the comment text
// You can also output the comment meta values directly to the comments template  
function modify_comment( $text ){
  if ( $commentrating = get_comment_meta( get_comment_ID(), 'rating', true) ) {
    echo '<div class="comment-rating">';
    switch ($commentrating) {
      case 1:
        // echo "rating equals 1 star";
        echo '<i class="fa fa-star" aria-hidden="true"></i>';
        break;
      case 2:
        echo '<i class="fa fa-star" aria-hidden="true"></i>
              <i class="fa fa-star" aria-hidden="true"></i>';
        break;
      case 3:
        echo '<i class="fa fa-star" aria-hidden="true"></i>
              <i class="fa fa-star" aria-hidden="true"></i>
              <i class="fa fa-star" aria-hidden="true"></i>';
        break;
      case 4:
        echo '<i class="fa fa-star" aria-hidden="true"></i>
              <i class="fa fa-star" aria-hidden="true"></i>
              <i class="fa fa-star" aria-hidden="true"></i>
              <i class="fa fa-star" aria-hidden="true"></i>';
        break;
      case 5:
        echo '<i class="fa fa-star" aria-hidden="true"></i>
              <i class="fa fa-star" aria-hidden="true"></i>
              <i class="fa fa-star" aria-hidden="true"></i>
              <i class="fa fa-star" aria-hidden="true"></i>
              <i class="fa fa-star" aria-hidden="true"></i>';
        break;
    }
    echo '</div>';

    return $text;
  } 
  else {
    return $text;
  }
}

add_filter( 'comment_text', 'modify_comment');

// Add the reply form directly on the desired comment
function enqueue_comment_reply_script () {
  if ( get_option( 'thread_comments' ) ) {
    // Load comment-reply.js
    wp_enqueue_script( 'comment-reply', '/wp-includes/js/comment-reply.min.js', array(), false, true );
  }
}

add_action( 'comment_form_before', 'enqueue_comment_reply_script' );