  <!-- Navbar -->
  <nav>
    <div class="logo">
      <a href="<?php echo home_url(); ?>">
        <?php 
          // TODO => be careful to change the value of $attachment_id = the id of the logo's picture !!!
          $image_attributes = wp_get_attachment_image_src($attachment_id = 8);
          $alt_text = get_post_meta(8, '_wp_attachment_image_alt', true);
        ?>
  
        <img src="<?php echo $image_attributes[0]; ?>" alt="<?php echo $alt_text; ?>" />
      </a>
    </div>
  
    <!-- Menu Items -->
      <?php 
        $menu = wp_nav_menu([
          'theme_location' => 'main-menu',
          'container' => 'none',
          // 'container_class' => 'main-nav',
          'echo' => false
        ]);

        $menu = str_replace('class="menu"', 'class="nav-links"', $menu);

        echo $menu;
      ?>
  
    <!-- Menu Burger -->
    <div class="burger">
      <div class="bar1"></div>
      <div class="bar2"></div>
      <div class="bar3"></div>
    </div>
  </nav>