<?php
include_once "koneksi.php";
$tanggal = date('d F Y');
$query="SELECT * FROM cuaca JOIN kota ON kota.id=cuaca.kota_id where cuaca.kota_id='".$_GET["id"]."' AND tanggal='".$tanggal."'";
$result=mysql_query($query);
$data=mysql_fetch_array($result);
header('Content-Type: application/json');
// echo "<pre>".json_encode($data, JSON_PRETTY_PRINT)."</pre>";
$arr=array(
	"name"=>$data["name"],
 	"cuaca"=>$data["cuaca"],
	"image"=>$data["image"],
	"tanggal"=>$data["tanggal"]
 	);
// print_r($arr);
echo json_encode($arr);
?>