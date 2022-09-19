  <!-- Events/Promotions -->
  <?php 
    // TODO => be careful to change the value of 23 = the id of the special event's article !!!
    if (get_field('status', 23)) {
      $value = '';
    } 
    else {
      $value = ' finished';
    }
  ?>

  <div class="special-event<?php echo $value; ?>">
    <a href="#"><i class="fa fa-pause-circle-o fa-2x" aria-hidden="true" title="Stopper/Lancer l'animation"></i></a>

    <div class="special-event__items offer">
      <div class="special-event__items__single">
      <?php  
        $args = [
          'post_type' => 'post',
          'category_name' => 'header+events',
        ];
          
        $wpqueryArticles = new WP_Query($args);
      ?>

      <?php if ($wpqueryArticles->have_posts()): while ($wpqueryArticles->have_posts()): $wpqueryArticles->the_post(); ?>
        <strong><?php the_field('name'); ?></strong>
        <i class="fa <?php the_field('icon'); ?>" aria-hidden="true"></i>
        <span>
          <p><?php the_field('period_beginning'); ?></p>
          <p><?php the_field('date_beginning'); ?></p>
          <p><?php the_field('period_ending') ?></p>
          <p><?php the_field('date_ending'); ?></p>
        </span>
      <?php endwhile; endif; ?>
      </div>
    </div>
  </div>