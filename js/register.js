$(document).ready(function(){
    $('.signoutclick').hide();

    $('.signout').click(function(){	
      if ($(".register").is(':hidden')) {
		$('.drop').slideUp(),
        $('#link').removeClass('signinclick').addClass('signin');  
        $(".register").slideDown().animate({height:'390px'},{queue:false, duration:600, easing: 'easeOutBounce'}),
        $('#link2').removeClass('signout').addClass('signoutclick');
	  }
      else {
        $('.register').slideUp(),
        $('#link2').removeClass('signoutclick').addClass('signout');
      }
      return false;
    });
    $('.register').click(function(e) {
      e.stopPropagation();
    });
    $(document).click(function() {
      $('.register').fadeOut('fast'),
      $('#link2').removeClass('signoutclick').addClass('signout');
    });
});



