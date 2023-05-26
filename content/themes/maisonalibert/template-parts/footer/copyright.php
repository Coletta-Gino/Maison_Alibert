      <!-- Copyright -->
      <div class="copyright">
        <?php  
          $args = [
            'post_type' => 'post',
            'category_name' => 'footer+copyright',
          ];
      
          $wpqueryArticles = new WP_Query($args);
        ?>

        <?php if ($wpqueryArticles->have_posts()): while ($wpqueryArticles->have_posts()): $wpqueryArticles->the_post(); ?>
          <?php $copyright = get_field_object('copyright'); ?>
          <p><i class="fa fa-copyright" aria-hidden="true"></i> <span id="year"></span> - <a href="mailto:<?php the_field('copyright'); ?>?subject=" class="needle-link-alt"><?= esc_attr($copyright['default_value']); ?></a>, Tous droits réservés</p>
        <?php endwhile; endif; ?>
      </div>