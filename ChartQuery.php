<?php
require('ChartQuery.class.php');
$query = new ChartQuery(
	$_POST['page'],
	$_POST['rp'],
	$_POST['sortname'],
	$_POST['sortorder'],
	$_POST['qtype'],
	$_POST['query']
	);
$view = $query->process();
echo $view;
?>