<?php
include "koneksi.php"; 
header('Content-Type: application/json');
$tanggal = date('d F Y');
$query="SELECT * FROM cuaca JOIN kota ON kota.id=cuaca.kota_id where kota.name='".$_POST["kota"]."' AND tanggal='".$tanggal."'";
$result=mysql_query($query);
$data=mysql_fetch_array($result);
header('Content-Type: application/json');
$arr=array(
	"name"=>$data["name"],
 	"cuaca"=>$data["cuaca"],
	"image"=>$data["image"],
	"tanggal"=>$data["tanggal"]
 	);
echo json_encode($arr);
?>