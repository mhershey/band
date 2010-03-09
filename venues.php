<?php include("header.php");?>
<h2>Bands</h2>
<ul>
	<?php
	$search = str_replace("'","\'",$_POST['venueSearch']);
	$query = "SELECT * FROM Venue WHERE name LIKE '%{$search}%' OR city LIKE '%{$search}%' OR zipcode = '{$search}' OR musicType LIKE '%{$search}%' ORDER BY name ASC";
	$result = mysqli_query($db,$query);
	while($row = mysqli_fetch_array($result)) { ?>
	<li>
		<a href="venue.php?venueId=<?php echo $row['venueId'];?>"><?php echo $row['name'];?></a> - <?php echo $row['musicType'];?>
	</li>
	<?php } ?>
</ul>
<?php include("footer.php");?>