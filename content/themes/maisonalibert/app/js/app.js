var app = {
  init: function() {
    console.log('init');

    /////////////// Sticky Nav ///////////////
    window.addEventListener('scroll', () => {
      var navigation = document.querySelector("nav");
      navigation.classList.toggle('sticky', window.scrollY > 0);
    });

    /////////////// Header Style ///////////////
    window.addEventListener('scroll', () => {
      var triangle = document.querySelector('.triangle');
      triangle.classList.toggle('resized', window.scrollY > 0);
    });

    /////////////// Swipe Menu ///////////////
    navSlide = () => {
      var burger = document.querySelector('.burger');
      var bar1 = document.querySelector('.burger .bar1');
      var bar2 = document.querySelector('.burger .bar2');
      var bar3 = document.querySelector('.burger .bar3');
      var nav = document.querySelector('.nav-links');
      var navLinks = document.querySelectorAll('.nav-links li');

      burger.addEventListener('click', () => {
        // Toggle Nav
        nav.classList.toggle('nav-active');

        // Turn Bars Into Cross
        if (nav.classList.contains('nav-active')) {
          bar1.style.transform = 'rotate(-45deg) translate(-9px, 6px)';
          bar2.style.opacity = '0';
          bar3.style.transform = 'rotate(45deg) translate(-8px, -8px)';
        }
        else {
          bar1.style.transform = '';
          bar2.style.opacity = '';
          bar3.style.transform = '';
        }

        // Animated Links
        navLinks.forEach((link, index) => {
          if (link.style.animation) {
            link.style.animation = '';
          }
          else {
            // To slow down/accelerate the delay of the animated links, change the value after the index; shorter = slower
            link.style.animation = `navLinkFade 0.5s ease forwards ${index / 2.5}s`;
          }
        });
      });
    };

    navSlide();

    /////////////// Selected Category ///////////////
    const categoryButtons = document.querySelectorAll('.filter button');
    categoryButtons.forEach(button => {
      button.addEventListener('click', (event) => {
        event.preventDefault();
        const category = button.dataset.category;
        const currentUrl = new URL(window.location.href);
        currentUrl.searchParams.set('category', category);
        window.location.href = currentUrl.href;
      });
    });

    /////////////// Add User's First Character Before His Name ///////////////
    let fnElements = document.querySelectorAll('.comment-author .fn');

    fnElements.forEach(function(fn) {
      const newNode = document.createElement('div');
      newNode.classList.add('first-char');
      newNode.textContent = fn.textContent.charAt(0);
    
      let firstChar = fn.parentNode;
      firstChar.insertBefore(newNode, fn);
    });

    /////////////// Replace <a> By <p> In Comments Area ///////////////
    const commentMetas = document.querySelectorAll('.comment-meta');

    commentMetas.forEach(commentMeta => {
      const link = commentMeta.querySelector('a');

      const newElement = document.createElement('em');

      // Copy the content of the <a> element to the new <p> element
      newElement.innerHTML = link.innerHTML;

      // Replace the <a> element with the new <p> element
      link.parentNode.replaceChild(newElement, link);
    });

    /////////////// Get The Current Year To Automatically Change It In The Copyright ///////////////
    document.querySelector('.copyright p span').innerHTML = new Date().getFullYear();
  }
};

$(app.init);