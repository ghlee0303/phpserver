var btn = document.querySelectorAll('.dropdown-item');
var menu = document.getElementById('dropdownMenu1');

[].forEach.call(btn, function(e){ 
    e.addEventListener("click", function(){
        var index = getElementIndex(btn, e);
        menu.innerText = btn[index].innerText;
    }, false); 
});

function getElementIndex(e, range) {
if (!!range) return [].indexOf.call(e, range);
    return [].indexOf.call(e.parentNode.children, e);
}