<?php
session_start();

include("connection.php");
include("function.php");

//Get the room id from the URL
$room_owner = $_GET['owner'];



//Select the room details from the database
$query = "SELECT * FROM rooms WHERE owner = '$room_owner'";
$result = mysqli_query($con, $query);

//Fetch the room details from the result
$row = mysqli_fetch_array($result);

//Assign the room details to variables
$owner_id = $row['owner'];
$room_type = $row['type'];
$room_rent = $row['rent'];
$room_description = $row['description'];
$room_address = $row['address'];
$room_size = $row['size'];
$room_floor = $row['floor'];
$room_number = $row['roomnumber'];
$room_city = $row['city'];
$room_state = $row['state'];
$room_country = $row['country'];
$room_pincode = $row['pincode'];
$room_facilities = $row['facilities'];
$room_availability = $row['availability'];
$room_image = $row['image'];

//Close the database connection
mysqli_close($con);
?>
<!DOCTYPE html>
<html>
<head>
    
	<title>Room Details</title>
    <style>
        /* Body background */
body {
background-color: #222;
color: #fff;
}

/* Container background */
.container {
background-color: #333;
padding: 20px;
}

/* Headings */
h3 {
color: #fff;
}

/* Paragraphs */
p {
color: #ccc;
}

/* Button */
.btn {
background-color: #0069d9;
color: #fff;
border: none;
padding: 10px 20px;
margin-top: 20px;
}

/* Button hover */
.btn:hover {
background-color: #0052a5;
cursor: pointer;
}

/* Image */
img {
max-width: 100%;
height: auto;
margin-bottom: 20px;
}

/* Footer */
footer {
background-color: #111;
padding: 20px;
text-align: center;
color: #fff;
}
</style>
    </head>
<body>
<main>
<div class="container">
  <div class="row">
    <div class="col-md-6">
      <img src="<?php echo $room_image; ?>" alt="Room Image">
    </div>
    <div class="col-md-6">
      <h3><?php echo $room_type; ?></h3>
      <p>Address: <?php echo $room_address; ?>, <?php echo $room_city; ?>, <?php echo $room_state; ?>, <?php echo $room_country; ?> - <?php echo $room_pincode; ?></p>
      <p>Size: <?php echo $room_size; ?> sq.ft.</p>
      <p>Floor: <?php echo $room_floor; ?></p>
      <p>Room Number: <?php echo $room_number; ?></p>
      <p>Facilities: <?php echo $room_facilities; ?></p>
      <p>Rent: <?php echo $room_rent; ?></p>
      <p>Description: <?php echo $room_description; ?></p>
      <p>Availability: <?php echo $room_availability; ?></p>
      <button class="btn btn-primary">Book Now</button>
    </div>
  </div>
</div>

	</main>
	
	<footer>
		<p>&copy; 2023 My Company. All rights reserved.</p>
	</footer>
	
</body>
</html>