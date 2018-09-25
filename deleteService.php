<?php
  require 'header.inc.php';
  require 'nav.inc.php';



  if($_SERVER['REQUEST_METHOD'] == 'POST'){
      $selectedService = $_GET['id'];
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
?>
<div class="content">
  <form method="POST">
    <input class="btn btn-success" type="submit" value="Yes"/>
    <a class="btn btn-warning" href="services.php">No</a>
  </form>
</div>
