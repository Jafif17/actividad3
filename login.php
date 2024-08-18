<?php
session_start();

// Conexión a la base de datos
$servername = "localhost";
$username = "root";
$password = "root";
$dbname = "DPW2_U2_A2_BRJC";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

// Verificar si se ha enviado el formulario
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $idUsuario = intval($_POST['idUsuario']);
    $password = $_POST['password'];

    // Verificar si el IDUsuario existe
    $stmt = $conn->prepare("SELECT Nombre, ApellidoPaterno, ApellidoMaterno, TipoUsuario, Password FROM usuarios WHERE IDUsuario = ?");
    $stmt->bind_param("i", $idUsuario);
    $stmt->execute();
    $stmt->store_result();
    
    if ($stmt->num_rows > 0) {
        $stmt->bind_result($nombre, $apellidoPaterno, $apellidoMaterno, $tipoUsuario, $hashedPassword);
        $stmt->fetch();

        // Verificar la contraseña
        if (password_verify($password, $hashedPassword)) {
            $_SESSION['nombre'] = $nombre;
            $_SESSION['apellidoPaterno'] = $apellidoPaterno;
            $_SESSION['apellidoMaterno'] = $apellidoMaterno;
            $_SESSION['tipoUsuario'] = $tipoUsuario;

            // Mostrar el mensaje de bienvenida
            $mensaje = "¡Bienvenido $nombre $apellidoPaterno $apellidoMaterno! ¡Has ingresado como $tipoUsuario!";
            echo "<script>alert('$mensaje'); window.location.href='main.php';</script>";
        } else {
            $_SESSION['error'] = "Contraseña incorrecta.";
            header("Location: login.html");
            exit();
        }
    } else {
        $_SESSION['error'] = "Usuario no registrado.";
        header("Location: login.html");
        exit();
    }

    $stmt->close();
}

$conn->close();
?>
