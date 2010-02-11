<?php include("header.php");?>
<h2><b>Featured</b> Bands</h2>
<img src="images/pic_1.jpg" width="112" height="92" alt="Pic 1" class="left" />
<?php
$query = "SELECT * FROM Band ORDER BY RAND() LIMIT 1";
$result = mysqli_query($db,$query);
$row = mysqli_fetch_array($result);
?>
<h2><a href="band.php?bandId=<?php echo $row['bandId'];?>"><?php echo $row['name'];?></a></h2>
<h3><?php echo $row['city'].', '.$row['state'];?></h3>
<h4><?php echo $row['musicType'];?></h4>
<p><?php echo $row['description'];?></p>

<hr>

<h2><b>Featured</b> Venue</h2>
<img src="images/venue2.jpg" width="112" height="92" alt="Pic 1" class="left" />
<?php
$query = "SELECT * FROM Venue ORDER BY RAND() LIMIT 1";
$result = mysqli_query($db,$query);
$row = mysqli_fetch_array($result);
?>
<h2><a href="venue.php?venueId=<?php echo $row['venueId'];?>"><?php echo $row['name'];?></a></h2>
<h3><?php echo $row['city'].', '.$row['zipcode'];?></h3>
<h4><?php echo $row['musicType'];?></h4>
<p><?php echo $row['description'];?></p>
<?php include("footer.php");?>