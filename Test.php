<?php
header("access-control-allow-origin: *");
$_POST['page'] = 1;
$_POST['rp'] = 5;
$_POST['sortname'] = 'tap';
$_POST['sortorder'] = 'asc';
$_POST['query'] = '0.01';
$_POST['qtype'] = 'imperial';
require('ChartQuery.php');
?>