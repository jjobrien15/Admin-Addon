<?php

require 'header.inc.php';
require 'nav.inc.php';
$selectedService = $_GET['id'];
if($_SERVER['REQUEST_METHOD'] == 'POST'){
  $newService = $_POST['newServiceName'];
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
  <h3>Edit Service</h3>

  <div class="col-md-6">
    <form method="POST">
      <div class="form-group">
        <label for="editService">Update Service: </label>
        <input class="form-control" type="text" name="newServiceName" value="<?php echo $service['servname']; ?>"/>
      </div>
      <div class="float-right">
        <input class="btn btn-success" type="submit" action="" value="Update"/>
        <a href="services.php"><div class="btn btn-danger">Cancel</div></a>
      </div>
    </form>
  </div>

</div>

<?php require 'footer.inc.php'; ?>
