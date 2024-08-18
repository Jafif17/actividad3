<?php
// Iniciar sesión para manejar mensajes
session_start();

if (isset($_SESSION['error'])) {
    echo '<div class="error">' . $_SESSION['error'] . '</div>';
    unset($_SESSION['error']);
}

if (isset($_SESSION['success'])) {
    echo '<div class="success">' . $_SESSION['success'] . '</div>';
    unset($_SESSION['success']);
}

// Conexión a la base de datos (ajusta estos valores según tu configuración)
$servername = "localhost";
$username = "root";
$password = "root";
$dbname = "DPW2_U2_A2_BRJC";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

// Función para validar la contraseña
function validarPassword($password) {
    // Mínimo 8 caracteres, al menos una letra, un número y un carácter especial
    $patron = "/^(?=.*[A-Za-z])(?=.*\d)(?=.*[#$\-_&%])[A-Za-z\d#$\-_&%]{8,}$/";
    return preg_match($patron, $password);
}

// Verificar si se ha enviado el formulario
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Recoger y limpiar los datos del formulario
    $idUsuario = intval($_POST['idUsuario']);
    $nombre = $conn->real_escape_string($_POST['nombre']);
    $apellidoPaterno = $conn->real_escape_string($_POST['apellidoPaterno']);
    $apellidoMaterno = $conn->real_escape_string($_POST['apellidoMaterno']);
    $edad = intval($_POST['edad']);
    $sexo = $conn->real_escape_string($_POST['sexo']);
    $email = $conn->real_escape_string($_POST['email']);
    $telefono = $conn->real_escape_string($_POST['telefono']);
    $password = $_POST['password'];
    $confirmPassword = $_POST['confirmPassword'];
    $tipoUsuario = 'CL'; // Fijo para clientes

    // Verificar que ningún campo esté vacío
    if (empty($idUsuario) || empty($nombre) || empty($apellidoPaterno) || empty($edad) || 
        empty($sexo) || empty($email) || empty($telefono) || empty($password) || empty($confirmPassword)) {
        $_SESSION['error'] = "Todos los campos son obligatorios.";
        header("Location: registro.php");
        exit();
    }

    // Verificar que las contraseñas coincidan
    if ($password !== $confirmPassword) {
        $_SESSION['error'] = "Las contraseñas no coinciden.";
        header("Location: registro.php");
        exit();
    }

    // Validar la contraseña
    if (!validarPassword($password)) {
        $_SESSION['error'] = "La contraseña debe tener al menos 8 caracteres, incluir letras, números y al menos un carácter especial (#,$,-,_,&,%).";
        header("Location: registro.php");
        exit();
    }

    // Verificar si el IDUsuario ya existe
    $stmt = $conn->prepare("SELECT IDUsuario FROM usuarios WHERE IDUsuario = ?");
    $stmt->bind_param("i", $idUsuario);
    $stmt->execute();
    $result = $stmt->get_result();
    if ($result->num_rows > 0) {
        $_SESSION['error'] = "El ID de Usuario ya existe. Por favor, elija otro.";
        header("Location: registro.php");
        exit();
    }
    $stmt->close();

    // Hash de la contraseña
    $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

    // Insertar el nuevo usuario
    $stmt = $conn->prepare("INSERT INTO usuarios (IDUsuario, Nombre, ApellidoPaterno, ApellidoMaterno, Edad, Sexo, Email, Telefono, TipoUsuario, Password) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("isssisssss", $idUsuario, $nombre, $apellidoPaterno, $apellidoMaterno, $edad, $sexo, $email, $telefono, $tipoUsuario, $hashedPassword);

    if ($stmt->execute()) {
        $_SESSION['success'] = "Usuario registrado con éxito.";
        header("Location: main.html");
        exit();
    } else {
        $_SESSION['error'] = "Error al registrar el usuario: " . $stmt->error;
        header("Location: registro.php");
        exit();
    }

    $stmt->close();
}

$conn->close();
?>
