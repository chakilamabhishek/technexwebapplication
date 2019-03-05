<!DOCTYPE html>
<?php
require_once "php/demo.php";
$demo = new Demo();
$demo->tokensActivator();
$bodyLocations = $demo->bodyLocationsLoader();
?>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <link rel="stylesheet" href="css/master.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

    <title>Body Locations</title>
  </head>
  <body class="back1">
<div class="wrap">
  <h1 class="he2">BODY LOCATIONS</h1>
  <form class="" action="bodysublocations.php" method="post">
    <?php
    $demo->printBodyLocations($bodyLocations);
    ?>
    <input type="submit" name="submit" value="Next">
  </form>
</div>
  </body>
</html>
