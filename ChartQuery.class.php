<?php
require('ChartModel.class.php');

class ChartQuery {
	private $model;
	private $view = array();
	private $previous = array();

	/**
	 * 
	 */
	function __construct($page, $rp, $sortname, $sorttype, $qtype, $query){
		$this->model = new ChartModel('TapDrill_Chart.csv');
		$this->pageNumber = $page;
		$this->rowsPerPage = $rp;
		$this->sortByColumn = $sortname;
		$this->sortDirection = $sorttype;
		$this->query = $query;
		$this->queryType = $qtype; 
		// fluent-ish interface $which->is()->really('cool');
		return $this;
	}

	function search($term){
		$this->view['rows'] = array_search($term, $this->view['rows']);
		return $this;
	}

	function sortBy($column, $dir){
		$data = $this->view['rows'];
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

		return $this;
	}

	function revert(){
		$this->view['rows_prev_tmp'] = $this->view->previous['rows'];
		$this->view->previous['rows'] = $this->view['rows'];
		$this->view['rows'] = $this->view->previous['rows'];
		unset($this->view['rows_prev_tmp']);
		return $this;
	}

	function viewPage($pn, $rpp){
		$start = (($pn - 1) * $rpp);
		$end = $start + $rpp;
		$this->view['page'] = $pn;
		$this->view['rows'] = array_slice($this->model->rows, $start, $end);
		$this->view['total'] = count($this->view['rows']);
		return $this;
	}

	function viewAll(){
		$this->view['page'] = $pn;
		$this->view['rows'] = array_slice($this->model->rows, $start, $end);
		$this->view['total'] = count($this->view['rows']);
		return $this;
	}

	/**
	 * Main entry point for the class
	 */
	function process(){
		switch($this->queryType){
			case 'json':
				viewPage($this->pageNumber, $this->rowsPerPage)->sortBy($this->model->column($sortname), $sorttype);
				break;
		}
		$this->viewPage($this->pageNumber, $this->rowsPerPage)
				->sortBy($this->model->column($sortname), $sorttype);
		return json_encode($this->view);
	}
}
?>