<?php
$pdo=require('connection.php');
$password=$_POST['password'];
$username=$_POST['username'];
$options = [
    'cost' => 12,
];
$hashedPassword=password_hash($password, PASSWORD_BCRYPT,$options);
$sql="SELECT  * FROM `users` WHERE username=:username";
$statement=$pdo->prepare($sql);
$statement->bindParam(":username",$username);

if ($statement->execute()) {
	$response=array();
	if ($statement->rowCount()>0) {
		$result=$statement->fetch(PDO::FETCH_OBJ);
	$dbPassword=$result->password;
	$dbUsername=$result->username;
	$isValid=password_verify( $password,$dbPassword);
	
	if ($isValid) {
		$response['error']=false;
		$response['message']="Login Successfully";
		$response['body']=$result;
		echo json_encode($response);
	 } else {
		$response['error']=true;
		$response['message']="Invalid Username or Password";
		echo json_encode($response);
	 }
	 	} 
	 	else {
		$response['error']=true;
		$response['message']="Invalid Username or Password";
		echo json_encode($response);
	}
	
	
	
} else {
	echo "Hello";
}

