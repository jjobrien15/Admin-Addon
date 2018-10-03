<?php

require 'header.inc.php';
require 'nav.inc.php';

if($_SERVER['REQUEST_METHOD'] == "POST"){
  $author = trim($_POST['author']);
  $body = trim($_POST['body']);
  try{
    $sql = "INSERT INTO testimonials(author, body) VALUES (:author, :body)";
    $stmt = $pdo->prepare($sql);
    $stmt->bindValue(":author", $author);
    $stmt->bindValue(":body", $body);
    $stmt->execute();
    header('Location: testimonials.php');
  }catch(Exception $e){
    echo $e->getMessage();
  }
}

?>
<div class="content">
  <div class="heading-content">
    <h3>Add Testimonial</h3>
    <span class="spacer"></span>
    <a href="http://www.eliteimagedetailing.com" target="_blank"><div class="btn btn-primary">View Site</div></a>
  </div>
  <div class="inner-content">
    <form method = "POST">
      <div class="form-group">
        <label for="author">Author: </label>
        <input class="form-control" type="text" name="author"/>
      </div>
      <div class="form-group">
        <label for="body">Body: </label>
        <textarea class="form-control" type="text" name="body" rows="10"></textarea>
      </div>
      <input class="btn btn-success" type="submit" value="Add"/>
      <a href="testimonials.php"><div class="btn btn-danger">Cancel</div></a>
    </form>
  </div>

</div>

<?php require 'footer.inc.php'; ?>
