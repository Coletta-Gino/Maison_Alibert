<?php get_header(); ?>
  <?php if (have_posts()): while (have_posts()): the_post(); ?>
    <h1><?php the_title(); ?></h1>
  <?php endwhile; endif; ?>

  <!-- Categories -->
  <button class="sorting">sort</button>
  <button class="filtering">filters</button>

  <div class="container">
    <article class="product">
      <div class="product__image">
        <img src="" alt="">
      </div>

      <div class="product__infos">
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
    </article>

    <article class="product">
      <div class="product__image">
        <img src="" alt="">
      </div>

      <div class="product__infos">
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
    </article>

    <article class="product">
      <div class="product__image">
        <img src="" alt="">
      </div>

      <div class="product__infos">
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
    </article>

    <article class="product">
      <div class="product__image">
        <img src="" alt="">
      </div>

      <div class="product__infos">
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
    </article>
  </div>
























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

  <!-- <div class="container"> -->
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
  <!-- </div> -->
<?php get_footer(); ?>