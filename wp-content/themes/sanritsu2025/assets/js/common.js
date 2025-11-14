jQuery(function($) {
  $('.sp-g-nav-btn').on('click', function() {
    $(this).toggleClass('is-active');
    $('.g-nav').toggleClass('is-active');
  });
  $('.g-nav a[href*="#"]').on('click', function() {
    $('.g-nav').removeClass('is-active');
    $('.sp-g-nav-btn').removeClass('is-active');
  });
  $(window).on('scroll', function() {
    if ($(this).scrollTop() > 60) {
      $('.footer-cta').addClass('is-active');
    } else {
      $('.footer-cta').removeClass('is-active');
    }
  });

  $('form').validate({
    rules: {
      "name": {
        required: true,
      },
      "furigana": {
        required: true,
      },
      "email": {
        required: true,
        email: true,
      }
    },
    errorElement: 'span',
    errorPlacement: function (error, element) {
      error.insertBefore(element);
    }
  });
  Fancybox.bind("[data-fancybox]");
});