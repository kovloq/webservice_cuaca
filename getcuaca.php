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
$data["cuaca"]=$data["cuaca"]=="" ? "Tidak ada data" : $data["cuaca"];
$data["image"]=$data["image"]=="" ? "default_cuaca" : $data["image"];
$query2="SELECT * FROM cuaca JOIN kota ON kota.id=cuaca.kota_id where kota.name='".$_POST["kota"]."' AND tanggal LIKE '%".$besok."%' ORDER BY cuaca.id DESC";
$result2=mysql_query($query2);
$data2=mysql_fetch_array($result2);
$data2["cuaca"]=$data["cuaca"]=="" ? "Tidak ada data" : $data2["cuaca"];
$data2["image"]=$data["image"]=="" ? "default_cuaca" : $data2["image"];
$data["name"]=$data["name"]=="" ? $data2["name"] : $data["name"];
// print_r($script_tz);
$arr_orig=array("January","February","March","May","June","July","August","October","December");
$arr_rep=array("Januari","Februari","Maret","Mei","Juni","Juli","Agustus","Oktober","Desember");
header('Content-Type: application/json');
if(mysql_num_rows($result2) > 0){//Check if tomorrow weather is not received yet
	if($_POST["propinsi"]=="Jabodetabek"){
		$cuaca=explode("__",$data["cuaca"]);
		$image=explode("__",$data["image"]);
		$cuaca_besok=explode("__",$data2["cuaca"]);
		$image_besok=explode("__",$data2["image"]);
		$tanggal=str_replace($arr_orig, $arr_rep, trim($data["tanggal"]));
		$tanggal_besok=str_replace($arr_orig, $arr_rep, trim($data2["tanggal"]));
		$cuaca_skrng=str_replace("tidak_ada_data","default_cuaca",$image[0]);
		$arr=array(
			"name"=>$data["name"],
		 	"cuaca"=>$cuaca[0],
			"image"=>$cuaca_skrng,
			"tanggal"=>$tanggal,
			"cuaca_besok"=>$cuaca_besok[0],
			"image_besok"=>$image_besok[0],
			"tanggal_besok"=>$tanggal_besok
		 	);
	}else{
		$tanggal=str_replace($arr_orig, $arr_rep, trim($data["tanggal"]));
		$tanggal_besok=str_replace($arr_orig, $arr_rep, trim($data2["tanggal"]));
		$cuaca_skrng=str_replace("tidak_ada_data","default_cuaca",$data["image"]);
		$arr=array(
			"name"=>$data["name"],
		 	"cuaca"=>$data["cuaca"],
			"image"=>$cuaca_skrng,
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
		$tanggal_besok=str_replace($arr_orig, $arr_rep, $besok);
		$cuaca_skrng=str_replace("tidak_ada_data","default_cuaca",$image[0]);
		$arr=array(
			"name"=>$data["name"],
		 	"cuaca"=>$cuaca[0],
			"image"=>$cuaca_skrng,
			"tanggal"=>$tanggal,
			"cuaca_besok"=>"Belum ada data",
			"image_besok"=>"tidak_ada_data",
			"tanggal_besok"=>$tanggal_besok
		 	);
	}else{
		$tanggal=str_replace($arr_orig, $arr_rep, trim($data["tanggal"]));
		$tanggal_besok=str_replace($arr_orig, $arr_rep,$besok);
		$cuaca_skrng=str_replace("tidak_ada_data","default_cuaca",$data["image"]);
		$arr=array(
			"name"=>$data["name"],
		 	"cuaca"=>$data["cuaca"],
			"image"=>$cuaca_skrng,
			"tanggal"=>$tanggal,
			"cuaca_besok"=>"Belum ada data",
			"image_besok"=>"tidak_ada_data",
			"tanggal_besok"=>$tanggal_besok
		 	);
	}
}
echo json_encode($arr);
?>