$(document).ready(function() {

    $('#install_reports_table').DataTable({
        responsive: true,
        dom : "<'row'<'col-md-6'<'row'<'col-md-3 vli'l><'col-md-9'i>>><'col-md-2 vl'f><'col-md-4 apt text-right'B>>" 
            + "<'row'<'col-md-12'tr>>" 
            + "<'row'<'col-md-6'i><'col-md-6'p>>",
        buttons: [
          'csv', 'pdf', 'print'
        ],
        "language": {
          "lengthMenu": "_MENU_",
          "info": "Showing _START_ to _END_ of _TOTAL_ alerts",
        },
        "pageLength": 20,
        "lengthMenu": [[10, 20, 50, 100, -1], [10, 20, 50, 100, "All"]],
        "columnDefs": [{
            "targets": [ 0 ],
            "width" : "17%"
        }, {
            "targets": [ 1 ],
            "width" : "10%"
        }, {
            "targets": [ 2 ],
            "width" : "20%"
        }, {
            "targets": [ 6 ],
            "searchable": false,
            "width" : "10%"
        }]
    }).columns.adjust().draw();

    $('#test_reports_table').DataTable({
        responsive: true,
        dom : "<'row'<'col-md-6'<'row'<'col-md-3 vli'l><'col-md-9'i>>><'col-md-2 vl'f><'col-md-4 apt text-right'B>>"  
            + "<'row'<'col-md-12'tr>>" 
            + "<'row'<'col-md-6'i><'col-md-6'p>>",
        buttons: [
          'csv', 'pdf', 'print'
        ],
        "language": {
          "lengthMenu": "_MENU_",
          "info": "Showing _START_ to _END_ of _TOTAL_ alerts",
        },
        "pageLength": 20,
        "lengthMenu": [[10, 20, 50, 100, -1], [10, 20, 50, 100, "All"]]
    }).columns.adjust().draw();

    $('#accept_reports_table').DataTable({
        responsive: true,
        dom : "<'row'<'col-md-6'<'row'<'col-md-3 vli'l><'col-md-9'i>>><'col-md-2 vl'f><'col-md-4 apt text-right'B>>" 
            + "<'row'<'col-md-12'tr>>" 
            + "<'row'<'col-md-6'i><'col-md-6'p>>",
        buttons: [
          'csv', 'pdf', 'print'
        ],
        "columnDefs": [{
          "targets": [ 0 ],
          "visible" : false
        }],
        "language": {
          "lengthMenu": "_MENU_",
          "info": "Showing _START_ to _END_ of _TOTAL_ alerts",
        },
        "pageLength": 20,
        "lengthMenu": [[10, 20, 50, 100, -1], [10, 20, 50, 100, "All"]]
    }).columns.adjust().draw();

    
    $("#changeAcceptanceForm").click(function(){
      $("#toggleView").toggle();
    });

    // https://webdesign.tutsplus.com/tutorials/how-to-add-deep-linking-to-the-bootstrap-4-tabs-component--cms-31180
    let url = location.href.replace(/\/$/, "");
   
    if (location.hash) {
      const hash = url.split("#");
      $('#alertsTab a[href="#'+hash[1]+'"]').tab("show");
      url = location.href.replace(/\/#/, "#");
      history.replaceState(null, null, url);
      setTimeout(() => {
        $(window).scrollTop(0);
      }, 400);
    } 
     
    $('a[data-toggle="tab"]').on("click", function() {
      let newUrl;
      const hash = $(this).attr("href");
      if(hash == "#all") {
        newUrl = url.split("#")[0];
      } else {
        newUrl = url.split("#")[0] + hash;
      }
      newUrl += "/";
      history.replaceState(null, null, newUrl);
    });

});