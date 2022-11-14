<?php get_header(); ?>
  <?php if (have_posts()): while (have_posts()): the_post(); ?>
    <h1><?php the_title(); ?></h1>
  <?php endwhile; endif; ?>

  <!-- Sorting system -->
  <!-- Categories -->
  <!-- <section class="sort">
    <a href="index.php?order=espèce">
      <span>par espèce</span>
      <div class="wave"></div>
    </a>

    <a href="index.php?order=nombre">
      <span>par nombre</span>
      <div class="wave"></div>
    </a> -->

    <!-- Si un tri a été appliqué, on ajoute un bouton pour l'annuler et revenir à l'état de base -->
    <!-- <?php if (isset($_GET['order'])) : ?>
      <a href="index.php">
        <span>annuler le tri</span>
        <div class="wave"></div>
      </a>
    <?php endif; ?>
  </section> -->

  <!-- Get all the children categories -->
  <!-- <section class="categories">
    <button class="selected">Tous</button> -->

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
  <!-- </section> -->

  <button class="sorting">sort</button>
  <button class="filtering">filters</button>

  <div class="container">
    <?php  
      $args = [
        'post_type' => 'post',
        'category_name' => 'products',
      ];
          
      $wpqueryArticles = new WP_Query($args);
    ?>

    <?php if ($wpqueryArticles->have_posts()): while ($wpqueryArticles->have_posts()): $wpqueryArticles->the_post(); ?>
      <?php get_template_part('template-parts/products/test'); ?>
    <?php endwhile; endif; ?>

    <!-- TODO 0 : dynamization (WIP) -->
    <!-- TODO 1 : create loop with foreach (check) -->
    <!-- TODO 2 : link to the id of each article (href="[page-title].php?id= (check) -->
    <!-- <a class="product">
      <div class="product__image">
        <img src="" alt="">
      </div>

      <div class="product__infos">
        <div class="product__infos__rating">
          <i class="fa fa-star" aria-hidden="true"></i>
          <i class="fa fa-star" aria-hidden="true"></i>
          <i class="fa fa-star" aria-hidden="true"></i>
          <i class="fa fa-star" aria-hidden="true"></i>
          <i class="fa fa-star-half" aria-hidden="true"></i>
        </div>

        <h3>Product name</h3>

        <div class="product__infos__colors">
          <div></div>
          <div></div>
          <div></div>
          <div></div>
          <div></div>
          <div></div>
        </div>

        <p class="product__infos__price">12,99 €</p>

        <a href="#" class="view-more">View more</a>
      </div>
    </a> -->
  </div>    
<?php get_footer(); ?>