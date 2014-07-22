/* jshint jquery:true */


$(document).ready(function () {
	var rotateTracker = 0;
	var portfolioTimer = null;
	var lastSiteNo = 3;
	var siteNo = 4;
	
	
	
	
	
	
	// make all the section equal height
	$("#home, #about, #contact").height($(window).height());
	$("#portfolio").css("height", "auto");

	
	/*
	 *- - - - - - - - - - - - - - - - - - - - - - - - - - - - - +
	 *															|
	 * highlightMenuItem() accepts 1 argument, the section of	|
	 * the page to scroll into the visible area, which we		|
	 * signal using class active-section.						|
	 *															|
	 *- - - - - - - - - - - - - - - - - - - - - - - - - - - - - +
	 */
	
	var highlightMenuItem = function (page) {
		var i;
		for (i = 0; i < 4; i++) {
			$(".menu-container").find("div").eq(i).removeClass("active-section");
		}
		$(".menu-container").find("div").eq(page).addClass("active-section");
	};

	$(".menu-container div, #homeButton").click(function (e) {
		e.preventDefault();
		$(".menu-container").removeClass("menu-visible");
		$(".menu-container").addClass("menu-hidden");
		var target = "#" + $(this).text().toLowerCase();
		var $target = $(target);

		if (target === "#contact") {
			if ($(".bugs-bunny").hasClass("bugs-up")){
				$(".bugs-bunny").addClass("bugs-down").removeClass("bugs-up");
			} else {
				$(".bugs-bunny").addClass("bugs-up").removeClass("bugs-down");
			}
		}

		$('html, body').stop().animate({
			'scrollTop': $target.offset().top
		}, 900, 'swing', function () {
			window.location.hash = target;
		});
	});

	$(".bugs-bunny").click(function() {
		$(".bugs-bunny").addClass("bugs-down").removeClass("bugs-up");
	});
	$(".hole").click(function() {
		$(".bugs-bunny").addClass("bugs-up").removeClass("bugs-down");
	});

	$(document).scroll(function() {
		var fromTop = $(document).scrollTop();
		//console.log(fromTop);
		var page_break = $("#home").height();
		if (fromTop > page_break * 3) {
			highlightMenuItem(3);
			$(".bugs-bunny").addClass("bugs-down").removeClass("bugs-up");
		}else{
			if (fromTop > page_break * 2) {
				$(".bugs-bunny").addClass("bugs-up").removeClass("bugs-down");
				highlightMenuItem(2);
			}else{
				if (fromTop > page_break) {
					highlightMenuItem(1);
					$(".bugs-bunny").addClass("bugs-down").removeClass("bugs-up");
				}else{
					highlightMenuItem(0);
					$(".bugs-bunny").addClass("bugs-down").removeClass("bugs-up");
				}
			}
		}
	});

	$(".menu-button").click(function(){
		$(".menu-container").toggleClass("menu-hidden");
		$(".menu-container").toggleClass("menu-visible");
	});

	$('#cover').removeClass("hidden");
	$('#cover').addClass("visible");
	/* to prevent showing the initial animation on the menu container */
	window.setTimeout(function(){ $(".menu-container").css("opacity", 1); }, 4000); 

	
	
	
	
	// this is for rotating the star-pointed inner circle navigation
	function rotateStar(){
		rotateTracker = rotateTracker < -288 ? 0 : rotateTracker - 72;
		$(".mainCircle").css("transform", "rotate(" + rotateTracker + "deg)");
		if(typeof timeoutId == "number") {
			window.clearTimeout(timeoutId);
			console.log("cleared timeout");
			delete timeoutId;
		}
	}



	// portfolio: auto-start display cycle
	
	function switchSite() {
		if(typeof timeoutId == "number") {
			window.clearTimeout(timeoutId);
			console.log("cleared timeout");
			delete timeoutId;
			rotateStar();
		}

		siteNo > 3 ? siteNo = 0 : siteNo++;
		lastSiteNo > 3 ? lastSiteNo = 0 : lastSiteNo++;
		
		console.log("siteNo: %s lastSiteNo %s", siteNo, lastSiteNo);

		$('.contrib:eq(' + lastSiteNo + ')').css('display', 'none');

		$('.contrib:eq(' + siteNo + ')').css('display', 'block');
		$('.site-slice:eq(' + siteNo + ')').css('display', 'block').fadeOut(9950, "easeInQuint"); //fadeout just before switching
		timeoutId = window.setTimeout(switchSite, 10000);
	}

	
	
	// When you directly click on the start
	$(".innerCircle").on("click", function(){
		console.log("manual click. hiding view of siteNo %s", siteNo);
		$('.site-slice:eq(' + siteNo + ')').css('display', 'none');
		switchSite();
		timeout = false;
		return false;
	});


	switchSite();
});