<?php 

include 'database.php';

session_start();

error_reporting(0);

if (isset($_SESSION['username'])) {
    header("Location: welcome.php");
}

if (isset($_POST['submit'])) {
	$email = $_POST['email'];
	$password = md5($_POST['password']);

	$sql = "SELECT * FROM user WHERE email='$email' AND password='$password'";
	$result = mysqli_query($conn, $sql);
	if (mysqli_num_rows($result) > 0) {
		$row = mysqli_fetch_assoc($result);
		$_SESSION['username'] = $row['username'];
        $_SESSION['email'] = $row['email'];
        
$sql="UPDATE user set lastlogin= now() where email={$_SESSION['email']} LIMIT 1";
$result=mysqli_query($conn,$sql);
if(!$result){
    die('query failed');
} header("Location: welcome.php");
		
	} else {
		echo "<script>alert(' Email or Password is incorrect.')</script>";
	}
}

?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">

	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
   
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-wEmeIV1mKuiNpC+IOBjI7aAzPcEZeedi5yW5f2yOq55WWLwNGmvvx4Um1vskeMj0" crossorigin="anonymous">
<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>

	<link rel="stylesheet" type="text/css" href="style.css">

	<title>Login Form </title>
</head>
<body>
<div class="container bg-light col-md-6">
    
		<form action="" method="POST" class="login-email">
			<h3 class="login-text">Login</h3>
			<div class="input-group">
				<input type="email" placeholder="Email" name="email" value="<?php echo $email; ?>" required>
			</div>
			<div class="input-group">
				<input type="password" placeholder="Password" name="password" value="<?php echo $_POST['password']; ?>" required>
			</div>
			<div class="input-group">
				<button name="submit" class="btn">Login</button>
			</div>
			<p class="login-register">Don't have an account? <a href="registration.php">Sign-Up</a>.</p>
		</form>
	</div>

</body>
</html>
