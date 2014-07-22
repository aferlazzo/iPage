


$(document).ready(function () {
    var portfolioTimer = null;
    var scroll = {
        init: function(){
            var bodyHeight = 0;
            var layerHeight;
            var index = 0;
            var priorIndex = 0;
            var dataPosition = 0;
            var hh = parseInt($(document).height(), 10);

            for (index = 0; index < 4; index++) {
                if (index < 3) {
                    layerHeight = hh;
                } else {
                    layerHeight = hh;
                }
                bodyHeight += layerHeight;
                $("section").eq(index).css("height", layerHeight)
                                  .css("min-height", layerHeight)
                                  .attr("data-layer-height", layerHeight)
                                  .attr("data-layer-current-position", "0");

                if (index > 0) {
                    priorIndex = index - 1;
                    dataPosition = parseInt($("section").eq(priorIndex).attr("data-layer-start"), 10) + parseInt($("section").eq(priorIndex).attr("data-layer-height"), 10);
                }

                $("section").eq(index).attr("data-layer-start", dataPosition); // dataPosition: the height of last layer
                console.log("section[" + index + "] data-layer-start: " + dataPosition + ", data-layer-height: " + $("section").eq(index).attr("data-layer-height"));
            }

            console.log("bodyHeight: " + bodyHeight);
            $("body").css("height", bodyHeight);
        },

        keyboardHandler: function () {
            var fromBodyTop;
            var layerHeight;
            var $activeSelector;
            var $activeId;
            var $oldId;
            var layerCurrentPosition;
            var direction;

            var positionScrollbar = function () {
                switch ($activeId){
                    case "home":
                    $(document).scrollTop(0);
                    break;

                    case "about":
                    $(document).scrollTop(hh * 0.33);
                    break;

                    case "contact":
                    $(document).scrollTop(hh * 0.66);
                    break;

                    case "portfolio":
                    $(document).scrollTop(hh);
                    break;
                }
            }

            function addHandlers () {
                // bind handler for keypress event

                $(document).keydown(function(e) {
                    var ignoreIt = false;

                    //console.log('You pressed key: '+ e.keyCode);

                    switch (e.keyCode) {
                        case 40: console.log('You pressed DownArrow key');
                            layerCurrentPosition -= 40;
                            direction = 'forward';
                            break;

                        case 38: console.log('You pressed Up Arrow key');
                            layerCurrentPosition += 40;
                            direction = 'backward';
                            break;

                        case 34: console.log('You pressed PageDown key');
                            if ($activeId !== "portfolio"){
                                $activeSelector.css("margin-top", layerHeight);
                                $oldId = $activeId;
                                $activeSelector.removeClass("active").next().addClass("active");
                                $activeSelector = $(".active");
                                $activeId = $activeSelector.prop("id");
                                layerHeight         = parseInt($activeSelector.attr("data-layer-height"), 10);
                                fromBodyTop         = parseInt($activeSelector.attr("data-layer-start"), 10);
                                layerCurrentPosition = 0;
                                direction = 'forward';
                            } else {
                                ignoreIt = true;
                            }
                            break;

                        case 33: console.log('You pressed PageUp key');

                            if ($activeId !== "home"){
                                $activeSelector.css("margin-top", 0);
                                $oldId = $activeId;
                                $activeSelector.removeClass("active").prev().addClass("active");
                                $activeSelector = $(".active");
                                $activeId = $activeSelector.prop("id");
                                layerHeight         = parseInt($activeSelector.attr("data-layer-height"), 10);
                                fromBodyTop         = parseInt($activeSelector.attr("data-layer-start"), 10);
                                layerCurrentPosition = 0;
                                direction = 'backward';
                            } else {
                                ignoreIt = true;
                            }
                            break;

                        default: //console.log('You pressed an uninteresting key');
                            ignoreIt = true;
                    }

                    if ((ignoreIt === false)){
                        //positionScrollbar();
                        checkLimits();
                    }
                });
                /* end of keydown event handler */
            }

            addHandlers();

            function mWheel () {
                $(document).bind('mousewheel', function(event, delta) {
                    var dir = delta > 0 ? 'Up' : 'Down';
                    var vel = Math.abs(delta);

                    if (dir == 'Up'){
                        layerCurrentPosition += 40;
                        direction = 'backward';
                    }
                    if (dir == 'Down'){
                        layerCurrentPosition -= 40;
                        direction = 'forward';
                    }
                    console.log(dir + ' mouse wheel');
                    checkLimits();
                });
                /* end of mouse-wheel event handler */
            }

            mWheel();


            function checkLimits () {
                if ((direction === "backward") && (layerCurrentPosition > 0)) {
                    console.log("layerCurrentPosition: " + layerCurrentPosition + " > 0");
                    if ($activeId != "home") {
                        $oldId = $activeId;
                        $activeSelector.removeClass("active").prev().addClass("active");
                        $activeSelector = $(".active");
                        $activeId = $activeSelector.prop("id");
                        layerHeight = parseInt($activeSelector.attr("data-layer-height"), 10);
                        fromBodyTop = parseInt($activeSelector.attr("data-layer-start"), 10);

                        $activeSelector.css("margin-top", layerHeight);

                        layerCurrentPosition    = -1 * parseInt($activeSelector.attr("data-layer-height"), 10);
                        console.log("Changed active layer to the end of: '" + $activeId + " layerCurrentPosition: " + layerCurrentPosition + " layerHeight: " + layerHeight + "\n");
                    } else {
                        layerCurrentPosition = 0;
                    }
                }

                if ((direction === "forward") && (layerCurrentPosition < -1 * layerHeight)) {
                    console.log("layerCurrentPosition: " + layerCurrentPosition + " < layerHeight: " + -1 * layerHeight);

                    if ($activeId != "portfolio") {
                        $activeSelector.css("margin-top", -1 * layerHeight); // completely hide to layer before shifting to next layer
                        $oldId = $activeId;
                        $activeSelector.removeClass("active").next().addClass("active");
                        $activeSelector = $(".active");
                        $activeId = $activeSelector.prop("id");
                        layerHeight         = parseInt($activeSelector.attr("data-layer-height"), 10);
                        fromBodyTop         = parseInt($activeSelector.attr("data-layer-start"), 10);
                        layerCurrentPosition = 0;
                    }

                    $activeSelector.css("margin-top", 0);

                    console.log("layerCurrentPosition: " + layerCurrentPosition + " layerHeight: " + layerHeight + " Scrolled forward and the bottom of layer '" + $oldId +
                        "' was reached. Changed active layer to the top of: '" + $activeId + "'\n");
                    //layerCurrentPosition = -40;
                }

                if (((direction == "backward") && (layerCurrentPosition <= 0))
                 || ((direction == "forward") && (layerCurrentPosition >= -1 * layerHeight))) {
                    $activeSelector.attr("data-layer-current-position",  layerCurrentPosition + "");
                    $activeSelector.css("margin-top", layerCurrentPosition);
                }

                $(document).scrollTop(fromBodyTop - layerCurrentPosition);
                console.log("activeId: \"" + $activeId + "\" fromBodyTop: " + fromBodyTop + " layerCurrentPosition: " + layerCurrentPosition + " layer: \"" +
                    $activeId + "\" layerHeight: " + layerHeight + " scroll position: " + $(document).scrollTop());
            }
            /* end of checkLimits */

            $activeSelector     = $(".active");
            $activeId           = $activeSelector.prop("id");
            fromBodyTop         = 0;
            layerHeight         = parseInt($activeSelector.attr("data-layer-height"), 10);
            layerCurrentPosition= parseInt($activeSelector.attr("data-layer-current-position"), 10);
        }
        /* end of keyboardhandler */
    };
    /* end of scroll object */

    scroll.init();
    scroll.keyboardHandler();
});
/* end of device ready */





    // portfolio: click on a circle/dot or on the site thumbnail to stop cycling
    $('.circleDot').click(function () {
        var cIndex;
        cIndex = $(this).index();
        clearTimeout(portfolioTimer);

        $('.circleDot').each(
            function (i) {
                $('.contrib:eq(' + i + ')').css('display', 'none');
                $('.site-slice:eq(' + i + ')').css('display', 'none');
                $('.circleDot:eq(' + i + ')').html('&#9675;'); //&#9675; unfilled circle
            }
        );

        $('.contrib:eq(' + cIndex + ')').css('display', 'block');
        $('.site-slice:eq(' + cIndex + ')').css('display', 'block');
        $('.circleDot:eq(' + cIndex + ')').html('&#9679;');
    });

    // portfolio: auto-start display cycle

    var sampleSites = function () {
        var lastSiteNo = 4;
        var siteNo = 0;
        var doIt = function () {
            $('.contrib:eq(' + lastSiteNo + ')').css('display', 'none');
            $('.circleDot' + lastSiteNo).html('&#9675;');   //&#9675; unfilled circle

            $('.contrib:eq(' + siteNo + ')').css('display', 'block');
            $('.site-slice:eq(' + siteNo + ')').css('display', 'block').fadeOut(14950, "easeInQuint"); //fadeout just before switching
            $('.circleDot' + siteNo).html('&#9679;');       // filled circle

            siteNo++;
            if (siteNo > 4) {
                siteNo = 0;
            }
            lastSiteNo++;
            if (lastSiteNo > 4) {
                lastSiteNo = 0;
            }
            portfolioTimer = setTimeout(doIt, 15000);
        },


            portfolioTimer = 1;
        doIt();
    }

    sampleSites();

    $(".menu-button").click(function () {
        $(".menu-container").toggleClass("menu-hidden");
        $(".menu-container").toggleClass("menu-visible");
    });

    $('#cover').removeClass("hidden");
    $('#cover').addClass("visible");
    setTimeout(function () { $(".menu-container").css("opacity", 1); }, 4000); /* to prevent showing the initial animation on the menu container */

