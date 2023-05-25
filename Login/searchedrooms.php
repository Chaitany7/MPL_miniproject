<?php
session_start();

include("connection.php");
include("function.php");

if (!isset($_SESSION['search'])) {
    // Redirect to the homepage if search session is not set
    header("Location: index.php");
    exit();
}

$searchText = $_SESSION['search'];

$query = "SELECT * FROM rooms WHERE city = '$searchText'";
$result = mysqli_query($con, $query);
$rooms = mysqli_fetch_all($result, MYSQLI_ASSOC);

// Check if no rooms are found
if (count($rooms) == 0) {
    $notFound = true;
}
else{
    $notFound=false;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Searched Rooms | PG Room Management System</title>
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
    color: #fff;
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
    color: #fff;
}

.room p {
    margin: 10px 0;
    font-size: 18px;
    color: #fff;
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
margin: 0;
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
.btn:hover {
transform: translateY(-5px);
box-shadow: 0 5px 10px rgba(0, 0, 0, 0.2);
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

    </style>
</head>
<body>
    <header>
        <div class="container">
            <a href="#" class="logo"><img src="images/logo.png" alt="PG Room Management System"></a>
            <nav>
                <ul>
                    <li><a href="index.php">Home</a></li>
                    <li><a href="#">Favourites</a></li>
                    <li><a href="profile.php">Profile</a></li>
                    <li><a href="login.php">Logout</a></li>
                </ul>
            </nav>
        </div>
    </header>
    <section class="search-results">
        <div class="container">
            <h2>Search Results for '<?php echo $searchText; ?>'</h2>
            <?php if ($notFound) { ?>
                <p>Not found!</p>
            <?php } else { ?>
                <?php foreach ($rooms as $room) { ?>
                <div class="room">
                    <img src="<?php echo $room['image']; ?>">
                    <p>Location: <?php echo $room['city']; ?></p>
                    <p>Price: <?php echo $room['rent']; ?>/month</p>
                    <a href="booking.php<?php $_SESSION['owner'] = $room['owner']; $_SESSION['roomid'] = $room['roomid']; ?>" class="btn">Book Now</a>
                </div>
                <?php } ?>
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
