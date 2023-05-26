  <!-- Skills -->
  <section class="skills">
    <?php  
      $args = [
        'post_type' => 'post',
        'category_name' => 'home+skills',
      ];
        
      $wpqueryArticles = new WP_Query($args);
    ?>

    <?php if ($wpqueryArticles->have_posts()): while ($wpqueryArticles->have_posts()): $wpqueryArticles->the_post(); ?>
      <div class="triangle top-left"></div>

      <h2><?php the_title(); ?></h2>

      <div class="skills__content">
        <!-- <?php the_content(); ?> -->
      </div>

      <div class="skills__icon">
        <div>
          <?php
            $image_1 = get_field('picture_1');
            
            if ($image_1) {
              $alt_1 = $image_1['alt'];
              echo '<img src="' . $image_1['url'] . '" alt="' . $alt_1 . '">';
            }
          ?>

          <span><?php the_field('name_1'); ?></span>
        </div>

        <div>
          <?php
            $image_2 = get_field('picture_2');

            if ($image_2) {
              $alt_2 = $image_2['alt'];
              echo '<img src="' . $image_2['url'] . '" alt="' . $alt_2 . '">';
            }
          ?>

          <span><?php the_field('name_2'); ?></span>
        </div>

        <div>
          <?php
            $image_3 = get_field('picture_3');

            if ($image_3) {
              $alt_3 = $image_3['alt'];
              echo '<img src="' . $image_3['url'] . '" alt="' . $alt_3 . '">';
            }
          ?>
          
          <span><?php the_field('name_3'); ?></span>
        </div>
      </div>

      <div class="triangle bottom-right"></div>
    <?php endwhile; endif; ?>
  </section>