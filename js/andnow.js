jQuery(function($) {
    var portfolioTimer = null;
    var i;


    /* Look Ma, no plug-ins...
     *
     * Here is the original plan for this cool looking scroll effect was planned. Along the road of developing the script I made some adjustments, but it
     * turned out pretty close to my original plan.
     *
     *  First of all, we want the scrollbar to work normally by making the document's body height is equal to the sum of the screen height multiplied by
     * the number of page-layers we are showing the user.
     *
     * The page's scroll effect will be simulated by the transform: translateY(Ypx) or -webkit-translate(Ypx), where Y equals the distance from 0, the top
     * line of the screen.
     *
     * Each "page" is a separate layer. Each page will be set as an HTML5 section. The pages are "position: fixed". In all cases the min-height is
     * equal to the browser's height.
     *
     * The current layer with the z-index value that has a "transform" value of "translate(-1 * screen height) is not visible. The next time the up arrow is
     * pressed will cause the layer's class changed to hidden and the layer's display property set to "none".  The layer below it will have its class set to
     * current.
     *
     * So if the page's (the screen's) height is 500px then the section will be scrolled off the screen when it has an attribute of translateY(-500px).
     * When the "current" page (the section with class:current and translateY value equal to the (screen height * -1) is scrolled off the screen, its
     * class is changed from current to hidden and the display property is set to "none". The layer below it has its class set to current from hidden.
     *
     *
     */



    /* initialize */

    $(document).ready(function () {
        var bodyHeight = 0;
        var layerHeight;
        var index = 0;
        var priorIndex = 0;
        var dataPosition = 0;

        for (index = 0; index < 4; index++) {
            if (index < 3) {
                layerHeight = 600; // set pages to be 600px tall
            } else {
                layerHeight = 890; // except last page {portfolio)
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
        keyboardHandler();
    });







    function keyboardHandler() {
        var fromBodyTop;
        var layerHeight;
        var $activeSelector;
        var $activeId;
        var $oldId;
        var layerCurrentPosition;
        var direction;

        $activeSelector     = $(".active");
        $activeId           = $activeSelector.prop("id");
        fromBodyTop         = 0;
        layerHeight         = parseInt($activeSelector.attr("data-layer-height"), 10);
        layerCurrentPosition= parseInt($activeSelector.attr("data-layer-current-position"), 10);


        positionScrollbar = function(){
            switch ($activeId){
                case "home":
                $(document).scrollTop(0);
                break;

                case "about":
                $(document).scrollTop(600);
                break;

                case "contact":
                $(document).scrollTop(1200);
                break;

                case "portfolio":
                $(document).scrollTop(1800);
                break;
            }
        }


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

            if (ignoreIt === false){
                positionScrollbar();
                checkLimits();
            }
        });


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


        function checkLimits() {
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
                console.log("layerCurrentPosition: " + layerCurrentPosition + " < layerHeight: " + layerHeight);

                if ($activeId != "portfolio") {
                    $oldId = $activeId;
                    $activeSelector.removeClass("active").next().addClass("active");
                    $activeSelector = $(".active");
                    $activeId = $activeSelector.prop("id");
                    layerHeight         = parseInt($activeSelector.attr("data-layer-height"), 10);
                    fromBodyTop         = parseInt($activeSelector.attr("data-layer-start"), 10);

                    $activeSelector.css("margin-top", 0);
                } else {
                    //alert("end of portfolio");
                    $activeSelector.css("margin-top", 0);
                }
                console.log("layerCurrentPosition: " + layerCurrentPosition + " layerHeight: " + layerHeight + " Scrolled forward and the bottom of layer '" + $oldId +
                    "' was reached. Changed active layer to the top of: '" + $activeId + "'\n");
                layerCurrentPosition = -40;
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
    }








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
    };

    sampleSites();

    $(".menu-button").click(function () {
        $(".menu-container").toggleClass("menu-hidden");
        $(".menu-container").toggleClass("menu-visible");
    });

    $('#cover').removeClass("hidden");
    $('#cover').addClass("visible");
    setTimeout(function () { $(".menu-container").css("opacity", 1); }, 4000); /* to prevent showing the initial animation on the menu container */
});
