<?php get_header(); ?>
  <?php if (have_posts()): while (have_posts()): the_post(); ?>
    <h1><?php the_title(); ?></h1>
  <?php endwhile; endif; ?>

  <!-- Categories -->
  <section class="categories">
    <button class="selected">Tous</button>

    <?php
      // TODO => be careful to change the value of 'parent' = the id of the ephemerals category !!!
      $args = [
        'taxonomy' => 'category',
        'parent' => 8,
        'hide_empty' => false
      ];

      $categories = get_categories($args);

      foreach ($categories as $category) {
        $category = $category->name;

        echo '<button>' . $category . '</button>';
      }
    ?>
  </section>

  <div class="container">
    <?php  
      $args = [
        'post_type' => 'post',
        'category_name' => 'ephemeral',
        'orderby' => 'rand',
      ];
          
      $wpqueryArticles = new WP_Query($args);
    ?>

    <?php if ($wpqueryArticles->have_posts()): while ($wpqueryArticles->have_posts()): $wpqueryArticles->the_post(); ?>
      <?php get_template_part('template-parts/products/ephemerals'); ?>
    <?php endwhile; endif; ?>    
  </div>
<?php get_footer(); ?>