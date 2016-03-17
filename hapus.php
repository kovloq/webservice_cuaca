<?php
include_once "koneksi.php";
error_reporting(E_ALL);
ini_set('display_errors', 1);
//Delete yesterday's weather
$tanggal= date('d F Y');
$query1="SELECT id FROM cuaca WHERE tanggal = '".$tanggal."' ORDER BY ID ASC";
$result=mysql_query($query1);
$data=mysql_fetch_array($result);
$id=$data["id"];
$query="DELETE FROM cuaca WHERE id < $id";
echo "OK";
?>