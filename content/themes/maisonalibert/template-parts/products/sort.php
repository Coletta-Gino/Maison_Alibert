      <!-- Sorting system -->
        <!-- Categories -->
          <!-- <section class="sort"> -->
            <a href="<?php bloginfo('url'); ?>/produits/?sort=date">tri par date</a>
            <a href="<?php bloginfo('url'); ?>/produits/?sort=note">tri par note</a>
            <a href="<?php bloginfo('url'); ?>/produits/?sort=price">tri par prix</a>

            <!-- If a sort has been applied, display a cancel button -->
            <?php if (isset($_GET['order'])) : ?>
              <a href="<?php bloginfo('url'); ?>/produits">annuler le tri</a>
            <?php endif; ?>

            <!-- If a sort has been requested -->
            <?php
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
            ?>
          <!-- </section> -->