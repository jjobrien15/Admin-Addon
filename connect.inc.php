<?php

//just have to change the variables up top here
$connString = "mysql:host=localhost;dbname=admintest";
$uname = "root";
$pwd = "Zxasqw12";

try{
	$pdo = new PDO($connString, $uname, $pwd);
	$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
}catch(PDOException $e){
	echo "Connection to DB failed -> " . $e->getMessage();
}

?>
