$(document).ready(function() {

    $('#top_ten_table').DataTable({
        "scrollY": 150,
        "scrollX": true,
        "lengthMenu": [[5, 10, -1], [5, 10, "All"]]
    });

    Chart.defaults.global.defaultFontFamily = 'Varela Round', 'sans-serif';
    Chart.defaults.global.defaultFontColor = 'black';

    Chart.defaults.global.animation.duration = 700;
    Chart.defaults.global.animation.easing = 'linear';

    // TITLE CONFIGURTAION
    Chart.defaults.global.title.fontSize = 19;
    Chart.defaults.global.title.fontStyle = 'normal';
    Chart.defaults.global.title.fontColor = 'rgb(65, 65, 65)';

    Chart.defaults.global.legend.position = 'bottom';
    Chart.defaults.global.legend.labels.fontSize = 12;
    Chart.defaults.global.legend.labels.fontStyle = 'normal';

    var alertsTypesGroup = document.getElementById("bar-chart-grouped")
    alertsTypesGroup.height = 200;

    var alertTypes = new Chart(alertsTypesGroup, {
        type: 'bar',
        data: {
          labels: ["Sat", "Sun", "Mon"],
          datasets: [
            {
              label: "Azimuth",
              backgroundColor: "#3e95cd",
              data: [13,17,23]
            }, {
              label: "Pitch",
              backgroundColor: "#58ffff",
              data: [12, 13, 12]
            },
            {
              label: "Roll",
              backgroundColor: "#3cba9f",
              data: [18, 25, 21]
            }, 
            {
              label: "Signal Strength",
              backgroundColor: "#f8e646",
              data: [22,14,16]
            },
            {
              label: "Battery",
              backgroundColor: "#c45850",
              data: [16, 5, 9]
            }, {
              label: "No Communication",
              backgroundColor: "#8e5ea2",
              data: [4, 5, 6]
            },
          ]
        },
        options: {
          title: {
            display: true,
            text: 'ALERT GROUPS BY TYPES'
          }
        }
    });
});