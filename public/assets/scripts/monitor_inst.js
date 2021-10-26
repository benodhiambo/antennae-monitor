$(document).ready(function() {

    $('#monitors_table').DataTable({
        "scrollY": 300,
        "scrollX": true,
        "lengthMenu": [[10, 20, 50, 100, -1], [10, 20, 50, 100, "All"]]
    });
});