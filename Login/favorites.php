<?php
session_start();

include("connection.php");
include("function.php");

// Check if user is logged in
if (!isset($_SESSION['email'])) {
    header("Location: login.php");
    exit();
}

$email = $_SESSION['email'];

// Get the favorite rooms for the user
$query = "SELECT r.roomid, r.image, r.rent, r.image
          FROM favorites AS f
          JOIN rooms AS r ON f.roomid = r.roomid
          WHERE f.email = '$email'";
$result = mysqli_query($con, $query);
$favoriteRooms = mysqli_fetch_all($result, MYSQLI_ASSOC);

// Get all the rooms that the user has in their favorite table
$roomIds = array_column($favoriteRooms, 'roomid');

// Get the details of the favorite rooms
$query = "SELECT * FROM rooms WHERE roomid IN (" . implode(',', $roomIds) . ")";
$result = mysqli_query($con, $query);
$rooms = mysqli_fetch_all($result, MYSQLI_ASSOC);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PG Room Management System</title>
    <style>
		/* Global Styles */
body {
background-color: #1c1c1c;
color: #fff;
font-family: Roboto;
font-size: 16px;
}

.container {
max-width: 1200px;
margin: 0 auto;
padding: 0 20px;
}

a {
color: #fff;
text-decoration: none;
}

header {
background-color: #222;
padding: 10px 0;
position: fixed;
top: 0;
left: 0;
width: 100%;
z-index: 100;
}

.logo img {
height: 50px;
}

nav {
float: right;
}

nav ul {
list-style: none;
margin: 0;
padding: 0;
}

nav li {
display: inline-block;
margin-left: 30px;
}

nav a {
display: block;
padding: 10px;
}

nav a:hover {
background-color: #555;
}

.hero {
background-image: url('images/hero-bg.jpg');
background-size: cover;
background-position: center;
height: 600px;
display: flex;
justify-content: center;
align-items: center;
}

.hero h1 {
font-size: 48px;
text-align: center;
margin: 0;
}

.search input[type="text"] {
width: 70%;
padding: 10px;
border: none;
border-radius: 4px;
margin-right: 10px;
}

.search button {
padding: 10px;
background-color: #555;
border: none;
border-radius: 4px;
color: #fff;
}

.search button:hover {
background-color: #333;
cursor: pointer;
}

.popular-rooms {
padding: 100px 0;
}

.popular-rooms h2 {
text-align: center;
}

.room {
margin-bottom: 50px;
}

.room img {
width: 25%;
height: 300px;
object-fit: cover;
border-radius: 4px;
}

.room h3 {
margin: 10px 0;
font-size: 24px;
}

.room p {
margin: 10px 0;
font-size: 18px;
}

.btn {
display: block;
padding: 10px;
background-color: #555;
border: none;
border-radius: 4px;
color: #fff;
text-align: center;
margin-top: 20px;
}

.btn:hover {
background-color: #333;
cursor: pointer;
}

.services {
padding: 100px 0;
background-color: #222;
}

.services h2 {
text-align: center;
color: #fff;
}

.service {
margin-bottom: 50px;
}

.service img {
width: 10%;
height: 125px;
object-fit: cover;
border-radius: 4px;
}

.service h3 {
margin: 10px 0;
font-size: 24px;
color: #fff;
}

.service p {
margin: 10px 0;
font-size: 18px;
color: #fff;
}

footer {
background-color: #333;
padding: 20px 0;
margin-top: 50px;
}

footer p {
text-align: center;
margin:0;
color: #fff;
}

/* Media Queries */
@media only screen and (max-width: 768px) {
.container {
padding: 0 10px;
}

.logo img {
height: 80px;
}

nav ul {
display: none;
position: absolute;
top: 60px;
left: 0;
background-color: #222;
width: 100%;
}

nav li {
display: block;
margin: 0;
}

nav a {
padding: 10px;
}

.search input[type="text"] {
width: 60%;
}

.search button {
width: 30%;
}
}

@media only screen and (max-width: 600px) {
.hero h1 {
font-size: 36px;
}

.search input[type="text"] {
width: 50%;
}

.search button {
width: 40%;
}
}

@media only screen and (max-width: 480px) {
.hero h1 {
font-size: 24px;
}

.search input[type="text"] {
width: 40%;
}

.search button {
width: 50%;
}
}



