var btn = [];
var menu = [];
var val = [];
btn[0] = document.querySelectorAll('.item_1');
btn[1] = document.querySelectorAll('.item_2');
menu[0] = document.getElementById('dropdownMenu1');
menu[1] = document.getElementById('dropdownMenu2');
val[0] = document.getElementById('val_1');
val[1] = document.getElementById('val_2');

[].forEach.call(btn[0], function(e){ 
    e.addEventListener("click", function () {
        var index = getElementIndex(btn[0], e);
        menu[0].innerText = btn[0][index].innerText;
        //val[0].value = btn[0][index].value;
    }, false); 
});

[].forEach.call(btn[1], function(e){ 
    e.addEventListener("click", function () {
        var index = getElementIndex(btn[1], e);
        menu[1].innerText = btn[1][index].innerText;
        //val[1].value = btn[1][index].value;
    }, false); 
});

function getElementIndex(e, range) {
if (!!range) return [].indexOf.call(e, range);
    return [].indexOf.call(e.parentNode.children, e);
}

