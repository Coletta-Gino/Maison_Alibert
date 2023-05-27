<?php

// Search Filter
function my_search_filter($query) {
  if (!is_admin()) {
    // TODO => be carreful to change the values of the id of all categories !!!
    if ($query->is_search) {
      // $query->set('post_type', 'posts'); // to exclude posts
      $query->set('category__not_in', array(1, 31, 26, 4)); // to exclude 'uncategorized', 'events', 'footer', 'home'
    }

    return $query;
  }
}

add_filter('pre_get_posts','my_search_filter');