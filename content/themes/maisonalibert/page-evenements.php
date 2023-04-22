<?php get_header(); ?>
  <?php if (have_posts()): while (have_posts()): the_post(); ?>
    <h1><?php the_title(); ?></h1>
  <?php endwhile; endif; ?>

  <!-- Events -->
  <div class="events">
    <?php  
      $args = [
        'post_type' => 'post',
        'category_name' => 'events',
      ];
    
      $wpqueryArticles = new WP_Query($args);
    ?>

    <?php if ($wpqueryArticles->have_posts()): while ($wpqueryArticles->have_posts()): $wpqueryArticles->the_post(); ?>
      <article class="event">
        <?php the_content(); ?>

        <h2><?php the_title(); ?></h2>

        <div class="event__date">
          <strong>
            <p>
              <?php the_field('period_beginning'); ?> <?php the_field('date_beginning'); ?></br>
              <?php the_field('period_ending') ?> <?php the_field('date_ending'); ?>
            </p>
          </strong>
        </div>

        <div class="event__location">
          <p>
            <?php the_field('place'); ?></br>
            <?php the_field('address'); ?>,</br>
            <?php the_field('city'); ?>, <?php the_field('postcode'); ?>
          </p>
        </div>

        <div class="event__price">
          <p><?php the_field('event_price'); ?></p>
        </div>
      </article>
    <?php endwhile; endif; ?>
  </div>
<?php get_footer(); ?>