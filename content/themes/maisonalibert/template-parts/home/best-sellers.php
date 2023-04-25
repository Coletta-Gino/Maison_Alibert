  <!-- Best Sellers -->
  <section class="best-sellers">
    <?php  
      $args = [
        'post_type' => 'post',
        'category_name' => 'home+best-sellers',
      ];
        
      $wpqueryArticles = new WP_Query($args);
    ?>

    <?php if ($wpqueryArticles->have_posts()): while ($wpqueryArticles->have_posts()): $wpqueryArticles->the_post(); ?>
      <h2><?php the_title(); ?></h2>

      <div class="best-sellers__content">
        <!-- <?php the_content(); ?> -->
      </div>

      <div class="best-sellers__items">
        <!-- Products -->
        <div class="products">
          <?php 
            $args = array(
              'post_type' => 'post',
              'category_name' => 'products',
              'posts_per_page' => 4,
              'order' => 'DESC',
            );
          
            $query = new WP_Query( $args );
          
            if ( $query->have_posts() ) {
              while ( $query->have_posts() ) {
                $query->the_post();
                get_template_part('template-parts/products/article');
              }
            }
          
            wp_reset_postdata();
          ?>
        </div>
      </div>

      <div class="best-sellers__cta">
        <!-- TODO => be careful to change the value of 'get_permalink' = the id of the products page !!! -->
        <a href="<?= get_permalink(2); ?>">Voir tous les produits</a>
      </div>
    <?php endwhile; endif; ?>
  </section>