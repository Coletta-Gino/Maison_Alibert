<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
  <meta charset="<?php bloginfo('charset'); ?>">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <?php wp_head(); ?>
</head>

<body>
  <!-- Header -->
  <header>
    <?php get_template_part('template-parts/header/events'); ?>
    <?php get_template_part('template-parts/header/nav'); ?>
  </header>

  <!-- Main -->
  <main>