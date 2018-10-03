<?php

	require 'header.inc.php';
	require 'nav.inc.php';

	if($_SERVER['REQUEST_METHOD'] == "POST"){
		$newMessage = trim($_POST['message']);
		try{
			$sql = "UPDATE contact SET message = :message";
			$stmt = $pdo->prepare($sql);
			$stmt->bindValue(":message", $newMessage);
			$stmt->execute();
			header('Location: contact.php');
		}catch(PDOException $e){
			echo $e->getMessage();
		}
	}

	try{
		$sql = "SELECT * FROM contact";
		$stmt = $pdo->prepare($sql);
		$stmt->execute();
		$message = $stmt->fetch(PDO::FETCH_ASSOC);
	}catch(PDOException $e){
		echo $e->getMessage();
	}

?>
<div class="content">
  <div class="heading-content">
    <h3>Contact</h3>
    <div class="spacer"></div>
    <a href="http://www.eliteimagedetailing.com" target="_blank"><div class="btn btn-primary">View Site</div></a>
  </div>
  <div class="inner-content">
		<form class="form" method="POST">
		  <div class="form-group">
					<p><strong>NOTE: </strong>Email and Phone information can be edited through the <a href="home.php">home page</a></p>
		      <label for="intro">"Let's Chat" Message: <small>(5000 character limit)</small></label>
		      <textarea class="form-control" name="message" rows=10><?php echo $message['message'];?></textarea>
		      <input class="f-right btn btn-success" type="submit" value="Save"/>
		</div>
	</form>
</div>
<?php require 'footer.inc.php'; ?>
