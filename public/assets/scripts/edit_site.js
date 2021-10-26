$(document).ready(function() {

    $('table.display').DataTable({
        "lengthMenu": [[10, 20, 50, 100, -1], [10, 20, 50, 100, "All"]]
    });
    
    // https://webdesign.tutsplus.com/tutorials/how-to-add-deep-linking-to-the-bootstrap-4-tabs-component--cms-31180
    let url = location.href.replace(/\/$/, "");
   
    if (location.hash) {
      const hash = url.split("#");
      $('#sitesTab a[href="#'+hash[1]+'"]').tab("show");
      url = location.href.replace(/\/#/, "#");
      history.replaceState(null, null, url);
      setTimeout(() => {
        $(window).scrollTop(0);
      }, 400);
    } 
     
    $('a[data-toggle="tab"]').on("click", function() {
      let newUrl;
      const hash = $(this).attr("href");
      if(hash == "#overview") {
        newUrl = url.split("#")[0];
      } else {
        newUrl = url.split("#")[0] + hash;
      }
      newUrl += "/";
      history.replaceState(null, null, newUrl);
    });

    var mymap = L.map('mapid').setView([lat, long]).setZoom(17);
    var marker = L.marker([lat, long]).addTo(mymap);
    var circle = L.circle([lat, long], {
        color: 'red',
        fillColor: '#f03',
        fillOpacity: 0.5,
        radius: 150
    }).addTo(mymap);

    L.tileLayer('https://api.mapbox.com/styles/v1/{id}/tiles/{z}/{x}/{y}?access_token=pk.eyJ1IjoiYWxsdGhpbmdzZGV2IiwiYSI6ImNrOHJkcTJrbzAxeDkzbXBtbTdkN3M3MmUifQ.YEygLBcu0w-yWACoiQ1WGQ', {
        attribution: 'Map data &copy; <a href="https://www.openstreetmap.org/">OpenStreetMap</a> contributors, <a href="https://creativecommons.org/licenses/by-sa/2.0/">CC-BY-SA</a>, Imagery © <a href="https://www.mapbox.com/">Mapbox</a>',
        id: 'mapbox/streets-v11',
        tileSize: 512,
        zoomOffset: -1,
        accessToken: 'pk.eyJ1IjoiYWxsdGhpbmdzZGV2IiwiYSI6ImNrOHJkcTJrbzAxeDkzbXBtbTdkN3M3MmUifQ.YEygLBcu0w-yWACoiQ1WGQ'
    }).addTo(mymap);
    mymap.off();
    mymap.remove();

    $('.nav-tabs a[href="#map"]').on('shown.bs.tab', function(){
      var mymap = L.map('mapid').setView([lat, long]).setZoom(15);
      var marker = L.marker([lat, long]).addTo(mymap);
      var circle = L.circle([lat, long], {
          color: 'red',
          fillColor: '#f03',
          fillOpacity: 0.5,
          radius: 150
      }).addTo(mymap);

      L.tileLayer('https://api.mapbox.com/styles/v1/{id}/tiles/{z}/{x}/{y}?access_token=pk.eyJ1IjoiYWxsdGhpbmdzZGV2IiwiYSI6ImNrOHJkcTJrbzAxeDkzbXBtbTdkN3M3MmUifQ.YEygLBcu0w-yWACoiQ1WGQ', {
          attribution: 'Map data &copy; <a href="https://www.openstreetmap.org/">OpenStreetMap</a> contributors, <a href="https://creativecommons.org/licenses/by-sa/2.0/">CC-BY-SA</a>, Imagery © <a href="https://www.mapbox.com/">Mapbox</a>',
          id: 'mapbox/streets-v11',
          tileSize: 512,
          zoomOffset: -1,
          accessToken: 'pk.eyJ1IjoiYWxsdGhpbmdzZGV2IiwiYSI6ImNrOHJkcTJrbzAxeDkzbXBtbTdkN3M3MmUifQ.YEygLBcu0w-yWACoiQ1WGQ'
      }).addTo(mymap);
    });
});