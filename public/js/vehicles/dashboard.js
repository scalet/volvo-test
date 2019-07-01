$(function () {
    var vehicles = ['Bus','Car','Truck'];
    var data = {series: [$('#totBuses').html(), $('#totCars').html(), $('#totTrucks').html()]};

    new Chartist.Pie('.ct-chart', data, {
        labelInterpolationFnc: function(value, idx) {
            var percentage = Math.round(value / $('#totVehicles').html() * 100) + '%';
            return vehicles[idx] + ' ' + percentage;
        },
        'width': 300,
        'height': 200
    });

    $('#fleetTable').DataTable({
        'order': [[0, 'desc'], [1, 'desc'], [2, 'desc']],
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
});
