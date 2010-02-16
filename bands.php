<?php include("header.php");?>
<h2>Bands</h2>
<ul>
	<?php
	$search = str_replace("'","\'",$_POST['bandSearch']);
	$query = "SELECT * FROM Band WHERE name LIKE '%{$search}%' OR musicType LIKE '%{$search}%' ORDER BY name ASC";
	$result = mysqli_query($db,$query);
	while($row = mysqli_fetch_array($result)) { ?>
	<li>
		<a href="band.php?bandId=<?php echo $row['bandId'];?>"><?php echo $row['name'];?></a> - <?php echo $row['musicType'];?>
	</li>
	<?php } ?>
</ul>
<?php include("footer.php");?>