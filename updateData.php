<?php
$pdo= require 'connection.php';
$first_name=$_POST['first_name'];
$last_name=$_POST['last_name'];
$auther_id=$_POST['id'];
if (!is_null($first_name) && !is_null($last_name)) {
	$sql="UPDATE `authors` SET `first_name`=:first_name,`last_name`=:last_name WHERE auther_id=$auther_id";
	$statement=$pdo->prepare($sql);
	$statement->bindParam(":first_name",$first_name);
	$statement->bindParam(":last_name",$last_name);
	if ($statement->execute()) {
		echo "Update Done Successfully";
	} else {
		echo "Not Done";
	}
	

} else {
	if (isset($first_name)) {
		$sql="UPDATE `authors` SET first_name=:first_name WHERE auther_id=$auther_id ";
		$statement=$pdo->prepare($sql);
		$statement->bindParam(":first_name",$first_name);
		$statement->execute();
		echo "first_name updated Successfully";
		# code...
	} else {
		$sql="UPDATE `authors` SET last_name=:last_name  WHERE auther_id=$auther_id";
		$statement=$pdo->prepare($sql);
		$statement->bindParam(':last_name',$last_name);
		$statement->execute();
		echo "last_name updated Successfully";
	}
	
}
