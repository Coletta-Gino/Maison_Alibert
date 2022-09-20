<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
  <meta charset="<?php bloginfo('charset'); ?>">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <?php wp_head(); ?>
</head>

<body>
  <!-- Header -->
  <header style="width: 100%; color: #f0eae2; background-color: #1d616c; padding: 1em 2em">
    <?php get_template_part('template-parts/header/nav'); ?>
    <?php get_template_part('template-parts/header/events'); ?>
  </header>

  <!-- Main -->
  <main>