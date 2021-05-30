// These features are not supported by all browsers. You can check the support on the site "Can I use"

function scroller() {
    $(".smooth").on("scroll", function() {
      let scrollPos = $(this).scrollTop();
      $(".parallax").css({
        top: scrollPos / 2 + "px",
        opacity: 1 - scrollPos / 200
      });
    });
  }
  scroller();
  