<?php get_header();?>

<article class="errors">
  <h3>Oops, la page est introuvable</h3>

  <h2>404</h2>

  <p>L'adresse saisie est probablement incorrecte, ou la page a été déplacée.</p>

  <a href="<?= home_url(); ?>">Retour</a>
</article>

<?php get_footer();?>