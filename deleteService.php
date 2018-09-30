<?php
  require 'header.inc.php';
  require 'nav.inc.php';


  $selectedService = $_GET['id'];

  if($_SERVER['REQUEST_METHOD'] == 'POST'){
    try{
      $sql = "DELETE FROM services WHERE id = :id";
      $stmt = $pdo->prepare($sql);
      $stmt->bindValue(':id', $selectedService);
      $stmt->execute();
      header('Location: services.php');
    }catch(Exception $e){
      echo $e->getMessage();
    }
  }

  try{
    $sql = "SELECT servname FROM services WHERE id = :id";
    $stmt = $pdo->prepare($sql);
    $stmt->bindValue(":id", $selectedService);
    $stmt->execute();
    $service = $stmt->fetch(PDO::FETCH_ASSOC);
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
    <p>Are you sure you want to delete <?php echo $service['servname']; ?> from services?</p>
    <form method="POST">
      <input class="btn btn-success" type="submit" value="Yes"/>
      <a class="btn btn-danger" href="services.php">No</a>
    </form>
  </div>
</div>
<?php require 'footer.inc.php';?>
