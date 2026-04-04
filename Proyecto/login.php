<?php
// login.php - Solo un ejemplo de cómo se hace en el backend
$conexion = new mysqli("localhost", "root", "", "mi_base_datos");

if ($conexion->connect_error) {
    die("Error de conexión: " . $conexion->connect_error);
}

$user = $_POST['user'];
$pass = $_POST['pass'];

// IMPORTANTE: Siempre usa consultas preparadas (Prepared Statements) para evitar Inyección SQL
$stmt = $conexion->prepare("SELECT id FROM usuarios WHERE username = ? AND password = ?");
$stmt->bind_param("ss", $user, $pass);
$stmt->execute();
$resultado = $stmt->get_result();

if ($resultado->num_rows > 0) {
    echo json_encode(["status" => "success"]);
} else {
    echo json_encode(["status" => "error"]);
}

$stmt->close();
$conexion->close();
?>