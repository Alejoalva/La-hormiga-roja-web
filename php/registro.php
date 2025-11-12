<?php
$data = json_decode(file_get_contents('php://input'), true);
$nombre = $data['nombre'];
$email = $data['email'];
$password = password_hash($data['password'], PASSWORD_DEFAULT);

// CONEXIÓN A BASE DE DATOS
$conn = new mysqli("localhost", "usuario", "contraseña", "nombre_base");

if ($conn->connect_error) {
  echo json_encode(["mensaje" => "Error de conexión"]);
  exit;
}

$stmt = $conn->prepare("INSERT INTO usuarios (nombre, email, password) VALUES (?, ?, ?)");
$stmt->bind_param("sss", $nombre, $email, $password);

if ($stmt->execute()) {
  echo json_encode(["mensaje" => "Registro exitoso"]);
} else {
  echo json_encode(["mensaje" => "Error al registrar"]);
}

$conn->close();
?>
