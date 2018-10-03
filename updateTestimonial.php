<?php

require 'header.inc.php';
require 'nav.inc.php';
$selectedTestimonial = $_GET['id'];
if($_SERVER['REQUEST_METHOD'] == 'POST'){
  $newAuthor = trim($_POST['newAuthor']);
  $newBody = trim($_POST['newBody']);
  try{
    $sql="UPDATE testimonials SET author = :author, body = :body  WHERE id = :id";
    $stmt = $pdo->prepare($sql);
    $stmt->bindValue(":body", $newBody);
    $stmt->bindValue(":author", "$newAuthor");
    $stmt->bindValue(":id", "$selectedTestimonial");
    $stmt->execute();
    header('Location: testimonials.php');
  }catch(Exception $e){
    echo $e->getMessage();
  }
}
  try{
    $sql = "SELECT * from testimonials WHERE id = :id";
    $stmt = $pdo->prepare($sql);
    $stmt->bindValue(":id", "$selectedTestimonial");
    $stmt->execute();
    $testimonial = $stmt->fetch(PDO::FETCH_ASSOC);
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
        <label for="newAuthor">Update Author: </label>
        <input class="form-control" type="text" name="newAuthor" value="<?php echo $testimonial['author']; ?>"/>
      </div>
      <div class="form-group">
        <label for="newBody">Update Testimonial: </label>
        <input class="form-control" type="text" name="newBody" value="<?php echo $testimonial['body']; ?>"/>
      </div>
      <div class="text-right">
        <input class="btn btn-success" type="submit" value="Update"/>
        <a href="testimonials.php"><div class="btn btn-danger">Cancel</div></a>
      </div>
    </form>
  </div>

</div>

<?php require 'footer.inc.php'; ?>
