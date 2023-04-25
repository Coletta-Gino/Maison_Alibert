      <?php
        $categories = get_the_category();
        foreach ($categories as $category) {
          if ( $category->category_parent > 0 ) {
            // This is a child category
            $child_category = get_term( $category, 'category' );
            $slug = $child_category->slug;
          }
        }
      ?>
      
      <article class="product" id="product-<?php the_ID(); ?>" data-category="<?= $slug; ?>">
        <div class="triangle top-left"></div>
        
        <div class="product__image">
          <?php the_post_thumbnail(); ?>
        </div>

        <div class="product__infos">
          <div class="product__infos__rating">
            <?php
              if (get_comments_number() >= 1) {
                $average_rating = 0;
                $total_review = 0;
                $five_star_review = 0;
                $four_star_review = 0;
                $three_star_review = 0;
                $two_star_review = 0;
                $one_star_review = 0;
                $total_user_rating = 0;
  
                $query = "SELECT wp_comments.comment_author, wp_comments.comment_date, wp_comments.comment_content, wp_commentmeta.meta_key, wp_commentmeta.meta_value FROM wp_comments INNER JOIN wp_commentmeta ON wp_comments.comment_ID=wp_commentmeta.comment_ID WHERE wp_commentmeta.meta_key = 'rating' AND wp_commentmeta.meta_value > 0 AND wp_comments.comment_post_ID = $post->ID";
  
                global $wpdb;
                $results = $wpdb->get_results($query, OBJECT_K);
  
                foreach ($results as $row) {
                  if ($row->meta_value == '5') {
                    $five_star_review++;
                  }
              
                  if ($row->meta_value == '4') {
                    $four_star_review++;
                  }
              
                  if ($row->meta_value == '3') {
                    $three_star_review++;
                  }
              
                  if ($row->meta_value == '2') {
                    $two_star_review++;
                  }
              
                  if ($row->meta_value == '1') {
                    $one_star_review++;
                  }
              
                  $total_review++;
              
                  $total_user_rating = $total_user_rating + $row->meta_value;
                } 
  
                $average_rating = $total_user_rating / $total_review;
  
                // To display the final version of the average rating value
                // Explode the number to get its integer and floating part
                $final_rating = explode(".", number_format($average_rating, 1));
  
                $star_full = '<i class="fa fa-star" aria-hidden="true"></i>';
                $star_half = '<i class="fa fa-star-half" aria-hidden="true"></i>';
  
                // To display the number of stars based on the integer part of the average rating value
                for ($stars_nb = 1; $stars_nb <= $final_rating[0]; $stars_nb++) {
                  echo $star_full;
                }
  
                // If the average rating value contains a floating part, add half a star
                if (!empty($final_rating[1])) {
                  if ($final_rating[1] >= 2 && $final_rating[1] <= 8) {
                    echo $star_half;
                  }
                }
  
                echo '<span id="total_review">&#8239;(' . get_comments_number() . ')</span>';
              }
            ?>
          </div>

          <?php if ( ! function_exists( 'maisonalibert_the_title' ) ) {
	          function maisonalibert_the_title($class = 'product__infos__name', $link = TRUE) {
		          $title_before = '<h3' . ' class="' . $class . '">';
		          $title_after = '</h3>';

		          if ($link === TRUE) {
			          $output = the_title( sprintf( $title_before . '<a href="%s">', esc_url( get_permalink() ) ), '</a>' . $title_after );
		          } 
              else {
			          $output = $title_before . get_the_title() . $title_after;
		          }

		          echo $output;
	          }
          } ?>

          <?php if ( is_single() ) : ?>
		        <?php maisonalibert_the_title('product__infos__name', false); ?>
		      <?php else : ?>
		        <?php maisonalibert_the_title('product__infos__name'); ?>
		      <?php endif; ?>

          <div class="product__infos__colors">
            <?php 
              $colors = array(
                get_field_object('color_1'),
                get_field_object('color_2'),
                get_field_object('color_3'),
                get_field_object('color_4'),
                get_field_object('color_5')
              );

              if (!empty($colors)) : ?>
                <?php foreach($colors as $color) : ?>
                  <?php if ($color['value']) : ?>
                    <div style="background-color:<?= $color['value']; ?>"></div>
                  <?php endif; ?>
                <?php endforeach; ?>
              <?php endif; ?>
          </div>

          <p class="product__infos__price"><?php $price = get_field_object('price'); echo $price['value']; ?>&#8239;€</p>
        </div>

        <div class="triangle bottom-right"></div>
      </article>