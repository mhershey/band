<?php include("header.php");
$venueId = preg_replace("@[^\d]+@","",$_GET['venueId']);
if(isset($_POST['update'])) {
	$errors = array();
	$name = str_replace("'","\'",$_POST['name']);
	if(strlen($name)==0) {
		$errors[] = "Must Include a Name";
	}
	$city = str_replace("'","\'",$_POST['city']);
	if(strlen($city)==0) {
		$errors[] = "Must Include a city";
	}
	$zipcode = str_replace("'","\'",$_POST['zipcode']);
	if(strlen($zipcode)==0) {
		$errors[] = "Must Include a zipcode";
	}
	$musicType = str_replace("'","\'",$_POST['musicType']);
	if(strlen($musicType)==0) {
		$errors[] = "Must Include a Music Type";
	}
	
	$description = str_replace("'","\'",$_POST['description']);
	if(strlen($description)==0) {
		$errors[] = "Must Include a Description";
	}
	
	if(sizeOf($errors)==0) {
		if(isset($_GET['venueId'])) {
			$query = "UPDATE Venue SET name='$name', city='$city', zipcode='$zipcode', description='$description', musicType='$musicType' WHERE venueId='$venueId' LIMIT 1";
			mysqli_query($db,$query);
		} else {
			$query = "INSERT INTO Venue (name,city,zipcode,description,musicType) VALUES('$name','$city','$zipcode','$description','$musicType')";
			mysqli_query($db,$query);
		}
	} else {
		foreach($errors as $error) {
			echo '<div>'.$error.'</div>';
		}
	}
}
if(isset($_GET['venueId'])) {
	$query = "SELECT * FROM Venue WHERE venueId='$venueId' LIMIT 1";
	$result = mysqli_query($db,$query);
	$row = mysqli_fetch_array($result);
} else {
	$row = array();
}
?>
<a style="float:right;" href="addAVenue.php?venueId=<?php echo $venueId;?>">Delete</a>
<h2><b><?php echo (isset($_GET['venueId'])?'Update':'Add');?> a</b> Venue</h2>
<form action="<?php echo $_SERVER['REQUEST_URI'];?>" method="POST">
	<input type="hidden" name="update" value="true">
	<div>Name:</div><div><input type="text" name="name" value="<?php echo htmlentities($row['name']);?>"></div>
	<div>City:</div><div><input type="text" name="city" value="<?php echo htmlentities($row['city']);?>"></div>
	<div>ZipCode:</div><div><input type="text" name="zipcode" value="<?php echo htmlentities($row['zipcode']);?>"></div>
	<div>Music Type:</div><div><input type="text" name="musicType" value="<?php echo htmlentities($row['musicType']);?>"></div>
	<div>Description:</div><div><textarea name="description" style="width:400px;height:200px;"><?php echo htmlentities($row['description']);?></textarea></div>
	<div><input type="submit" value="<?php echo (isset($_GET['venueId'])?'Update':'Add');?>"></div>
</form>
<?php include("footer.php");?>