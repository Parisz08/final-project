<?php
// Konfigurasi koneksi database
$servername = "localhost"; 
$username = "root";        
$password = "";            
$database = "ecommerce_db"; 

$conn = mysqli_connect($servername, $username, $password, $database);


if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}
?>
