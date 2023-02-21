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

        $parent_categories = get_categories($args);

        // print_r($parent_categories); 

        foreach ($parent_categories as $parent_category) {
          $parent_name = $parent_category->name;
          $parent_id = $parent_category->cat_ID;

          // print_r($parent_name);
          // print_r($parent_id);

          echo '<div>
                  <span>
                    <div>
                      <div><p>' . $parent_name . '&nbsp;</p><div class="count"></div></div>
                      <div id="dropdown"><i class="fa fa-chevron-down" aria-hidden="true"></i></div>
                    </div>
                  </span>
                </div>';

          // echo '<div class="item">
          //         <label for="green">Green</label>
          //         <input id="green" type="checkbox" value="Green">
          //       </div>';

          // echo '<button>' . $parent_category . '</button>';

          // TODO => be careful to change the value of 'parent' = the id of the children categories !!!
          $args = [
            'taxonomy' => 'category',
            'parent' => $parent_id,
            'hide_empty' => false
          ];

          $child_categories = get_categories($args);

          foreach ($child_categories as $child_category) {
            echo '<div class="collapsible is-closed">
                    <label for="' . $child_category->name . '">' . $child_category->name . '</label>
                    <input id="' . $child_category->name . '" type="checkbox" value="' . $child_category->name . '">
                  </div>';
          }
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