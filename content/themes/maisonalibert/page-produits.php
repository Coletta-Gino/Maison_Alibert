<?php get_header(); ?>
  <?php if (have_posts()): while (have_posts()): the_post(); ?>
    <h1><?php the_title(); ?></h1>
  <?php endwhile; endif; ?>

  <div class="options">
    <!-- Filter System -->
    <div class="filter">
      <button class="selected" data-category="all">Tous</button>

      <?php
        // TODO => be careful to change the value of 'parent' = the id of the products category !!!
        $args = [
          'taxonomy' => 'category',
          'parent' => 10,
          'hide_empty' => false
        ];

        $categories = get_categories($args);

        foreach ($categories as $category) {
          $category_slug = $category->slug;
          $category_name = $category->name;
          $active_class = $category_slug === $category ? 'selected' : '';
          echo '<button class="' . $active_class . '" data-category="' . $category_slug . '">' . $category_name . '</button>';
        }
      ?>
    </div>

    <!-- Sort System -->
    <div class="sort">
      <a href="<?= add_query_arg( 'sort', 'date_asc' ); ?>">les plus anciens</a>
      <a href="<?= add_query_arg( 'sort', 'price_asc' ); ?>">prix croissant</a>
      <a href="<?= add_query_arg( 'sort', 'price_desc' ); ?>">prix décroissant</a>

      <?php if ( isset( $_GET['sort'] ) ) : ?>
        <a href="<?= remove_query_arg( 'sort' ); ?>">annuler le tri</a>
      <?php endif; ?>
    </div>
  </div>

  <div class="container">
    <?php 
      // To select a category in order to filter the posts
      $category = isset( $_GET['category'] ) ? sanitize_text_field( $_GET['category'] ) : 'all'; 

      // Display the posts and sort them by date and price
      function custom_query_sort( $posts_per_page, $order, $sort_by, $meta_key, $meta_value, $offset, $current_page, $category ) {
        $args = array(
          'post_type' => 'post',
          'category_name' => 'products',
          'posts_per_page' => $posts_per_page,
          'order' => $order,
          'orderby' => $sort_by,
          'meta_key' => $meta_key,
          'meta_value' => $meta_value,
          'offset' => $offset,
          'paged' => $current_page,
        );

        if ( $category !== 'all' ) {
          $args['tax_query'] = array(
            array(
              'taxonomy' => 'category',
              'field' => 'slug',
              'terms' => $category,
            ),
          );
        }
      
        $query = new WP_Query( $args );
      
        if ( $query->have_posts() ) {
          while ( $query->have_posts() ) {
            $query->the_post();
            get_template_part('template-parts/products/article');
          }
        }
      
        wp_reset_postdata();
      }

      // Retrieve the total number of posts
      $total_posts = wp_count_posts()->publish;

      // Set the number of posts per page
      $posts_per_page = 12;

      // Calculate the number of pages
      $total_pages = ceil($total_posts / $posts_per_page);

      // Initialize variables
      $order = '';
      $sort = '';
      $meta_key = '';
      $value = '';

      // Retrieve the current page number
      $current_page = get_query_var('paged') ? get_query_var('paged') : 1;

      // Set the offset
      $offset = ($current_page - 1) * $posts_per_page; 

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

      custom_query_sort( $posts_per_page, $order, $sort, $meta_key, $value, $offset, $current_page, $category ); 
    ?>
  </div>  
  
  <?php
    // Display the pagination links
    $pagination = paginate_links(array(
      'base' => home_url( '/produits/page/%#%/' ),
      'format' => '?sort=' . $sort . '&page=%#%&category=' . $category,
      'current' => $current_page,
      'total' => $total_pages,
      'prev_text' => '&laquo;',
      'next_text' => '&raquo;',
      'type' => 'list'
    ));
  
    if ($pagination) {
      echo '<div class="pagination">' . $pagination . '</div>';
    }
  ?>
<?php get_footer(); ?>