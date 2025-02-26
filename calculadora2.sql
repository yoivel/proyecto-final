CREATE DATABASE calculadora_electrica;

USE calculadora_electrica;

CREATE TABLE calculos (
    id INT AUTO_INCREMENT PRIMARY KEY,
    tipo_calculo VARCHAR(50) NOT NULL,
    valor1 FLOAT NOT NULL,
    valor2 FLOAT NOT NULL,
    resultado FLOAT NOT NULL,
    fecha TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

<?php
$servername = "localhost";
$username = "root";  // Cambia esto si usas otro usuario
$password = "";      // Agrega tu contraseña si es necesario
$database = "calculadora_electrica";

$conn = new mysqli($servername, $username, $password, $database);

if ($conn->connect_error) {
    die("Error de conexión: " . $conn->connect_error);
}

$tipo = $_POST["tipo"];
$valor1 = $_POST["valor1"];
$valor2 = $_POST["valor2"];
$resultado = $_POST["resultado"];

$sql = "INSERT INTO calculos (tipo_calculo, valor1, valor2, resultado) 
        VALUES ('$tipo', '$valor1', '$valor2', '$resultado')";

if ($conn->query($sql) === TRUE) {
    echo "Cálculo guardado correctamente";
} else {
    echo "Error: " . $conn->error;
}

$conn->close();
?>

CREATE TABLE users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(50) UNIQUE,
    password VARCHAR(255),
    email VARCHAR(100)
);