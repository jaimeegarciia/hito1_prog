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
    $id_entrada = $_POST["id"];
    $titulo = $_POST["titulo"];
    $contenido = $_POST["contenido"];
    $fecha_publicacion = $_POST["fecha_publicacion"];
    $imagen = $_POST["imagen"];


    $sql = "UPDATE entradas SET titulo=?, contenido=?, fecha_publicacion=?, imagen=? WHERE id=?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ssssi", $titulo, $contenido, $fecha_publicacion, $imagen, $id_entrada);

    if ($stmt->execute()) {
        echo "Entrada actualizada con éxito. <a href='ver_entrada.php?id=$id_entrada'>Ver entrada</a>";
    } else {
        echo "Error al actualizar la entrada: " . $stmt->error;
    }

    $stmt->close();
} else {
    echo "Método de solicitud incorrecto.";
}

$conn->close();

