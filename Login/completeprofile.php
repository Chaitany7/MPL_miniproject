<?php
session_start();

include("connection.php");
include("function.php");

if ($_SERVER['REQUEST_METHOD'] == "POST") {
   $firstname = validate($_POST['firstname']);
   $lastname = validate($_POST['lastname']);
   $mobile = validate($_POST['mobile']);
   $dob = validate($_POST['dob']);
   $gender = validate($_POST['gender']);
   $city = validate($_POST['city']);
   $email = $_SESSION['email'];

   // Check if the edit session is equal to 1
   if ($_SESSION['edit'] == 1) {
      // Search the email in the profiles table
      $search_query = "SELECT * FROM profiles WHERE email = '$email'";
      $search_result = mysqli_query($con, $search_query);
      if (mysqli_num_rows($search_result) > 0) {
         // Apply update query to update the data
         $update_query = "UPDATE profiles SET firstname = '$firstname', lastname = '$lastname', mobile = '$mobile', dob = '$dob', gender = '$gender', city = '$city' WHERE email = '$email'";
         mysqli_query($con, $update_query);
         header("Location: profile.php");
         exit();
      }
   } else {
      // Check if mobile number already exists in the database
      $check_query = "SELECT * FROM profiles WHERE mobile = '$mobile'";
      $check_result = mysqli_query($con, $check_query);
      if (mysqli_num_rows($check_result) > 0) {
         echo "Mobile number already exists in the database.";
         exit();
      } else {
         $query = "INSERT INTO profiles (email, firstname, lastname, mobile, dob, gender, city) VALUES ('$email', '$firstname', '$lastname', '$mobile', '$dob', '$gender', '$city')";
         mysqli_query($con, $query);
         $_SESSION['email'] = $email;
         header("Location: profile.php");
         exit();
      }
   }
}


function validate($data) {
	$data = trim($data);
	$data = stripslashes($data);
	$data = htmlspecialchars($data);
	return $data;
}
?>



<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Complete Profile</title>
    <style>
        /* Dark theme styles */
        {
box-sizing: border-box;
margin: 0;
padding: 0;
}
body {
background-color: #1a1a1a;
color: #ffffff;
font-family: Arial, sans-serif;
}

.container {
width: 400px;
margin: 100px auto;
background-color: #363636;
border-radius: 10px;
padding: 40px;
box-shadow: 0 10px 20px rgba(0, 0, 0, 0.5);
}

h1 {
text-align: center;
font-size: 36px;
margin-bottom: 40px;
}

input[type="text"],
input[type="tel"],
input[type="date"],
input[type="radio"] {
width: 100%;
padding: 10px;
margin-bottom: 20px;
border: none;
background-color: #1a1a1a;
color: #ffffff;
border-bottom: 2px solid #ffffff;
}

input[type="submit"] {
background-color: #ff6b6b;
color: #ffffff;
border: none;
padding: 15px 20px;
border-radius: 5px;
cursor: pointer;
font-size: 18px;
font-weight: bold;
}

a {
display: block;
text-align: center;
margin-top: 30px;
color: #ffffff;
font-size: 18px;
text-decoration: none;
padding-right: 20px;
}

a:hover {
color: #ff6b6b;
}

.form-group {
position: relative;
}

.form-group label {
position: absolute;
top: -20px;
left: 0;
font-size: 16px;
color: #ffffff;
transition: all 0.3s ease;
}

.form-group input[type="text"]:focus + label,
.form-group input[type="password"]:focus + label,
.form-group input[type="tel"]:focus + label,
.form-group input[type="date"]:focus + label {
top: -40px;
left: 0;
font-size: 14px;
color: #ff6b6b;
}

label{
display: block;
margin-bottom: 10px;
font-size: 18px;
}

input[type="radio"]{
margin-right: 10px;
}

input[type="text"]:focus,
input[type="tel"]:focus,
input[type="date"]:focus,
input[type="radio"]:focus {
outline: none;
border-bottom: 2px solid #ff6b6b;
}
</style>
    </head>
    <body>
        <div class="container">
        <h1>Complete your profile</h1>
            <form action="" method="POST">
                <label for="firstname">First Name:</label>
                <input type="text" id="firstname" name="firstname" required>
                <br>
                
                <label for="lastname">Last Name:</label>
                <input type="text" id="lastname" name="lastname" required>
                <br>
                
                <label for="mobile">Mobile:</label>
                <input type="tel" id="mobile" name="mobile" pattern="[0-9]{10}" required>
                <br>
                
                <label for="dob">DOB:</label>
                <input type="date" id="dob" name="dob" required>
                <br>
                
                <label for="gender">Gender:</label>
                <input type="radio" id="male" name="gender" value="male" required>
                <label for="male">Male</label>
                <input type="radio" id="female" name="gender" value="female">
                <label for="female">Female</label>
                <br>
                
                <label for="city">City:</label>
                <input type="text" id="city" name="city" required>
                <br>
                
                <input type="submit" value="Submit">
        </form>
	</div>
</body>
</html>