<?php get_header(); ?>

<section class="results">
  <?php
    $count = $wp_query->found_posts;
    if ($count <= 1 ) {
      $several = '';
    }
    else {
      $several = 's';
    }

    if ($count > 0) {
      $output = $count . ' Résultat' . $several . ' pour la recherche';
    }
    else {
      $output = 'Aucun résultat pour la recherche';
    }

    $result = $output . ' ' . '"' . get_search_query() . '"'; 
  ?>

  <h1><?php echo $result; ?></h1>

  <?php if (have_posts()) : while (have_posts()) : the_post(); ?>
    <!-- If there is almost one result -->
    <div class="results__found">
      <a href="<?php the_permalink(); ?>" class="needle-link"><?php the_title(); ?><span class="needle">&#129697;</span></a>
    </div>

    <?php endwhile; wp_reset_query(); ?>
  <?php else : ?>
    <!-- If there is no result -->
    <p>Désolé, mais rien ne correspond à vos critères de recherche. Veuillez réessayer avec d&apos;autres mots-clés.</p>
  <?php endif; ?>

  <a href="<?= home_url(); ?>" class="needle-link">Retour<span class="needle">&#129697;</span></a>
</section>

<?php get_footer(); ?>