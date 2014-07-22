/*
function pageDimensions(pageId) {
    var total = 0;
    var header = 0;
    var content = 0;
    var footer = 0;
    var filler;

    console.log("div [0]: " + $(pageId  + " div").eq(0).attr("data-role")); //header
    console.log("div [0]: " + $(pageId  + " div").eq(0).attr("data-position")); //header
    console.log("div [1]: " + $(pageId  + " div").eq(1).attr("data-role")); //content
    console.log("div [1]: " + $(pageId  + " div").eq(1).attr("class")); //content
    console.log("div [2]: " + $(pageId  + " div").eq(2).attr("data-role")); //footer
    console.log("div [2]: " + $(pageId  + " div").eq(2).attr("data-position")); //footer

    total   = $(pageId).height();
    header  = $(pageId + " div").eq(0).height();
    content = $(pageId + " div").eq(1).height();
    footer  = $(pageId + " div").eq(2).height();
    filler  = total - header - content - footer;

    console.log("total height of "   + pageId + " is "  + total);
    console.log("header height is "  + header);
    console.log("content height is " + content);
    console.log("filler height is "  + filler);
    console.log("footer height is "  + footer);
}

$(document).ready(function() {
    var homeObj = {};
    var total = 0, header, content, filler, footer;
    $(document).on( "mobileinit", function() {
        $.mobile.buttonMarkup.hoverDelay = 100; // to smooth out transitions
    });

    pageDimensions("#home");
    pageDimensions("#recruiters");
    pageDimensions("#employers");
    pageDimensions("#contact");
    pageDimensions("#about");
});
*/