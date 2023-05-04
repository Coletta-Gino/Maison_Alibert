      <!-- Contact -->
      <ul class="contact">
        <h4>Contactez-moi !</h4>

        <?php  
          $args = [
            'post_type' => 'post',
            'category_name' => 'footer+contact',
          ];
      
          $wpqueryArticles = new WP_Query($args);
        ?>

        <?php if ($wpqueryArticles->have_posts()): while ($wpqueryArticles->have_posts()): $wpqueryArticles->the_post(); ?>
          <!-- ?subject=[content] to pre-fill mail's object -->
          <!-- %20 to space out the words -->
          <!-- & to add informations like body, cc, bcc, etc -->
          <!-- body=[content] to allow the user to directly write the content of his message -->
          <li>
            <i class="fa fa-envelope" aria-hidden="true"></i>
            <a href="mailto:<?php the_field('mail'); ?>?subject=Mail%20Envoyé%20Depuis%20Le%20Site&body=" title="Mail" class="needle-link-alt">contact@maisonalibert.fr<span class="needle">&#129697;</span></a>
          </li>

          <li>
            <i class="fa fa-phone" aria-hidden="true"></i>
            <a href="tel:+<?php the_field('phone_number'); ?>" title="Téléphone" class="needle-link-alt">06 46 00 87 08<span class="needle">&#129697;</span></a>
          </li>
        <?php endwhile; endif; ?>
      </ul>