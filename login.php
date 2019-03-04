<!DOCTYPE html>
<?php
require_once "php/user.php";
$info = new User();
if(isset($_POST['user']) && isset($_POST['pass'])) {
	$user = $_POST['user'];
	$pass = $_POST['pass'];
	$info->getUser($user,$pass);
	if(!$info->wmsg) {
		session_start();
		$_SESSION['user'] = $user;
		$_SESSION['pass'] = $pass;
		header("Location: index.php");
	}
	else {
		$warning = $info->showError();
	}
}
?>
<html lang="en" dir="ltr">
    <head>
        <meta charset="utf-8">
        <link rel="stylesheet" href="css/master.css">
        <title></title>
    </head>
    <body class="back1">
        <div class="wrap">
            <h1 class="he2">Login</h1>
            <form action="login.php" method="post">
                <input type="email" placeholder="Email" name="user" value="" required>
                <input type="password" placeholder="enter password" name="pass" value="" required>
                <input type="submit" name="submit" value="Login">
                <a class="a" href="signup.php" name="submit">Signup</a>
                <p><?php if(isset($warning)) echo $warning ?></p>
            </form>
        </div>
    </body>
</html>
