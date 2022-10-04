<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
  <meta charset="<?php bloginfo('charset'); ?>">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <?php wp_head(); ?>
</head>

<body>
  <!-- Wrapper -->
  <?php 
    // TODO => be careful to change the value of $attachment_id = the id of the background's picture !!!
    $image_attributes = wp_get_attachment_image_src(36, 'full');
  ?>

  <div class="wrapper" style="background-image: url('<?= $image_attributes[0]; ?>');">

    <!-- Header -->
    <header>
      <?php get_template_part('template-parts/header/events'); ?>
      <?php get_template_part('template-parts/header/nav'); ?>
    </header>

    <!-- Main -->
    <main>