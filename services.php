<?php

require 'header.inc.php';
require 'nav.inc.php';

  try{
    $sql = "SELECT * FROM services";
    $stmt = $pdo->prepare($sql);
    $stmt->execute();
    $service = $stmt->fetchAll(PDO::FETCH_ASSOC);
  }catch(PDOException $e){
    echo $e->getMessage();
  }

?>
<div class="content">
  <div class="heading-content">
    <h3>Services</h3>
    <span class="spacer"></span>
    <a href="addService.php"><div class="btn btn-success">Add Service</div></a>
  </div>
    <div class="inner-content">
      <ul>
        <?php
          if(count($service) > 0){
            $serviceCount = 0;
            foreach($service as $serv){
              $serviceCount ++;
        ?>
          <li class="service">
            <?php echo $serv['servname']; ?>
            <span class="spacer"></span>
            <a href="updateService.php?id=<?php echo $serv['id'];?>"><div class="btn btn-primary">Edit</div></a>
            <a href="deleteService.php?id=<?php echo $serv['id'];?>"><div class="btn btn-danger">Delete</div></a>
          </li>
        <?php
            }
          }
        ?>
      </ul>
    </div>
<?php require 'footer.inc.php'; ?>
</div>
