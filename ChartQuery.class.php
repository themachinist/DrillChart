<?php
require('ChartModel.class.php');

class ChartQuery {
	private $model;
	private $view = array();
	private $previous = array();

	function __construct($page, $rp, $sortname, $sorttype, $qtype, $query){
		$this->model = new ChartModel('TapDrill_Chart.csv');
		$this->pageNumber = $page;
		$this->rowsPerPage = $rp;
		$this->columnToSortBy['name'] = $sortname;
		$this->columnToSortBy['number'] = $this->model->column($this->columnToSortBy['name']);
		$this->sortDirection = $sorttype;
		$this->searchTerm = $query;
		$this->searchColumn = $qtype; 
		$this->view['rows'] = $this->model->rows;
		$this->view['total'] = count($this->view['rows']);
		return $this;
	}

	function search($term, $column){
		if (!empty($term)){
			$this->view['rows'] = array_filter($this->view['rows'], function($array) use ($term, $column){
				if (strpos($array['cell'][$column], $term) !== false) {
					return true;
				} else {
					return false;
				}
			});
			$this->view['total'] = count($this->view['rows']);
		}
		return $this;
	}

	function sortBy($column, $dir){
		uasort($this->view['rows'], function($a, $b) use ($dir) {
			$comp = strcmp($a['cell'][$this->columnToSortBy['number']], 
							  $b['cell'][$this->columnToSortBy['number']]);
			if ($dir == 'asc'){
				return $comp;
			} else {
				return $comp * -1;
			}
		});
		$this->view['rows'] = array_values($this->view['rows']);
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
		$this->view['rows'] = array_slice($this->view['rows'], $start, $end);
		return $this;
	}

	function process(){
		try {

			$this->search(	$this->searchTerm, 						
							$this->model->column($this->searchColumn))

				 ->viewPage($this->pageNumber, 
				 			$this->rowsPerPage)

				 ->sortBy(	$this->model->column($this->columnToSortBy['name']), 
				 			$this->sortDirection);

		} catch (Exception $e) {
			if ($e instanceof ColumnException) {
				$this->viewPage($this->pageNumber, $this->rowsPerPage);
				return json_encode($this->view);
			}
			$this->view['page'] = 1;
			$this->view['rows'] = array('id' => '1', 
										'cell' => array($e->getMessage())
										);
			$this->view['total'] = 1;
		}
		return json_encode($this->view);
	}
}
?>