<?php

require 'header.inc.php';
require 'nav.inc.php';
$selectedService = $_GET['id'];
if($_SERVER['REQUEST_METHOD'] == 'POST'){
  $newService = trim($_POST['newServiceName']);
  try{
    $sql="UPDATE services SET servname = :servname WHERE id = :id";
    $stmt = $pdo->prepare($sql);
    $stmt->bindValue(":servname", $newService);
    $stmt->bindValue(":id", "$selectedService");
    $stmt->execute();
    header('Location: services.php');
  }catch(Exception $e){
    echo $e->getMessage();
  }
}
  try{
    $sql = "SELECT * from services WHERE id = :id";
    $stmt = $pdo->prepare($sql);
    $stmt->bindValue(":id", "$selectedService");
    $stmt->execute();
    $service = $stmt->fetch(PDO::FETCH_ASSOC);
  }catch(Exception $e){
    echo $e->getMessage();
  }
?>
<div class="content">
  <div class="heading-content">
    <h3>Edit Service</h3>
    <span class="spacer"></span>
    <a href="http://www.eliteimagedetailing.com" target="_blank"><div class="btn btn-primary">View Site</div></a>
  </div>
  <div class="inner-content">
    <form method="POST">
      <div class="form-group">
        <label for="newServiceName">Update Service: </label>
        <input class="form-control" type="text" name="newServiceName" value="<?php echo $service['servname']; ?>"/>
      </div>
      <div class="f-right">
        <input class="btn btn-success" type="submit" action="" value="Update"/>
        <a href="services.php"><div class="btn btn-danger">Cancel</div></a>
      </div>
    </form>
  </div>

</div>

<?php require 'footer.inc.php'; ?>
