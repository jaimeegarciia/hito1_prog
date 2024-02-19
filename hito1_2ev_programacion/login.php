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
    $contrasena = $_POST["contrasena"];

    $sql = "SELECT * FROM usuarios WHERE usuario = '$usuario'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        if (password_verify($contrasena, $row["contrasena"])) {
            // Credenciales válidas, iniciar sesión y redirigir
            $_SESSION["usuario_autenticado"] = true;
            header("Location: formulario.php");
            exit();
        } else {
            $_SESSION["mensaje_error"] = "Contraseña incorrecta. ¿No tienes una cuenta? <a href='registro.php'>Regístrate aquí</a>.";
            header("Location: login.php");
            exit();
        }
    } else {
        $_SESSION["mensaje_error"] = "Usuario no encontrado. ¿No tienes una cuenta? <a href='registro.php'>Regístrate aquí</a>.";
        header("Location: login.php");
        exit();
    }
}

$conn->close();
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
            display: flex;
            align-items: center;
            justify-content: center;
            min-height: 100vh;
        }

        h2 {
            color: #333;
        }

        form {
            max-width: 400px;
            width: 100%;
            background-color: #fff;
            padding: 20px;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        label {
            margin-bottom: 8px;
            display: block;
        }

        input {
            padding: 10px;
            margin-bottom: 15px;
            width: 100%;
            box-sizing: border-box;
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
if (isset($_SESSION["mensaje_error"])) {
    echo "<p>{$_SESSION["mensaje_error"]}</p>";
    unset($_SESSION["mensaje_error"]);
}
?>
<h2>Login</h2>
<form method="post" action="login.php">
    <label for="usuario">Usuario:</label>
    <input type="text" name="usuario" id="usuario" required>
    <label for="contrasena">Contraseña:</label>
    <input type="password" name="contrasena" id="contrasena" required>
    <input type="submit" value="Iniciar sesión">
</form>
</body>
</html>
