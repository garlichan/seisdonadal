<?php
session_start();
if (!isset($_SESSION['rol'])) {
    header('location: ../../login.php');
} else if ($_SESSION['rol'] == 2) {
    header('location: ../../login.php');
} else {
}
?>
<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>

<head>
    <meta charset="UTF-8">
    <link rel="icon" href="/imagenes/logo/logo002.png">
    <title>CEIP Plurilingüe Seis do Nadal</title>
    <link href="styles/actividades_extraescolares.css" rel="stylesheet" type="text/css">
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
            }
            switch ($_SESSION['rol']) {
                case 1:
                    //
                    break;
                case 2:
                    //
                    break;
                case 3:
                    //
            ?>
                    <a href="../actividades_extraescolares.php">Actividades</a>
                <?php

                    break;
                default:
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
    <h1>Actividades para los niños:</h1>
    <div class="contenedor_actividades">
        <form action="" method="post" name="formulario_actividades">
            <input type="submit" id="ballet" name="ballet" value="">
            <input type="submit" id="gimnasia_ritmica" name="gimnasia_ritmica" value="">
            <input type="submit" id="baile_moderno" name="baile_moderno" value="">
            <input type="submit" id="baloncesto" name="baloncesto" value="">
            <input type="submit" id="balonmano" name="balonmano" value="">
            <input type="submit" id="kung_fu" name="kung_fu" value="">
            <input type="submit" id="teatro" name="teatro" value="">
            <input type="submit" id="pintura_creativa" name="pintura_creativa" value="">
            <input type="submit" id="comic" name="comic" value="">
            <input type="submit" id="ingles" name="ingles" value="">
        </form>
    </div>
    <?php
    if (isset($_POST["ballet"])) {
        header("Location:/actividades/ballet.php");
    }
    if (isset($_POST["gimnasia_ritmica"])) {
        header("Location:/actividades/gimnasia_ritmica.php");
    }
    if (isset($_POST["baile_moderno"])) {
        header("Location:/actividades/baile_moderno.php");
    }
    if (isset($_POST["baloncesto"])) {
        header("Location:/actividades/baloncesto.php");
    }
    if (isset($_POST["balonmano"])) {
        header("Location:/actividades/balonmano.php");
    }
    if (isset($_POST["kung_fu"])) {
        header("Location:/actividades/kung_fu.php");
    }
    if (isset($_POST["teatro"])) {
        header("Location:/actividades/teatro.php");
    }
    if (isset($_POST["pintura_creativa"])) {
        header("Location:/actividades/pintura_creativa.php");
    }
    if (isset($_POST["comic"])) {
        header("Location:/actividades/comic.php");
    }
    if (isset($_POST["ingles"])) {
        header("Location:/actividades/ingles.php");
    }
    ?>
</body>

</html>