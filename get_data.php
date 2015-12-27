<?php
include_once "koneksi.php";
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
$url=$_POST["url"];

$xml=simplexml_load_file($url);
$json = json_encode($xml);
$array = json_decode($json,TRUE);
//Add exception for Jakarta
if($_POST["id"]==12){
	$jum=count($array["Isi"]["Row"]);
	for($i=0;$i<$jum;$i++){
		// echo $i;
		$name= $array["Isi"]["Row"][$i]["Daerah"];
		//Insert into database
		mysql_query("INSERT INTO kota (name,propinsi_id) VALUES ('".$name."','".$_POST["id"]."')");
	}
}else{
	for($i=0;$i<count($array["Isi"]["Row"]);$i++){
		$name=$array["Isi"]["Row"][$i]["Kota"];
		//Insert into database
		mysql_query("INSERT INTO kota (name,propinsi_id) VALUES ('".$name."','".$_POST["id"]."')");
		// echo "<br/>";
	}
}

// echo count($array["Isi"]["Row"]);
// echo "<pre>";
// print_r($array["Isi"]["Row"][0]["Kota"]);
// echo "</pre>";

?>