<?php
$pdo= require 'connection.php';
$sql="SELECT * FROM authors";
$statement=$pdo->prepare($sql);
$statement->execute();
$publishers=$statement->fetchAll(PDO::FETCH_OBJ);
echo json_encode( $publishers) ;

