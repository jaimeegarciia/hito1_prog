<?php

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "hitoprog";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

echo "
<!DOCTYPE html>
<html lang='es'>
<head>
    <meta charset='UTF-8'>
    <meta name='viewport' content='width=device-width, initial-scale=1.0'>
    <title>Detalle de Entrada</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
        }

        .container {
            max-width: 800px;
            margin: 20px auto;
            background-color: #fff;
            padding: 20px;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        h2 {
            color: #333;
        }

        p {
            color: #555;
        }

        img {
            max-width: 100%;
            height: auto;
            margin-top: 10px;
        }

        a {
            color: #007bff;
            text-decoration: none;
            margin-right: 10px;
        }

        a:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>
    <div class='container'>
";

if (isset($_GET["id"])) {
    $id_entrada = $_GET["id"];


    $sql = "SELECT * FROM entradas WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $id_entrada);
    $stmt->execute();

    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();

        echo "<h2>{$row['titulo']}</h2>";
        echo "<p>Autor: {$row['autor_email']}</p>";
        echo "<p>Contenido: {$row['contenido']}</p>";
        echo "<p>Fecha de Publicación: {$row['fecha_publicacion']}</p>";
        echo "<img src='{$row['imagen']}' alt='Imagen de la entrada'>";

        // Agregar enlaces/botones para eliminar y actualizar
        echo "<p><a href='eliminar_entrada.php?id=$id_entrada'>Eliminar Entrada</a></p>";
        echo "<p><a href='actualizar_entrada.php?id=$id_entrada'>Actualizar Entrada</a></p>";
        echo "<p><a href='todas_entradas.php'>Ver Todas las Entradas</a></p>";

    } else {
        echo "Entrada no encontrada.";
    }

    $stmt->close();
} else {
    echo "ID de entrada no proporcionado.";
}

echo "
    </div>
</body>
</html>
";

$conn->close();
?>




