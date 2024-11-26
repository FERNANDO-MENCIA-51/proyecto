<?php
$servername = "localhost"; 
$username = "root";  
$password = ""; 
$dbname = "dbproyecto"; 

try {
    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch(PDOException $e) {
    die("Error de conexión: " . $e->getMessage());
}


global $conn;

function cerrarConexion() {
    global $conn;
    $conn = null;
}


if (!is_file(__FILE__)) {
    die("Error: No se puede acceder al archivo de conexión");
}
?>
