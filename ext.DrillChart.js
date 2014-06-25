mw.loader.using( 'jquery', function(){
	mw.loader.using( 'flexigrid', function(){
		var testFunctionExists = setInterval(function(){
			if (typeof $('.flexigrid').flexigrid != 'undefined'){
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
					{display: 'Decimal', name : 'decimal', width : 80, sortable : true, align: 'right'},
					{display: 'Wire', name : 'wire', width : 80, sortable : true, align: 'right'},
					{display: 'Metric', name : 'metric', width : 80, sortable : true, align: 'right'},
					{display: 'Tap Sizes', name : 'tap', width : 130, sortable : true, align: 'left'},
					{display: 'STI Sizes', name : 'sti', width : 80, sortable : true, align: 'left'}
					],
					searchitems : [
					{display: 'Decimal', name : 'decimal', isdefault: true},
					{display: 'Wire', name : 'wire'},
					{display: 'Metric', name : 'metric'},
					{display: 'Tap Sizes', name : 'tap'},
					{display: 'STI Sizes', name : 'sti'}
					],
					sortname: "decimal",
					sortorder: "asc",
					usepager: true,
					useRp: true,
					rp: 15,
					showTableToggleBtn: false,
					width: 700,
					height: 400
				});
				clearInterval(testFunctionExists);
			}
		}, 100);
	});
});


