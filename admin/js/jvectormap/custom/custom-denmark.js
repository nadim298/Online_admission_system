// Denmark
$(function(){
	$('#mapDenmark').vectorMap({
		map: 'dk_mill',
		zoomOnScroll: false,
		regionStyle:{
			initial: {
				fill: '#52bf8a',
			},
			hover: {
				"fill-opacity": 0.8
			},
			selected: {
				fill: '#A9BD7A'
			},
		},
		backgroundColor: '#FFFFFF',
	});
});