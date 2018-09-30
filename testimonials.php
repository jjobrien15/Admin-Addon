<?php

	require 'header.inc.php';
	require 'nav.inc.php';

  try{
    $sql = "SELECT * FROM testimonials";
    $stmt = $pdo->prepare($sql);
    $stmt->execute();
    $testimonial = $stmt->fetchAll(PDO::FETCH_ASSOC);
  }catch(PDOException $e){
    echo $e->getMessage();
  }

?>
<div class="content">
  <div class="heading-content">
    <h3>Testimonials</h3>
    <span class="spacer"></span>
    <a href="addTestimonial.php"><div class="btn btn-success">Add Testimonial</div></a>
    <a href="http://www.eliteimagedetailing.com" target="_blank"><div class="btn btn-primary">View Site</div></a>
  </div>
  <div class="inner-content">

    <table>
      <tr>
        <th>ID</th>
        <th>Author</th>
        <th>Body</th>
        <th class="text-right">Options</th>
      </tr>
      <?php
        if(count($testimonial) > 0){
          $testimonialCount = 0;
          foreach($testimonial as $test){
            $testimonialCount ++;
        ?>
      <tr>
        <td>
          <?php echo $test['id']; ?>
        </td>
        <td>
          <?php echo $test['author']; ?>
        </td>
        <span class="spacer"></span>
        <td>
          <?php echo $test['body']; ?>
        </td>
        <span class="spacer"></span>
        <td class="text-right">
          <a href="updateTestimonial.php?id=<?php echo $test['id'];?>"><div class="btn btn-primary">Edit</div></a>
          <a href="deleteTestimonial.php?id=<?php echo $test['id'];?>"><div class="btn btn-danger">Delete</div></a>
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
