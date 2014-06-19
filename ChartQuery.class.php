<?php
class ChartQuery {
	$model = new ChartModel();
	$view = array();

	/**
	 * 
	 */
	function __construct($page, $rp, $sortname, $sorttype, $qtype, $query){
		$this->pageNumber = $page;
		$this->rowsPerPage = $rp;
		$this->sortByColumn = $sortname;
		$this->sortDirection = $sorttype;
		$this->query = $query;
		$this->queryType = $qtype;
	}

	function viewPage($pn, $rpp){
		$start = (($pn - 1) * $rpp);
		$end = $start + $rpp;
		$this->view['page'] = $pn;
		$this->view['rows'] = array_slice($this->model->rows, $start, $end);
		$this->view['total'] = count($this->view['rows']);
		return $view;
	}

	function viewAll(){
		
	}

	function (){
		viewPage($this->pageNumber, $this->rowsPerPage)->sortBy($this->model->column($sortname), $sorttype);
	}

	function sortBy($data, $column, $dir){
		// correct value for array_multisort
		if ($dir){
			$dir = SORT_ASC;
		} else {
			$dir = SORT_DESC;
		}

		// build array of columns for array_multisort
		foreach ($data as $key => $row) {
			foreach ($row as $name){
				$$name[$key] = $row[$name];
			}
		}

		// sort by column (hopefully)
		array_multisort($$column, $dir, $data);

		// replace row data
		$this->view['rows'] = $data;
	}

	function 

	/**
	 * Main entry point for the class
	 */
	function process(){
		return json_encode($this->view);
	}
}
?>