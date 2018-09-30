<?php

require 'header.inc.php';
require 'nav.inc.php';

  try{
    $sql = "SELECT * FROM packages";
    $stmt = $pdo->prepare($sql);
    $stmt->execute();
    $package = $stmt->fetchAll(PDO::FETCH_ASSOC);
  }catch(PDOException $e){
    echo $e->getMessage();
  }

?>
<div class="content">
  <div class="heading-content">
    <h3>Packages</h3>
    <span class="spacer"></span>
    <a href="addPackages.php"><div class="btn btn-success">Add Package</div></a>
    <a href="http://www.eliteimagedetailing.com" target="_blank"><div class="btn btn-primary">View Site</div></a>
  </div>
    <div class="inner-content">
      <table>
        <tr>
          <th>ID</th>
          <th>Package</th>
					<th>Details</th>
          <th>Price Small</th>
          <th>Price Medium</th>
          <th>Price Large</th>
          <th class="text-right">Options</th>
        </tr>
        <?php
          if(count($package) > 0){
            $packageCount = 0;
            foreach($package as $pack){
              $packageCount ++;
        ?>
          <tr>
            <td>
              <?php echo $pack['id']; ?>
            </td>
            <span class="spacer"></span>
            <td>
              <?php echo $pack['title']; ?>
            </td>
            <span class="spacer"></span>
						<td>
              <?php
              try{
                $sql = "SELECT * FROM details WHERE package = :id";
                $stmt = $pdo->prepare($sql);
                $stmt->bindValue(":id", $pack['id']);
                $stmt->execute();
                $details = $stmt->fetchAll(PDO::FETCH_ASSOC);
              }catch(PDOException $e){
                echo $e->getMessage();
              }
              foreach($details as $detail){
                echo $detail['detail']; ?>
                <br />
              <?php  } ?>
            </td>
            <span class="spacer"></span>
            <td>
              <?php echo $pack['priceSmall']; ?>
            </td>
            <span class="spacer"></span>
            <td>
              <?php echo $pack['priceMedium']; ?>
            </td>
            <span class="spacer"></span>
            <td>
              <?php echo $pack['priceLarge']; ?>
            </td>
            <span class="spacer"></span>
            <td class="text-right">
              <a href="updatePackage.php?id=<?php echo $pack['id'];?>"><div class="btn btn-primary">Edit</div></a>
              <a href="deletePackage.php?id=<?php echo $pack['id'];?>"><div class="btn btn-danger">Delete</div></a>
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
