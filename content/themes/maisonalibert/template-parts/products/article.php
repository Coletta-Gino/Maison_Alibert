      <article class="product" id="product-<?php the_ID(); ?>">
        <div class="product__image">
          <!-- <img src="" alt=""> -->
          <?php the_post_thumbnail(); ?>
        </div>

        <div class="product__infos">
          <div class="product__infos__rating">
            <i class="fa fa-star" aria-hidden="true"></i>
            <i class="fa fa-star" aria-hidden="true"></i>
            <i class="fa fa-star" aria-hidden="true"></i>
            <i class="fa fa-star" aria-hidden="true"></i>
            <i class="fa fa-star-half" aria-hidden="true"></i>
          </div>

          <!-- <h3>Product name</h3> -->
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

              if ($colors) : ?>
                <?php foreach($colors as $color) : ?>
                  <?php if ($color['value']) : ?>
                    <div style="background-color:<?= $color['value']; ?>"></div>
                  <?php endif; ?>
                <?php endforeach; ?>
              <?php endif; ?>
          </div>

          <p class="product__infos__price"><?php $price = get_field_object('price'); echo $price['value']; ?></p>
        </div>
      </article>