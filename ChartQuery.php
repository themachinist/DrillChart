<?php
require('ChartQuery.class.php');
print("<pre>" . var_dump($_POST) . "</pre>");
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