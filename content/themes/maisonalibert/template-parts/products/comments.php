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
    <?php if ( have_comments() ) : ?>
      <h2 class="comments__title">
        <?php echo get_comments_number(); // Nombre de commentaires ?> Commentaire(s)
      </h2>
    
      <ol class="comment__list">
        <?php
          // La fonction qui liste les commentaires
          wp_list_comments( array(
            'style'       => 'ol',
            'short_ping'  => true,
            'avatar_size' => 74,
          ) );
        ?>
      </ol>
        
      <!-- S'il n'y a pas de commentaires -->
      <?php else : ?>
        <p class="comments__none">Il n'y a pas de commentaires pour le moment. Soyez le premier à participer !</p>
    <?php endif; ?>
 
    <?php comment_form(); // Le formulaire d'ajout de commentaire ?>
  </section>