<?php 
$date = date_create();
header('Content-Type: application/json');
echo json_encode(['name'=>'@daikabot','version'=>'1.0.0-beta','timestamp'=>date_timestamp_get($date)]);
die;