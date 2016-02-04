<?php
include "koneksi.php"; 
header('Content-Type: application/json');
$tanggal = date('d F Y');
$datetime = new DateTime('tomorrow');
$besok=$datetime->format('d F Y');
$query="SELECT * FROM cuaca JOIN kota ON kota.id=cuaca.kota_id where kota.name='".$_POST["kota"]."' AND tanggal='".$tanggal."'";
$result=mysql_query($query);
$data=mysql_fetch_array($result);
$query2="SELECT * FROM cuaca JOIN kota ON kota.id=cuaca.kota_id where kota.name='".$_POST["kota"]."' AND tanggal='".$besok."'";
$result2=mysql_query($query2);
$data2=mysql_fetch_array($result2);
header('Content-Type: application/json');
$arr=array(
	"name"=>$data["name"],
 	"cuaca"=>$data["cuaca"],
	"image"=>$data["image"],
	"tanggal"=>$data["tanggal"],
	"cuaca_besok"=>$data2["cuaca"],
	"image_besok"=>$data2["image"],
	"tanggal_besok"=>$data2["tanggal"]
 	);
echo json_encode($arr);
?>