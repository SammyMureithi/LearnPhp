<?php
$auther_id=$_POST['id'];
$poinst=$_POST['points'];
$pdo=require('connection.php');
$sql="UPDATE `authors` SET Points=Points+:points WHERE auther_id=:auther_id";
$statement=$pdo->prepare($sql);
$statement->bindParam(':points',$poinst);
$statement->bindParam(':auther_id',$auther_id);
if ($statement->execute()) {
	echo "Points Added Successfully";
} else {
	echo "Poinst Not added Successfully";
}



