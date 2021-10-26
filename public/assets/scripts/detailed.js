$(document).ready(function () {

    $('#detailed_table').DataTable({
        responsive: false,
        scrollX: true,
        dom: "<'row'<'col-md-6'<'row'<'col-md-3 vli'l><'col-md-9'i>>><'col-md-2 vl'f><'col-md-4 apt text-right'B>>"
            + "<'row'<'col-md-12'tr>>"
            + "<'row'<'col-md-6'i><'col-md-6'p>>",
        buttons: [
            'csv', 'pdf', 'print'
        ],
        "language": {
            "lengthMenu": "_MENU_",
            "info": "Showing _START_ to _END_ of _TOTAL_ entries",
        },
        "pageLength": 10,
        "lengthMenu": [[10, 20, 50, 100, -1], [10, 20, 50, 100, "All"]],
        "columnDefs": [{
            "targets": [0,1,7,8,14],
            "className": "dt-center"
        }, {
            "targets": [9,12],
            "visible": false,
            "searchable": true
        }, {
            "targets": ["_all"],
            "className": "dt-head-center"
        }, {
            "targets": [6],
            "searchable": false
        }]
    }).columns.adjust().draw();

    // https://webdesign.tutsplus.com/tutorials/how-to-add-deep-linking-to-the-bootstrap-4-tabs-component--cms-31180
    let url = location.href.replace(/\/$/, "");

    if (location.hash) {
        const hash = url.split("#");
        $('#summaryTab a[href="#' + hash[1] + '"]').tab("show");
        url = location.href.replace(/\/#/, "#");
        history.replaceState(null, null, url);
        setTimeout(() => {
            $(window).scrollTop(0);
        }, 400);
    }

    $('a[data-toggle="tab"]').on("click", function () {
        let newUrl;
        const hash = $(this).attr("href");
        if (hash == "#all") {
            newUrl = url.split("#")[0];
        } else {
            newUrl = url.split("#")[0] + hash;
        }
        newUrl += "/";
        history.replaceState(null, null, newUrl);
    });

});