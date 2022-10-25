$(document).ready(function () {
    var sidebarClass = sessionStorage.getItem('sidebar-class');
    if (sidebarClass) {
        $('.mi-sidebar').removeClass('mi-collapse');
        $('.mi-sidebar').addClass(sidebarClass);
    }

    $("#openCloseSideBar").change(function () {
        if (this.checked) {
            $('.mi-sidebar').removeClass('mi-collapse');
            $('.mi-sidebar').addClass('mi-expand');
            sessionStorage.setItem('sidebar-class', 'mi-expand');
        } else {
            $('.mi-sidebar').removeClass('mi-expand');
            $('.mi-sidebar').addClass('mi-collapse');
            sessionStorage.setItem('sidebar-class', 'mi-collapse');
        }
        console.log(sessionStorage.getItem('sidebar-class'));
    });

    $('.mi-on-hover,.mi-on-hover>i').hover(function () {
        $(this).popover("show");
    });
    $('.mi-on-hover , .mi-on-hover>i').mouseout(function () {
        $(this).popover("hide");
    });

    $(".active").parent().addClass("show");
    $(".show").prev().addClass("main-active");

    $('.mi-content').click(function(){
        var drodown = $('.mi-collapse .submenu.show').prev('.dropdown')[0]
        if (drodown) {
            drodown.click();
        }

    });
});
var popoverTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="popover"]'))
var popoverList = popoverTriggerList.map(function (popoverTriggerEl) {
    return new bootstrap.Popover(popoverTriggerEl)
});


//close message

setTimeout(() => {
    $('.mi-smart-alert .btn-close').click();
}, 4000)



//close message



document.addEventListener("DOMContentLoaded", function () {
    document.querySelectorAll('.dropdown').forEach(function (element) {

        element.addEventListener('click', function (e) {

            let nextEl = element.nextElementSibling;
            let parentEl = element.parentElement;
            if (nextEl) {
                e.preventDefault();
                let mycollapse = new bootstrap.Collapse(nextEl);

                if (nextEl.classList.contains('show')) {
                    mycollapse.hide();
                } else {
                    mycollapse.show();
                    // find other submenus with class=show
                    var opened_submenu = parentEl.parentElement.querySelector('.submenu.show');
                    // if it exists, then close all of them
                    if (opened_submenu) {
                        new bootstrap.Collapse(opened_submenu);
                    }
                }
            }
        }); // addEventListener
    }) // forEach
});


var collection = [];
var params = JSON.parse($('#_params').val());
var params = Object.entries(params);
params.map((item, index, array) => {
    collection.push({
        name: item[0],
        value: item[1]
    });
})


function collectSearchData(event) {
    console.log(event);
    let nameExist = false;
    const name = event.target.name;
    const value = event.target.value;
    if (collection.length > 0) {
        collection.map((item, index, array) => {
            if (item.name == name) {
                nameExist = true;
                collection[index].value = value;
            }
        })
    }

    if (collection.length > 0) {
        if (!nameExist) {
            collection.push({
                name: name,
                value: value
            });
        }
    } else {
        collection.push({
            name: name,
            value: value
        });
    }
    console.log(collection);
}

function search() {
    var url = '?';
    if (collection.length > 0) {
        collection.map((item, index, array) => {
            if (item.value !== '') {
                url += item.name + '=' + item.value + '&'
            }
        });
        window.location.href = url;
    }
}

function loader() {
    $('.mi-loader').removeClass('d-none');
    return true;
}
