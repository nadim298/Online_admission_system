$(function () {
		
	var d1, chartOptions;

	d1 = [
		[1262304000000, 89], [1264982400000, 460], [1267401600000, 780], [1270080000000, 970], 
		[1272672000000, 1260], [1275350400000, 1325], [1277942400000, 1685], [1280620800000, 2260], 
		[1283299200000, 3100], [1285891200000, 3240], [1288569600000, 4520], [1291161600000, 3820]
	];

	data = [{ 
		label: "Development Activity", 
		data: d1
	}];
 
		chartOptions = {
			xaxis: {
				min: (new Date(2009, 11, 1)).getTime(),
				max: (new Date(2010, 11, 1)).getTime(),
				mode: "time",
				tickSize: [2, "month"],
				monthNames: ["Jan", "Feb", "Mar", "Apr", "May", "Jun", "Jul", "Aug", "Sep", "Oct", "Nov", "Dec"],
				tickLength: 1
			},
			yaxis: {

			},
			series: {
				stack: true,
				lines: {
					show: true, 
					fill: true,
					lineWidth: 3,
					fillColor: { colors: [{ opacity: 0.1 }, { opacity: 0.6}] }
				},
				points: {
					show: true,
					radius: 5,
					fill: true,
					fillColor: "#ffffff",
					lineWidth: 3
				}
			},
			grid:{
				hoverable: true,
				clickable: true,
				borderWidth: 1,
				tickColor: '#eaf3fb',
				borderColor: '#eaf3fb',
			},
			legend: {
				show: true,
				position: 'nw'
			},
			shadowSize: 0,
			tooltip: true,
			tooltipOpts: {
			content: '%s: %y'
			},
			colors: ['#3a86c8'],
		};

		var holder = $('#area-chart3');

		if (holder.length) {
			$.plot(holder, data, chartOptions );
		}


});