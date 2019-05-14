// Africa
$(function(){
	$('#mapAfrica').vectorMap({
		map: 'africa_mill',
		backgroundColor: '#FFFFFF',
		scaleColors: ['#707C8E'],
		zoomOnScroll:false,
		zoomMin: 1,
		hoverColor: true,
		series: {
			regions: [{
				values: gdpData,
				scale: ['#002868', '#FEDFDD', '#FBACAF', '#E4817B', '#AE4357'],
				normalizeFunction: 'polynomial'
			}]
		},
	});
});