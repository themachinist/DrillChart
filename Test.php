<?php
header("access-control-allow-origin: *");
$_POST['page'] = 1;
$_POST['rp'] = 25;
$_POST['sortname'] = 'wire';
$_POST['sortorder'] = 'asc';
$_POST['query'] = '';
$_POST['qtype'] = 'imperial';
require('ChartQuery.php');
?>