<!DOCTYPE html>
<?php
if(isset($_POST['bl']) && isset($_POST['bsl']) && isset($_POST['selector'])) {
    require_once "php/demo.php";
    $demo = new Demo();
    $demo->tokensActivator();
    $bodySubLocationID = $_POST['bsl'] + 0;
    $selector = $_POST['selector'];
    $bodySymptoms = $demo->bodySymptomsLoader($bodySubLocationID, $selector);
} else {
    header("Location: bodysublocations.php");
}
?>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <link rel="stylesheet" href="css/master.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

    <title></title>
  </head>
  <body class="back4">
<div class="wrap">
  <form class="" action="result.php" method="post">
      <h1 class="he2">Symptoms</h1>
      <input type="hidden" name="bl" value="<?php echo $_POST['bl'] ?>">
      <input type="hidden" name="bsl" value="<?php echo $_POST['bsl'] ?>">
      <input type="hidden" name="selector" value="<?php echo $_POST['selector'] ?>">
      <?php
      $demo->printSymptoms($bodySymptoms);
      ?>
      <h1 class="he2">Year of Birth</h1>
      <input type="text" name="yob" placeholder="year of birth">
<input type="submit" name="submit" value="Submit">
  </form>
</div>
  </body>
</html>
