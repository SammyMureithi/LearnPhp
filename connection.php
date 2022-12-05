<?php
 require 'config.php';
function connect($db,$host,$user,$password){
	$dsn="mysql:host=$host;dbname=$db;charset=UTF8";
	$options = [
    PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
    PDO::ATTR_EMULATE_PREPARES   => false,
];
	try {
		//echo "Connnected to Database Successfully";
return new PDO($dsn,$user,$password);
		
	} catch (PDOException $e) {
		//echo "Failed To Connect To Database";
		die($e->getMessage());
	}
}
  return connect('books','localhost','root','');