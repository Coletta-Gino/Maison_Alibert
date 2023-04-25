  <!-- Introduction -->
  <section class="intro">
    <?php  
      $args = [
        'post_type' => 'post',
        'category_name' => 'home+intro',
      ];
        
      $wpqueryArticles = new WP_Query($args);
    ?>

    <?php if ($wpqueryArticles->have_posts()): while ($wpqueryArticles->have_posts()): $wpqueryArticles->the_post(); ?>
      <div class="triangle top-left"></div>

      <h2><?php the_title(); ?></h2>

      <div class="intro__content">
        <?php the_content(); ?>
      </div>

      <div class="intro__picture">
        <?php the_post_thumbnail(); ?>
      </div>

      <div class="triangle bottom-right"></div>
    <?php endwhile; endif; ?>
  </section>