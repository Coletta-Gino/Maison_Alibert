<?php get_header();?>

<article class="errors">
  <h3>Désolé, la page est restreinte</h3>

  <h2>403</h2>

  <p>L'accès à cette page est interdit.</p>

  <a href="<?= home_url(); ?>" class="needle-link">Retour<span class="needle">&#129697;</span></a>
</article>

<?php get_footer();?>