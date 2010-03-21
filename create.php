<?php
if(isset($_POST['create']))
{
$root = $_POST['root'];
$pw = $_POST['pw'];
$db = mysqli_connect('localhost',$root,$pw);
if(!$db)
die('Connect Error, did you enter the right information?');
mysqli_query($db,"drop DATABASE IF EXISTS band;");
mysqli_query($db,"create database band");

mysqli_query($db,"CREATE USER 'band'@'localhost' IDENTIFIED BY 'bandpass'");
mysqli_query($db,"GRANT ALL PRIVILEGES ON *.* TO 'band'@'localhost' WITH GRANT OPTION");
mysqli_query($db,"use band");


mysqli_query($db,"CREATE TABLE IF NOT EXISTS `band` (
  `bandId` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL,
  `city` varchar(20) NOT NULL,
  `state` char(2) NOT NULL,
  `bandMembers` varchar(200) NOT NULL,
  `description` text NOT NULL,
  `recordLabel` varchar(100) NOT NULL,
  `musicType` varchar(100) NOT NULL,
  PRIMARY KEY (`bandId`),
  UNIQUE KEY `name` (`name`),
  KEY `city` (`city`,`state`,`bandMembers`,`recordLabel`),
  KEY `musicType` (`musicType`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2");

mysqli_query($db,"INSERT INTO `band` (`bandId`, `name`, `city`, `state`, `bandMembers`, `description`, `recordLabel`, `musicType`) VALUES
(1, 'Electric Lights', 'Manassas', 'VA', 'David, Nick, Tom', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Maecenas magna est, dignissim a luctus rhoncus, consequat nec libero. Cras quis urna ac ligula dignissim feugiat. Curabitur neque eros, tincidunt sed varius non, porta nec justo. Nulla eu elit tortor. Etiam sapien dolor, commodo et ullamcorper ac, vehicula ac lorem. Aenean ut orci neque, sed placerat leo.', 'Cooperative Records', 'rock, indie, acustic'),
(2, 'Linkin Park', 'Agoura Hills', 'Ca', 'Chester Bennington Rob Bourdon Brad Delson David \"Phoenix\" Farrell Joe Hahn Mike Shinoda', 'Rock Band Group', 'Dead by Sunrise', 'Rock'),
(3, 'Brad Paisley', 'Glen Dale', 'We', 'Brad Paisley', 'Songs such as: To the World, Mud on the Tires', 'Arista Nashville', 'Country'),
(4, 'Metallica', 'Los Angeles', 'Ca', 'James Hetfield Lars Ulrich Kirk Hammett Robert Trujillo', 'Classic Rock Band', 'Warner Bros.', 'Heavy metal'),
(5, 'Jay-Z', 'New York', 'Ne', 'Shawn Corey Carter', 'Rapper', 'Roc Nation', 'Rap'),
(6, 'DragonForce', 'London', 'En', 'Herman Li Sam Totman Vadim Pruzhanov Dave Mackintosh Frédéric Leclercq', 'Fastest Band in world at one time', 'Sanctuary', 'Power Metal'),
(7, 'The Blanks', 'Na', 'Na', 'Sam Lloyd, George Miserlis, Philip McNiven, and Paul F. Perry.', 'Famous band from show scrubs', 'CD Baby', 'A cappella'),
(8, 'Lazlo Bane', 'Santa Monica', 'Ca', 'Lazlo Bane', 'Superman theme song to popular tv show Scrubs.', 'Lookout Sound', 'Alternative Rock'),
(9, 'Tim McGraw', 'Delhi', 'Lo', 'Samuel Timothy McGraw', 'Country Legend', 'Curb Records', 'Country'),
(10, 'Eminem', 'Detriot', 'Mi', 'Marshall Bruce Mathers III', 'Artist performing in multiple bands including D12', 'Mashin'' Duck Records', 'Hip Hop'),
(11, 'Rick Astley', 'Lancashire', 'En', 'Richard Paul Astley', 'Famous for people using his songs for RickRolling', 'Sony BMG', 'Eurobeat'),
(12, 'Ke$ha', 'Los Angeles', 'Ca', 'Kesha Rose Sebert', 'Popular for redo of \"Right Round\" initially', 'Nashville', 'Electropop')");

mysqli_query($db,"CREATE TABLE IF NOT EXISTS `comment` (
  `commentId` int(11) NOT NULL AUTO_INCREMENT,
  `bandId` int(11) NOT NULL,
  `description` text NOT NULL,
  `datePosted` datetime NOT NULL,
  PRIMARY KEY (`commentId`),
  KEY `bandId` (`bandId`,`datePosted`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3");

mysqli_query($db,"INSERT INTO `comment` (`commentId`, `bandId`, `description`, `datePosted`) VALUES
(1, 1, 'This band is AWESOME', '2010-02-10 00:36:22'),
(2, 1, 'WOW', '2010-02-11 00:44:52')");

mysqli_query($db,"CREATE TABLE IF NOT EXISTS `event` (
  `eventId` int(11) NOT NULL AUTO_INCREMENT,
  `venueId` int(11) NOT NULL,
  `bandId` int(11) NOT NULL,
  `performanceDate` datetime NOT NULL,
  PRIMARY KEY (`eventId`),
  UNIQUE KEY `venueId` (`venueId`,`bandId`,`performanceDate`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3");

mysqli_query($db,"INSERT INTO `event` (`eventId`, `venueId`, `bandId`, `performanceDate`) VALUES
(1, 1, 1, '2010-02-07 09:00:00'),
(2, 1, 1, '2010-06-19 09:01:00')");

mysqli_query($db,"CREATE TABLE IF NOT EXISTS `popularalbum` (
  `popularAlbumId` int(11) NOT NULL AUTO_INCREMENT,
  `bandId` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  PRIMARY KEY (`popularAlbumId`),
  KEY `bandId` (`bandId`,`name`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1");

mysqli_query($db,"CREATE TABLE IF NOT EXISTS `user` (
  `userId` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(100) NOT NULL,
  `password` varchar(40) NOT NULL,
  PRIMARY KEY (`userId`),
  UNIQUE KEY `username` (`username`),
  KEY `password` (`password`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1");

mysqli_query($db,"CREATE TABLE IF NOT EXISTS `venue` (
  `venueId` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL,
  `city` varchar(20) NOT NULL,
  `zipcode` int(11) NOT NULL,
  `description` text NOT NULL,
  `musicType` varchar(100) NOT NULL,
  PRIMARY KEY (`venueId`),
  UNIQUE KEY `name` (`name`),
  KEY `city` (`city`,`zipcode`),
  KEY `musicType` (`musicType`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2");

mysqli_query($db,"INSERT INTO `venue` (`name`, `city`, `zipcode`, `description`, `musicType`) VALUES
('Birchmere', 'Alexandria', 22305, 'One of the leading Folk clubs in the country. They also present some R&B/Bluegrass/Country/Fusion Jazz. Mike Jaworek books the club.', 'folk'),
('Brittany\'s Restaurant & Sports Bar', 'Woodbridge', 22192, 'Rock and Roll, Classic Rock, Modern. They run the live music on Fridays, Saturdays and Special Events.', 'rock'),
('Capital Alehouse', 'Richmond', 23219, 'It was built in the 1870s and we have restored the original hardwood floors, wooden rafters and old brick walls.', 'folk'),
('Club Paradiso', 'Springfield', 22150, 'They present Country music & Jamie La Ritz is hosting an open mic.', 'country'),
('Folk Club of Reston-Herndon', 'Herndon', 22070, 'An all-volunteer organization that promotes traditional and contemporary folk music and hosts an open mike every Tuesday.', 'folk'),
('Jammin Java', 'Vienna', 22181, 'Variety of music from folk to alternative rock. National and regional acts.', 'rock'),
('Jaxx', 'Springfield', 22152, 'Not really known for its cussine however you can occassionally see national Hard Rock and Metal acts that you won\'t find at other venues.', 'rock'),
('Nissan Pavillion', 'Bristow', 20136, '25,000 seats makes this the largest outdoor amphitheater in the region.', 'misc'),
('Old Brogue', 'Great Falls', 22066, 'A small pub with great food in the beautiful Great Falls area. Its nightly entertainment is Folk/Acoustic.', 'folk'),
('Patriot Center', 'Alexandria', 22314, '10,000 plus or minus seats. Can be rented.', 'misc'),
('Rhodeside Grill', 'Arlington', 22202, 'They present alternative rock and acoustic music.', 'alternative'),
('Sala Thai', 'Arlington', 22202, 'Live jazz every Friday and Saturday nights. No cover charge for the music.', 'jazz'),
('Secrets', 'Alexandria', 22309, 'Presents Rock/Pop mostly on weekends.', 'rock'),
('Sign of the Whale', 'Falls Church', 22042, 'A restaurant/bar that presents Acoustic music.', 'acoustic'),
('Sunset Grille', 'Annandale', 22003, 'Peanut shells litter the floor and some of the best Blues and Rockabilly sounds in town blast you out of your seat.', 'blues')");
	rename("create.php","create.bak.php");
	header("Location: index.php");
	exit;
}
else
{
?>
<html>
<head>
<title> Band Set up page </title>
</head>
<body>
<form method="post" action="create.php">
Enter the information for your mysql database server.
<br>
Enter Root Name: <input type="text" name="root">
<br>
Enter Root Password: <input type="password" name="pw">
<br>
<input type="submit" name="create" value="Create DB">
</form>
</body>
</html>
<?php
}
?>