$(document).ready(function() {
    $(".event-info.list").hover(function(){
        $(this).children('div.order').slideDown(100);
    }, function(){
        $(this).children('div.order').slideUp(100);
    });
});

function showHideFAQAnswer(el) {
    var sibling = el.nextSibling;
    if(sibling.style.display == 'block') {
        sibling.style.display = 'none';
    } else {
        sibling.style.display = 'block';
    }
}