  <section class="details">
    <?php if (have_posts()): while (have_posts()): the_post(); ?>
      <h1><?php the_title(); ?></h1>
    <?php endwhile; endif; ?>

    <div class="details__wrapper">
      <div class="details__wrapper__left">
        <div class="pictures">
          <?php the_content(); ?>

          <?php // .wpcp-carousel-section .wpcp-single-item img {margin: 0 auto; max-width: 100%; height: auto; box-shadow: none; border-radius: 15px;}; ?>
        </div>
      </div>

      <div class="details__wrapper__right">
        <div class="colors">
          <?php 
            $colors = array(
              get_field_object('color_1'),
              get_field_object('color_2'),
              get_field_object('color_3'),
              get_field_object('color_4'),
              get_field_object('color_5')
            );

            $has_colors = false;
            foreach($colors as $color) {
              if ($color['value']) {
                $has_colors = true;
                break;
              }
            }
            
            if ($has_colors) : 
          ?>
            <p>Disponible en :</p>
          <?php endif; ?>
          
          <div class="colors-available">
            <?php foreach($colors as $color) : ?>
              <?php if ($color['value']) : ?>
                <div style="background-color:<?= $color['value']; ?>"></div>
              <?php endif; ?>
            <?php endforeach; ?>
          </div>
        </div>

        <div class="description">
          <p>
            <?php $desc = get_field_object('description'); echo $desc['value']; ?>
          </p>
        </div>

        <div class="price">
          <p>
            <?php $price = get_field_object('price'); echo $price['value']; ?>&#8239;€
          </p>
        </div>
      </div>
    </div>
  </section>