<!DOCTYPE html>
<?php require_once 'routine.php'?>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <link rel="stylesheet" href="css/master.css">
    <link rel="stylesheet" href="css/bootstrap.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>

    <title></title>
  </head>
  <body class="back1">
    <nav class="navbar navbar-inverse">
  <div class="container-fluid">
    <div class="navbar-header">
      <a class="navbar-brand" href="#">Health Care</a>
    </div>
    <ul class="nav navbar-nav">
      <li class="active"><a href="#">Home</a></li>
    </ul>
    <ul class="nav navbar-nav navbar-right">
        <li>
            <form action="index.php" method="post">
                <button type="submit" name="logout" style="border: none; background: none; color: grey; margin: 14px">
                    Logout
                </button>
            </form>
        </li>
    </ul>
  </div>
</nav>

<div class="container">
<div class="jumbotron">
  <h1 class="display-4">DIGITAL HOSPITAL</h1>
  <hr class="my-4">
  <p align="center">
    <a class="btn btn-primary btn-lg" href="bodylocations.php" role="button">Diagnosis</a>
  </p>
</div>
</div>
 <nav class="navbar navbar-inverse navbar-fixed-bottom">
  <div class="container-fluid">
    <div class="navbar-header">
      <a class="navbar-brand" href="#">Health Care</a>
    </div>
    <div class="img_size">
    <ul class="nav navbar-nav navbar-right">
      <li><h2 style="color:white;">contact us</h2></li>
      <li><a href="https://www.facebook.com/" target="blank">  <img src="https://tech.co/wp-content/themes/techdot/motel/images/facebook.png" style="height:35px"></a></li>
      <li> <a href="https://twitter.com/" target="blank"> <img src="https://tech.co/wp-content/themes/techdot/motel/images/twitter.png" style="height:35px"> </a></li>
      <li> <a href="https://www.linkedin.com/" target="blank"> <img src="https://tech.co/wp-content/themes/techdot/motel/images/linkedin.png" style="height:35px"> </a></li>
        <li><a href="https://www.youtube.com/" target="blank"> <img src="https://tech.co/wp-content/themes/techdot/motel/images/youtube.png" style="height:35px">   </a></li>
    </ul>
  </div>
</div>
</nav>

  </body>
</html>
