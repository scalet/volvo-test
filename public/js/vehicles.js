function openRighSideScreen(route) {

    var rSideBar = $('.right-sidebar');
    var rPanelBody = $('.r-panel-body');

    if (!rSideBar.attr('shw-rside')) {

        rPanelBody.html('');
        rPanelBody.load(route);
    }

    rSideBar.slideDown(50)
    rSideBar.toggleClass('shw-rside');
}

$(function () {
    $('.btn-change-color').click(function () {
        openRighSideScreen('/vehicles/create');
    });
});
