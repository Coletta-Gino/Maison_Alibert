  <!-- <section class="comments-area">
    <div class="card">
      <h2>Avis</h2>

      <h3><span id="average">average</span> / 5</h3>

      <div class="rating">
        <i class="fa fa-star" aria-hidden="true"></i>
        <i class="fa fa-star" aria-hidden="true"></i>
        <i class="fa fa-star" aria-hidden="true"></i>
        <i class="fa fa-star" aria-hidden="true"></i>
        <i class="fa fa-star-half" aria-hidden="true"></i>
      </div>

      <div class="total-reviews">
        <h3>(number) reviews</h3>
      </div>

      <div class="reviews-by-stars">
        <div class="five-stars">
          <p>5 <i class="fa fa-star" aria-hidden="true"></i></p> -->
          <!-- <div class="progress-bar"></div> -->
          <!-- <progress class="progress" id="five-stars__progress" value="16.666666666666664" max="100"></progress>
          <p class="number-of-reviews">(<span id="total_five_stars_review">number</span>)</p>
        </div>

        <div class="four-stars">
          <p>4 <i class="fa fa-star" aria-hidden="true"></i></p>
          <progress class="progress" id="five-stars__progress" value="0" max="100"></progress>
          <p class="number-of-reviews">(<span id="total_four_stars_review">number</span>)</p>
        </div>

        <div class="three-stars">
          <p>3 <i class="fa fa-star" aria-hidden="true"></i></p>
          <progress class="progress" id="five-stars__progress" value="0" max="100"></progress>
          <p class="number-of-reviews">(<span id="total_three_stars_review">number</span>)</p>
        </div>

        <div class="two-stars">
          <p>2 <i class="fa fa-star" aria-hidden="true"></i></p>
          <progress class="progress" id="five-stars__progress" value="0" max="100"></progress>
          <p class="number-of-reviews">(<span id="total_two_stars_review">number</span>)</p>
        </div>

        <div class="one-star">
          <p>1 <i class="fa fa-star" aria-hidden="true"></i></p>
          <progress class="progress" id="five-stars__progress" value="0" max="100"></progress>
          <p class="number-of-reviews">(<span id="total_one_star_review">number</span>)</p>
        </div>
      </div>

      <div class="add-review">
        <h4>Write review here</h4>
        <button type="submit">Submit review</button>
      </div>

      <div class="comments" style="color: #f0eae2; background-color: #1d616c;">
        <div>
          <div class="user-picture">
            <img src="" alt="">
          </div>

          <p class="user-name">Author</p>

          <div class="user-rate">
            <i class="fa fa-star" aria-hidden="true"></i>
            <i class="fa fa-star" aria-hidden="true"></i>
            <i class="fa fa-star" aria-hidden="true"></i>
            <i class="fa fa-star" aria-hidden="true"></i>
            <i class="fa fa-star-half" aria-hidden="true"></i>
          </div>

          <p class="user-review">User's comment</p>

          <p class="review-date">On monday 14th, november 2022 16:23:42 AM</p>
        </div>
      </div>
    </div>
  </section> -->

  <section id="comments" class="comments-area">
    <h2>Avis</h2>
    
    <?php if ( have_comments() ) : ?>
      <!-- Global Reviews & Rating Div -->
      <div style="display: flex; justify-content: space-between; align-items: center;">
        <!-- Total Reviews + Average -->
        <div style="display: flex; flex-direction: column; justify-content: center; align-items: center;">
          <h2>
            <span id="average_rating">0.0</span> / 5
          </h2>

          <div class="stars">
            <i class="fa fa-star" aria-hidden="true"></i>
            <i class="fa fa-star" aria-hidden="true"></i>
            <i class="fa fa-star" aria-hidden="true"></i>
            <i class="fa fa-star" aria-hidden="true"></i>
            <i class="fa fa-star" aria-hidden="true"></i>
          </div>

          <h3>
            <?php
              if (get_comments_number() > 1) {
                echo '<span id="total_review">' . get_comments_number() . '</span>' . ' commentaires';
              }
              else {
                echo '<span id="total_review">' . get_comments_number() . '</span>' . ' commentaire';
              }
            ?>
          </h3>
        </div>

        <!-- Test -->
        <div>
          <?php
            $average_rating = 0;
            $total_review = 0;
            $five_star_review = 0;
            $four_star_review = 0;
            $three_star_review = 0;
            $two_star_review = 0;
            $one_star_review = 0;
            $total_user_rating = 0;
            $review_content = array();

            $query = "SELECT wp_comments.comment_author, wp_comments.comment_date, wp_comments.comment_content, wp_commentmeta.meta_key, wp_commentmeta.meta_value FROM wp_comments INNER JOIN wp_commentmeta ON wp_comments.comment_ID=wp_commentmeta.comment_ID WHERE wp_commentmeta.meta_key = 'rating' AND wp_commentmeta.meta_value > 0";

            global $wpdb;
            $results = $wpdb->get_results($query, OBJECT_K);
            // print_r($results);

            foreach ($results as $row) {
              $review_content[] = array(
                'author' => $row->comment_author,
                'comment' => $row->comment_content,
                'rating' => $row->meta_value,
                'datetime' => $row->comment_date,
              );

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

            $output = array(
              'average_rating' => number_format($average_rating, 1),
              'total_review' => $total_review,
              'five_star_review' => $five_star_review,
              'four_star_review' => $four_star_review,
              'three_star_review' => $three_star_review,
              'two_star_review' => $two_star_review,
              'one_star_review' => $one_star_review,
              'review_data' => $review_content,
            );

            echo json_encode($output);
          ?>

            <pre>
              <!-- The oldest comment is in the first index -->
              <?php print_r($review_content); ?>
            </pre>
          <!-- ?> -->
        </div>

        <!-- Reviews Details -->
        <div>
          <!-- 5 -->
          <div style="display: flex;">
            <!-- Value -->
            <div class="column"><b>5 </b><i class="fa fa-star" aria-hidden="true"></i></div>

            <!-- Progress Bar -->
            <div class="column">
              <progress class="progress" id="five_star_progress" value="0" max="100"></progress>
            </div>

            <!-- Number Of Reviews -->
            <div class="column">
              (<span id="total_five_star_review">0</span>)
            </div>
          </div>

          <!-- 4 -->
          <div style="display: flex;">
            <!-- Value -->
            <div class="column"><b>4 </b><i class="fa fa-star" aria-hidden="true"></i></div>

            <!-- Progress Bar -->
            <div class="column">
              <progress class="progress" id="four_star_progress" value="0" max="100"></progress>
            </div>

            <!-- Number Of Reviews -->
            <div class="column">
              (<span id="total_four_star_review">0</span>)
            </div>
          </div>

          <!-- 3 -->
          <div style="display: flex;">
            <!-- Value -->
            <div class="column"><b>3 </b><i class="fa fa-star" aria-hidden="true"></i></div>

            <!-- Progress Bar -->
            <div class="column">
              <progress class="progress" id="three_star_progress" value="0" max="100"></progress>
            </div>

            <!-- Number Of Reviews -->
            <div class="column">
              (<span id="total_three_star_review">0</span>)
            </div>
          </div>

          <!-- 2 -->
          <div style="display: flex;">
            <!-- Value -->
            <div class="column"><b>2 </b><i class="fa fa-star" aria-hidden="true"></i></div>

            <!-- Progress Bar -->
            <div class="column">
              <progress class="progress" id="two_star_progress" value="0" max="100"></progress>
            </div>

            <!-- Number Of Reviews -->
            <div class="column">
              (<span id="total_two_star_review">0</span>)
            </div>
          </div>

          <!-- 1 -->
          <div style="display: flex;">
            <!-- Value -->
            <div class="column"><b>1 </b><i class="fa fa-star" aria-hidden="true"></i></div>

            <!-- Progress Bar -->
            <div class="column">
              <progress class="progress" id="one_star_progress" value="0" max="100"></progress>
            </div>

            <!-- Number Of Reviews -->
            <div class="column">
              (<span id="total_one_star_review">0</span>)
            </div>
          </div>
        </div>

        <!-- Add Review -->
        <div style="display: flex; flex-direction: column; justify-content: center; align-items: center;">
          <h3>Write review here</h3>

          <button type="button" name="add_review" class="button is-info js-modal-trigger" id="add_review" data-target="modal-js-example">Add review</button>
        </div>
      </div>
    
      <ul class="comment__list" style="margin-top: 5em;">
        <?php
          // La fonction qui liste les commentaires
          wp_list_comments( array(
            'style'       => 'ul',
            'short_ping'  => true,
            'avatar_size' => 74,
          ) );
        ?>
      </ul>
        
      <!-- S'il n'y a pas de commentaires -->
      <?php else : ?>
        <p class="comments__none">Il n'y a pas de commentaires pour le moment. Soyez le premier à participer !</p>
    <?php endif; ?>
 
    <?php comment_form(); // Le formulaire d'ajout de commentaire ?>
  </section>