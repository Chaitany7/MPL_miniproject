<?php
session_start();
include("connection.php");

if(isset($_POST['submit'])) {
    $owner_id = $_SESSION['email'];
    $room_type = $_POST['room_type'];
    $room_rent = $_POST['room_rent'];
    $room_description = $_POST['room_description'];
    $room_address = $_POST['room_address'];
    $room_size = $_POST['room_size'];
    $room_floor = $_POST['room_floor'];
    $room_number = $_POST['room_number'];
    $room_city = $_POST['room_city'];
    $room_state = $_POST['room_state'];
    $room_country = $_POST['room_country'];
    $room_pincode = $_POST['room_pincode'];
    $room_facilities = $_POST['room_facilities'];
    $room_availability = $_POST['room_availability'];
    
    // Image Upload
    $target_dir = "uploads/";
    $target_file = $target_dir . basename($_FILES["room_image"]["name"]);
    $uploadOk = 1;
    $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
    
    // Check if image file is a actual image or fake image
    $check = getimagesize($_FILES["room_image"]["tmp_name"]);
    if($check !== false) {
        $uploadOk = 1;
    } else {
        echo "File is not an image.";
        $uploadOk = 0;
    }
    
    // Check file size
    if ($_FILES["room_image"]["size"] > 500000) {
        echo "Sorry, your file is too large.";
        $uploadOk = 0;
    }
    
    // Allow certain file formats
    if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
    && $imageFileType != "gif" ) {
        echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
        $uploadOk = 0;
    }
    
    if ($uploadOk == 0) {
        echo "Sorry, your file was not uploaded.";
    // if everything is ok, try to upload file
    } else {
        if (move_uploaded_file($_FILES["room_image"]["tmp_name"], $target_file)) {
            $room_image = $target_file;
            $query = "INSERT INTO rooms(owner, type, rent, description, address, size, floor, roomnumber, city, state, country, pincode, facilities, availability, image) VALUES ('$owner_id', '$room_type', '$room_rent', '$room_description', '$room_address', '$room_size', '$room_floor', '$room_number', '$room_city', '$room_state', '$room_country', '$room_pincode', '$room_facilities', '$room_availability', '$room_image')";
            mysqli_query($con, $query);
            header("Location: profile.php");
            exit();
        } else {
            echo "Sorry, there was an error uploading your file.";
        }
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Upload Room Information</title>
    <style>
        body {
  background-color: #1e1e1e;
  color: #f8f8f8;
  font-family: 'Roboto', sans-serif;
}
h1 {
text-align: center;
margin-top: 50px;
}

form {
max-width: 500px;
margin: 0 auto;
}

label {
display: block;
margin-bottom: 10px;
}

input[type="text"],
input[type="number"],
input[type="date"],
textarea {
width: 100%;
padding: 10px;
border: none;
border-radius: 5px;
background-color: #3a3a3a;
color: #f8f8f8;
margin-bottom: 20px;
}

textarea {
height: 150px;
}

input[type="submit"] {
background-color: #0080ff;
color: #f8f8f8;
padding: 10px 20px;
border: none;
border-radius: 5px;
cursor: pointer;
font-weight: bold;
}

input[type="submit"]:hover {
background-color: #0066cc;
}

input[type="submit"]:active {
background-color: #0052cc;
}

</style>
</head>
<body>
    <h1>Upload Room Information</h1>
    <form method="post" enctype="multipart/form-data">
  <label for="room_type">Room Type:</label>
  <input type="text" name="room_type" required>

  <label for="room_rent">Room Rent:</label>
  <input type="number" name="room_rent" required>

  <label for="room_description">Room Description:</label>
  <textarea name="room_description" required></textarea>

  <label for="room_address">Room Address:</label>
  <input type="text" name="room_address" required>

  <label for="room_size">Room Size:</label>
  <input type="number" name="room_size" required>

  <label for="room_floor">Room Floor:</label>
  <input type="number" name="room_floor" required>

  <label for="room_number">Room Number:</label>
  <input type="text" name="room_number" required>

  <label for="room_city">Room City:</label>
  <input type="text" name="room_city" required>

  <label for="room_state">Room State:</label>
  <input type="text" name="room_state" required>

  <label for="room_country">Room Country:</label>
  <input type="text" name="room_country" required>

  <label for="room_pincode">Room Pincode:</label>
  <input type="number" name="room_pincode" required>

  <label for="room_facilities">Room Facilities:</label>
  <textarea name="room_facilities" required></textarea>

  <label for="room_availability">Availability:</label><br>
  <input type="radio" id="yes" name="room_availability" value="Yes">
  <label for="yes">Yes</label><br>
  <input type="radio" id="no" name="room_availability" value="No">
  <label for="no">No</label><br>

  <label for="room_image">Room Image:(less than 15MB)</label>
  <input type="file" name="room_image" required>

  <input type="submit" name="submit" value="Submit">
</form>

</body>
</html> 