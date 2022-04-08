var btn = [];
var menu = [];

function dropdown_setting(index) { 
    console.log("dropdown : "+index);
    btn[index] = document.querySelectorAll('.item_' + index);
    menu[index] = document.getElementById('dropdownMenu'+index);

    [].forEach.call(btn[index], function (e) {
        e.addEventListener("click", function () {
            var key = getElementIndex(btn[index], e);
            menu[index].innerText = btn[index][key].innerText;
            menu[index].value = btn[index][key].value;
        }, false);
    });
}

function getElementIndex(e, range) {
    if (!!range) return [].indexOf.call(e, range);
    return [].indexOf.call(e.parentNode.children, e);
}

