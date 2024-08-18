<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registro - El Tesoro del Saber</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <body>
        <?php
        session_start();
        if(isset($_SESSION['error'])) {
            echo '<div class="error">' . $_SESSION['error'] . '</div>';
            unset($_SESSION['error']);
        }
        if(isset($_SESSION['success'])) {
            echo '<div class="success">' . $_SESSION['success'] . '</div>';
            unset($_SESSION['success']);
        }
        ?>
        
        <!-- Resto del contenido HTML -->
    <nav>
        <ul>
            <li><a href="main.php">Inicio</a></li>
            <li><a href="registro.php" class="active">Registrarse</a></li>
            <li><a href="login.php">Iniciar sesión</a></li>
        </ul>
    </nav>

    <main>
        <h1>Registro de Nuevo Cliente</h1>
        <form id="registroForm" action="procesar_registro.php" method="POST">
            <div class="form-group">
                <label for="idUsuario">ID de Usuario:</label>
                <input type="number" id="idUsuario" name="idUsuario" required>
            </div>
            <div class="form-group">
                <label for="nombre">Nombre:</label>
                <input type="text" id="nombre" name="nombre" required>
            </div>
            <div class="form-group">
                <label for="apellidoPaterno">Apellido Paterno:</label>
                <input type="text" id="apellidoPaterno" name="apellidoPaterno" required>
            </div>
            <div class="form-group">
                <label for="apellidoMaterno">Apellido Materno:</label>
                <input type="text" id="apellidoMaterno" name="apellidoMaterno">
            </div>
            <div class="form-group">
                <label for="edad">Edad:</label>
                <input type="number" id="edad" name="edad" required min="18" max="120">
            </div>
            <div class="form-group">
                <label for="sexo">Sexo:</label>
                <select id="sexo" name="sexo" required>
                    <option value="">Seleccione</option>
                    <option value="H">Hombre</option>
                    <option value="M">Mujer</option>
                </select>
            </div>
            <div class="form-group">
                <label for="email">Email:</label>
                <input type="email" id="email" name="email" required>
            </div>
            <div class="form-group">
                <label for="telefono">Teléfono:</label>
                <input type="tel" id="telefono" name="telefono" required>
            </div>
            <div class="form-group">
                <label for="password">Contraseña:</label>
                <input type="password" id="password" name="password" required>
            </div>
            <div class="form-group">
                <label for="confirmPassword">Confirmar Contraseña:</label>
                <input type="password" id="confirmPassword" name="confirmPassword" required>
            </div>
            <input type="hidden" name="tipoUsuario" value="CL">
            <button type="submit">Registrarse</button>
        </form>
    </main>

    <script src="registro.js"></script>
</body>

</html>