<?php include("header.php");?>
<h2>Events</h2>
<ul>
	<?php
	if($_GET['view']=='ALL') {
		$now = 0;
	} else {
		$now = date("Y-m-d H:i:s");
	}
	$query = "SELECT *,Band.name as bandName,Venue.name as venueName FROM Event JOIN Band ON Event.bandId = Band.bandId JOIN Venue ON Event.venueId = Venue.venueId WHERE performanceDate >= '$now' ORDER BY performanceDate ASC";

	$result = mysqli_query($db,$query);
	while($row = mysqli_fetch_array($result)) { ?>
	<li>
		<a href="band.php?bandId=<?php echo $row['bandId'];?>"><?php echo $row['bandName'];?></a> at <?php echo $row['venueName'];?> On <?php echo date("D, F d, Y \A\\t g:ia",strToTime($row['performanceDate']));?>
		<a href="addAnEvent.php?eventId=<?php echo $row['eventId'];?>">Edit</a>
	</li>
	<?php } ?>
</ul>
<?php if($_GET['view']!='ALL') { ?>
<p class="more"><a href="events.php?view=ALL"><img width="68" height="14" alt="More" src="images/more.gif"></a></p>
<?php } ?>

<?php include("footer.php");?>