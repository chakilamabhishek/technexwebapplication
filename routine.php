<?php
require_once("php/user.php");
session_start();
if(isset($_POST['logout'])) {
	destroySession();
}
if(isset($_SESSION['user']) && isset($_SESSION['pass'])) {
	$info = new User();
	$user = $_SESSION['user'];
	$pass = $_SESSION['pass'];
	$info->getUser($user, $pass);
	if(!$info->wmsg) {
		
	}
	else {
		die($info->showError());
	}
}
else {
	header("Location: login.php");
}
?>