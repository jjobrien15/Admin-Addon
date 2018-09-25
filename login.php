<?php

 require 'header.inc.php';

 	$showform = 1;
 	$err = false;
 	$errmsg = "";

 if($_SERVER["REQUEST_METHOD"] == "POST"){

//Trimming form data and storing into array for neatness :)

 	$formdata['uname'] = trim($_POST['uname']);
 	$formdata['pwd'] = trim($_POST['pwd']);
//Checking for empty form values

 	if(empty($formdata['uname']) || empty($formdata['pwd'])){
 		$err = true;
 		$errmsg = "Username and password are required!";
 	}

//Checking if username exists
//If username exists, check if the password matches too

 	try{

 		$sql = "SELECT uname FROM users WHERE uname = :uname";
 		$stmt = $pdo->prepare($sql);
 		$stmt->bindValue(":uname", $formdata['uname']);
 		$stmt->execute();
 		$count = $stmt->rowCount();
 		if($count == 0){
 			$err=true;
 			$errmsg="Username does not exist";
 		}else{
 			try{
 				$sql = "SELECT * FROM users WHERE uname = :pwd";
 				$stmt = $pdo->prepare($sql);
 				$stmt->bindValue(":pwd", $formdata['pwd']);
 				$stmt->execute();
 				$row = $stmt->fetch(PDO::FETCH_ASSOC);
        //Hash password.. store in db 
        echo $formdata['pwd'] . "/////" . $row['pwd'];
 				if(password_verify($formdata['pwd'], $row['pwd'])){
 					//Change this to admin site
 					header('Location:home.php');
 				}else{
 					$err=true;
 					$errmsg= "Invalid password!";
 				}
 			}catch(PDOException $e){
				echo $e->getMessage();
			}
 		}

	}catch(PDOException $e){
		echo $e->getMessage();
	}


 }

?>

<div class="col-md-4 mx-auto p-5">
	<h2 class="text-center">Vanilla Admin</h2>

	<form class="form" method="POST">

		<span class="error"><?php if(isset($errmsg)){echo $errmsg;}?></span>

		<div class="form-group">
			<label for="uname">Username:</label>
			<input class="form-control" type="text" name="uname"/>
		</div>

		<div class="form-group">
			<label for="pwd">Password:</label>
			<input class="form-control" type="password" name="pwd"/>
		</div>

		<div class="form-group">
			<input class="form-control" type="submit" value="Login"/>
		</div>

	</form>
</div>

<?php require 'footer.inc.php'; ?>
