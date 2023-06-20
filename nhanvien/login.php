<?php
include_once '../classes/stafflogin.php';
?>
<?php
$class = new stafflogin();
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
	$staffUser = $_POST['staffUser'];
	$staffPass = md5($_POST['staffPass']);

	$login_check = $class->login_staff($staffUser, $staffPass);
}
?>

<!DOCTYPE html>

<head>
	<meta charset="utf-8">
	<title>Login</title>
	<link rel="stylesheet" type="text/css" href="css/stylelogin.css" media="screen" />
</head>

<body>
	<div class="container">
		<section id="content">
			<form action="login.php" method="post">
				<h1>Staff Login</h1>
				<span><?php
						if (isset($login_check)) {
							echo $login_check;
						}
						?></span>
				<div>
					<input type="text" placeholder="Username" required="" name="staffUser" />
				</div>
				<div>
					<input type="password" placeholder="Password" required="" name="staffPass" />
				</div>
				<div>
					<input type="submit" value="Log in" />
				</div>
			</form><!-- form -->
			<div class="button">
				<a href="#">Training with live project</a>
			</div><!-- button -->
		</section><!-- content -->
	</div><!-- container -->
</body>

</html>