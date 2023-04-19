      <!-- Social Media -->
      <ul class="social-media">
        <h4>Suivez-moi !</h4>

        <?php  
          $args = [
            'post_type' => 'post',
            'category_name' => 'footer+social-media',
          ];
      
          $wpqueryArticles = new WP_Query($args);
        ?>

        <?php if ($wpqueryArticles->have_posts()): while ($wpqueryArticles->have_posts()): $wpqueryArticles->the_post(); ?>
          <li><a href="<?php the_field('facebook');?>" title="Facebook"><i class="fa fa-facebook-square" aria-hidden="true"></i></a></li>
          <li><a href="<?php the_field('instagram'); ?>" title="Instagram"><i class="fa fa-instagram" aria-hidden="true"></i></a></li>
        <?php endwhile; endif; ?>
      </ul>