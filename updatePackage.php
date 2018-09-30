<?php

require 'header.inc.php';
require 'nav.inc.php';

$selectedPackage = $_GET['id'];

if($_SERVER['REQUEST_METHOD'] == 'POST'){
  $newTitle = $_POST['newTitle'];
  $priceSmall = $_POST['newPriceSmall'];
  $priceMedium = $_POST['newPriceMedium'];
  $priceLarge = $_POST['newPriceLarge'];
  $count = $_POST['counter'];
  $numOfDetails = 0;

  try{
    $sql="UPDATE packages SET title = :title, priceSmall = :priceSmall, priceMedium = :priceMedium, priceLarge = :priceLarge WHERE id = :id";
    $stmt = $pdo->prepare($sql);
    $stmt->bindValue(":title", $newTitle);
    $stmt->bindValue(":priceSmall", $priceSmall);
    $stmt->bindValue(":priceMedium", $priceMedium);
    $stmt->bindValue(":priceLarge", $priceLarge);
    $stmt->bindValue(":id", "$selectedPackage");
    $stmt->execute();
  }catch(Exception $e){
    echo $e->getMessage();
  }

  $numOfDetails = 0;
  while($numOfDetails < $count){
    $numOfDetails++;
    $currentDetailId = $_POST['detailId' . $numOfDetails];
    $currentDetailTitle = $_POST['detail' . $numOfDetails];
    try{
      $sql="UPDATE details SET detail = :detail WHERE id = :id";
      $stmt = $pdo->prepare($sql);
      $stmt->bindValue(":detail", "$currentDetailTitle");
      $stmt->bindValue(":id", "$currentDetailId");
      $stmt->execute();
    }catch(PDOException $e){
      echo $e->getMessage();
    }
  }//end while*/
header('Location: packages.php');
}
  try{
    $sql = "SELECT * from packages WHERE id = :id";
    $stmt = $pdo->prepare($sql);
    $stmt->bindValue(":id", "$selectedPackage");
    $stmt->execute();
    $package = $stmt->fetch(PDO::FETCH_ASSOC);
  }catch(Exception $e){
    echo $e->getMessage();
  }

  try{
    $sql = "SELECT * FROM details WHERE package = :id";
    $stmt = $pdo->prepare($sql);
    $stmt->bindValue(":id", $selectedPackage);
    $stmt->execute();
    $details = $stmt->fetchAll(PDO::FETCH_ASSOC);
  }catch(PDOException $e){
    echo $e->getMessage();
  }
?>
<div class="content">
  <div class="heading-content">
    <h3>Edit Package</h3>
    <span class="spacer"></span>
    <a href="http://www.eliteimagedetailing.com" target="_blank"><div class="btn btn-primary">View Site</div></a>
  </div>
  <div class="inner-content">
    <form method="POST">
      <div class="form-group">
        <label for="newTitle">Update Title: </label>
        <input class="form-control" type="text" name="newTitle" value="<?php echo $package['title']; ?>"/>
      </div>
      <div class="form-group">
        <label for="newPriceSmall">Update Price Small: </label>
        <input class="form-control" type="text" name="newPriceSmall" value="<?php echo $package['priceSmall']; ?>"/>
      </div>
      <div class="form-group">
        <label for="newPriceMedium">Update Price Medium: </label>
        <input class="form-control" type="text" name="newPriceMedium" value="<?php echo $package['priceMedium']; ?>"/>
      </div>
      <div class="form-group">
        <label for="newPriceLarge">Update Price Large: </label>
        <input class="form-control" type="text" name="newPriceLarge" value="<?php echo $package['priceLarge']; ?>"/>
      </div>
      <h5>Package Details</h5>
      <?php
      $counter = 0;
      foreach($details as $detail){
        $counter++;
      ?>
        <div class="form-group">
          <label for="detail<?php echo $counter; ?>">Update <?php echo $detail['detail']; ?>: </label>
          <input type="hidden" name="detailId<?php echo $counter; ?>" value="<?php echo $detail['id']; ?>"/>
          <input class="form-control" type="text" name="detail<?php echo $counter; ?>" value="<?php echo $detail['detail']; ?>"/>
        </div>
      <?php  } ?>
        <input type="hidden" name="counter" value="<?php echo $counter; ?>"/>
      <div class="f-right">
        <input class="btn btn-success" type="submit" value="Update"/>
        <a href="packages.php"><div class="btn btn-danger">Cancel</div></a>
      </div>
    </form>
  </div>

</div>

<?php require 'footer.inc.php'; ?>
