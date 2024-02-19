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
    <title>Todas las Entradas</title>
    <style>
        body {
            font-family: 'Arial', sans-serif;
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
            text-align: center;
        }

        h3 {
            color: #007bff;
        }

        p {
            color: #555;
        }

        img {
            max-width: 100%;
            height: auto;
            margin-top: 10px;
        }

        hr {
            border: 1px solid #ddd;
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
        <h2>Todas las Entradas</h2>
";

// Utilizar consulta preparada para evitar la inyección de SQL
$sql = "SELECT * FROM entradas ORDER BY fecha_publicacion DESC";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        echo "<h3>{$row['titulo']}</h3>";
        echo "<p>Autor: {$row['autor_email']}</p>";
        echo "<p>Contenido: {$row['contenido']}</p>";
        echo "<p>Fecha de Publicación: {$row['fecha_publicacion']}</p>";
        echo "<img src='{$row['imagen']}' alt='Imagen de la entrada'>";
        echo "<hr>"; // Línea separadora entre entradas
    }
} else {
    echo "No hay entradas publicadas.";
}

echo "
    </div>
</body>
</html>
";

$conn->close();
?>


