$(document).ready(function () {
  $(".toggle.l").click(function () {
    $(".left").toggleClass("active");
    $(".toggle.l").toggleClass("active");
  });
});
$(document).ready(function () {
  $(".toggle.r").click(function () {
    $(".right").toggleClass("active");
    $(".toggle.r").toggleClass("active");
  });
});

$(".owl-carousel").owlCarousel({
  loop: true,
  margin: 10,
  nav: true,
  responsive: {
    0: {
      items: 1,
    },
    600: {
      items: 3,
    },
    1000: {
      items: 5,
    },
  },
});
