
function showHideFAQAnswer(el) {
    var sibling = el.nextSibling;
    if(sibling.style.display == 'block') {
        sibling.style.display = 'none';
    } else {
        sibling.style.display = 'block';
    }
}