<?php
session_start();
include("connection.php");

if(isset($_POST['submit'])) {
    $owner_id = $_SESSION['user_id'];
    $room_type = $_POST['room_type'];
    $room_rent = $_POST['room_rent'];
    $room_description = $_POST['room_description'];
    $query = "INSERT INTO rooms(owner_id, room_type, room_rent, room_description) VALUES ('$owner_id', '$room_type', '$room_rent', '$room_description')";
    mysqli_query($con, $query);
    header("Location: owner_dashboard.php");
    exit();
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
    <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
        <label for="room_type">Room Type:</label>
        <input type="text" name="room_type" required>
        <br>
        <label for="room_rent">Room Rent:</label>
        <input type="number" name="room_rent" required>
        <br>
        <label for="room_description">Room Description:</label>
        <textarea name="room_description" required></textarea>
        <br>
        <input type="submit" name="submit" value="Submit">
    </form>
</body>
</html>
