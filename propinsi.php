<?php include_once "koneksi.php"; ?>
<h4>Propinsi</h4>
<ul>
<?php 
$query="select * from propinsi order by id ASC";
$result=mysql_query($query);
while ($data=mysql_fetch_array($result)){
?>
	<li><form method="post" action="get_data.php">
		<a href="<?php echo $data["today_url"] ?>"><?php echo $data["id"]." ".$data["name"];?></a>
		<input type="hidden" name="url" value="<?php echo $data["today_url"] ?>">
		<input type="hidden" name="name" value="<?php echo $data["name"] ?>">
		<input type="hidden" name="id" value="<?php echo $data["id"] ?>">
		<input type="submit" value="Get Data">
		</form>
	</li>
<?php 
}
?>
</ul>