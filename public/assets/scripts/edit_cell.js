$(document).ready(function() {

    $('table.display').DataTable({
        "lengthMenu": [[5, 10, 20, -1], [5, 10, 20, "All"]]
    });

    /*
|--------------------------------------------------------------------------
| LINE GRAPH
|--------------------------------------------------------------------------
*/
    Chart.defaults.global.defaultFontFamily = 'Varela Round', 'sans-serif';
    Chart.defaults.global.defaultFontColor = 'black';

    Chart.defaults.global.animation.duration = 700;
    Chart.defaults.global.animation.easing = 'linear';

    // TITLE CONFIGURTAION
    Chart.defaults.global.title.fontSize = 16;
    Chart.defaults.global.title.fontStyle = 'normal';
    Chart.defaults.global.title.fontColor = 'rgb(65, 65, 65)';

    Chart.defaults.global.legend.labels.fontSize = 12;
    Chart.defaults.global.legend.labels.fontStyle = 'normal';

    var voltageLineGraph = document.getElementById("voltageLineGraph"); 
    voltageLineGraph.style.backgroundColor = '#f5f9ff';



    var labelArray = [];
    var voltageArray = [];
    for(var i=1;i<lc_volt.length;i++){
      var created = new Date(lc_volt[i]['created_at']);
      hours = created.getUTCHours(); 
      minutes = created.getUTCMinutes(); 
      seconds = created.getSeconds(); 
      timeString = hours.toString().padStart(2, '0') 
                + ':' + minutes.toString().padStart(2, '0'); 

      labelArray.push(timeString);
      voltageArray.push(lc_volt[i]['voltage']);
    }
    
    // DRAW LINE CHART
    var dashLineChart = new Chart(voltageLineGraph, {
        type: 'line',
        data: {
          labels: labelArray,
          datasets: [
            { 
                data: voltageArray,
                label: "Voltage Level",
                borderColor: "#3e95cd",
                fill: 'origin',
                backgroundColor:'#cedaf0'
            }
          ]
        },
        options: {
          legend: {
            labels: {
              fontSize: 15
            }
          },
          title: {
            display: true,
            text: 'Voltage Trends (Last 12 Hours)'
          },
          layout: {
            padding: {
                left: 15,
                right: 30,
                top: 10,
                bottom: 10
            }
        },
          scales: {
                xAxes: [{
              scaleLabel: {
                display: true,
                labelString: 'Time',
                gridLines: { lineWidth: 50 },
                fontSize: 15
              },
                    ticks: {
                        beginAtZero: false
                    }
                }],
                yAxes: [{
              scaleLabel: {
                display: true,
                labelString: 'Voltage',
                fontSize: 15
              },ticks: {
                beginAtZero: true
            }
                }]
            }
        }
      });
    
    // https://webdesign.tutsplus.com/tutorials/how-to-add-deep-linking-to-the-bootstrap-4-tabs-component--cms-31180
    let url = location.href.replace(/\/$/, "");
   
    if (location.hash) {
      const hash = url.split("#");
      $('#cellsTab a[href="#'+hash[1]+'"]').tab("show");
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

});