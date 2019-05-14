// Europe
$(function(){
	$('#mapEurope').vectorMap({
		map: 'europe_mill',
		zoomOnScroll: false,
		series: {
			regions: [{
				values: gdpData,
				scale: ['#E02F2F', '#F9BB06', '#32AB52', '#4286F7'],
				normalizeFunction: 'polynomial'
			}]
		},
		backgroundColor: '#FFFFFF',
	});
});