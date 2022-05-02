<?php
require_once('C:\Sites\php\yosiki\core/config.php');

$mysqli = new mysqli($host, $username, $password, $dbname);
if ($mysqli->connect_error) {
  error_log($mysqli->connect_error);
  exit;
}
?>