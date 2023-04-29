<?php
session_start();

include("connection.php");
include("function.php");

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>PG Room Management System</title>
    <style>
		/* Global Styles */
body {
background-color: #1c1c1c;
color: #fff;
font-family: Arial, sans-serif;
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
</style>
</head>
<body>
    <header>
        <div class="container">
            <a href="#" class="logo"><img src="images/logo.png" alt="PG Room Management System"></a>
            <nav>
                <ul>
                    <li><a href="index.php">Home</a></li>
                    <li><a href="#">Rooms</a></li>
                    <li><a href="#">Favourites</a></li>
                    <li><a href="profile.php">Profile</a></li>
                    <li><a href="login.php">Logout</a></li>
                </ul>
            </nav>
        </div>
    </header>
    <section class="hero">
        <div class="container">
            <h1>Find the best PG accommodation for you</h1>
            <form action="#" class="search">
                <input type="text" placeholder="Enter city or location">
                <button>Search</button>
            </form>
        </div>
    </section>
    <section class="popular-rooms">
        <div class="container">
            <h2>Popular Rooms</h2>
            <div class="room">
                <img src="images/hostel1.jpg" alt="Room 1">
                <h3>Room 1</h3>
                <p>Location: XYZ</p>
                <p>Price: $200/month</p>
                <a href="#" class="btn">Book Now</a>
            </div>
            <div class="room">
                <img src="images/hostel2.jpg" alt="Room 2">
                <h3>Room 2</h3>
                <p>Location: ABC</p>
                <p>Price: $250/month</p>
                <a href="#" class="btn">Book Now</a>
            </div>
            <div class="room">
                <img src="images/hostel3.jpg" alt="Room 3">
                <h3>Room 3</h3>
                <p>Location: PQR</p>
                <p>Price: $180/month</p>
                <a href="#" class="btn">Book Now</a>
            </div>
        </div>
    </section>
    <section class="services">
        <div class="container">
            <h2>Our Services</h2>
            <div class="service">
                <img src="images/24-7.png" alt="Service 1">
                <h3>24/7 Customer Support</h3>
                <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit.</p>
            </div>
            <div class="service">
                <img src="images/protection.png" alt="Service 2">
                <h3>Secure Online Payments</h3>
                <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit.</p>
            </div>
            <div class="service">
                <img src="images/legal-document.png" alt="Service 3">
                <h3>Verified Rooms</h3>
                <p>Lorem
				ipsum dolor sit amet, consectetur adipiscing elit.</p>
</div>
</div>
</section>
<footer>
<div class="container">
<p>© 2021 PG Room Management System</p>
</div>
</footer>

</body>
</html>