$(function () {
    var vehicles = ['Bus','Car','Truck'];
    var data = {series: [$('#totBuses').html(), $('#totCars').html(), $('#totTrucks').html()]};

    if ($('.ct-chart')[0]) {
        new Chartist.Pie('.ct-chart', data, {
            labelInterpolationFnc: function (value, idx) {
                if (value > 0) {
                    var percentage = Math.round(value / $('#totVehicles').html() * 100) + '%';
                    return vehicles[idx] + ' ' + percentage;
                }
            },
            'width': 300,
            'height': 200
        });
    }

    $('#fleetTable').DataTable({
        'order': [[2, 'desc']],
        'aoColumns': [
            null,
            null,
            null,
            { 'bSortable': false },
            { 'bSortable': false }
        ],
        'columnDefs': [
            { type: 'natural', targets: 1 }
        ]
    });


    $('.btn-add-vehicle').click(function () {
        openRightSideScreen('Add a vehicle', '/vehicles/create');
    }).tooltip();

    $('.btn-change-color').click(function () {
        openRightSideScreen('Set vehicle color', '/vehicles/' + $(this).data('id') + '/set-color');
    }).tooltip();

    $('.btn-delete').click(function () {
        openRightSideScreen('Delete Vehicle', '/vehicles/' + $(this).data('id') + '/confirm-delete');
    });

    $('.btn-create').click(function () {
        e.preventDefault();
        $(this).addClass('fa-spinner').addClass('fa-spin');
    });
});
