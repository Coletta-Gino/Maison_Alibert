<?php get_header(); ?>
  <?php if (have_posts()): while (have_posts()): the_post(); ?>
    <h1><?php the_title(); ?></h1>
  <?php endwhile; endif; ?>


  

  <div class="options">
    <div class="sort">
      <a href="<?= add_query_arg( 'sort', 'date_asc' ); ?>">les plus anciens</a>
      <a href="<?= add_query_arg( 'sort', 'price_asc' ); ?>">prix croissant</a>
      <a href="<?= add_query_arg( 'sort', 'price_desc' ); ?>">prix décroissant</a>

      <?php if ( isset( $_GET['sort'] ) ) : ?>
        <a href="<?= remove_query_arg( 'sort' ); ?>">annuler le tri</a>
      <?php endif; ?>
    </div>

    <!-- Filter System -->
    <div class="filter">
      <div class="filter__choices">
        <!-- data-att="< $category = get_the_category(); echo esc_attr($category[0]->slug); ?>" -->
        <?php
          // TODO => be careful to change the value of 'parent' = the id of the products category !!!
          $args = [
            'taxonomy' => 'category',
            'parent' => 10,
            'hide_empty' => false
          ];

          $parent_categories = get_categories($args);

          foreach ($parent_categories as $parent_category) {
            $parent_name = $parent_category->name;
            $parent_id = $parent_category->cat_ID;

            echo '<div class="category">
                    <span>
                      <div>
                        <div>
                          <p>' . $parent_name . '&nbsp;</p>
                          <div class="count"></div>
                        </div>

                        <div id="btn" class="btn">
                          <i class="fa fa-chevron-down" id="arrow" aria-hidden="true"></i>
                        </div>
                      </div>
                    </span>';

            // TODO => be careful to change the value of 'parent' = the id of the children categories !!!
            $args = [
              'taxonomy' => 'category',
              'parent' => $parent_id,
              'hide_empty' => false
            ];

            $child_categories = get_categories($args);

            echo '<div class="subcategories">';

            foreach ($child_categories as $child_category) {
              echo '<div class="dropdown" id="dropdown">
                      <div>
                        <label for="' . $child_category->name . '">' . $child_category->name . '</label>
                        <input id="' . $child_category->name . '" type="checkbox" value="' . $child_category->name . '">
                      </div>
                    </div>';
            }

            echo '</div></div>';
          }
        ?>
      </div>
    </div>
  </div>

  <div class="container">
    <?php  
      // Display the posts and sort them by date and price
      function custom_query_sort( $posts_per_page, $order, $sort_by, $meta_key, $meta_value, $offset, $current_page ) {
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

      custom_query_sort( $posts_per_page, $order, $sort, $meta_key, $value, $offset, $current_page );

      // Display the pagination links
      $pagination = paginate_links(array(
        'base' => home_url( '/produits/page/%#%/' ),
        'format' => '?sort=' . $sort . '&page=%#%',
        // 'format' => '?page=%#%&sort=' . $sort,
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
  </div>    
<?php get_footer(); ?>