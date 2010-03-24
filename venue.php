<?php
include("db_connect.php");
$venueId = preg_replace("@[^\d]+@","",$_GET['venueId']);
if(isset($_GET['venueId'])) {
	$query = "SELECT * FROM Venue WHERE venueId='$venueId' LIMIT 1";
	$result = mysqli_query($db,$query);
	$row = mysqli_fetch_array($result);
} else {
	header("Location:venues.php");
	exit;
}

include("header.php");
?>
<a style="float:right;" href="addAVenue.php?venueId=<?php echo $venueId;?>">Edit</a>
<h2><?php echo $row['name'];?></h2>
<img src="images/venue2.jpg" width="112" height="92" alt="Pic 1" class="left" />
<h3><?php echo $row['city'].', '.$row['zipcode'];?></h3>
<h4><?php echo $row['musicType'];?></h4>
<p><?php echo $row['description'];?></p>

<h2>Upcoming Events</h2>
<ul>
	<?php
	$query = "SELECT *,Venue.name as venueName FROM Event JOIN Band ON Event.bandId = Band.bandId JOIN Venue ON Event.venueId = Venue.venueId WHERE Event.venueId='$venueId' ORDER BY performanceDate ASC";
	$result = mysqli_query($db,$query);
	while($event = mysqli_fetch_array($result)) { ?>
	<li>
		<?php echo $event['venueName'];?> On <?php echo date("D, F d, Y \A\\t g:ia",strToTime($event['performanceDate']));?>
	</li>
	<?php } ?>
</ul>
<h3><a href="http://maps.google.com/maps?f=q&source=s_q&hl=en&q=<?php echo urlencode($row['name'] .' '.$row['city'] .' '. $row['zipcode']);?>" target="_blank">Google Map</a>
<?php include("footer.php");?>