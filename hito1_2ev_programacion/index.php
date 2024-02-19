<?php
$ip = $_SERVER['REMOTE_ADDR'];
setcookie("user_ip", $ip, time() + (86400 * 30), "/");
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Explicación de diferencias entre lenguajes de programación</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
        }
        .container {
            width: 80%;
            margin: auto;
            overflow: hidden;
            background-color: #fff;
            padding: 20px;
            margin-top: 20px;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        h2 {
            color: #333;
        }
        p {
            color: #666;
        }
    </style>
</head>
<body>
<div class="container">
    <h1>Explicación de diferencias entre lenguajes de programación</h1>
    <p>Los lenguajes de programación se pueden clasificar en diferentes categorías según su enfoque y funcionalidad. A continuación, se presentan brevemente las diferencias entre lenguajes orientados a objetos, a eventos y lenguajes procedimentales:</p>
    <h2>Lenguajes Orientados a Objetos</h2>
    <p>Los lenguajes orientados a objetos se basan en el concepto de "objetos", que pueden contener datos y código para manipular dichos datos. Ejemplos de lenguajes orientados a objetos incluyen Java, C++ y Python.</p>
    <h2>Lenguajes de Eventos</h2>
    <p>Los lenguajes de eventos se centran en la interacción basada en eventos, donde las acciones del usuario o del sistema desencadenan respuestas específicas. JavaScript es un ejemplo común de un lenguaje de eventos utilizado en el desarrollo web.</p>
    <h2>Lenguajes Procedimentales</h2>
    <p>Los lenguajes procedimentales siguen un enfoque lineal y secuencial para la ejecución del código, dividiendo el programa en procedimientos o funciones. Ejemplos de lenguajes procedimentales son C, BASIC y Pascal.</p>
    <div>
        <h2>Opciones de Usuario</h2>
        <a href="registro.php">Registrarse</a> | <a href="login.php">Iniciar Sesión</a>
    </div>
</div>
</body>
</html>
