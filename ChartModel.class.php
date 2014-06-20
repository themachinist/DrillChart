<?php
class ChartModel {
	private $data = array();

	function __construct($file){
		// not sure if i like this - president not sure
		if (!ChartModel::isCSV($file)){
			throw new Exception('File path given to ChartModel is not a CSV.');
		}
		// arbitrary comment
		$this->csv = file_get_contents($file);
		echo $this->csv;
		// kind of need some data
		if ($this->csv !== false || is_string($this->csv)){
			throw new Exception('Error trying to read csv file using ChartModel. Verify file exists and check permissions.');
		}

		$this->readCSV();
	}

	function readCSV(){
		$lines = explode("\n",$this->csv);
		$id = 1;
		foreach ($lines as $ln){
			$fields = explode(',', $ln);
			unset($cell_array);
			foreach ($fields as $field){
				$cell_array[] = $field;
			}
			$this->rows[] = array(
			'id' => $id,
			'cell' => $cell_array
			);
			$id++;
		}
		unset($this->rows[0]);
	}

	static function isCSV($csv) {
		return true;
	}
}

/**if ($_GET['data']) {
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
}*/
?>