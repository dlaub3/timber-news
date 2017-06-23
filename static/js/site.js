jQuery( document ).ready( function($) {

  $(document).foundation();

  //This implements smooth scoll to same page links but doesn't work with Woocommerce
  // item desctiption tabs
  // $('a[href*="#"]:not([href="#"])').click(function() {
  //   if (location.pathname.replace(/^\//,'') == this.pathname.replace(/^\//,'') && location.hostname == this.hostname) {
  //     var target = $(this.hash);
  //     target = target.length ? target : $('[name=' + this.hash.slice(1) +']');
  //     if (target.length) {
  //       $('html, body').animate({
  //         scrollTop: target.offset().top
  //       }, 1000);
  //       return false;
  //     }
  //   }
  // });

  $(window).scroll(function(){
  if ($(this).scrollTop() < 1800) {
    $('#up').fadeOut();
  } else {
    $('#up').css("display", "block");
  }
  });

  $(window).load(function(){
  $('#masonry-container').masonry({
    itemSelector: '#masonry-container article'
  });
  });


});
