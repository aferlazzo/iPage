

(function () {
      var Today = new Date();
      $('#thisYear').text(Today.getFullYear());
})();

// code for cycling through comic book hero portraits behind Alfred on page 1
(function(){
    var pictureNo = 0;
    changePicture = function (){
        var x = 'url(img/'+ pictureNo++ +'.jpg)';

        $('#heroes').css('background-image', x).fadeOut(5000, "easeInQuint", function(){$("#heroes").css("display", "block")});
        if (pictureNo > 15)
            pictureNo = 0;

        setTimeout('changePicture()', 5000);
    };

    changePicture();
})();

$('document').ready(function (){
	var i, portfolioTimer = null;


	// page 2: click on a circle/dot or on the site thumbnail to stop cycling
	$('.circleDot').click(function (){
		var cIndex = $(this).index();
		clearTimeout(portfolioTimer);

		$('.circleDot').each(function (i) {
			$('.contrib:eq('+ i +')').css('display', 'none');
			$('.site-slice:eq('+ i +')').css('display', 'none');
			$('.circleDot:eq(' + i + ')').html('&#9675;'); //&#9675; unfilled circle
		});

		$('.contrib:eq('+ cIndex +')').css('display', 'block');
		$('.site-slice:eq('+ cIndex +')').css('display', 'block');
		$('.circleDot:eq(' + cIndex + ')').html('&#9679;');
	});

	// page 2: auto-start display cycle

	(function() {
		var lastSiteNo = 4;
        var siteNo = 0;

		doIt = function(){
            $('.contrib:eq('+ lastSiteNo +')').css('display', 'none');
            $('.circleDot' + lastSiteNo).html('&#9675;');   //&#9675; unfilled circle

			$('.contrib:eq('+ siteNo +')').css('display', 'block');
			$('.site-slice:eq('+ siteNo +')').css('display', 'block').fadeOut(14950, "easeInQuint");
			$('.circleDot' + siteNo).html('&#9679;');       // filled circle

            if(++siteNo > 4)
                siteNo = 0;
            if(++lastSiteNo > 4)
                lastSiteNo = 0;

    		portfolioTimer = setTimeout('doIt()', 15000);
		},


		portfolioTimer = 1;
		doIt();
	})();

    // page 1: set up hover panels
    // although this can be done without JavaScript, we've attached these events
    // because it causes the hover to be triggered when the element is tapped on a touch device
    $('.hover').hover(function(){
        $(this).addClass('flip');
    },function(){
        $(this).removeClass('flip');
    });

    // page 1: set up event handler for clicking/tapping panels

    $('.click').click(function(){
        $(this).toggleClass("flip");
    });

	$('#cover').css('display', 'block');

    $(".contact-tab, .contact-container").click(function () {
        $("#contact").toggleClass("visible");
    });

    // page 1: for the modal panel

    $('.modal-close').click(function (){
        $('.modal').addClass('shrink').removeClass('grow');
    });

    $('.modal-open').click(function (){
        $('.modal').addClass('grow').removeClass('shrink');
    });

});
