<?php
// Datos de conexión
$servername = "localhost";
$username = "root";
$password = "root";
$dbname = "DPW2_U2_A2_BRJC";

// Conectar a la base de datos
$conn = new mysqli($servername, $username, $password, $dbname);

// Verificar conexión
if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

// Nueva contraseña hasheada
$newHashedPassword = '$2y$10$8.25EaVQWGPeeGYO5Cs2PeBrGnoPE/j26sMLxBw/cZRihXpUb.88K';

// Preparar la consulta SQL para actualizar ambos usuarios
$idsToUpdate = [0000, 9999]; // IDs de los usuarios
$stmt = $conn->prepare("UPDATE usuarios SET Password = ? WHERE IDUsuario = ?");
$stmt->bind_param("si", $newHashedPassword, $idUsuario);

// Actualizar cada usuario
foreach ($idsToUpdate as $idUsuario) {
    if (!$stmt->execute()) {
        echo "Error al actualizar la contraseña para el usuario $idUsuario: " . $stmt->error . "<br>";
    }
}

echo "Contraseñas actualizadas correctamente.";

$stmt->close();
$conn->close();
?>
