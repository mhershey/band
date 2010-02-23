<?php include_once("db_connect.php");
$bandId = preg_replace("@[^\d]+@","",$_GET['bandId']);
if(isset($_POST['delete'])) {
	$query = "DELETE FROM Band WHERE bandId = '$bandId'";
	mysqli_query($db,$query);
	header("Location: addABand.php");
	exit;
	//***
}
include("header.php");
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
	$state = str_replace("'","\'",$_POST['state']);
	if(strlen($state)==0) {
		$errors[] = "Must Include a state";
	}
	$bandMembers = str_replace("'","\'",$_POST['bandMembers']);
	if(strlen($bandMembers)==0) {
		$errors[] = "Must Include the Band Members";
	}
	$recordLabel = str_replace("'","\'",$_POST['recordLabel']);
	if(strlen($recordLabel)==0) {
		$errors[] = "Must Include a Record Label";
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
		if(isset($_GET['bandId'])) {
			$query = "UPDATE Band SET name='$name', city='$city', state='$state', bandMembers='$bandMembers',recordLabel='$recordLabel', description='$description', musicType='$musicType' WHERE bandId='$bandId' LIMIT 1";
			mysqli_query($db,$query);
		} else {
			$query = "INSERT INTO Band (name,city,state,bandMembers,recordLabel,description,musicType) VALUES('$name','$city','$state','$bandMembers','$recordLabel','$description','$musicType')";
			mysqli_query($db,$query);
		}
	} else {
		foreach($errors as $error) {
			echo '<div>'.$error.'</div>';
		}
	}
}
if(isset($_GET['bandId'])) {
	$query = "SELECT * FROM Band WHERE bandId='$bandId' LIMIT 1";
	$result = mysqli_query($db,$query);
	$row = mysqli_fetch_array($result);
} else {
	$row = array();
}
?>
<?php
if(isset($_GET['bandId'])) { ?>
	<form action="<?php echo $_SERVER['REQUEST_URI'];?>" method="POST" name="deleteForm">
		<input type="hidden" name="delete" value="true">
	</form>
	<A HREF ="#" onclick="document.deleteForm.submit();" style = "float:right;">Delete</A>
	<?php } ?>
<h2><b><?php echo (isset($_GET['bandId'])?'Update':'Add');?> a</b> Band</h2>
<form action="<?php ?>" method="POST">

<form action="<?php echo $_SERVER['REQUEST_URI'];?>" method="POST">
	<input type="hidden" name="update" value="true">
	<div>Name:</div><div><input type="text" name="name" value="<?php echo htmlentities($row['name']);?>"></div>
	<div>City:</div><div><input type="text" name="city" value="<?php echo htmlentities($row['city']);?>"></div>
	<div>State:</div><div><input type="text" name="state" value="<?php echo htmlentities($row['state']);?>"></div>
	<div>Band Members:</div><div><input type="text" name="bandMembers" value="<?php echo htmlentities($row['bandMembers']);?>"></div>
	<div>Record Label:</div><div><input type="text" name="recordLabel" value="<?php echo htmlentities($row['recordLabel']);?>"></div>
	<div>Music Type:</div><div><input type="text" name="musicType" value="<?php echo htmlentities($row['musicType']);?>"></div>
	<div>Description:</div><div><textarea name="description" style="width:400px;height:200px;"><?php echo htmlentities($row['description']);?></textarea></div>
	<div><input type="submit" value="<?php echo (isset($_GET['bandId'])?'Update':'Add');?>"></div>
</form>
<?php include("footer.php");?>