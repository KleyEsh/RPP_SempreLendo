$(function () {

    "use strict";

  // preloader
  $(window).on('load', function(event) {
    $('.appilan-loader').delay(500).fadeOut(500);
    
  });

    jQuery(document).ready(function($) {
      $('a[data-rel^=lightcase]').lightcase();
    });

     //===== Sticky

     $(window).on('scroll', function (event) {
        var scroll = $(window).scrollTop();
        if (scroll < 20) {
            $(".header_navbar").removeClass("sticky");
        } else {
            $(".header_navbar").addClass("sticky");
        }
    });


    //===== mobile-menu-btn
    let navbarToggler = document.querySelector(".mobile-menu-btn");
    navbarToggler.addEventListener('click', function () {
        navbarToggler.classList.toggle("active");
    });

    //===== Section Menu Active

    var scrollLink = $('.page-scroll');
    // Active link switching
    $(window).scroll(function () {
        var scrollbarLocation = $(this).scrollTop();

        scrollLink.each(function () {

            var sectionOffset = $(this.hash).offset().top - 73;

            if (sectionOffset <= scrollbarLocation) {
                $(this).parent().addClass('active');
                $(this).parent().siblings().removeClass('active');
            }
        });
    });

    // Button hover js 
    
    $('.main-btn').on('mouseenter', function(e) {
      var parentOffset = $(this).offset(),
      relX = e.pageX - parentOffset.left,
      relY = e.pageY - parentOffset.top;
      $(this).find('span').css({top:relY, left:relX})
  })
  .on('mouseout', function(e) {
        var parentOffset = $(this).offset(),
        relX = e.pageX - parentOffset.left,
        relY = e.pageY - parentOffset.top;
    $(this).find('span').css({top:relY, left:relX})
  });



    //===== Back to top

    // Show or hide the sticky footer button
    $(window).on('scroll', function (event) {
        if ($(this).scrollTop() > 600) {
            $('.back-to-top').fadeIn(200)
        } else {
            $('.back-to-top').fadeOut(200)
        }
    });


    //Animate the scroll to yop
    $('.back-to-top').on('click', function (event) {
        event.preventDefault();

        $('html, body').animate({
            scrollTop: 0,
        }, 1500);
    });


  // Wow
    new WOW().init();



  /*--
      App Screenshot
	  -----------------------------------*/
    var testimonial = new Swiper('.screenshot-slider', {
      slidesPerView: 1,
      loop: true,
      spaceBetween: 20,
      centeredSlides: true,
      pagination: {
        el: '.swiper-pagination',
        type: 'bullets',
        clickable: true,
    },
      breakpoints: {
        0: {
          slidesPerView: 1,
        },
        576: {
          slidesPerView: 1,
        },
        768: {
          slidesPerView: 3,
        },
        992: {
          slidesPerView: 5,
        }
      }
    });



  /*--
        Testimonial
	  -----------------------------------*/
    var testimonial = new Swiper('.testimonial-slider', {
      slidesPerView: 1,
      loop: true,
      navigation: {
        nextEl: '.swiper-button-next',
        prevEl: '.swiper-button-prev',
      },
      breakpoints: {
        0: {
          slidesPerView: 1,
        },
        576: {
          slidesPerView: 1,
        },
        768: {
          slidesPerView: 1,
        },
        992: {
          slidesPerView: 1,
        }
      }
    });

});



