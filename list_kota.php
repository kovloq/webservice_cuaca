<?php
include "koneksi.php"; 
$query="SELECT kota.name  as name FROM kota JOIN propinsi ON kota.propinsi_id=propinsi.id where propinsi.name='".$_POST["propinsi"]."'";
$hasil=mysql_query($query);
while($data=mysql_fetch_array($hasil)){
	echo "<option value=\"".$data["name"]."\">".$data["name"]."</option>";
}
?>