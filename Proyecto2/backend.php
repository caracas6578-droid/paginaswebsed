<?php
header('Content-Type: application/json');

// Configuración de MySQL
$host = "localhost";
$user = "root"; // Tu usuario de BD
$pass = "";     // Tu contraseña de BD
$db   = "mundo_dino";

$conn = new mysqli($host, $user, $pass, $db);

if ($conn->connect_error) {
    echo json_encode(['status' => 'error', 'message' => 'Fallo la conexión a la base de datos']);
    exit;
}

$action = $_POST['action'] ?? '';

if ($action == 'login') {
    $correo = $conn->real_escape_string($_POST['correo']);
    $password = $_POST['password']; // En un entorno real, usa password_verify()

    $sql = "SELECT * FROM usuarios WHERE correo = '$correo' AND password = '$password'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        echo json_encode(['status' => 'success', 'message' => 'Login correcto']);
    } else {
        echo json_encode(['status' => 'error', 'message' => 'Usuario no existe']);
    }
} 
elseif ($action == 'register') {
    $correo = $conn->real_escape_string($_POST['correo']);
    $password = $conn->real_escape_string($_POST['password']);
    $dino = $conn->real_escape_string($_POST['dino']);

    // INSERT ... ON DUPLICATE KEY UPDATE: Esto "reemplaza" los datos si el correo ya existe
    $sql = "INSERT INTO usuarios (correo, password, dino_favorito) 
            VALUES ('$correo', '$password', '$dino') 
            ON DUPLICATE KEY UPDATE password = '$password', dino_favorito = '$dino'";

    if ($conn->query($sql) === TRUE) {
        echo json_encode(['status' => 'success']);
    } else {
        echo json_encode(['status' => 'error', 'message' => $conn->error]);
    }
}

$conn->close();
?>