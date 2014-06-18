<?php
class ChartModel {
	function ChartModel($data){

	}

	static function isCSV($csv) {
		
	}
}

if ($_GET['data']) {
	if (isset($_POST['page']) && is_int($_POST['page']) ) {
		$page = $_POST['page'];
	} else {
		$page = 1;
	}
	$data = array();
	$data['page'] = $page;
	
	$csv = file_get_contents('TapDrill_Chart.csv');
	$lines = explode("\n",$csv);
	$id = 1;
	foreach ($lines as $ln){
		$fields = explode(',', $ln);
		unset($cell_array);
		foreach ($fields as $field){
			$cell_array[] = $field;
		}
		$data['rows'][] = array(
		'id' => $id,
		'cell' => $cell_array
		);
		$id++;
	}
	unset($data['rows'][0]);
	$data['total'] = $id;
	header('Content-type: application/json');	
	echo json_encode($data);
	exit(1);
}
?>