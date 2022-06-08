<?php
include 'database.php';
session_start();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="/imagenes/logo/logo002.png">
    <title>CEIP Plurilingüe Seis do Nadal</title>
    <link rel="stylesheet" href="styles/contacto.css">
</head>

<body>
    <header class="header">
        <div class="logo">
            <a href="index.php"><img src="imagenes/logo/logo001.png" /></a>
        </div>
        <h3>CEIP Plurilingüe Seis do Nadal</h3>
        <nav class="enlaces">
            <?php
            if (isset($_SESSION['rol'])) {

                switch ($_SESSION['rol']) {
                    case 1:
                        //
                        break;
                    case 2:
                        //
            ?>
                        <a href="aulas.php">Aulas</a>
                    <?php
                        break;
                    case 3:
                        //
                    ?>
                        <a href="actividades_extraescolares.php">Actividades</a>
                <?php

                        break;
                    default:
                }
            }
            if (isset($_SESSION['nombre'])) { ?>
                <a href="/usuarios/perfil.php"><?php echo $_SESSION['nombre'] ?></a>
            <?php
            } else {
            ?>
                <a href="login.php">Inicio Sesión</a>
            <?php } ?>
            <a href="contacto.php">Contacto</a>
        </nav>
    </header>
    <div class="contenedor">
        <div class="contacto">
            <h1>Contacta con nosotros</h1>
            <form name="formulario_contacto" method="post" action="/correo/envio_correo.php">
                <input type="text" name="name" placeholder="Nombre">
                <input type="email" name="email" placeholder="Correo electrónico">
                <textarea id="message" name="coment" placeholder="Escríbenos aquí tu mensaje. Le contestaremos en un plazo de 2 días hábiles " rows="7"></textarea>
                <input type="submit" name="enviar_mensaje" id="enviar_mensaje" value="Enviar">
            </form>
        </div>
    </div>
</body>

</html>