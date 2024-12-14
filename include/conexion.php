<?php 
$servername = "localhost";
$username = "root";
$password = "";
$bdname = "tienda";

$conn = new mysqli($servername, $username, $password, $bdname);

if($conn->connect_error) die("no se pudo conectar" . $conn->connect_error);