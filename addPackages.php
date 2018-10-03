<?php

require 'header.inc.php';
require 'nav.inc.php';

if($_SERVER['REQUEST_METHOD'] == "POST"){

  $newTitle = trim($_POST['newTitle']);
  $newPriceSmall = trim($_POST['newPriceSmall']);
  $newPriceMedium = trim($_POST['newPriceMedium']);
  $newPriceLarge= trim($_POST['newPriceLarge']);
  $numOfDetails = trim($_POST['detailCounter']);
  $count = 0;

  try{
    $sql = "INSERT INTO packages(title, priceSmall, priceMedium, priceLarge) VALUES (:title, :priceSmall, :priceMedium, :priceLarge)";
    $stmt = $pdo->prepare($sql);
    $stmt->bindValue(":title", $newTitle);
    $stmt->bindValue(":priceSmall", $newPriceSmall);
    $stmt->bindValue(":priceMedium", $newPriceMedium);
    $stmt->bindValue(":priceLarge", $newPriceLarge);
    $stmt->execute();
  }catch(Exception $e){
    echo $e->getMessage();
  }

  try{
    $sql = "SELECT id FROM packages WHERE title = :title";
    $stmt = $pdo->prepare($sql);
    $stmt->bindValue(":title", $newTitle);
    $stmt->execute();
    $package = $stmt->fetch(PDO::FETCH_ASSOC);


    while($count < $numOfDetails){
      $count++;
      $currentDetailTitle = $_POST['detail' . $count];
      $currentDetailPackage = $package['id'];
      try{
        $sql="INSERT INTO details(package, detail) VALUES (:package, :detail)";
        $stmt = $pdo->prepare($sql);
        $stmt->bindValue(":detail", $currentDetailTitle);
        $stmt->bindValue(":package", $currentDetailPackage);
        $stmt->execute();
      }catch(PDOException $e){
        echo $e->getMessage();
      }
    }//end while*/

  }catch(PDOException $e){
    echo $e->getMessage();
  }

  header('Location: packages.php');
}

?>
<script type="text/javascript">
var counter = 1;
  function addPerk(){
    counter++;
    $('<div class="form-group"><label for="detail' +
    counter + '">New Perk: </label><input class="form-control" type="text" name="detail'+
    counter +'"/></div>').appendTo($('.extraPerk'));
    $('#detailCounter').val(counter);
  }
</script>
<div class="content">
  <div class="heading-content">
    <h3>Add Package</h3>
    <span class="spacer"></span>
    <a href="http://www.eliteimagedetailing.com" target="_blank"><div class="btn btn-primary">View Site</div></a>
  </div>
  <div class="inner-content">
    <form method="POST">
      <div class="form-group">
        <label for="newTitle">Title: </label>
        <input class="form-control" type="text" name="newTitle"/>
      </div>
      <div class="form-group">
        <label for="newPriceSmall">Price Small: </label>
        <input class="form-control" type="text" name="newPriceSmall"/>
      </div>
      <div class="form-group">
        <label for="newPriceMedium">Price Medium: </label>
        <input class="form-control" type="text" name="newPriceMedium"/>
      </div>
      <div class="form-group">
        <label for="newPriceLarge">Price Large: </label>
        <input class="form-control" type="text" name="newPriceLarge"/>
      </div>
      <div class="heading-content">
        <h5>Package Details</h5>
        <span class="spacer"></span>
        <input class="btn btn-success" type="button" onclick="addPerk();" value="Add Perk"/>
      </div>
      <div class="form-group">
        <label for="detail1">New Perk: </label>
        <input class="form-control" type="text" name="detail1"/>
        <input id="detailCounter" type="hidden" name="detailCounter" value="1"/>
      </div>
      <div class="extraPerk"></div>
      <div class="f-right">
        <input class="btn btn-success" type="submit" value="Add"/>
        <a href="packages.php"><div class="btn btn-danger">Cancel</div></a>
      </div>
    </form>
  </div>
</div>

<?php require 'footer.inc.php'; ?>
