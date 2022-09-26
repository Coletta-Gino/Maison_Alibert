  </main>

  <!-- Footer -->
  <footer>
    <div>
      <?php 
        // TODO => be careful to change the value of $attachment_id = the id of the logo's picture !!!
        // $image_attributes = wp_get_attachment_image_src($attachment_id = 8);
        // $alt_text = get_post_meta(8, '_wp_attachment_image_alt', true);
      ?>
  
      <!-- <img src="<?php // echo $image_attributes[0]; ?>" alt="<?php // echo $alt_text; ?>" /> -->
      <img src="" alt="Logo (Simplifié)">
    </div>

    <ul>
      <h4>A propos</h4>
      <li>lien</li>
      <li>lien</li>
      <li>lien</li>
      <li>lien</li>
    </ul>

    <div>
      <h4>Réseaux Sociaux</h4>
    </div>

    
    <?php get_template_part('template-parts/footer/links'); ?>
    <?php get_template_part('template-parts/footer/simplified-logo'); ?>
    <?php get_template_part('template-parts/footer/social-media'); ?>
    <?php get_template_part('template-parts/footer/copyright'); ?>
    <?php get_template_part('template-parts/footer/anchor'); ?>
  </footer>

  <?php wp_footer(); ?>
</body>
</html>