/**************************************ScrollREveal****************************/

var sr = ScrollReveal();

sr.reveal('.title', {
  distance: '50px',
  opacity: 0.5
});

sr.reveal('h2', {
  distance: '20px',
  opacity: 0.5
});

sr.reveal('.card', {
  reset: true,
}, 150);

sr.reveal('.comments', {
  reset: true,
  origin: 'left',
  distance: '300px'
},500);
/***********************************Identity card**************************** */

$(document).ready(function()
{
    $('.contact').click(function (e) 
    {
        $('.card').toggleClass('active');
        $('.banner').toggleClass('active');
        $('.photo').toggleClass('active');
        $('.social-media-banner').toggleClass('active');
        $('.email-form').toggleClass('active');  
        var buttonText = $('button.contact#main-button').text();
        if (buttonText === 'Retour')
        {
            buttonText = 'Contactez-moi !';
            $('button.contact#main-button').text(buttonText);
        }
        else
        {
            buttonText = 'Retour';
            $('button.contact#main-button').text(buttonText);
        }
    });
});

/*----------------------BURGER-------------*/



$(document).ready(function () {
  $('.mask ,.burger').click(function () {
    $('.mask').toggleClass('closed');
    $('nav').toggleClass('nav-mobil');
    $('.burger').toggleClass('active');

  });
});



/*------------------SCROLLTOP-------------------------- */



$(document).ready(function () {

  var scrollTop = $(".scrollTop");

  $(window).scroll(function () {
    var topPos = $(this).scrollTop();

    if (topPos > 100) {
      $(scrollTop).css("opacity", "1");

    } else {
      $(scrollTop).css("opacity", "0");
    }

  });


  $(scrollTop).click(function () {
    $('html, body').animate({
      scrollTop: 0
    }, 1000);
    return false;

  });

});

/*--------------script appels ajax--------------*/


/***************************************************/

