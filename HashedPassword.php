<?php
$password=$_POST['password'];
$options = [
    'cost' => 12,
];
echo password_hash($password, PASSWORD_BCRYPT, $options);