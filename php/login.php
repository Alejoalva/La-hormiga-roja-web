<?php
$data = json_decode(file_get_contents('php://input'), true);
$email = $data['email'];
$password = $data['password'];

$conn = new mysqli("localhost", "usuario", "contraseña", "nombre_base");

if ($conn->connect_error) {
  echo json_encode(["mensaje" => "Error de conexión"]);
  exit;
}

$stmt = $conn->prepare("SELECT password, habilitado FROM usuarios WHERE email = ?");
$stmt->bind_param("s", $email);
$stmt->execute();
$stmt->store_result();

if ($stmt->num_rows > 0) {
  $stmt->bind_result($hash, $habilitado);
  $stmt->fetch();
  if (password_verify($password, $hash)) {
    if ($habilitado) {
      echo json_encode(["acceso" => true]);
    } else {
      echo json_encode(["acceso" => false, "mensaje" => "Aún no has pagado para acceder."]);
    }
  } else {
    echo json_encode(["acceso" => false, "mensaje" => "Contraseña incorrecta."]);
  }
} else {
  echo json_encode(["acceso" => false, "mensaje" => "Usuario no encontrado."]);
}

$conn->close();
?>
