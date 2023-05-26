<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
  <meta charset="<?php bloginfo('charset'); ?>">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <?php wp_head(); ?>
</head>

<body>
  <!-- Wrapper -->
  <div class="wrapper" id="top">

    <!-- Header -->
    <?php 
      // TODO => be careful to change the value of $attachment_id = the id of the background's picture !!!
      $image_attributes = wp_get_attachment_image_src(36, 'full'); // original background
      // $image_attributes = wp_get_attachment_image_src(40, 'full'); // blue background
    ?>

    <header style="background-image: url('<?= $image_attributes[0]; ?>');">
      <?php get_template_part('template-parts/header/nav'); ?>
    </header>

    <!-- Main -->
    <main>