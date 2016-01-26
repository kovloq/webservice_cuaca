<?php
include_once "koneksi.php";
error_reporting(E_ALL);
ini_set('display_errors', 1);
//Delete yesterday's weather
$tanggal= date('d F Y');
$query="DELETE FROM cuaca WHERE tanggal < '".$tanggal."'";
mysql_query($query);

?>