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
  $('#inquiry-form').validate({
    rules: {
      "お名前": {
        required: true,
      },
      "Email": {
        required: true,
        email: true,
      },
      "問い合わせ内容": {
        required: true,
      }
    },
    errorElement: 'span',
    errorPlacement: function (error, element) {
      error.insertBefore(element);
    }
  });
  Fancybox.bind("[data-fancybox]");
});