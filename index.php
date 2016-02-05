<?php
include "koneksi.php"; 
?>
<script src="//code.jquery.com/jquery-1.12.0.min.js"></script>
<form method="post" action="getcuaca.php">
<p>Propinsi : 
<select name="propinsi" id="propinsi">
	<?php
	$query="Select * from propinsi";
	$query=mysql_query($query);
	while($data=mysql_fetch_array($query)){ 
	?>
	<option value="<?php echo $data["name"];?>"><?php echo $data["name"];?></option>
	<?php } ?>
</select>
</p>
<p>Kota : 
<select name="kota" id="kota">
	<?php
	$query="Select * from kota where propinsi_id=1";
	$query=mysql_query($query);
	while($data=mysql_fetch_array($query)){ 
	?>
	<option value="<?php echo $data["name"];?>"><?php echo $data["name"];?></option>
	<?php } ?>
</select>
</p>
<p><input type="submit" value="submit"/></p>
</form>
<script>
$(document).ready(function(){
	$("#propinsi").change(function(){
		$( "#kota" ).load("list_kota.php",{"propinsi":$("#propinsi").val()});
	})
	
})
</script>