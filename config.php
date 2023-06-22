<?php

// $host = 'localhost';// Database host
// $dbName = 'nmdin6to_nmdnew';  // Database name
// $username = 'nmdin6to_nmd'; // Database username
// $password = 'PG{%r2zYKfCy'; // Database password

$host = 'localhost';        // Database host
$dbName = 'nmdin6to_nmdnew';  // Database name
$username = 'root'; // Database username
$password = ''; // Database passwor
try {
    $conn = new PDO("mysql:host=$host;dbname=$dbName", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    echo "Connection failed: " . $e->getMessage();
    exit();
}

