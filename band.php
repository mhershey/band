<?php
include("db_connect.php");
$bandId = preg_replace("@[^\d]+@","",$_GET['bandId']);
if(isset($_GET['bandId'])) {
	$query = "SELECT * FROM Band WHERE bandId='$bandId' LIMIT 1";
	$result = mysqli_query($db,$query);
	$row = mysqli_fetch_array($result);
} else {
	header("Location:bands.php");
	exit;
}
if(isset($_POST['update'])) {
	$errors = array();

	$description = trim(str_replace("'","\'",$_POST['description']));
	if(strlen($description)==0) {
		$errors[] = "You must include a comment";
	}

	if(sizeOf($errors)==0) {
		$query = "INSERT INTO Comment (bandId,description,datePosted) VALUES('$bandId','$description',NOW())";
		mysqli_query($db,$query);
	}
}

include("header.php");
?>
<a style="float:right;" href="addABand.php?bandId=<?php echo $bandId;?>">Edit</a>
<h2><?php echo $row['name'];?></h2>
<img src="images/pic_1.jpg" width="112" height="92" alt="Pic 1" class="left" />
<h3><?php echo $row['city'].', '.$row['state'];?></h3>
<h4>
<?php
	$type = $row['musicType'];
  	$name=explode(",",$type);
  	$v=0;

  	while(count($name,0) > 0){

  		$elem = array_shift($name);

  		echo
  		"<a name = \"$elem\" href = \"#\" onclick= \"document.getElementById('bandSearch').value='$elem';document.bandSearchForm.submit();\">$elem</a>";

		$v = $v +1;

		if ($v <= count($name,0)+1 && (count($name, 0)+1 > 1)){
		  		echo ",";
	 	}

	}

?></h4>

<p><?php echo $row['description'];?></p>

<h2>Upcoming Events</h2>
<ul>
	<?php
	$query = "SELECT *,Venue.name as venueName FROM Event JOIN Band ON Event.bandId = Band.bandId JOIN Venue ON Event.venueId = Venue.venueId WHERE Event.bandId='$bandId' ORDER BY performanceDate ASC";
	$result = mysqli_query($db,$query);
	while($event = mysqli_fetch_array($result)) { ?>
	<li>
		<?php echo $event['venueName'];?> On <?php echo date("D, F d, Y \A\\t g:ia",strToTime($event['performanceDate']));?>
	</li>
	<?php } ?>
</ul>
<h2>Comments</h2>
<ul>
	<?php
	$query = "SELECT * FROM Comment WHERE bandId='$bandId' ORDER BY datePosted DESC";
	$result = mysqli_query($db,$query);
	while($comment = mysqli_fetch_array($result)) { ?>
	<li>
		<?php echo htmlentities($comment['description']);?> (<?php echo date("F d",strToTime($comment['datePosted']));?>)
	</li>
	<?php } ?>
</ul>
<h4>Add Comment</h4>
<form action="<?php echo $_SERVER['REQUEST_URI'];?>" method="POST">
	<input type="hidden" name="update" value="comment">
	<textarea name="description" style="width:350px;height:100px;"></textarea><br>
	<input type="submit" value="Add Comment">
</form>
<?php include("footer.php");?>