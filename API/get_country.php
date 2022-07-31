<?php
header('Access-control-Allow-Origin: *');
header('content-type: application/json; charset=utf-8');
include_once('../country/PostApi.php');
  $local = 'localhost';
  $pwd = '';
  $user = 'root';
  $dbName = 'locations';

$postApi = new PostAPI($local, $user, $pwd, $dbName);

$postApi->getData();
