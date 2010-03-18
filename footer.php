				  </div>
					<div id="express-box">
						<h2><b>Band</b> Search</h2>
						<img src="images/pic_2.jpg" width="112" height="92" alt="Pic 2" class="left" />
						<p>Type the name of band, or type of music</p>
						<form action="bands.php#main" method="POST" name="bandSearchForm">
							<input onclick = "this.value = ''" id = "bandSearch" type="text" id="bandSearch" name="bandSearch" value="<?php echo (isset($_POST['bandSearch'])?$_POST['bandSearch']:'Band Name...');?>">
							<input type="submit" value="Go">
						</form>
						<hr>
						<h2><b>Club</b> Search</h2>
						<img src="images/venue.jpg" width="112" height="92" alt="Pic 2" class="left" />
						<p>Type the club name, city, zip, or type of music</p>
						<form action="venues.php#main" method="POST">
							<input onclick = "this.value = ''" type="text" name="venueSearch" value="<?php echo (isset($_POST['venueSearch'])?$_POST['venueSearch']:'Club Name...');?>">
							<input type="submit" value="Go">
						</form>
					</div>
					<div class="clear"></div>
				</div>
			</div>
		</div>


		<div id="footer">
			<p>&copy; 2010 CPSC 350 :P all right reserved</p>
		</div>
	</div>

</body>

</html>