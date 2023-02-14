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
          $colors = array(
            get_field_object('color_1'),
            get_field_object('color_2'),
            get_field_object('color_3'),
            get_field_object('color_4'),
            get_field_object('color_5')
          );

          if ($colors) : ?>
            <?php foreach($colors as $color) : ?>
              <?php if ($color['value']) : ?>
                <div style="background-color:<?= $color['value']; ?>"></div>
              <?php endif; ?>
            <?php endforeach; ?>
          <?php endif; ?>
      </div>
    </div>

    <p class="description"><?php $desc = get_field_object('description'); echo $desc['value']; ?></p>

    <p class="price"><?php $price = get_field_object('price'); echo $price['value']; ?>&#8239;€</p>
  </section>