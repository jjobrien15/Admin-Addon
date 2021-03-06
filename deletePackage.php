<?php
  require 'header.inc.php';
  require 'nav.inc.php';


  $selectedPackage = $_GET['id'];

  if($_SERVER['REQUEST_METHOD'] == 'POST'){
    try{
      $sql = "DELETE FROM packages WHERE id = :id";
      $stmt = $pdo->prepare($sql);
      $stmt->bindValue(':id', $selectedPackage);
      $stmt->execute();
      try{
        $sql = "DELETE FROM details WHERE package = :package";
        $stmt = $pdo->prepare($sql);
        $stmt->bindValue(":package", $selectedPackage);
        $stmt->execute();
      }catch(PDOException $e){
        echo $e->getMessage();
      }
      header('Location: packages.php');
    }catch(Exception $e){
      echo $e->getMessage();
    }
  }

  try{
    $sql = "SELECT title FROM packages WHERE id = :id";
    $stmt = $pdo->prepare($sql);
    $stmt->bindValue(":id", $selectedPackage);
    $stmt->execute();
    $package = $stmt->fetch(PDO::FETCH_ASSOC);
  }catch(PDOException $e){
    echo $e->getMessage();
  }
?>
<div class="content">
  <div class="heading-content">
    <h3>Confirmation</h3>
    <span class="spacer"></span>
    <a href="http://www.eliteimagedetailing.com" target="_blank"><div class="btn btn-primary">View Site</div></a>
  </div>
  <div class="inner-content">
    <p>Are you sure you want to delete <?php echo $package['title']; ?> from services?</p>
    <form method="POST">
      <input class="btn btn-success" type="submit" value="Yes"/>
      <a class="btn btn-danger" href="packages.php">No</a>
    </form>
  </div>
</div>
<?php require 'footer.inc.php';?>
