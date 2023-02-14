<?php get_header(); ?>
  <?php if (have_posts()): while (have_posts()): the_post(); ?>
    <h1><?php the_title(); ?></h1>
  <?php endwhile; endif; ?>

  <div class="options">
    <!-- Sorting System -->
    <div class="sort">
      <a href="<?php get_permalink($post->name); ?>?sort=date_asc">les plus anciens</a>
      <a href="<?php get_permalink($post->name); ?>?sort=price_asc">prix croissant</a>
      <a href="<?php get_permalink($post->name); ?>?sort=price_desc">prix décroissant</a>
      <!-- <a href="<?php get_permalink($post->name); ?>?sort=rate_desc">note croissant</a> -->

      <!-- If a sort has been applied, display a cancel button -->
      <?php if (isset($_GET['sort'])) : ?>
        <a href="<?php the_permalink($post->name); ?>">annuler le tri</a>
      <?php endif; ?>
    </div>

    <!-- Filter System -->
    <div class="filter">
      <?php
        // TODO => be careful to change the value of 'parent' = the id of the products category !!!
        $args = [
          'taxonomy' => 'category',
          'parent' => 10,
          'hide_empty' => false
        ];

        $categories = get_categories($args);

        // print_r($categories); 

        foreach ($categories as $category) {
          $category = $category->name;

          echo '<button>' . $category . '</button>';
        }
      ?>
    </div>
  </div>

  <div class="container">
    <?php  
      // Sort by date and price
      function custom_query_sort( $order, $sort_by, $meta_key, $meta_value ) {
        $args = array(
          'post_type' => 'post',
          'category_name' => 'products',
          'posts_per_page' => 12,
          'order' => $order,
          'orderby' => $sort_by,
          'meta_key' => $meta_key,
          'meta_value' => $meta_value,
          // 'meta_value_num' => $meta_value_num,
        );
      
        $query = new WP_Query( $args );
      
        if ( $query->have_posts() ) {
          while ( $query->have_posts() ) {
            $query->the_post();
            get_template_part('template-parts/products/article');
          }
        }
      
        wp_reset_postdata();
      }

      $order = '';
      $sort = '';
      $meta_key = '';
      $value = '';

      if ( isset( $_GET['sort'] ) ) {
        $sort = sanitize_text_field( $_GET['sort'] );

        switch ( $sort ) {
          case 'date_asc':
            $order = 'ASC';
            $meta_key = '';
            $value = '';
            break;
          case 'price_asc':
            $order = 'ASC';
            $meta_key = 'price';
            $value = '';
            $sort = 'meta_value_num';
            break;
          case 'price_desc':
            $order = 'DESC';
            $meta_key = 'price';
            $value = '';
            $sort = 'meta_value_num';
            break;
          // case 'rate_desc':
          //   $order = 'DESC';
          //   $meta_key = 'rating';
          //   $value = '';
          //   $sort = 'rating';
          //   break;
          default:
            $order = 'DESC';
            $meta_key = '';
        }
      }

      custom_query_sort( $order, $sort, $meta_key, $value );
    ?>
  </div>    
<?php get_footer(); ?>