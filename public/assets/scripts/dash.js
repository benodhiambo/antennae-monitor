$(document).ready(function() {

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

$('#optim_table').DataTable({
  "scrollY": 300,
  "scrollX": true,
  "lengthMenu": [[10, 20, 50, 100, -1], [10, 20, 50, 100, "All"]]
});

/*
|--------------------------------------------------------------------------
| PIE CHART
|--------------------------------------------------------------------------
*/
//GET LABELS AND DATA ... DEFINED IN HTML/BLADE
var pieChartLabels = [];
var alertTypeCount = [];
for(var i in pc_data) {
	pieChartLabels.push(pc_data[i].alert_type)
	alertTypeCount.push(pc_data[i].count);
}

// DRAW PIE CHART
var dashPieChart = new Chart(document.getElementById("dash-pie-chart"), {
  type: 'pie',
  data: {
    labels: pieChartLabels,
    datasets: [{
      label: "Alerts Count",
      backgroundColor: ["#3e95cd", "#58ffff","#3cba9f","#f8e646","#c45850","#c4fff5"],
      data: alertTypeCount
    }]
  },
  options: {
    legend: {
      position: 'bottom',
      align: 'start',
      labels: {
        fontSize: 15
      }
    },
    title: {
      display: true,
      text: 'TOTAL ALERTS BY TYPE'
    }
  }
});

/*
|--------------------------------------------------------------------------
| BAR GRAPH
|--------------------------------------------------------------------------
*/

//GET LABELS ... DEFINED IN HTML/BLADE
var barChartLabels = [];
var totalAlertCount = [];

for(var i in bc_data) {
	barChartLabels.push(bc_data[i].cell_id)
	totalAlertCount.push(bc_data[i].num);
}
// DRAW BAR CHART
var dashBarChartHorizantal = new Chart(document.getElementById("dash-bar-chart-horizontal"), {
  type: 'horizontalBar',
  data: {
    labels: barChartLabels,
    datasets: [
      {
        label: "Alert Count",
        backgroundColor: ["#3e95cd", "#58ffff","#3cba9f","#f8e646","#c45850"],
        data: totalAlertCount
      }
    ]
  },
  options: {
    legend: {
      display: false,
      labels: {
        fontSize: 15
      }
    },
    title: {
      display: true,
      text: 'TOP 5 CELLS BY ALERT COUNT (Over Last 6 Months)'
	},
	scales: {
        xAxes: [{
			scaleLabel: {
				display: true,
				labelString: 'Alert Count',
				fontSize: 15
			},
            ticks: {
                beginAtZero: true
            }
        }],
        yAxes: [{
			scaleLabel: {
				display: true,
				labelString: 'Cell ID',
				fontSize: 15
			}
        }]
    }
  }
});

/*
|--------------------------------------------------------------------------
| LINE GRAPH
|--------------------------------------------------------------------------
*/
var ac_my = [0,1,2,3,4,5,6,7,8,9,10,11];
var ac_em = [];
for(var i=1;i<lc_azim.length;i++){
	ac_em.push(lc_azim[i]['mon']);
}
for(var i=1;i<ac_my.length;i++){
	if(ac_em.indexOf(parseInt(ac_my[i])) < 0){
		var zeroObject = {
		"mon": i,
		"count": 0
		};
		lc_azim.push(zeroObject);
	}
}
ac = [];
for(var i in lc_azim) {
	ac.push(lc_azim[i].count);
}

var tc_my = [0,1,2,3,4,5,6,7,8,9,10,11];
var tc_em = [];
for(var i=1;i<lc_tilt.length;i++){
	tc_em.push(lc_tilt[i]['mon']);
}
for(var i=1;i<tc_my.length;i++){
	if(tc_em.indexOf(parseInt(tc_my[i])) < 0){
		var zeroObject = {
		"mon": i,
		"count": 0
		};
		lc_tilt.push(zeroObject);
	}
}
tc = [];
for(var i in lc_tilt) {
	tc.push(lc_tilt[i].count);
}

var rc_my = [0,1,2,3,4,5,6,7,8,9,10,11];
var rc_em = [];
for(var i=1;i<lc_roll.length;i++){
	rc_em.push(lc_roll[i]['mon']);
}
for(var i=1;i<rc_my.length;i++){
	if(rc_em.indexOf(parseInt(rc_my[i])) < 0){
		var zeroObject = {
		"mon": i,
		"count": 0
		};
		lc_roll.push(zeroObject);
	}
}
rc = [];
for(var i in lc_roll) {
	rc.push(lc_roll[i].count);
}

var vd_my = [0,1,2,3,4,5,6,7,8,9,10,11];
var vd_em = [];
for(var i=1;i<lc_volt_drop.length;i++){
	vd_em.push(lc_volt_drop[i]['mon']);
}
for(var i=1;i<vd_my.length;i++){
	if(vd_em.indexOf(parseInt(vd_my[i])) < 0){
		var zeroObject = {
		"mon": i,
		"count": 0
		};
		lc_volt_drop.push(zeroObject);
	}
}
vd = [];
for(var i in lc_volt_drop) {
	vd.push(lc_volt_drop[i].count);
}

var vl_my = [0,1,2,3,4,5,6,7,8,9,10,11];
var vl_em = [];
for(var i=1;i<lc_volt_low.length;i++){
	vl_em.push(lc_volt_low[i]['mon']);
}
for(var i=1;i<vl_my.length;i++){
	if(vl_em.indexOf(parseInt(vl_my[i])) < 0){
		var zeroObject = {
		"mon": i,
		"count": 0
		};
		lc_volt_low.push(zeroObject);
	}
}
vl = [];
for(var i in lc_volt_low) {
	vl.push(lc_volt_low[i].count);
}

var cc_my = [0,1,2,3,4,5,6,7,8,9,10,11];
var cc_em = [];
for(var i=1;i<lc_comm.length;i++){
	cc_em.push(lc_comm[i]['mon']);
}
for(var i=1;i<cc_my.length;i++){
	if(cc_em.indexOf(parseInt(cc_my[i])) < 0){
		var zeroObject = {
		"mon": i,
		"count": 0
		};
		lc_comm.push(zeroObject);
	}
}
cc = [];
for(var i in lc_comm) {
	cc.push(lc_comm[i].count);
}


// DRAW LINE CHART
var dashLineChart = new Chart(document.getElementById("dash-line-chart"), {
  type: 'line',
  data: {
    labels: ["Jan", "Feb", "Mar", "Apr", "May", "Jun", "Jul", "Aug", "Sept", "Oct", "Nov", "Dec"],
    datasets: [
    { 
        data: ac,
        label: "Heading",
        borderColor: "#3e95cd",
        fill: false
	  }, {
		data: tc,
        label: "Pitch",
        borderColor: "#66ff66",
        fill: false
	  }, {
		data: rc,
        label: "Roll",
        borderColor: "#58ffff",
        fill: false
	  }, {
		data: vl,
        label: "Low Voltage",
        borderColor: "#3cba9f",
        fill: false
	  }, {
		data: vd,
        label: "Voltage Drop",
        borderColor: "#c4fff5",
        fill: false
	  }, {
		data: cc,
        label: "No Communication",
        borderColor: "#c45850",
        fill: false
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
      text: 'Alert Trends (This Year)'
    }
  }
});
});
