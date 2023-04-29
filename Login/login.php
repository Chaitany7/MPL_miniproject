<?php
session_start();

	include("connection.php");
	include("function.php");

	if($_SERVER['REQUEST_METHOD'] == "POST")
	{
		//something was posted
		$email = $_POST['email'];
		$password = $_POST['password'];

		if(!empty($email) && !empty($password) && !is_numeric($email))
		{
			//read from database
			$query = "select * from users where email = '$email' limit 1";
			$result = mysqli_query($con,$query);

			if($result)
			{
				if($result && mysqli_num_rows($result) > 0)
				{
					$user_data = mysqli_fetch_assoc($result);

					if($user_data['password'] === $password)
					{
						$_SESSION['email'] = $user_data['email'];
						header("Location: index.php");
						die;
					}
				}
			}
			echo "Wrong username or password";
		}

		else
		{
			echo "Invalid credentials";
		}
	}

?>



<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Login</title>
	<style>
		* {
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
input[type="password"] {
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
  margin-top: 10px;
  color: #ffffff;
  font-size: 18px;
  text-decoration: none;
  padding-right: 20px;
}

.dont{
  display: block;
  text-align: center;
  margin-top: 10px;
  color: #ffffff;
  font-size: 18px;
  text-decoration: none;
  float: left;
  margin-left: 20px;

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
.form-group input[type="password"]:focus + label {
  top: -40px;
  left: 0;
  font-size: 14px;
  color: #ff6b6b;
}


	</style>
</head>
<body>

  
	<div class="container">
	<h1>Login</h1>
    <form method="post" action="">
			<label for="username">Username:</label>
			<input type="text" id="username" name="email" required>
			<label for="password">Password:</label>
			<input type="password" id="password" name="password" required>
			<input type="submit" value="Login">
			<br>
			<br>
			<h1 class="dont">Don't have an account?</h1>
			<a href="signup.php">Sign up</a>
		</form>
	</div>
</body>
</html>

