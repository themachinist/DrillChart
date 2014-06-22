mw.loader.using( 'jquery', function(){
	console.log('jquery ready');
	mw.loader.using( 'flexigrid', function(){
		var testFunctionExists = setInterval(function(){
			console.log('testing for .flexigrid()');
			if (typeof $('.flexigrid').flexigrid != 'undefined'){
				console.log('flexigrid exists!');
				$('.flexigrid').flexigrid({
					url: 'extensions/DrillChart/ChartQuery.php',
					dataType: 'json',
					procmsg: 'Processing, Please wait ...',
					onSuccess:function(){
						console.log('successfully loaded data');
					},
					onError: function(data){
						console.log('something is wrong');
						console.log(data);
					},
					colModel : [
					{display: 'Imperial', name : 'imperial', width : 80, sortable : true, align: 'right'},
					{display: 'Wire', name : 'wire', width : 80, sortable : true, align: 'right'},
					{display: 'Metric', name : 'metric', width : 80, sortable : true, align: 'right'},
					{display: 'Tap Sizes', name : 'tap', width : 130, sortable : true, align: 'left'},
					{display: 'STI Sizes', name : 'sti', width : 80, sortable : true, align: 'left'}
					],
					searchitems : [
					{display: 'Imperial', name : 'imperial', isdefault: true},
					{display: 'Wire', name : 'wire'},
					{display: 'Metric', name : 'metric'},
					{display: 'Tap Sizes', name : 'tap'},
					{display: 'STI Sizes', name : 'sti'}
					],
					sortname: "imperial",
					sortorder: "asc",
					usepager: true,
					title: 'Drill and Tap-Drill Sizes',
					useRp: false,
					rp: 15,
					showTableToggleBtn: true,
					width: 700,
					height: 400
				});
				clear(testFunctionExists);
			}
		}, 100);
	});
});


