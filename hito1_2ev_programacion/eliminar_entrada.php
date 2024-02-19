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

if (isset($_GET["id"])) {
    $id_entrada = $_GET["id"];

    $sql = "DELETE FROM entradas WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $id_entrada);

    if ($stmt->execute()) {
        $message = "Entrada eliminada con éxito.";
    } else {
        $message = "Error al eliminar la entrada: " . $stmt->error;
    }

    $stmt->close();
} else {
    $message = "ID de entrada no proporcionado.";
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Eliminar Entrada</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
            display: flex;
            align-items: center;
            justify-content: center;
            height: 100vh;
        }

        .container {
            text-align: center;
            background-color: #fff;
            padding: 20px;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
    </style>
</head>
<body>
<div class="container">
    <p><?php echo $message; ?></p>
    <p><a href="index.php">Volver a la página principal</a></p>
</div>
</body>
</html>

