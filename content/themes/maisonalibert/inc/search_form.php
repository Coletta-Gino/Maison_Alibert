<?php 

function my_search_form($form) {
  $form = '<form role="search" method="get" id="searchform" class="searchform" action="' . home_url('/') . '" >
            <input type="search" placeholder="Chercher..." value="' . get_search_query() . '" name="s" id="s" />

            <button type="submit" id="searchsubmit"><i class="fa fa-search" aria-hidden="true"></i></button>
          </form>';

  return $form;
}

add_filter( 'get_search_form', 'my_search_form' );