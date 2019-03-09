<!DOCTYPE html>
<?php
require_once "php/user.php";
$info = new User();
if(isset($_POST['firstname']) && isset($_POST['lastname']) && isset($_POST['user']) && isset($_POST['pass'])) {
    $firstname = $_POST['firstname'];
    $lastname = $_POST['lastname'];
    $user = $_POST['user'];
    $pass = $_POST['pass'];
    $info->createUser($user, $pass, $firstname, $lastname);
    if(!$info->wmsg) {
        header("Location: login.php");
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
  <h1 class="he2">sign up Here</h1>
  <form class="" action="signup.php" method="post">
    <input type="text" placeholder="first name" name="firstname" value="" required>
    <input type="text" placeholder="last name" name="lastname" value="" required>
    <input type="email" placeholder="Email" name="user" value="" required>
    <input type="password" placeholder="enter password" name="pass" value="" required>
    <input type="submit" name="submit" value="submit">
      <a class="lin" href="login.php">Login</a>
      <p><?php if(isset($warning)) echo $warning ?></p>
  </form>
</div>
  </body>
</html>
