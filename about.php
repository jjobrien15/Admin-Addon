<?php

	require 'header.inc.php';
	require 'nav.inc.php';
	if($_SERVER['REQUEST_METHOD'] == "POST"){
		$message = trim($_POST['message']);
		try{
			$sql = "UPDATE about SET message = :message";
			$stmt = $pdo->prepare($sql);
			$stmt->bindValue(":message", $message);
			$stmt->execute();
		}catch(PDOException $e){
			echo $e->getMessage();
		}
	}

	try{
		$sql = "SELECT * FROM about";
		$stmt = $pdo->prepare($sql);
		$stmt->execute();
		$message = $stmt->fetch(PDO::FETCH_ASSOC);
	}catch(PDOException $e){
		echo $e->getMessage();
	}
?>
<div class="content">
  <div class="heading-content">
    <h3>About Us</h3>
    <div class="spacer"></div>
    <a href="http://www.eliteimagedetailing.com" target="_blank"><div class="btn btn-primary">View Site</div></a>
  </div>
  <div class="inner-content">
		<form class="form" method="POST">
		  <div class="form-group">
		      <label for="intro">"About Us: <small>(5000 character limit)</small></label>
		      <textarea class="form-control" name="message" rows=10><?php echo $message['message'];?></textarea>
		      <input class="f-right btn btn-success" type="submit" value="Save"/>
		</div>
	</form>
</div>
<?php require 'footer.inc.php'; ?>
