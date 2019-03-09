<!DOCTYPE html>
<?php
if(isset($_POST['bl'])) {
    require_once "php/demo.php";
    $demo = new Demo();
    $demo->tokensActivator();
    $bodyLocationId = $_POST['bl'] + 0;
    $bodySubLocations = $demo->bodySubLocationsLoader($bodyLocationId);
} else {
    header("Location: bodylocations.php");
}
?>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <link rel="stylesheet" href="css/master.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

    <title></title>
  </head>
  <body class="back3">
<div class="wrap">
  <h1 class="he2">BODY sub locations</h1>
  <form class="" action="symptoms.php" method="post">
      <input type="hidden" name="bl" value="<?php echo $bodyLocationId ?>">
      <?php
      $demo->printSubBodyLocations($bodySubLocations);
      ?>
      <h1 class="he2">Selector</h1>
      <div class="form-check">
          <input class="form-check-input" type="radio" name="selector" value="man" id="selector1" required>
          <label class="form-check-label" for="selector1">
              Man
          </label>
      </div>
      <div class="form-check">
          <input class="form-check-input" type="radio" name="selector" value="woman" id="selector2" required>
          <label class="form-check-label" for="selector2">
              Woman
          </label>
      </div>
      <div class="form-check">
          <input class="form-check-input" type="radio" name="selector" value="boy" id="selector3" required>
          <label class="form-check-label" for="selector3">
              Boy
          </label>
      </div>
      <div class="form-check">
          <input class="form-check-input" type="radio" name="selector" value="girl" id="selector4">
          <label class="form-check-label" for="selector4">
              Girl
          </label>
      </div>
<input type="submit" name="submit" value="Next">
  </form>
</div>
  </body>
</html>
