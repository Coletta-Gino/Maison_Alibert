  <!-- Navbar -->
  <nav>
    <div class="logo">
      <a href="<?php echo home_url(); ?>">
        <?php 
          // TODO => be careful to change the value of $attachment_id = the id of the logo's picture !!!
          $attachment_id = 37; // Default attachment ID
          $alt_text = get_post_meta($attachment_id, '_wp_attachment_image_alt', true);

          $nav_classes = get_body_class();

          if (in_array('sticky', $nav_classes)) {
            // If the nav element has the 'sticky' class, use a different attachment ID and alt text
            $attachment_id = 37; // ID of the new logo's picture
            $alt_text = get_post_meta($attachment_id, '_wp_attachment_image_alt', true); // New alt text for the sticky logo
          }
    
          $image_attributes = wp_get_attachment_image_src($attachment_id, 'full');
        ?>
      
        <img src="<?php echo $image_attributes[0]; ?>" alt="<?php echo $alt_text; ?>" />
      </a>
    </div>

    <!-- <div class="triangle top-left"></div> -->
  
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

    <!-- <div class="triangle bottom-right"></div> -->
  </nav>