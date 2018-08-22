$(document).ready(function() {
    $(".event-info.list").hover(function(){
        $(this).children('div.order').slideDown(100);
    }, function(){
        $(this).children('div.order').slideUp(100);
    });
    
    $("#faqs dt").on('click', function() {
        $("#faqs dd").slideUp();
        if ($(this).next().is(':hidden')) {
            $(this).next("dd").slideDown();
        }
    });
    
    // Fade in/out the controls for the slider
    $("#homeslider").hover(function(){
        $(".slider-control").fadeIn();
    }, function(){
        $(".slider-control").fadeOut();
    });
    
    // Move to the next slider item on click
    $("#homeslider #next").on('click', function(event) {
        // check if the right end of the slider is reached
        if(getSliderLeftPosition() > (($("#homeslider li").length - 1) * 600 * -1)) {
            $("#homeslider li").animate({
                left: '-=600'
            }, 500);
        }
        $( "#homeslider li" ).promise().done(setEventInfo);
        event.preventDefault();
    });
    // Move to the previous slider item on click
    $("#homeslider #previous").on('click', function(event) {
        // check if the left end of the slider is reached
        if(getSliderLeftPosition() < 0) {
            $("#homeslider li").animate({
                left: '+=600'
            }, 500);
        }
        $( "#homeslider li" ).promise().done(setEventInfo);
        event.preventDefault();
    });
    setEventInfo();
});

function setEventInfo() {
    var index = (getSliderLeftPosition() * -1) / 600;
    $('#info-frame p').text($('#homeslider li').eq(index).attr('data-info'));
}

function getSliderLeftPosition() {
    var elemOffset = $('#homeslider li:first').position();
    return elemOffset.left;
}