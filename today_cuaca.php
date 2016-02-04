
<?php
include_once "koneksi.php";
error_reporting(E_ALL);
ini_set('display_errors', 1);
//Loop From User ID 1 to 5
$query="SELECT * FROM propinsi WHERE id between ".$_GET["from"]." AND ".$_GET["to"];
$result=mysql_query($query);
while($data = mysql_fetch_array($result)){
	$url=$data["today_url"];
	$xml=simplexml_load_file($url);
	$id=$data["id"];
	if($id==12){
		$tanggal=$xml->Tanggal;
	}else{
		$tanggal=$xml->Tanggal->Mulai;
	}
	for($i=0;$i<count($xml->Isi->Row);$i++){
		if($id==12){
			$name=$xml->Isi->Row[$i]->Daerah;
		}else{
			$name=$xml->Isi->Row[$i]->Kota;
		}
		$query2="SELECT * FROM kota WHERE name='".addslashes($name)."'";
		$result2=mysql_query($query2);
		$data2=mysql_fetch_array($result2);
		$kota_id=$data2["id"];
		if($id==12){
			$pagi=$xml->Isi->Row[$i]->Pagi;
			$siang=$xml->Isi->Row[$i]->Siang;
			$malam=$xml->Isi->Row[$i]->Malam;
			$cuaca=$pagi."__".$siang."__".$malam;
			$pagi_image=str_replace(" ","_",strtolower($pagi));
			$siang_image=str_replace(" ","_",strtolower($siang));
			$malam_image=str_replace(" ","_",strtolower($malam));
			$image=$pagi_image."__".$siang_image."__".$malam_image;
		}else{
			$cuaca=$xml->Isi->Row[$i]->Cuaca;
			if($cuaca=="-"){
				$cuaca="Tidak ada data";
			}
			$image=str_replace(" ","_",strtolower($cuaca));
		}
		
		$query="INSERT INTO cuaca (propinsi_id,kota_id,tanggal,cuaca,image) VALUES ('".$id."','".$kota_id."','".$tanggal."','".$cuaca."','".$image."')";
		// echo "<br/>";
		mysql_query($query);
	}
}
echo "OK";
?>