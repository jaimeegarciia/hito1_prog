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

    $sql = "SELECT * FROM entradas WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $id_entrada);
    $stmt->execute();

    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();

        // Aquí deberías mostrar un formulario prellenado con la información actual
        echo "<h2>Actualizar Entrada</h2>";
        echo "<form method='post' action='actualizar_proceso.php'>";
        echo "<input type='hidden' name='id' value='$id_entrada'>";
        echo "Título: <input type='text' name='titulo' value='{$row['titulo']}' required><br>";
        echo "Contenido: <textarea name='contenido' required>{$row['contenido']}</textarea><br>";
        echo "Fecha de Publicación: <input type='date' name='fecha_publicacion' value='{$row['fecha_publicacion']}' required><br>";
        echo "Imagen (URL o datos base64): <input type='text' name='imagen' value='{$row['imagen']}'><br>";
        echo "<input type='submit' value='Actualizar Entrada'>";
        echo "</form>";
        echo "<style>
    body {
        font-family: Arial, sans-serif;
        background-color: #f4f4f4;
        margin: 0;
        padding: 0;
    }

    .container {
        width: 60%;
        margin: 50px auto;
        background-color: #fff;
        padding: 20px;
        border-radius: 8px;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
    }

    h2 {
        color: #333;
    }

    form {
        display: flex;
        flex-direction: column;
    }

    input[type='text'],
    textarea,
    input[type='date'] {
        width: 100%;
        padding: 8px;
        margin: 5px 0;
        box-sizing: border-box;
    }

    input[type='submit'] {
        background-color: #4caf50;
        color: #fff;
        padding: 10px;
        border: none;
        border-radius: 4px;
        cursor: pointer;
    }

    input[type='submit']:hover {
        background-color: #45a049;
    }
</style>";

    } else {
        echo "Entrada no encontrada.";
    }

    $stmt->close();
} else {
    echo "ID de entrada no proporcionado.";
}

$conn->close();

