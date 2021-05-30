

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">

	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">

	<link rel="stylesheet" type="text/css" href="log.css">

	<title>Login</title>
</head>
<body>

<?php 

$fullUrll = "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
$error=NULL;
include ('config.php');
include ('../components/header.php');


error_reporting(0);

if (isset($_SESSION['username'])) {
    header("Location: /E-Library/index.php");
}

if (isset($_POST['submit'])) {
	$email = $_POST['email'];
	$password = md5($_POST['password']);

	$sql = "SELECT * FROM users WHERE email='$email' AND password='$password'";
	$result = mysqli_query($conn, $sql);
	if ($result->num_rows > 0) {
		$row = mysqli_fetch_assoc($result);
		$_SESSION['id'] = $row['id'];
		$_SESSION['username'] = $row['username'];
		$_SESSION['role'] = $row['role'];
		if (isset($_GET['redirectl'])) {
			header('Location: ' . $_GET['redirectl']);
		} else {
			header("Location: /E-library/index.php");
		}
		
	} else {
		header("Location: login.php?redirectl=".$_GET['redirectl']."?login=error");
	}
}

?>
<section id="one" style="min-height: 100vmin;">
	<div class="container">
	<?php
				$fullUrl = "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";

				if(strpos($fullUrl, "msg=success")){
					echo "Please login to proceed!";	
				}
			?>

			<div class="login-container">
				<form action="" method="POST" class="form-login">
					<ul class="login-nav">
						<li class="login-nav__item active">
							<a href="#">LogIn</a>
						</li>
					</ul>
					<label for="login-input-user" class="login__label">
						Email
					</label>
					<input type="email" placeholder="Email" name="email" id="login-input-user" class="login__input" value="<?php echo $email; ?>" required>
					<label for="login-input-password" class="login__label">
						Password
					</label>
					<input type="password" placeholder="Password" id="login-input-password" class="login__input" name="password" value="<?php echo $_POST['password']; ?>" required>
					<?php
						$fullUrl = "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";

						if(strpos($fullUrl, "login=error")){
							echo "Email or Passoword is Incorrect";	
						}
					?>
					<button class="login__submit" name="submit">Sign in</button>

					<a href="register.php?redirectr=<?php echo $fullUrll?>" class="login__forgot">Don't Have an account? Register Here</a>
				</form>
				
			</div>
	</div>
</section>
</body>
</html>