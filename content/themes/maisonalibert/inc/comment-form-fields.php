<?php 

// This function remove the website field of the comment form 
function remove_website_field( $fields ) {
  unset( $fields['url'] );
  return $fields;
}

add_filter( 'comment_form_default_fields', 'remove_website_field' );

// This function change the cookies consent text
// Default text => 'Save my name, email, and website in this browser for the next time I comment.'
function change_cookies_consent_text( $fields ) {
  if ( !is_admin() ) {
    $commenter = wp_get_current_commenter();
    $consent   = empty( $commenter['comment_author_email'] ) ? '' : ' checked="checked"';
    $fields['cookies'] = '<p class="comment-form-cookies-consent"><input id="wp-comment-cookies-consent" name="wp-comment-cookies-consent" type="checkbox" value="yes"' . $consent . ' />' . '<label for="wp-comment-cookies-consent">' . __(' Se souvenir de moi!', 'textdomain').'</label></p>';
  }

  return $fields;
}
  
add_filter( 'comment_form_default_fields', 'change_cookies_consent_text' );

// TODO : add the rating stars system on the comment form
// This function add the rating stars field on the comment form 
function add_rating_field( $fields ) {
  $fields['test'] = '<p>' . '<label>' . __('Test') . '</label>' . '</p>';
  return $fields;
}
  
add_filter( 'comment_form_default_fields', 'add_rating_field' );