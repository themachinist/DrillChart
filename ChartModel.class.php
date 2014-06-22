<?php
class ColumnNotExistException extends Exception {
	// Redefine the exception so message isn't optional
	public function __construct($message, $code = 0, Exception $previous = null) {
		parent::__construct($message, $code, $previous);
	}

	public function __toString() {
		return __CLASS__ . ": [{$this->code}]: {$this->message}\n";
	}

}

class ChartModel {
	public $rows = array();
	public $columns = array();

	function __construct($file){
		// not sure if i like this - president not sure
		if (!ChartModel::isCSV($file)){
			throw new Exception('File path given to ChartModel is not a CSV.');
		}
		// arbitrary comment
		$this->csv = file_get_contents($file);

		// kind of need some data
		if (!is_string($this->csv)){
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

		// can't use anonymous function with array_combine
		// becuase it expects an array as input
		// might be able to use array_walk
		function buildArrayOfIntegers($arr){
			$arrizzle = array();
			for ($i = 0; $i < count($arr); $i++){
				$arrizzle[] = $i;
			}
			return $arrizzle;
		}
		$this->columns = array_combine($this->rows[0]['cell'], buildArrayOfIntegers($this->rows[0]['cell']));
		unset($this->rows[0]);
	}

	function column($str){
		if (!array_key_exists($str, $this->columns)){
			throw new ColumnNotExistException("$str not found");
			return false;
		}
		return $this->columns[$str];
	}

	static function isCSV($csv) {
		return true;
	}
}
?>