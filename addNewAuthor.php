<?php error_reporting (E_ALL ^ E_NOTICE); ?>
<?php
$pdo=require 'connection.php';
$first_name=$_POST['first_name'];
$last_name=$_POST['last_name'];
//$first_name="Sam";
//$last_name="Mure";

//let first check if the userExist in our database
function verifyUser(string $first_name,string $last_name,\PDO $pdo){
	$sql="SELECT * FROM authors WHERE first_name=:first_name OR last_name=:last_name";
	$statement=$pdo->prepare($sql);
	$statement->bindParam(':first_name',$first_name);
	$statement->bindParam(':last_name',$last_name);
	$result=array();
	if ($statement->execute()) {
		# code...
		$row=$statement->fetchAll(PDO::FETCH_ASSOC);
		if (count($row)>0) {
			
			return true;
		}
		else{
			
			return false;
		}
		
	}
	return false;
	
	
}
function addUserTransaction(\PDO $pdo,string $first_name,string $last_name){
	try {
		$response=array();
		$userExist=verifyUser($first_name,$last_name,$pdo);
	if ($userExist) {
		$response['error']=true;
		$response['message']="User Already Exist";
		return json_encode($response);
	}
	else{
		$addUser=AddUser($first_name,$last_name,$pdo);
		if ($addUser) {
			$response['error']=true;
			$response['message']="User not Added";
			return json_encode($response);
		} else {
			$response['error']=false;
			$response['message']="User Added Successfully";
			return json_encode($response);
		}
		
	}
	} catch (Exception $e) {
		
	}
	
}
function AddUser( string $first_name,string $last_name,\PDO $pdo) {
	$sql='INSERT INTO authors( first_name, last_name) VALUES (:first_name,:last_name)';
	$statement =$pdo->prepare($sql);
	$statement->bindParam(':first_name',$first_name);
	$statement->bindParam(':last_name',$last_name);
	
	if ($statement->execute()) {
		return false;
	}
	else{
		var_dump($statement->errorInfo());
	  return true;	
	}
}

//echo AddUser($first_name,$last_name,$pdo);
var_dump( addUserTransaction($pdo,$first_name,$last_name));

//echo $pdo;"