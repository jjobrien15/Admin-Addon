<?php

require 'header.inc.php';
require 'nav.inc.php';

if($_SERVER['REQUEST_METHOD'] == "POST"){
  $newService = trim($_POST['newService']);
  try{
    $sql = "INSERT INTO services(servname) VALUES (:servname)";
    $stmt = $pdo->prepare($sql);
    $stmt->bindValue(":servname", $newService);
    $stmt->execute();
    header('Location: services.php');
  }catch(Exception $e){
    echo $e->getMessage();
  }
}

?>
<div class="content">
  <div class="heading-content">
    <h3>Add Service</h3>
    <span class="spacer"></span>
    <a href="http://www.eliteimagedetailing.com" target="_blank"><div class="btn btn-primary">View Site</div></a>
  </div>

  <div class="inner-content">
    <form method = "POST">
      <div class="form-group">
        <label for="newService">New Service: </label>
        <input class="form-control" type="text" name="newService"/>
      </div>
      <input class="btn btn-success" type="submit" value="Add"/>
      <a href="services.php"><div class="btn btn-danger">Cancel</div></a>
    </form>
  </div>

</div>

<?php require 'footer.inc.php'; ?>
