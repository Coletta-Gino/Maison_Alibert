  <section id="comments" class="comments-area">
    <h2>Avis</h2>
    
    <?php if ( get_comments_number($post->ID) > 0 ) : ?>
      <!-- Global Reviews & Rating Div -->
      <div class="comments-area__summary">
        <!-- Total Reviews + Average -->
        <div class="total-reviews-average">
          <?php
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
            // print_r($results);

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
          ?>

          <h2>
            <span id="average_rating">
              <?php
                // To display the final version of the average rating value
                // Explode the number to get its integer and floating part
                $final_rating = explode(".", number_format($average_rating, 1));

                // $final_rating[0] => integer part
                // $final_rating[1] => float part
                // If the floating part is equal to 0, don't display it
                if ($final_rating[1] == 0) {
                  $final_rating = number_format($average_rating, 0);

                  echo $final_rating;
                }
                else {
                  echo $final_rating[0] . ',' . $final_rating[1];
                }
              ?>
            </span>&#8239;/ 5
          </h2>

          <div class="stars">
            <?php
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
            ?>
          </div>

          <h3>
            <?php
              if (get_comments_number() > 1) {
                echo '<span id="total_review">' . get_comments_number() . ' commentaires</span>';
              }
              else {
                echo '<span id="total_review">' . get_comments_number() . ' commentaire</span>';
              }
            ?>
          </h3>
        </div>

        <!-- Reviews Details -->
        <div class="reviews-details">
          <!-- 5 -->
          <div class="reviews-details__5">
            <!-- Value -->
            <div class="column">
              <b>5</b><i class="fa fa-star" aria-hidden="true"></i>
            </div>

            <!-- Progress Bar -->
            <div class="column">
              <progress class="progress" id="five_star_progress" value="<?= ($five_star_review / $total_review) * 100; ?>" max="100"></progress>
            </div>

            <!-- Number Of Reviews -->
            <div class="column">
              (<span id="total_five_star_review"><?= $five_star_review; ?></span>)
            </div>
          </div>

          <!-- 4 -->
          <div class="reviews-details__4">
            <!-- Value -->
            <div class="column">
              <b>4</b><i class="fa fa-star" aria-hidden="true"></i>
            </div>

            <!-- Progress Bar -->
            <div class="column">
              <progress class="progress" id="four_star_progress" value="<?= ($four_star_review / $total_review) * 100; ?>" max="100"></progress>
            </div>

            <!-- Number Of Reviews -->
            <div class="column">
              (<span id="total_four_star_review"><?= $four_star_review; ?></span>)
            </div>
          </div>

          <!-- 3 -->
          <div class="reviews-details__3">
            <!-- Value -->
            <div class="column">
              <b>3</b><i class="fa fa-star" aria-hidden="true"></i>
            </div>

            <!-- Progress Bar -->
            <div class="column">
              <progress class="progress" id="three_star_progress" value="<?= ($three_star_review / $total_review) * 100; ?>" max="100"></progress>
            </div>

            <!-- Number Of Reviews -->
            <div class="column">
              (<span id="total_three_star_review"><?= $three_star_review; ?></span>)
            </div>
          </div>

          <!-- 2 -->
          <div class="reviews-details__2">
            <!-- Value -->
            <div class="column">
              <b>2</b><i class="fa fa-star" aria-hidden="true"></i>
            </div>

            <!-- Progress Bar -->
            <div class="column">
              <progress class="progress" id="two_star_progress" value="<?= ($two_star_review / $total_review) * 100; ?>" max="100"></progress>
            </div>

            <!-- Number Of Reviews -->
            <div class="column">
              (<span id="total_two_star_review"><?= $two_star_review; ?></span>)
            </div>
          </div>

          <!-- 1 -->
          <div class="reviews-details__1">
            <!-- Value -->
            <div class="column">
              <b>1</b><i class="fa fa-star" aria-hidden="true"></i>
            </div>

            <!-- Progress Bar -->
            <div class="column">
              <progress class="progress" id="one_star_progress" value="<?= ($one_star_review / $total_review) * 100; ?>" max="100"></progress>
            </div>

            <!-- Number Of Reviews -->
            <div class="column">
              (<span id="total_one_star_review"><?= $one_star_review; ?></span>)
            </div>
          </div>
        </div>

        <!-- Add Review -->
        <div class="add-review">
          <h3>Donnez votre avis ici</h3>

          <a href="#respond">Ajouter un commentaire</a>
        </div>
      </div>
    
      <ul class="comment__list">
        <?php
          // La fonction qui liste les commentaires
          wp_list_comments( array(
            'style'       => 'ul',
            'short_ping'  => true,
            // 'avatar_size' => 74,
          ) );
        ?>
      </ul>
        
      <!-- S'il n'y a pas de commentaires -->
      <?php else : ?>
        <p class="comments__none">Il n'y a pas de commentaires pour le moment. Soyez le premier à participer !</p>
    <?php endif; ?>
 
    <?php comment_form(); // Le formulaire d'ajout de commentaire ?>
  </section>