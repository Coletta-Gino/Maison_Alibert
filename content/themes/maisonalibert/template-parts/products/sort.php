      <!-- Sorting system -->
        <!-- Categories -->
          <!-- <section class="sort"> -->
            <a href="<?php get_permalink($post->name); ?>?sort=date_asc">les plus anciens</a>
            <a href="<?php get_permalink($post->name); ?>?sort=price_desc">prix décroissant</a>
            <a href="<?php get_permalink($post->name); ?>?sort=price_asc">prix croissant</a>
            <!-- <a href="<?php get_permalink($post->name); ?>?sort=rate_desc">note croissant</a> -->

            <!-- If a sort has been applied, display a cancel button -->
            <?php if (isset($_GET['sort'])) : ?>
              <a href="<?php the_permalink($post->name); ?>">annuler le tri</a>
            <?php endif; ?>

            <!-- If a sort has been requested -->
            <?php
              if (!empty($_GET['sort'])) {
                // Fetch the selected sort
                $sort = trim($_GET['sort']);

                // Sorts
                global $wpdb;

                global $wp_query;

                // Sort by date asc - > +
                if ($sort == 'date_asc') {
                  $date = "SELECT * FROM wp_posts WHERE wp_posts.post_type = 'post' AND wp_posts.comment_count > 0 ORDER BY wp_posts.post_date ASC";

                  $date_asc_results = $wpdb->get_results($date, OBJECT_K);
                  // print_r($results);
                }
                // Sort by price desc + > - 
                elseif ($sort == 'price_desc') {
                  $price = "SELECT * FROM wp_postmeta WHERE wp_postmeta.meta_key = 'price' ORDER BY wp_postmeta.meta_value DESC";

                  $price_desc_results = $wpdb->get_results($price, OBJECT_K);
                  // print_r($results);
                }
                // Sort by price asc - > + 
                elseif ($sort == 'price_asc') {
                  $price = "SELECT * FROM wp_postmeta WHERE wp_postmeta.meta_key = 'price' ORDER BY wp_postmeta.meta_value ASC";

                  $price_asc_results = $wpdb->get_results($price, OBJECT_K);
                  // print_r($results);
                }
                // Sort by rate desc + > -
                // elseif ($sort == 'rate_desc') {
                //   $rates = "SELECT * FROM wp_commentmeta WHERE wp_commentmeta.meta_key = 'rating' AND wp_commentmeta.meta_value > 0 ORDER BY wp_commentmeta.meta_value DESC";

                //   $rate_desc_results = $wpdb->get_results($rates, OBJECT_K);
                //   // print_r($results);
                // }

                switch ( $wp_query->query_vars['filter'] ) {
                  case 'date_asc':
                    $args['orderby'] = $date_asc_results;                  
                    break;
                  case 'price_desc':
                    $args['orderby'] = $price_desc_results;                  
                    break;
                  case 'price_asc':
                    $args['orderby'] = $price_asc_results;                  
                    break;
                  case 'rate_desc':
                    $args['orderby'] = $rate_desc_results;                  
                    break;
                }
              }
            ?>
          <!-- </section> -->

          <?php
            // Filters
            // TODO => be careful to change the value of 'parent' = the id of the products category !!!
            $args = [
              'taxonomy' => 'category',
              'parent' => 10,
              'hide_empty' => false
            ];

            $categories = get_categories($args);

            // print_r($categories); 

            foreach ($categories as $category) {
              $category = $category->name;

              echo '<button>' . $category . '</button>';
            }
          ?>