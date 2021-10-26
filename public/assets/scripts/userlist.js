$(document).ready(function() {

    $('#userlist_table').DataTable({
        "scrollX": true,
        "lengthMenu": [[20, 50, 100, -1], [20, 50, 100, "All"]],
    });

});