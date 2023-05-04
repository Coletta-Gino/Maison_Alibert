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
          <i class="fa <?php the_field('icon_1');?>" aria-hidden="true"></i>
          <span><?php the_field('name_1');?></span>
        </div>

        <div>
          <i class="fa <?php the_field('icon_2');?>" aria-hidden="true"></i>
          <span><?php the_field('name_2');?></span>
        </div>

        <div>
          <i class="fa <?php the_field('icon_3');?>" aria-hidden="true"></i>
          <span><?php the_field('name_3');?></span>
        </div>
      </div>

      <div class="triangle bottom-right"></div>
    <?php endwhile; endif; ?>
  </section>