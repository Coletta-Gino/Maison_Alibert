var app = {
  init: function() {
    console.log('init');

    /////////////// Sticky Nav ///////////////
    window.addEventListener('scroll', () => {
      var navigation = document.querySelector("nav");
      navigation.classList.toggle('sticky', window.scrollY > 0);
    });

    /////////////// Add Classname And <span> To <a> In The Nav ///////////////
    const navLinksA = document.querySelectorAll('.menu-item a');

    function updateNavLinksClass() {
      const windowWidth = window.innerWidth;
      const newClassName = windowWidth < 768 ? 'needle-link' : 'needle-link-alt';
    
      navLinksA.forEach((navLinkA) => {
        navLinkA.className = newClassName;
    
        const navSpan = navLinkA.querySelector('.needle');
        if (!navSpan) {
          const newNavSpan = document.createElement('span');
          newNavSpan.className = 'needle';
          newNavSpan.innerHTML = '&#129697;';
          navLinkA.appendChild(newNavSpan);
        }
      });
    }
    
    updateNavLinksClass();
    
    // Update the class whenever the window is resized
    window.addEventListener('resize', updateNavLinksClass);

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

    /////////////// Dropdown Animation ///////////////
    $(document).ready(function() {
      const $dropdownBtn = $("#btn");
      const $dropdownMenu = $("#dropdown");
      const $toggleArrow = $("#arrow");

      const toggleDropdown = () => {
        $dropdownMenu.toggleClass("is-open");
        $toggleArrow.toggleClass("arrow");
      };

      $dropdownBtn.on("click", function(e) {
        e.stopPropagation();
        toggleDropdown();
      });

      $(document).on("click", function() {
        if ($dropdownMenu.hasClass("is-open")) {
          toggleDropdown();
        }
      });
    });

    /////////////// Selected Category ///////////////
    const categoryButtons = document.querySelectorAll('.filter button');
    let currentButton = document.querySelector('.filter button[data-category="all"]');

    categoryButtons.forEach(button => {
      button.addEventListener('click', (event) => {
        event.preventDefault();
        const category = button.dataset.category;
        const currentUrl = new URL(window.location.href);
        currentUrl.searchParams.set('category', category);
        window.location.href = currentUrl.href;

        if (currentButton !== button) {
          currentButton.classList.remove('selected');
          button.classList.add('selected');
          currentButton = button;
        }
      });
    });

    /////////////// Add Class To Actual Page In Pagination ///////////////
    const lis = document.querySelectorAll('ul.page-numbers li');

    lis.forEach(li => {
      if (li.querySelector('span[aria-current="page"]')) {
        li.classList.add('actual');
      }
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

    /////////////// Add <span> To <a> In The Comment Reply ///////////////
    const replyLinks = document.querySelectorAll('.comment-reply-link');
    replyLinks.forEach((replyLink) => {
      const replySpan = document.createElement('span');
      replySpan.className = 'needle';
      replySpan.innerHTML = '&#129697;';
      replyLink.appendChild(replySpan);
    });

    /////////////// Add <span> To <a> In The Cancel Comment Reply Link ///////////////
    const cancelReplyLink = document.getElementById('cancel-comment-reply-link');
    if (cancelReplyLink) {
      const replySpan = document.createElement('span');
      replySpan.className = 'needle';
      replySpan.innerHTML = '&#129697;';
      cancelReplyLink.appendChild(replySpan);
    }

    /////////////// Replace <a> To <cite> In The Author's Comment Reply ///////////////
    const liElement = document.querySelector('li.comment.bypostauthor');
    const citeElement = liElement.querySelector('cite.fn');

    // Check if the <cite> element contains an <a> element
    if (citeElement.querySelector('a')) {
      // Get the text content of the <cite> element
      const text = citeElement.textContent;

      // Replace the <cite> element's content with just the text
      citeElement.innerHTML = text;
    }

    /////////////// Get The Current Year To Automatically Change It In The Copyright ///////////////
    document.querySelector('.copyright p span').innerHTML = new Date().getFullYear();
  }
};

$(app.init);