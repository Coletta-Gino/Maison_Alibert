<?php get_header();?>

<article class="errors">
  <h3>Aïe, la page est introuvable</h3>

  <h2>404</h2>

  <p>L'adresse saisie est probablement incorrecte, ou la page a été déplacée.</p>

  <a href="<?= home_url(); ?>" class="needle-link">Retour<span class="needle">&#129697;</span></a>
</article>

<?php get_footer();?>