/* Additional Styles and Effects */

/* Add a box shadow effect to the header */
header {
box-shadow: 0 5px 10px rgba(0, 0, 0, 0.1);
}

/* Add a hover effect to the logo */
.logo img:hover {
transform: rotate(360deg);
}

/* Add a hover effect to the popular rooms */
.popular-rooms .room:hover img {
transform: scale(1.1);
}

/* Add a hover effect to the services */
.services .service:hover img {
transform: rotateY(180deg);
}

/* Add a transition effect to the button */
.btn {
transition: all 0.3s ease;
}

/* Add a hover effect to the button */
.btn:hover {
transform: translateY(-5px);
box-shadow: 0 5px 10px rgba(0, 0, 0, 0.2);
}

/* Add a border radius to the input and button in the search bar */
.search input[type="text"],
.search button {
border-radius: 20px;
}

/* Change the font color and background color of the active link in the navigation */
nav a.active {
color: #fff;
background-color: #555;
}

/* Add a hover effect to the navigation */
nav a:hover {
background-color: #555;
transform: translateY(-3px);
}

/* Add a hover effect to the service titles */
.service h3:hover {
color: #555;
}

/* Add a hover effect to the footer social icons */
.footer-social a:hover {
transform: scale(1.1);
}


/* Add a border to images in the room section */
.room img {
  border: 4px solid #fff;
  box-shadow: 0px 0px 10px rgba(255, 255, 255, 0.5);
}

/* Add a hover effect to the room buttons */
.btn:hover {
  background-color: #ff9900;
  transition: background-color 0.3s ease-in-out;
}

/* Add a border and hover effect to the service images */
.service img {
  border: 2px solid #fff;
  transition: border 0.3s ease-in-out;
}

.service img:hover {
  border: 2px solid #ff9900;
}

/* Add a hover effect to nav links */
nav a:hover {
  background-color: #ff9900;
  transition: background-color 0.3s ease-in-out;
}

/* Add a hover effect to footer links */
footer a:hover {
  color: #ff9900;
  transition: color 0.3s ease-in-out;
}



/* Add a hover effect to the search button */
.search button:hover {
  background-color: #ff9900;
  cursor: pointer;
  transition: background-color 0.3s ease-in-out;
}

/* Add a hover effect to the service titles */
.service h3:hover {
  color: #ff9900;
  transition: color 0.3s ease-in-out;
}

/* Add a hover effect to the room titles */
.room h3:hover {
  color: #ff9900;
  transition: color 0.3s ease-in-out;
}


/* Add a hover effect to the back-to-top button */
.back-to-top:hover {
  background-color: #ff9900;
  cursor: pointer;
  transition: background-color 0.3s ease-in-out;
}

/* Add a hover effect to the room images */
.room img:hover {
  opacity: 0.8;
  transition: opacity 0.3s ease-in-out;
}
.favorite-btn {
    display: inline-block;
    padding: 8px 16px;
    background-color: #ffcc00;
    color: #fff;
    text-decoration: none;
    border-radius: 4px;
    transition: background-color 0.3s ease;
}

.favorite-btn:hover {
    background-color: #ffa500;
}

</style>
</head>
<body>
    <header>
        <div class="container">
            <a href="#" class="logo"><img src="images/logo.png" alt="PG Room Management System"></a>
            <nav>
                <ul>
                    <li><a href="index.php">Home</a></li>
                    <li><a href="favorites.php">Favorites</a></li>
                    <li><a href="profile.php">Profile</a></li>
                    <li><a href="logout.php">Logout</a></li>
                </ul>
            </nav>
        </div>
    </header>

    <section class="favorite-rooms">
        <div class="container">
            <h2>Favorite Rooms</h2>
            <?php foreach ($rooms as $room) { ?>
            <div class="room">
                <img src="<?php echo $room['image']; ?>" >
                <p>Location: <?php echo $room['city']; ?></p>
                <p>Price: <?php echo $room['rent']; ?>/month</p>
                <a href="booking.php?owner=<?php echo $room['owner']; ?>&roomid=<?php echo $room['roomid']; ?>" class="btn">Book Now</a>
                
            </div>
            <?php } ?>
        </div>
    </section>
    <footer>
        <div class="container">
            <p>© 2023 PG Room Management System</p>
        </div>
    </footer>
</body>
</html>
