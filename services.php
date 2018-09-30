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
    <a href="http://www.eliteimagedetailing.com" target="_blank"><div class="btn btn-primary">View Site</div></a>
  </div>
    <div class="inner-content">
      <table>
        <tr>
          <th>ID</th>
          <th>Service</th>
          <th class="text-right">Options</th>
        </tr>
        <?php
          if(count($service) > 0){
            $serviceCount = 0;
            foreach($service as $serv){
              $serviceCount ++;
        ?>
          <tr>
            <td>
              <?php echo $serv['id']; ?>
            </td>
            <span class="spacer"></span>
            <td>
              <?php echo $serv['servname']; ?>
            </td>
            <span class="spacer"></span>
            <td class="text-right">
              <a href="updateService.php?id=<?php echo $serv['id'];?>"><div class="btn btn-primary">Edit</div></a>
              <a href="deleteService.php?id=<?php echo $serv['id'];?>"><div class="btn btn-danger">Delete</div></a>
            </td>
          </tr>
        <?php
            }
          }
        ?>
      </table>
    </div>
</div>
<?php require 'footer.inc.php'; ?>
