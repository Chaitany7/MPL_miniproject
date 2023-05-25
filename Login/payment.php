<?php
session_start();

include("connection.php");
include("function.php");

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Store the payment details
    $name = $_POST['name'];
    $cardNumber = $_POST['cardNumber'];
    $expiryDate = $_POST['expiryDate'];
    $cvv = $_POST['cvv'];
    $amount = $_POST['amount'];

    // Get the booking details from the session
    $bookingId = $_SESSION['bookingId'];
    $roomId = $_SESSION['room_id'];


    // Insert the payment details into the database
    $query = "INSERT INTO payments (booking_id, room_id, name, card_number, expiry_date, cvv, amount) VALUES ('$bookingId', '$roomId', '$name', '$cardNumber', '$expiryDate', '$cvv', '$amount')";
    mysqli_query($con, $query);

    // Update the booking status to "Paid"
    $updateQuery = "UPDATE rooms SET availability = 'No' WHERE roomid = '$roomId'";
    mysqli_query($con, $updateQuery);

    // Redirect to the profile page with a success message
    header("Location: profile.php?message=Payment%20successfully%20completed");
    exit();
}
?>

<!DOCTYPE html>
<html>
<head>
	<title>Payment Page</title>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
	<div class="container my-5">
		<h1 class="text-center mb-5">Payment Details</h1>
		<div class="row">
			<div class="col-md-6 mx-auto">
				<form method="post" action="process_payment.php">
					<div class="form-group">
						<label for="card_number">Card Number:</label>
						<input type="text" class="form-control" id="card_number" name="card_number" placeholder="Enter your card number" required>
					</div>
					<div class="form-group">
						<label for="name_on_card">Name on Card:</label>
						<input type="text" class="form-control" id="name_on_card" name="name_on_card" placeholder="Enter the name on your card" required>
					</div>
					<div class="form-group">
						<label for="expiry_date">Expiry Date:</label>
						<input type="text" class="form-control" id="expiry_date" name="expiry_date" placeholder="MM/YY" required>
					</div>
					<div class="form-group">
						<label for="cvv">CVV:</label>
						<input type="text" class="form-control" id="cvv" name="cvv" placeholder="Enter the CVV number on the back of your card" required>
					</div>
					<div class="form-group">
						<label for="amount">Amount:</label>
						<input type="text" class="form-control" id="amount" name="amount" placeholder="Enter the amount you want to pay" required>
					</div>
					<button type="submit" class="btn btn-primary btn-block">Pay Now</button>
				</form>
			</div>
		</div>
	</div>
</body>
</html>
