<?php
include "koneksi.php"; 
?>
<form method="post" action="getcuaca.php">
<p>Propinsi : 
<select name="propinsi">
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
<select name="kota">
	<?php
	$query="Select * from kota";
	$query=mysql_query($query);
	while($data=mysql_fetch_array($query)){ 
	?>
	<option value="<?php echo $data["name"];?>"><?php echo $data["name"];?></option>
	<?php } ?>
</select>
</p>
<p><input type="submit" value="submit"/></p>
</form>