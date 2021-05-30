

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">

	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">

	<link rel="stylesheet" type="text/css" href="log.css">

	<title>Register</title>
</head>
<body>
<?php 

include ('config.php');
include ('../components/header.php');


error_reporting(0);


if (isset($_SESSION['username'])) {
    header("Location: ../index.php");
}

if (isset($_POST['submit'])) {
	$username = $_POST['username'];
	$email = $_POST['email'];
	$password = md5($_POST['password']);
	$cpassword = md5($_POST['cpassword']);

	if ($password == $cpassword) {
		$sql = "SELECT * FROM users WHERE email='$email'";
		$result = mysqli_query($conn, $sql);
		if (isset($_GET['chapter_id']))
					{
						$url = $_GET['redirectr'].'&chapter_id='.$_GET['chapter_id'];
					}
					else
					{
						$url= $_GET['redirectr'];
					} 
		if (!$result->num_rows > 0) {
			$sql = "INSERT INTO users (username, email, password)
					VALUES ('$username', '$email', '$password')";
			$result = mysqli_query($conn, $sql);
			
			if ($result) {
				header('Location: ' . $url.'&msg=success');

			} else {
				header("Location: register.php?redirectr=".$url."&register=error");
			}
		} else {
			header("Location: register.php?redirectr=".$url."&register=email");
		}
		
	} else {
		header("Location: register.php?redirectr=".$url."&register=password");
	}
}

?>
<section id="one" style="min-height: 100vmin;">
	<div class="container">
		<div class="login-container">
				<form action="" method="POST" class="form-login">
					<ul class="login-nav">
						<li class="login-nav__item active">
							<a href="#">Register</a>
						</li>
					</ul>
					<label for="login-input-user" class="login__label">
						Username
					</label>
					<input type="text" placeholder="Username" name="username" id="login-input-user" class="login__input" value="<?php echo $username; ?>" required>
					<label for="login-input-user" class="login__label">
						Email
					</label>
					<input type="email" placeholder="Email" name="email" id="login-input-user" class="login__input" value="<?php echo $email; ?>" required>
					
					<label for="login-input-password" class="login__label">
						Password
					</label>
					<input type="password" placeholder="Password" id="login-input-password" class="login__input" name="password" value="<?php echo $_POST['password']; ?>" required>
					
					<label for="login-input-password" class="login__label">
						Confirm Password
					</label>
					<input type="password" placeholder="Confirm Password" id="login-input-password" class="login__input" name="cpassword" value="<?php echo $_POST['cpassword']; ?>" required>
					

					<?php
						$fullUrl = "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";

						if(strpos($fullUrl, "register=error")){
							echo "Something went wrong Please Try Again With new username";	
						}
						if(strpos($fullUrl, "register=email")){
							echo "Email already exists";
						}
						if(strpos($fullUrl, "register=password")){
							echo "Password donot match";

						}
					?>
					<button class="login__submit" name="submit">Register</button>

					<a href="
					<?php
					if (isset($_GET['chapter_id']))
					{
						$url = $_GET['redirectr'].'&chapter_id='.$_GET['chapter_id'];
					}
					else
					{
						$url= $_GET['redirectr'];
					} 
					echo $url;?>" class="login__forgot">Already Have an account? Login Here</a>
				</form>
				
			</div>
	</div>
</section>
</body>
</html>