<?php
session_start();
$tipoUsuario = isset($_SESSION['tipoUsuario']) ? $_SESSION['tipoUsuario'] : '';

if ($tipoUsuario == 'PL') {
    echo '
    <nav>
        <ul>
            <li><a href="main.php" class="active">Inicio</a></li>
            <li><a href="consultar.html">Consultar</a></li>
            <li><a href="registrar.html">Registrar</a></li>
            <li><a href="modificar.html">Modificar</a></li>
            <li><a href="eliminar.html">Eliminar</a></li>
            <li><a href="logout.php">Salir</a></li>
        </ul>
    </nav>';
} elseif ($tipoUsuario == 'CL') {
    echo '
    <nav>
        <ul>
            <li><a href="main.php" class="active">Inicio</a></li>
            <li><a href="consultar.html">Consultar</a></li>
            <li><a href="registrar.html">Registrar</a></li>
            <li><a href="logout.php">Salir</a></li>
        </ul>
    </nav>';
} else {
    echo '
    <nav>
        <ul>
            <li><a href="main.php" class="active">Inicio</a></li>
            <li><a href="registro.php">Registrarse</a></li>
            <li><a href="login.html">Iniciar sesión</a></li>
        </ul>
    </nav>';
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>El Tesoro del Saber</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <main>
        <h1>El Tesoro del Saber</h1>
        <img src="https://concepto.de/wp-content/uploads/2023/02/Tipos-de-libros.jpg" alt="Librería El Tesoro del Saber">
        <p>Bienvenido a El Tesoro del Saber, uno de los mejores destinos literarios. Aquí encontrarás un viaje al conocimiento, aventura y emociones en cada libro. Elige un libro y disfruta.</p>
    </main>
</body>
</html>
