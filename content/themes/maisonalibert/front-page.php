<?php get_header(); ?>
  <?php if (have_posts()): while (have_posts()): the_post(); ?>
    <h1><?php the_title(); ?></h1>

    <?php the_content(); ?>

    <div style="position: absolute; top: 30px; width: 213px; height: 357.5px; left: 43%;">
      <img src="content/uploads/2022/09/Logo-Blue-Version.png" alt="" style="width: 100%; height: 100%;">
    </div>

    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1440 320">
      <path fill="#1d616c" fill-opacity="1" d="M0,192L60,186.7C120,181,240,171,360,149.3C480,128,600,96,720,90.7C840,85,960,107,1080,122.7C1200,139,1320,149,1380,154.7L1440,160L1440,0L1380,0C1320,0,1200,0,1080,0C960,0,840,0,720,0C600,0,480,0,360,0C240,0,120,0,60,0L0,0Z"></path>
    </svg>
  <?php endwhile; endif; ?>
  
  <?php get_template_part('template-parts/home/intro'); ?>
  <?php get_template_part('template-parts/home/concepts'); ?>
  <?php get_template_part('template-parts/home/wrapper'); ?>
  <?php get_template_part('template-parts/home/artists'); ?>
<?php get_footer(); ?>