<?php include("header.php");
$eventId = preg_replace("@[^\d]+@","",$_GET['eventId']);
if(isset($_POST['update'])) {
	$errors = array();
	$bandId = preg_replace("@[^\d]+@","",$_POST['bandId']);
	if(!is_numeric($bandId)) {
		$errors[] = "Must Include a Band";
	}
	$venueId = preg_replace("@[^\d]+@","",$_POST['venueId']);
	if(!is_numeric($venueId)) {
		$errors[] = "Must Include a Venue";
	}
	$performanceDate = strToTime($_POST['performanceDate']);
	if($performanceDate == 0) {
		$errors[] = "Must Have a Performance Date";
	} else {
		$performanceDate = date("Y-m-d H:i:s",$performanceDate);
	}
	if(sizeOf($errors)==0) {
		if(isset($_GET['eventId'])) {
			$query = "UPDATE Event SET bandId='$bandId', venueId='$venueId',performanceDate='$performanceDate' WHERE eventId='$eventId' LIMIT 1";
			mysqli_query($db,$query);
		} else {
			$query = "INSERT INTO Event (bandId,venueId,performanceDate) VALUES('$bandId','$venueId','$performanceDate')";
			mysqli_query($db,$query);
		}
	} else {
		foreach($errors as $error) {
			echo '<div>'.$error.'</div>';
		}
	}
}
if(isset($_GET['eventId'])) {
	$query = "SELECT * FROM Event WHERE eventId='$eventId' LIMIT 1";
	$result = mysqli_query($db,$query);
	$event = mysqli_fetch_array($result);
} else {
	$event = array();
	$event['performanceDate'] = "Today";
}
?>
<h2><b><?php echo (isset($_GET['eventId'])?'Update':'Add');?> an</b> Event</h2>
<form action="<?php echo $_SERVER['REQUEST_URI'];?>" method="POST">
<input type="hidden" name="update" value="true">
<div>Band:</div><div><select name="bandId">
	<?php
	$query = "SELECT * FROM Band ORDER BY name ASC";
	$result = mysqli_query($db,$query);
	while($row = mysqli_fetch_array($result)) {
		echo '<option '.(($row['bandId']==$event['bandId'])?'SELECTED':'').' value="'.$row['bandId'].'">'.$row['name'].'</option>';
	}
	?>
</select></div>
<div>Venue:</div><div><select name="venueId">
	<?php
	$query = "SELECT * FROM Venue ORDER BY name ASC";
	$result = mysqli_query($db,$query);
	while($row = mysqli_fetch_array($result)) {
		echo '<option '.(($row['venueId']==$event['venueId'])?'SELECTED':'').' value="'.$row['venueId'].'">'.$row['name'].'</option>';
	}
	?>
</select></div>
<div>Date of Performance:</div><div><input type="text" name="performanceDate" value="<?php echo date("m/d/Y g:i",strToTime($event['performanceDate']));?>"></div>
<div><input type="submit" value="<?php echo (isset($_GET['eventId'])?'Update':'Add');?>"></div>
</form>
<?php include("footer.php");?>