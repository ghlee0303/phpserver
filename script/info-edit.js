var btn_1 = document.querySelectorAll('.item_1');
var menu_1 = document.getElementById('dropdownMenu1');
var btn_2 = document.querySelectorAll('.item_2');
var menu_2 = document.getElementById('dropdownMenu2');

[].forEach.call(btn_1, function(e){ 
    e.addEventListener("click", function(){
        var index = getElementIndex(btn_1, e);
        menu_1.innerText = btn_1[index].innerText;
    }, false); 
});

[].forEach.call(btn_2, function(e){ 
    e.addEventListener("click", function(){
        var index = getElementIndex(btn_2, e);
        menu_2.innerText = btn_2[index].innerText;
    }, false); 
});

function getElementIndex(e, range) {
if (!!range) return [].indexOf.call(e, range);
    return [].indexOf.call(e.parentNode.children, e);
}

