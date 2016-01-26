
<?php
include_once "koneksi.php";
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
$url=$_POST["url"];

$xml=simplexml_load_file($url);
$id=$_POST["id"];
$tanggal=$xml->Tanggal->Mulai;
for($i=0;$i<count($xml->Isi->Row);$i++){
	$name=$xml->Isi->Row[$i]->Kota;
	$result=mysql_query("SELECT * FROM kota WHERE name='".$name."'");
	$data=mysql_fetch_array($result);
	$kota_id=$data["id"];
	if($id==12){
		$pagi=$xml->Isi->Row[$i]->Pagi;
		$siang=$xml->Isi->Row[$i]->Siang;
		$malam=$xml->Isi->Row[$i]->Malam;
		$cuaca=$pagi."__"$siang."__".$malam;
		$pagi_image=str_replace(" ","_",strtolower($pagi));
		$siang_image=str_replace(" ","_",strtolower($siang));
		$malam_image=str_replace(" ","_",strtolower($malam));
		$image=$pagi_image."__"$siang_image."__".$malam_image;
	}else{
		$cuaca=$xml->Isi->Row[$i]->Cuaca;
		$image=str_replace(" ","_",strtolower($cuaca));
	}
	
	$query="INSERT INTO cuaca (propinsi_id,kota_id,tanggal,cuaca,image) VALUES ('".$id."','".$kota_id."','".$tanggal."','".$cuaca."','".$image."')";
	mysql_query($query);
}

?>