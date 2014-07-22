jQuery(function($) {
    var portfolioTimer = null;

    var highlightMenuItem = function (page) {
        var i;
        for (i = 0; i < 4; i++) {
            $(".menu-container").find("div").eq(i).removeClass("active-item");
        }
        $(".menu-container").find("div").eq(page).addClass("active-item");
    };

    $(".menu-container div").click(function (e) {
        e.preventDefault();
        var target = "#" + $(this).text().toLowerCase();
        var $target = $(target);

        $('html, body').stop().animate({
            'scrollTop': $target.offset().top
        }, 900, 'swing', function () {
            window.location.hash = target;
        });
    });

    $(document).scroll(function() {
        var fromTop = $(document).scrollTop();
        //console.log(fromTop);

        if (fromTop > 1751) {
            highlightMenuItem(3);
        }else{
            if (fromTop > 1167) {
                highlightMenuItem(2);
            }else{
                if (fromTop > 571) {
                    highlightMenuItem(1);
                }else{
                    highlightMenuItem(0);
                }
            }
        }
    });

    // portfolio: click on a circle/dot or on the site thumbnail to stop cycling
    $('.circleDot').click(function (){
        var cIndex = $(this).index();
        clearTimeout(portfolioTimer);

        $('.circleDot').each(function (i) {
               $('.contrib:eq(' + i + ')').css('display', 'none');
            $('.site-slice:eq(' + i + ')').css('display', 'none');
             $('.circleDot:eq(' + i + ')').html('&#9675;'); //&#9675; unfilled circle
        });

           $('.contrib:eq(' + cIndex + ')').css('display', 'block');
        $('.site-slice:eq(' + cIndex + ')').css('display', 'block');
         $('.circleDot:eq(' + cIndex + ')').html('&#9679;');
    });

    // portfolio: auto-start display cycle

    (function() {
        var lastSiteNo = 4;
        var siteNo = 0;

        var doIt = function(){
            $('.contrib:eq('+ lastSiteNo +')').css('display', 'none');
            $('.circleDot' + lastSiteNo).html('&#9675;');   //&#9675; unfilled circle

            $('.contrib:eq('+ siteNo +')').css('display', 'block');
            $('.site-slice:eq('+ siteNo +')').css('display', 'block').fadeOut(14950, "easeInQuint"); //fadeout just before switching
            $('.circleDot' + siteNo).html('&#9679;');       // filled circle

            if(++siteNo > 4)
                siteNo = 0;
            if(++lastSiteNo > 4)
                lastSiteNo = 0;

            portfolioTimer = setTimeout(doIt, 15000);
        },


        portfolioTimer = 1;
        doIt();
    })();

    $(".menu-button").click(function(){
        $(".menu-container").toggleClass("menu-hidden");
        $(".menu-container").toggleClass("menu-visible");
    });

    $('#cover').removeClass("hidden");
    $('#cover').addClass("visible");
    setTimeout(function(){ $(".menu-container").css("opacity", 1); }, 4000); /* to prevent showing the initial animation on the menu container */
});
