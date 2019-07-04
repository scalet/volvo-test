function openRightSideScreen(title, route, loadCallback) {

    var rSideBar = $('.right-sidebar');
    var rPanelBody = $('.r-panel-body');

    if (rSideBar.data('url') != null && route != rSideBar.data('url')) {
        rSideBar.slideDown(50);
        rSideBar.toggleClass('shw-rside');
    }

    if (rSideBar.attr('class').indexOf('shw-rside') < 0) {
        $('.rpanel-title>label').html(title);
        rSideBar.data('url', route);
        rPanelBody.html('<div class="text-center"><img src="/images/loading.gif"></div>');
        rPanelBody.load(route, function () {
            setButtonType();
            $('#color').colorpicker();
            setCloseRightSideScreen();
        });
    }

    rSideBar.slideDown(50);
    rSideBar.toggleClass('shw-rside');
}

function setCloseRightSideScreen()
{
    $('.right-sidebar-close').unbind().click(function () {
        var rSideBar = $('.right-sidebar');
        rSideBar.slideDown(50);
        rSideBar.toggleClass('shw-rside');
        rSideBar.data('url', null);
    }).tooltip();
}

function setButtonType() {
    if ($('.btn-volvo')[0]) {
        $('.btn-volvo').click(function () {
            $('#numberOfPassengers').val($(this).find('input').data('passenger'));
        });
    }
}

$(function () {
    //Set the close button
    setCloseRightSideScreen();
});
