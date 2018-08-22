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
});
