
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
		$query2="SELECT * FROM kota WHERE name='".$name."'";
		$result2=mysql_query($query2);
		$data2=mysql_fetch_array($result2);
		$kota_id=$data2["id"];
		// // Compare Tomorrow URL and today URL
		$query3="SELECT * FROM cuaca WHERE tanggal='".$tanggal."' AND kota_id='".$kota_id."'";
		$result3=mysql_query($query3);
		$data3=mysql_fetch_array($result3);
		$cuaca_besok=$data3["cuaca"];
		if($id==12){
			$pagi=$xml->Isi->Row[$i]->Pagi;
			$siang=$xml->Isi->Row[$i]->Siang;
			$malam=$xml->Isi->Row[$i]->Malam;
			$cuaca=$pagi."__".$siang."__".$malam;
			$pagi_image=str_replace(" ","_",strtolower($pagi)).".jpg";
			$siang_image=str_replace(" ","_",strtolower($siang)).".jpg";
			$malam_image=str_replace(" ","_",strtolower($malam)).".jpg";
			$image=$pagi_image."__".$siang_image."__".$malam_image;
			if($cuaca_besok!=$cuaca && strlen($cuaca_besok > 9)){
				$cuaca=$cuaca_besok;
			}
		}else{
			$cuaca=$xml->Isi->Row[$i]->Cuaca;
			$image=str_replace(" ","_",strtolower($cuaca)).".jpg";
			// Compare Tomorrow URL and Today URL
			if($cuaca_besok=="-" && $cuaca!="-"){
				$query="UPDATE cuaca set cuaca='".$cuaca."' WHERE tanggal='".$tanggal."' AND kota_id='".$kota_id."'";
				mysql_query($query);//echo "satu";
			}elseif(trim($cuaca_besok)!=trim($cuaca)){
				$query="UPDATE cuaca set cuaca='".$cuaca."' WHERE tanggal='".$tanggal."' AND kota_id='".$kota_id."'";
				mysql_query($query);//echo "dua";
			}elseif($cuaca_besok=="-" AND $cuaca="-"){
				$query="UPDATE cuaca set cuaca='Tidak ada data',image='no_data.jpg' WHERE tanggal='".$tanggal."' AND kota_id='".$kota_id."'";
				mysql_query($query);//echo "tiga";
			}
		}
		
		
	}
}
?>