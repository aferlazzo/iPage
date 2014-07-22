/* Author - Anthony Ferlazzo */
$(function() {

    // First we create the Reservation object constructor.
    // Later we will send a validated instance of the object to the server for processing.

    var Reservation = function(firstName, lastName, inDate, outDate, roomPrice, roomType){
        this.firstName = firstName;
        this.lastName  = lastName;
        this.inDate    = inDate;
        this.outDate   = outDate;
        this.roomPrice = roomPrice;
        this.roomType  = roomType;
    };

    var getStayDuration = function(inDate, outDate){
        var date1 = new Date(inDate);
        var date2 = new Date(outDate);

        var timeDiff = date2.getTime() - date1.getTime();
        var diffDays = Math.ceil(timeDiff / (1000 * 3600 * 24));

        if ((diffDays === "NaN") || (diffDays < 1)) {
            $(".stay-duration").text("Please double-check the date range").addClass("error");
        }else{
            $(".stay-duration").text("Reservation is for " + diffDays + " night").removeClass("error");
            if (diffDays > 1) {
                $(".stay-duration").text($(".stay-duration").text() + "s");
            }
        }
        return diffDays;
    };


    var roomPrice;
    var roomType;
    var guest_room_accessible_price = 150;
    var guest_room_accessible_descripton = "This mobility and hearing accessible suite features one king bed, and a roll-in shower. The room also has a visual alarm, and notification devices for the doorbell or door knock and incoming telephone calls. Wake up refreshed with a new sense of purpose after a relaxing night in our warm and inviting guest room featuring a king-sized bed. From the moment your head hits the pillow until you have to hit the shower, you'll know this is your home away from home. A thoughtful work space has been created to incorporate a sizable desk, dresser & television bench for seamless efficiency.";
    var guest_room_standard_price = 120;
    var guest_room_standard_description = "Experience our Sight and Sound Rooms and enjoy a truly amazing range of high-technology media equipment, including a connectivity panel for personal media devices and a digital sound projector. Sip a cool drink in front of a HD new-release movie on the 42-inch plasma TV. Stay connected with complimentary high-speed internet access.";
    var guest_room_suite_price = 230;
    var guest_room_suite_description = "Perfect for hospitality functions, our Luxury Suites consist of a parlor area with two bedrooms. Recently refurbished, you'll find elegant decor with fine-quality traditional furniture and enticing views.";

    // check the in/out dates whenever entered by user

    $(".inDate, .outDate").change(function(){
        var inDate = $(".inDate").val();
        var outDate = $(".outDate").val();
        if((inDate !== "") && (outDate !== "")) {
            getStayDuration(inDate, outDate);
        }
    });

    $( ".inDate, .outDate" ).datepicker({ minDate: 0, showAnim: "slideDown" });

    // preveiwed and selected room type details

    $( "#room-options" ).buttonset();

    var blank = function blank(){
        $(".previewed_guest_room").css("display", "none");
        $(".previewed_guest_room .guest_room_photo").css({"background": ""});
        $(".previewed_guest_room .guest_room_price").text("");
        $(".previewed_guest_room .guest_room_description").text("");
    };

    $("label[for='standard']").hover(function(){
        $(".previewed_guest_room").css("display", "block");
        $(".previewed_guest_room h3").css("margin-left", "-21px");
        $(".previewed_guest_room .guest_room_photo").css({"background": 'url("img/guestRoomStandard.jpg")'});
        $(".previewed_guest_room .guest_room_price").text("Standard Guest Rooms, $" + guest_room_standard_price + "/night");
        $(".previewed_guest_room .guest_room_description").text(guest_room_standard_description);
    }, function(){
        blank();
    });
    $("label[for='accessible']").hover(function(){
        $(".previewed_guest_room").css("display", "block");
        $(".previewed_guest_room h3").css("margin-left", "-27px");
        $(".previewed_guest_room .guest_room_photo").css({"background": 'url("img/guestRoomAccessible.jpg")'});
        $(".previewed_guest_room .guest_room_price").text("Accessible Guest Rooms, $" + guest_room_accessible_price + "/night");
        $(".previewed_guest_room .guest_room_description").text(guest_room_accessible_descripton);
    }, function(){
        blank();
    });
    $("label[for='suite']").hover(function(){
        $(".previewed_guest_room").css("display", "block");
        $(".previewed_guest_room h3").css("margin-left", "-5px");
        $(".previewed_guest_room .guest_room_photo").css({"background": 'url("img/guestRoomSuite.jpg")'});
        $(".previewed_guest_room .guest_room_price").text("Suite Guest Rooms, $" + guest_room_suite_price + "/night");
        $(".previewed_guest_room .guest_room_description").text(guest_room_suite_description);
    }, function(){
        blank();
    });

    $("label[for='standard']").click(function(){
        $(".reserved_guest_room h2").css("display", "inline-block");
        $(".reserved_guest_room h3").css("margin-left", "-21px");
        $(".reserved_guest_room .guest_room_photo").css({"background": 'url("img/guestRoomStandard.jpg")'});
        roomPrice = guest_room_standard_price;
        roomType  = "standard";
        $(".reserved_guest_room .guest_room_price").text("Standard Guest Rooms, $" + roomPrice + "/night");
        $(".reserved_guest_room .guest_room_description").text(guest_room_standard_description);
        $(".confirm-container").css("display", "block");
    });
    $("label[for='accessible']").click(function(){
        $(".reserved_guest_room h2").css("display", "inline-block");
        $(".reserved_guest_room h3").css("margin-left", "-27px");
        $(".reserved_guest_room .guest_room_photo").css({"background": 'url("img/guestRoomAccessible.jpg")'});
        roomPrice = guest_room_accessible_price;
        roomType  = "accessible";
        $(".reserved_guest_room .guest_room_price").text("Accessible Guest Rooms, $" + roomPrice + "/night");
        $(".reserved_guest_room .guest_room_description").text(guest_room_accessible_descripton);
        $(".confirm-container").css("display", "block");
    });
    $("label[for='suite']").click(function(){
        $(".reserved_guest_room h2").css("display", "inline-block");
        $(".reserved_guest_room h3").css("margin-left", "-5px");
        $(".reserved_guest_room .guest_room_photo").css({"background": 'url("img/guestRoomSuite.jpg")'});
        roomPrice = guest_room_suite_price;
        roomType  = "suite";
        $(".reserved_guest_room .guest_room_price").text("Suite Guest Rooms, $" + roomPrice + "/night");
        $(".reserved_guest_room .guest_room_description").text(guest_room_suite_description);
        $(".confirm-container").css("display", "block");
    });

    $(".confirm").click(function(){
        var reservationLength;
        var reservation = new Reservation(  $(".firstName").val(),
                                            $(".lastName").val(),
                                            $(".inDate").val(),
                                            $(".outDate").val(),
                                            roomPrice,
                                            roomType);

        if (reservation.firstName === ""){
            alert("Please enter your first name");
            $(".firstName").focus();
            return;
        }

        if (reservation.lastName === ""){
            alert("Please enter your last name");
            $(".lastName").focus();
            return;
        }

        if (reservation.inDate === ""){
            alert("Please choose your check-in date");
            $(".inDate").focus();
            return;
        }
        if (reservation.outDate === ""){
            alert("Please enter your check-out date");
            $(".outDate").focus();
            return;
        }
        reservationLength = getStayDuration(reservation.inDate, reservation.outDate);
        if (reservationLength === 0){
            alert("Reservation must be for at least 1 night");
            return;
        }
        if (reservationLength < 0){
            alert("The check-in date cannot be after the check-out date");
            return;
        }
        alert("Sending instance of Reservation object to server for processing:\n" +
            "firstName: " + reservation.firstName + "\n" +
            "lastName: "  + reservation.lastName  + "\n" +
            "inDate: "    + reservation.inDate    + "\n" +
            "outDate: "   + reservation.outDate   + "\n" +
            "roomPrice: " + reservation.roomPrice + "\n" +
            "roomType: "  + reservation.roomType);
    });
});