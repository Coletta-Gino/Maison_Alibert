    </main>

    <!-- Footer -->
    <?php 
      // TODO => be careful to change the value of $attachment_id = the id of the background's picture !!!
      $image_attributes = wp_get_attachment_image_src(36, 'full'); // original background
      // $image_attributes = wp_get_attachment_image_src(40, 'full'); // blue background
    ?>

    <footer style="background-image: url('<?= $image_attributes[0]; ?>');">
      <?php get_template_part('template-parts/footer/simplified-logo'); ?>

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
      <?php get_template_part('template-parts/footer/social-media'); ?>
      <?php get_template_part('template-parts/footer/copyright'); ?>
      <?php get_template_part('template-parts/footer/anchor'); ?>
    </footer>

    <?php wp_footer(); ?>
  </div>
</body>
</html>