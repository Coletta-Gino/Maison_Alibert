<?php get_header(); ?>

<div class="results">
  <?php
    $count = $wp_query->found_posts;
    if ($count <= 1 ) {
      $several = '';
    }
    else {
      $several = 's';
    }

    if ($count > 0) {
      $output = $count . ' résultat' . $several . ' pour la recherche';
    }
    else {
      $output = 'Aucun résultat pour la recherche';
    }

    $result = $output . ' ' . '"' . get_search_query() . '"'; 
  ?>

  <h1><?php echo $result; ?></h1>

  <?php if (have_posts()) : while (have_posts()) : the_post(); ?>
    <!-- If there is almost one result -->
    <article class="results__found">
      <h3><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
    </article>

    <?php endwhile; wp_reset_query(); ?>
  <?php else : ?>
    <!-- If there is no result -->
    <p>Votre recherche est infructueuse. Veuillez essayer avec d&apos;autres termes de recherche.</p>
  <?php endif; ?>

  <a href="<?= home_url(); ?>">Retour</a>
</div>

<?php get_footer(); ?>