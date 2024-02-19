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
    $autor_email = $_POST["autor_email"];
    $titulo = $_POST["titulo"];
    $contenido = $_POST["contenido"];
    $fecha_publicacion = $_POST["fecha_publicacion"];
    $imagen = $_POST["imagen"];

    $sql = "INSERT INTO entradas (autor_email, titulo, contenido, fecha_publicacion, imagen) 
            VALUES ('$autor_email', '$titulo', '$contenido', '$fecha_publicacion', '$imagen')";

    if ($conn->query($sql) === TRUE) {
        $last_id = $conn->insert_id;
        echo "Entrada publicada con éxito. <a href='ver_entrada.php?id=$last_id'>Ver entrada</a>";
    } else {
        echo "Error al publicar la entrada: " . $conn->error;
    }
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Formulario de Entrada</title>
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
            text-align: center;
        }

        form {
            max-width: 600px;
            width: 100%;
            background-color: #fff;
            padding: 20px;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        label {
            display: block;
            margin-bottom: 8px;
            color: #333;
        }

        input,
        textarea {
            width: 100%;
            padding: 10px;
            margin-bottom: 15px;
            box-sizing: border-box;
            border: 1px solid #ccc;
            border-radius: 3px;
        }

        input[type="submit"] {
            background-color: #4caf50;
            color: #fff;
            cursor: pointer;
            border: none;
        }

        input[type="submit"]:hover {
            background-color: #45a049;
        }
    </style>
</head>
<body>
<h2>Formulario de Entrada</h2>
<form method="post" action="formulario.php">
    <label for="autor_email">Email del Autor:</label>
    <input type="email" name="autor_email" required>

    <label for="titulo">Título:</label>
    <input type="text" name="titulo" required>

    <label for="contenido">Contenido:</label>
    <textarea name="contenido" required></textarea>

    <label for="fecha_publicacion">Fecha de Publicación:</label>
    <input type="date" name="fecha_publicacion" required>

    <label for="imagen">Imagen (URL o datos base64):</label>
    <input type="text" name="imagen">

    <input type="submit" value="Publicar Entrada">
</form>
</body>
</html>



