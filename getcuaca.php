<?php
include "koneksi.php"; 
$script_tz = date_default_timezone_get();//Default time Zone is Chicago America
date_default_timezone_set('Asia/Jakarta');
header('Content-Type: application/json');
$tanggal = date('d F Y');
$datetime = new DateTime('tomorrow');
$besok=$datetime->format('d F Y');
$query="SELECT * FROM cuaca JOIN kota ON kota.id=cuaca.kota_id where kota.name='".$_POST["kota"]."' AND tanggal LIKE '%".$tanggal."%' ORDER BY cuaca.id DESC";
$result=mysql_query($query);
$data=mysql_fetch_array($result);
$query2="SELECT * FROM cuaca JOIN kota ON kota.id=cuaca.kota_id where kota.name='".$_POST["kota"]."' AND tanggal LIKE '%".$besok."%' ORDER BY cuaca.id DESC";
$result2=mysql_query($query2);
$data2=mysql_fetch_array($result2);
// print_r($script_tz);
$arr_orig=array("January","February","March","May","June","July","August","October","December");
$arr_rep=array("Januari","Februari","Maret","Mei","Juni","Juli","Agustus","Oktober","Desember");
header('Content-Type: application/json');
//echo mysql_num_rows($result2);
if(mysql_num_rows($result2) > 0){//Check if tomorrow weather is not received yet
	if($_POST["propinsi"]=="Jabodetabek"){
		$cuaca=explode("__",$data["cuaca"]);
		$image=explode("__",$data["image"]);
		$cuaca_besok=explode("__",$data2["cuaca"]);
		$image_besok=explode("__",$data2["image"]);
		$tanggal=str_replace($arr_orig, $arr_rep, trim($data["tanggal"]));
		$tanggal_besok=str_replace($arr_orig, $arr_rep, trim($data2["tanggal"]));
		$arr=array(
			"name"=>$data["name"],
		 	"cuaca"=>$cuaca[0],
			"image"=>$image[0],
			"tanggal"=>$tanggal,
			"cuaca_besok"=>$cuaca_besok[0],
			"image_besok"=>$image_besok[0],
			"tanggal_besok"=>$tanggal_besok
		 	);
	}else{
		$tanggal=str_replace($arr_orig, $arr_rep, trim($data["tanggal"]));
		$tanggal_besok=str_replace($arr_orig, $arr_rep, trim($data2["tanggal"]));
		$arr=array(
			"name"=>$data["name"],
		 	"cuaca"=>$data["cuaca"],
			"image"=>$data["image"],
			"tanggal"=>$tanggal,
			"cuaca_besok"=>$data2["cuaca"],
			"image_besok"=>$data2["image"],
			"tanggal_besok"=>$tanggal_besok
		 	);
	}
}else{
	if($_POST["propinsi"]=="Jabodetabek"){
		$cuaca=explode("__",$data["cuaca"]);
		$image=explode("__",$data["image"]);
		$cuaca_besok=explode("__",$data2["cuaca"]);
		$image_besok=explode("__",$data2["image"]);
		$tanggal=str_replace($arr_orig, $arr_rep, trim($data["tanggal"]));
		$tanggal_besok=str_replace($arr_orig, $arr_rep, trim($data2["tanggal"]));
		$arr=array(
			"name"=>$data["name"],
		 	"cuaca"=>$cuaca[0],
			"image"=>$image[0],
			"tanggal"=>$tanggal,
			"cuaca_besok"=>"Tidak ada data",
			"image_besok"=>"tidak_ada_data",
			"tanggal_besok"=>$tanggal_besok
		 	);
	}else{
		$tanggal=str_replace($arr_orig, $arr_rep, trim($data["tanggal"]));
		$tanggal_besok=str_replace($arr_orig, $arr_rep, trim($data2["tanggal"]));
		$arr=array(
			"name"=>$data["name"],
		 	"cuaca"=>$data["cuaca"],
			"image"=>$data["image"],
			"tanggal"=>$tanggal,
			"cuaca_besok"=>"Tidak ada data",
			"image_besok"=>"tidak_ada_data",
			"tanggal_besok"=>$tanggal_besok
		 	);
	}
}
echo json_encode($arr);
?>