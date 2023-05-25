<?php
session_start();

include("connection.php");
include("function.php");

if(isset($_SESSION['email'])) {
	$user_data = check_login($con);
} else {
    echo "User is not logged in";
}

?>

<!DOCTYPE html>
<html>
<head>
	<title>PG Room Management System</title>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<style>
		body {
			background-color: #1e1e1e;
			color: #fff;
			font-family: Arial, sans-serif;
		}

		header {
			background-color: #333;
			color: #fff;
			padding: 10px;
			text-align: center;
			display: flex;
			justify-content: space-between;
			align-items: center;
		}

		header img {
			height: 50px;
		}

		nav {
			background-color: #444;
			overflow: hidden;
		}

		nav a {
			color: #fff;
			text-align: center;
			padding: 14px 16px;
			text-decoration: none;
			display: inline-block;
		}

		nav a:hover {
			background-color: #888;
		}

		.search-container {
			display: flex;
			justify-content: center;
			margin-top: 20px;
		}

		.search-container input[type=text] {
			padding: 10px;
			font-size: 17px;
			border: none;
			width: 500px;
			background-color: #fff;
			border-radius: 20px;
			margin-right: 10px;
		}

		.search-container button {
			padding: 10px 20px;
			background-color: #555;
			color: #fff;
			border: none;
			border-radius: 20px;
			cursor: pointer;
		}

		.search-container button:hover {
			background-color: #777;
		}

		main {
			background-color: #333;
			padding: 20px;
			margin-top: 20px;
			margin-bottom: 20px;
			border-radius: 20px;
		}

		footer {
			background-color: #444;
			color: #fff;
			padding: 10px;
			text-align: center;
		}

		.profile-container {
			display: flex;
			flex-direction: column;
			align-items: center;
			margin-top: 50px;
		}

		.profile-pic {
			width: 200px;
			height: 200px;
			border-radius: 50%;
			overflow: hidden;
			margin-bottom: 20px;
		}

		.profile-pic img {
			width: 100%;
			height: 100%;
			object-fit: cover;
		}

		.profile-details {
			display: flex;
			flex-direction: column;
			align-items: center;
			color: #fff;
		}

		.profile-details h2 {
			margin-bottom: 10px;
		}

		.profile-details p {
			margin-bottom: 5px;
		}

		.edit-profile-btn {
			padding: 10px 20px;
			background-color: #555;
			color: #fff;
			border: none;
			border-radius: 20px;
			cursor: pointer;
			margin-top: 20px;
		}

		.edit-profile-btn:hover {
			background-color: #777;
		}
	</style>
</head>
<body>
	<header>
		<h1>PG Room Management System</h1>
		
	<div>
		<p>Welcome, <?php echo $user_data['firstname']; ?></p>
		<a href="logout.php">Logout</a>
	</div>
</header>

<nav>
	<a href="index.php">Home</a>
	<a href="#">Rooms</a>
	<a href="addroom.php">Register Room</a>
	<a href="about.php">About</a>
</nav>

<div class="profile-container">
	<div class="profile-pic">
		<img src="images/profile.png" alt="Profile Picture">
	</div>
	<div class="profile-details">
		<h2><?php echo $user_data['firstname']; echo " "; echo $user_data['lastname'] ?></h2>
		<p>Email: <?php echo $user_data['email']; ?></p>
		<p>Phone: <?php echo $user_data['mobile']; ?></p>
		<p>DOB: <?php echo $user_data['dob']; ?></p>
		<p>City: <?php echo $user_data['city']; ?></p>
		<a href="completeprofile.php" class="edit-profile-btn" onclick="<?php $_SESSION['edit'] = 1; ?>">Edit Profile</a>
	</div>
</div>

<footer>
	<p>© 2023 PG Room Management System</p>
</footer>
	</body>
	</html>