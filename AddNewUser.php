<?php

$pdo=require('connection.php');
$username=$_POST['username'];
$password=$_POST['password'];
$options = [
    'cost' => 12,
];
$hashedPassword=password_hash($password, PASSWORD_BCRYPT,$options);

$sql="INSERT INTO `users`(`username`, `password`) VALUES (?,?)";
$statement=$pdo->prepare($sql);
$statement->bindParam(1,$username);
$statement->bindParam(2,$hashedPassword);

if ($statement->execute()) {
	echo "User Added Successfuly";
} else {
	echo "User Failed To Insert";
}

