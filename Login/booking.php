<?php
session_start();

include("connection.php");
include("function.php");

if (isset($_GET['owner']) && isset($_GET['roomid'])) {
    $_SESSION['owner'] = $_GET['owner'];
    $_SESSION['roomid'] = $_GET['roomid'];
}

if(isset($_SESSION['owner'])) {
    $email = $_SESSION['owner'];
    $room_id = $_SESSION['roomid'];
    
    $query = "SELECT * FROM rooms WHERE owner = '$email' AND roomid = '$room_id' LIMIT 1";
    $result = mysqli_query($con, $query);
    
    if($result && mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);
        
        $query = "SELECT * FROM profiles WHERE email = '$email' LIMIT 1";
        $result = mysqli_query($con, $query);
        
        if($result && mysqli_num_rows($result) > 0) {
            $user_data = mysqli_fetch_assoc($result);
        }
    } else {
        echo "Room not available";
    }
}
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

// Set the room ID in the session
$_SESSION['roomid'] = $room_id;

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
    font-family: Arial, sans-serif;
    margin: 0;
    padding: 0;
}

/* Container background */
.container {
    background-color: #333;
    padding: 20px;
    border-radius: 10px;
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.3);
}

/* Headings */
h3 {
    color: #fff;
    margin-top: 0;
}

/* Paragraphs */
p {
    color: #ccc;
    margin-bottom: 10px;
}

/* Button */
.btn {
    background-color: #0069d9;
    color: #fff;
    border: none;
    padding: 10px 20px;
    margin-top: 20px;
    text-decoration: none;
    display: inline-block;
    transition: background-color 0.3s ease;
    border-radius: 5px;
    cursor: pointer;
}

/* Button hover */
.btn:hover {
    background-color: #0052a5;
}

/* Image */
img {
    max-width: 100%;
    height: auto;
    margin-bottom: 20px;
    border-radius: 5px;
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.3);
    transition: transform 0.3s ease;
}

/* Image hover */
img:hover {
    transform: scale(1.05);
}

/* Footer */
footer {
    background-color: #111;
    padding: 20px;
    text-align: center;
    color: #fff;
    font-size: 14px;
    border-top: 1px solid #333;
    margin-top: 20px;
}

/* Footer hover */
footer:hover {
    background-color: #333;
    transition: background-color 0.3s ease;
    cursor: pointer;
}

/* Additional Styles */

/* Container animation */
.container {
    animation: slideIn 0.5s ease;
}

@keyframes slideIn {
    from {
        opacity: 0;
        transform: translateY(-20px);
    }
    to {
        opacity: 1;
        transform: translateY(0);
    }
}

/* Button animation */
.btn {
    transition: transform 0.3s ease;
}

.btn:hover {
    transform: scale(1.05);
}

/* Footer animation */
footer {
    transition: background-color 0.3s ease;
}

footer:hover {
    background-color: #222;
}
/* Image hover effect */
.container img:hover {
    transform: scale(1.1);
    box-shadow: 0 2px 5px rgba(0, 0, 0, 0.5);
}

/* Button animation */
.btn {
    transition: transform 0.3s ease, background-color 0.3s ease;
    box-shadow: 0 2px 5px rgba(0, 0, 0, 0.3);
}

.btn:hover {
    transform: scale(1.05);
    background-color: #0052a5;
    box-shadow: 0 2px 5px rgba(0, 0, 0, 0.5);
}

/* Footer animation */
footer {
    transition: background-color 0.3s ease;
}

footer:hover {
    background-color: #222;
}

/* Text color */
h3, p {
    color: #fff;
}

/* Container background */
.container {
    background-color: #222;
    padding: 30px;
    border-radius: 10px;
    box-shadow: 0 2px 5px rgba(0, 0, 0, 0.3);
}

/* Button background */
.btn {
    background-color: #0069d9;
}

/* Button hover background */
.btn:hover {
    background-color: #0052a5;
}

/* Footer background */
footer {
    background-color: #111;
    border-top: 1px solid #333;
}

/* Footer text color */
footer p {
    color: #ccc;
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
      
      <h3>Owner: <?php echo $user_data['firstname']; echo " "; echo $user_data['lastname'] ?></h3>
		<h3>Phone: <?php echo $user_data['mobile']; ?></h3>
      <h3>E-mail: <?php echo $owner_id; ?></h3>
      <h3>Room Type: <?php echo $room_type; ?></h3>
      <p>Address: <?php echo $room_address; ?>, <?php echo $room_city; ?>, <?php echo $room_state; ?>, <?php echo $room_country; ?> - <?php echo $room_pincode; ?></p>
      <p>Size: <?php echo $room_size; ?> sq.ft.</p>
      <p>Floor: <?php echo $room_floor; ?></p>
      <p>Room Number: <?php echo $room_number; ?></p>
      <p>Facilities: <?php echo $room_facilities; ?></p>
      <p>Rent: <?php echo $room_rent; ?></p>
      <p>Description: <?php echo $room_description; ?></p>
      <p>Availability: <?php echo $room_availability; ?></p>
      <a href="payment.php" class="btn">Book Now</a>
    </div>
  </div>
</div>

	</main>
	
	<footer>
		<p>&copy; 2023 My Company. All rights reserved.</p>
	</footer>
	
</body>
</html>