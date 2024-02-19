<?php
session_start();

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "hitoprog";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $usuario = $_POST["usuario"];
    $contrasena = password_hash($_POST["contrasena"], PASSWORD_DEFAULT);


    $check_user_sql = "SELECT id FROM usuarios WHERE usuario = '$usuario'";
    $check_user_result = $conn->query($check_user_sql);

    if ($check_user_result->num_rows > 0) {
        $_SESSION["mensaje_error"] = "El nombre de usuario '$usuario' ya está registrado. Por favor, elija otro.";
        header("Location: registro.php");
        exit();
    }

    $sql = "INSERT INTO usuarios (usuario, contrasena) VALUES ('$usuario', '$contrasena')";

    if ($conn->query($sql) === TRUE) {
        $_SESSION["mensaje_info"] = "Registro exitoso. ¿Ya tienes una cuenta? <a href='login.php'>Inicia sesión aquí</a>.";
        header("Location: registro.php");
        exit();
    } else {
        echo "Error al registrar: " . $conn->error;
    }
}

$conn->close();
?>
<!-- Resto del código HTML -->
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registro de Usuario</title>
    <!-- Estilos CSS (copiados desde tu código original) -->
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
        }

        .container {
            max-width: 400px;
            margin: 50px auto;
            background-color: #fff;
            padding: 20px;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        h2 {
            color: #333;
        }

        form {
            display: flex;
            flex-direction: column;
        }

        label {
            margin-bottom: 8px;
        }

        input {
            padding: 10px;
            margin-bottom: 15px;
            border: 1px solid #ccc;
            border-radius: 3px;
        }

        input[type="submit"] {
            background-color: #4caf50;
            color: #fff;
            cursor: pointer;
        }

        input[type="submit"]:hover {
            background-color: #45a049;
        }

        p {
            color: #ff0000;
        }

        a {
            color: #0066cc;
            text-decoration: none;
        }

        a:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>
<?php
if (isset($_SESSION["mensaje_info"])) {
    echo "<p>{$_SESSION["mensaje_info"]}</p>";
    unset($_SESSION["mensaje_info"]);
} elseif (isset($_SESSION["mensaje_error"])) {
    echo "<p>{$_SESSION["mensaje_error"]}</p>";
    unset($_SESSION["mensaje_error"]);
}
?>
<div class="container">
    <h2>Registro de Usuario</h2>
    <form method="post" action="registro.php">
        <label for="usuario">Usuario:</label>
        <input type="text" name="usuario" id="usuario" required><br>
        <label for="contrasena">Contraseña:</label>
        <input type="password" name="contrasena" id="contrasena" required><br>
        <input type="submit" value="Registrarse">
    </form>
</div>
</body>
</html>
