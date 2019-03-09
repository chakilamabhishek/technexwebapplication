<!DOCTYPE html>
<?php
if(isset($_POST['bl']) && isset($_POST['bsl']) && isset($_POST['selector']) && isset($_POST['symptoms']) && isset($_POST['symptoms']) && isset($_POST['yob'])) {
    require_once "php/demo.php";
    $demo = new Demo();
    $demo->tokensActivator();
    $bl = $_POST['bl'];
    $bsl = $_POST['bsl'];
    $symptomsID = $_POST['symptoms'];
    $selector = $_POST['selector'];
    $yob = $_POST['yob'] - 0;
} else {
    header("Location: symptoms.php");
}
?>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <link rel="stylesheet" href="css/mast.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
  </head>
  <body class="back4">
    <div class="container">
      <div class="temp">
          <?php
          $demo->simulate($bl, $bsl, $symptomsID, $selector, $yob);
          ?>
<!--      <div class="jumbotron">-->
<!--  <h1 class="display-4">Hello, world!</h1>-->
<!--  <p class="lead">This is a simple hero unit, a simple jumbotron-style component for calling extra attention to featured content or information.</p>-->
<!--  <hr class="my-4">-->
<!--  <p>It uses utility classes for typography and spacing to space content out within the larger container.</p>-->
<!--  <a class="btn btn-primary btn-lg" href="#" role="button">Learn more</a>-->
<!--</div>-->
</div>
    </div>
  </body>
</html>
