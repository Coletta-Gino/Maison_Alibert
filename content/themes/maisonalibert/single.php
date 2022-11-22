<!-- Product Details -->
<?php get_header(); ?>
  <section class="product-details">
    <?php if (have_posts()): while (have_posts()): the_post(); ?>
      <h1><?php the_title(); ?></h1>
    <?php endwhile; endif; ?>

    <div class="pictures">
      <?php the_content(); ?>

      <?php // .wpcp-carousel-section .wpcp-single-item img {margin: 0 auto; max-width: 100%; height: auto; box-shadow: none; border-radius: 15px;}; ?>
    </div>

    <div class="colors">
      <p>Disponible en :</p>
      
      <!-- <div class="product__infos__colors"> -->
      <div class="colors-available">
        <style>
          .colors-available {
            display: flex;
            flex-wrap: wrap;
            justify-content: center;
            align-items: center;
            margin: 0 auto;
          }

          .colors-available div {
            width: 30px;
            height: 30px;
            margin: 0 5px 10px 5px;
            border-radius: 7px;
          }
        </style>
        
        <?php 
          $fields = get_field_objects();

          if ($fields) : ?>
            <?php foreach($fields as $field) : ?>
              <?php if ($field['value']) : ?>
                <div style="background-color:<?= $field['value']; ?>"></div>
              <?php endif; ?>
            <?php endforeach; ?>
          <?php endif; ?>
      </div>
    </div>

    <p class="description">Lorem ipsum dolor sit amet consectetur adipisicing elit. Maiores, sit?</p>

    <p class="price">29,99€</p>
  </section>

  <section class="comments-area">
    <!-- <div class="card"> -->
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
          <p>5 <i class="fa fa-star" aria-hidden="true"></i></p>
          <!-- <div class="progress-bar"></div> -->
          <progress class="progress" id="five-stars__progress" value="16.666666666666664" max="100"></progress>
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
    <!-- </div> -->
  </section>
<?php get_footer(); ?>