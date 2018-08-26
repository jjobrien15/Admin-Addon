<?php
  require 'connect.inc.php';
  try{
    $sql = "SELECT * FROM services";
    $stmt = $pdo->prepare($sql);
    $stmt->execute();
    $row = $stmt->fetchAll(PDO::FETCH_ASSOC);
    $count = 1;
    foreach($row as $rows){
      $services[$count] = $rows['servname'];
      $count++;
    }
  }catch(PDOException $e){
    echo $e->getMessage();
  }

?>
<h3>Services</h3>
<div class="col-md-8">
<form class="form" method="POST" action="<?php echo $_SERVER["PHP_SELF"]; ?>">
  <div class="form-group">
    <?php
      if(count($services) > 0){
        foreach($services as $service){
    ?>
      <label for="<?php echo $service; ?>">Service <?php echo $service; ?></label>
      <input class="form-control" name="<?php echo $service; ?>" type="text" value="<?php echo $service; ?>"/>
    <?php
        }
      }
    ?>

      <input class="btn" name="add" type="button" value="Add Service"/>
      <input class="btn btn-success" name="submit" type="submit" value="Submit"/>
  </div>
</form>
</div>
