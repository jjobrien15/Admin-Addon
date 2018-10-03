<?php

	require 'header.inc.php';
	require 'nav.inc.php';

	$msg = "";

  if($_SERVER["REQUEST_METHOD"] == "POST"){
    $formdata['email'] = trim($_POST['email']);
    $formdata['phone'] = trim($_POST['phone']);
    $formdata['facebook'] = trim($_POST['facebook']);
    $formdata['instagram'] = trim($_POST['instagram']);
    $formdata['intro'] = trim($_POST['intro']);
    //Try to update informations
    try{
      $sql = "UPDATE home SET email = :email , phone = :phone, facebook = :facebook, instagram = :instagram, intro = :intro";
      $stmt = $pdo->prepare($sql);
      $stmt ->bindValue(":email", $formdata['email']);
      $stmt ->bindValue(":phone", $formdata['phone']);
      $stmt ->bindValue(":facebook", $formdata['facebook']);
      $stmt ->bindValue(":instagram", $formdata['instagram']);
      $stmt ->bindValue(":intro", $formdata['intro']);
      $stmt->execute();
			//Echo needs to be moved
			$msg = "<script>alert('Updated Successfully!');</script>";
    }catch(PDOException $e){
      echo $e->getMessage();
    }
  }else{
    try{
      $sql="SELECT * FROM home";
      $stmt = $pdo->prepare($sql);
      $stmt->execute();
      $row = $stmt->fetch(PDO::FETCH_ASSOC);
      $formdata['email'] = $row['email'];
      $formdata['phone'] = $row['phone'];
      $formdata['facebook'] = $row['facebook'];
      $formdata['instagram'] = $row['instagram'];
      $formdata['intro'] = $row['intro'];
    }catch(PDOException $e){
      echo $e->getMessage();
    }
    $email_err = "";
    $phone_err = "";
    $facebook_err = "";
    $instagram_err = "";
    $intro_err = "";
    $err = false;
}
 ?>
<div class="content">
	<div class="heading-content">
			<h3>Home Page</h3>
			<div class="spacer"></div>
			<a href="www.eliteimagedetailing.com" target="_blank"><div class="btn btn-primary">View Site</div></a>
	</div>
	<?php echo $msg; ?>
<div class="inner-content">
<form class="form" method="POST">
  <div class="form-group">

      <label for="email">Email: <small>(Leave blank to remove Icon)</small></label>
      <input class="form-control" name="email" type="text" value="<?php echo $formdata['email']; ?>"/>

      <label for="phone">Phone: <small>(Leave blank to remove Icon)</small></label>
      <input class="form-control" name="phone" type="text" value="<?php echo $formdata['phone']; ?>"/>

      <label for="facebook">Facebook Link: <small>(Leave blank to remove Icon)</small></label>
      <input class="form-control" name="facebook" type="text" value="<?php echo $formdata['facebook']; ?>"/>

      <label for="instagram">Instagram Link: <small>(Leave blank to remove Icon)</small></label>
      <input class="form-control" name="instagram" type="text" value="<?php echo $formdata['instagram']; ?>"/>

      <label for="intro">Introduction: <small>(5000 character limit)</small></label>
      <textarea class="form-control" name="intro" rows=10><?php echo $formdata['intro']; ?></textarea>

      <input class="text-right btn btn-success" type="submit" value="Save"/>
  </div>
</form>
</div>
</div>
<?php require 'footer.inc.php'; ?>
