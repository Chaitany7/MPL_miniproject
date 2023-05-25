<?php
session_start();

include("connection.php");
include("function.php");

if ($_SERVER['REQUEST_METHOD'] == 'GET') {
    // Get the room ID from the URL parameters
    $roomId = $_GET['roomid'];
    
    // Get the user's email from the session
    $email = $_SESSION['email'];
    
    // Check if the room is already in favorites
    $query = "SELECT * FROM favorites WHERE email = '$email' AND roomid = '$roomId'";
    $result = mysqli_query($con, $query);
    if (mysqli_num_rows($result) > 0) {
        // Room is already in favorites, display a message
        echo "Room is already in favorites!";
    } else {
        // Add the room to favorites
        $insertQuery = "INSERT INTO favorites (email, roomid) VALUES ('$email', '$roomId')";
        mysqli_query($con, $insertQuery);
        
        // Display a success message
        echo "Room added to favorites!";
    }
}
header("Location: index.php");
    exit();
?>
