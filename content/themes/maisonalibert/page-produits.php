<?php get_header(); ?>
  <?php if (have_posts()): while (have_posts()): the_post(); ?>
    <h1><?php the_title(); ?></h1>
  <?php endwhile; endif; ?>

  <?php require_once('content/themes/maisonalibert/template-parts/products/sort.php'); ?>

  <!-- <button class="sorting">sort</button> -->
  <button class="filtering">filters</button>

  <div class="container">
    <?php  
      $args = [
        'post_type' => 'post',
        'category_name' => 'products',
        // 'orderby' => 'rand',
      ];
          
      $wpqueryArticles = new WP_Query($args);
    ?>

    <?php if ($wpqueryArticles->have_posts()): while ($wpqueryArticles->have_posts()): $wpqueryArticles->the_post(); ?>
      <?php get_template_part('template-parts/products/article'); ?>
    <?php endwhile; endif; ?>
  </div>    
<?php get_footer(); ?>