$(document).ready(function() {
    $('#celllist_table').DataTable({
        dom : "<'row'<'col-md-6'<'row'<'col-md-3 vli'l><'col-md-9'i>>><'col-md-2 vl'f><'col-md-4 apt text-right'B>>" 
            + "<'row'<'col-md-12'tr>>" 
            + "<'row'<'col-md-6'i><'col-md-6'p>>",
        buttons: [
          'csv', 'pdf', 'print'
        ],
        "language": {
          "lengthMenu": "_MENU_",
          "info": "Showing _START_ to _END_ of _TOTAL_ cells",
        },
        "order": [[ 3, "desc" ], [ 2, 'asc' ]],
        "pageLength": 20,
        "lengthMenu": [[10, 20, 50, 100, -1], [10, 20, 50, 100, "All"]],
        "columnDefs": [{
                "targets": [ 0 ],
                "visible": false,
                "searchable": true
            }, {
                "targets": [ 1 ],
                "visible": true,
                "searchable": true
            }]
    });
});