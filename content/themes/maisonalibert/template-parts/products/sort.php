      <!-- Sorting system -->
        <!-- Categories -->
          <!-- <section class="sort"> -->
            <!-- <a href="<?php bloginfo('url'); ?>/produits/?sort=date">tri par date</a>
            <a href="<?php bloginfo('url'); ?>/produits/?sort=note">tri par note</a>
            <a href="<?php bloginfo('url'); ?>/produits/?sort=price">tri par prix</a> -->

            <!-- If a sort has been applied, display a cancel button -->
            <!-- <?php if (isset($_GET['order'])) : ?>
              <a href="<?php bloginfo('url'); ?>/produits">annuler le tri</a>
            <?php endif; ?> -->

            <!-- If a sort has been requested -->
            <!-- <?php
              if (!empty($_GET['order'])) {
                // Fetch the selected sort
                $order = trim($_GET['order']);

                if ($order == 'date') {
                  $sql = "SELECT * FROM wp_posts WHERE wp_posts.post_type = 'post' ORDER BY wp_posts.post_date DESC";

                  global $wpdb;
                  $results = $wpdb->get_results($sql, OBJECT_K);
                  // print_r($results);
                }
                elseif ($order == 'rate') {
                  $sql = "SELECT * FROM wp_commentmeta WHERE wp_commentmeta.met_key = 'rating' AND wp_commentmeta.meta_value > 0 ORDER BY wp_commentmeta.meta_value DESC";
                }
                elseif ($order == 'price') {
                  $sql = "SELECT * FROM wp_postmeta WHERE wp_postmeta.meta_key = 'price' ORDER BY wp_postmeta.meta_value DESC";
                }
              }
            ?> -->
          <!-- </section> -->

          <?php
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
            

            <!-- Sort by price desc + > - -->
            <!-- <?php
              $price = "SELECT * FROM wp_postmeta WHERE wp_postmeta.meta_key = 'price' ORDER BY wp_postmeta.meta_value DESC";

              global $wpdb;
              $price_desc_results = $wpdb->get_results($price, OBJECT_K);
              // print_r($results);
            ?>

            <pre>
              <?php print_r($results); ?>
            </pre> -->

            <!-- Sort by price asc - > + -->
            <!-- <?php
              $price = "SELECT * FROM wp_postmeta WHERE wp_postmeta.meta_key = 'price' ORDER BY wp_postmeta.meta_value ASC";

              global $wpdb;
              $price_asc_results = $wpdb->get_results($price, OBJECT_K);
              // print_r($results);
            ?>

            <pre>
              <?php print_r($results); ?>
            </pre> -->

            <!-- Sort by date asc - > + -->
            <?php
              $date = "SELECT * FROM wp_posts WHERE wp_posts.post_type = 'post' AND wp_posts.comment_count > 0 ORDER BY wp_posts.post_date ASC";

              global $wpdb;
              $date_asc_results = $wpdb->get_results($date, OBJECT_K);
              // print_r($results);
            ?>

            <pre>
              <?php print_r($date_asc_results); ?>
            </pre>

            <!-- Sort by rate desc + > - -->
            <!-- <?php
              $rates = "SELECT * FROM wp_commentmeta WHERE wp_commentmeta.meta_key = 'rating' AND wp_commentmeta.meta_value > 0 ORDER BY wp_commentmeta.meta_value DESC";

              global $wpdb;
              $rate_desc_results = $wpdb->get_results($rates, OBJECT_K);
              // print_r($results);
            ?>

            <pre>
              <?php print_r($rate_desc_results); ?>
            </pre> -->