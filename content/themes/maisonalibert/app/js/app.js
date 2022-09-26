var app = {
  init: function() {
    console.log('init');

    /////////////// Sticky Nav ///////////////
    window.addEventListener('scroll', () => {
      var navigation = document.querySelector("nav");
      navigation.classList.toggle('sticky', window.scrollY > 0);
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
    }

    navSlide();

    /////////////// Play/Pause Button ///////////////
    var pausePlayBtn = document.querySelector('header .special-event a i');

    pausePlayBtn.addEventListener('click', () => {
      if (pausePlayBtn.classList.contains('fa-pause-circle-o')) {
        document.querySelectorAll('header .special-event .special-event__items .special-event__items__single').forEach((autoScrollItems) => {
          autoScrollItems.classList.add('active');
        })
        pausePlayBtn.classList.remove('fa-pause-circle-o');
        pausePlayBtn.classList.add('fa-play-circle-o');
      }
      else {
        document.querySelectorAll('header .special-event .special-event__items .special-event__items__single').forEach((autoScrollItems) => {
          autoScrollItems.classList.remove('active');
        })
        pausePlayBtn.classList.remove('fa-play-circle-o');
        pausePlayBtn.classList.add('fa-pause-circle-o');
      }
    });

    /////////////// Events Div ///////////////
    eventInfinite = () => {
      var offerText = document.querySelector('.offer');
      var offerTextDiv = offerText.querySelector('div');

      for (i = 0; i < 10; i++) {
        var clone = offerTextDiv.cloneNode(true);
        offerText.appendChild(clone);
      }
    }

    eventInfinite();
  }
};

$(app.init);