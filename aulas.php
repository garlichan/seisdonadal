<?php
session_start();
if (!isset($_SESSION['rol'])) {
    header('location: ../../login.php');
} else if ($_SESSION['rol'] == 3) {
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
    <link href="styles/aulas.css" rel="stylesheet" type="text/css">
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
            ?>
                    <a href="../aulas.php">Aulas</a>
                <?php
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
    <h1>Reservar aula:</h1>
    <div class="contenedor_aulas">
        <form action="" method="post" name="formulario_actividades">
            <input type="submit" id="musica" name="musica" value="">
            <input type="submit" id="informatica" name="informatica" value="">
            <input type="submit" id="biblioteca" name="biblioteca" value="">
            <input type="submit" id="bibliolab" name="bibliolab" value="">
            <input type="submit" id="multisensorial" name="multisensorial" value="">
            <input type="submit" id="rosalia" name="rosalia" value="">
            <input type="submit" id="gimnasio" name="gimnasio" value="">
            <input type="submit" id="patio_columnas" name="patio_columnas" value="">
        </form>
    </div>
    <?php
    if (isset($_POST["musica"])) {
        header("Location:/aulas/musica.php");
    }
    if (isset($_POST["informatica"])) {
        header("Location:/aulas/informatica.php");
    }
    if (isset($_POST["biblioteca"])) {
        header("Location:/aulas/biblioteca.php");
    }
    if (isset($_POST["bibliolab"])) {
        header("Location:/aulas/bibliolab.php");
    }
    if (isset($_POST["multisensorial"])) {
        header("Location:/aulas/multisensorial.php");
    }
    if (isset($_POST["rosalia"])) {
        header("Location:/aulas/rosalia.php");
    }
    if (isset($_POST["gimnasio"])) {
        header("Location:/aulas/gimnasio.php");
    }
    if (isset($_POST["patio_columnas"])) {
        header("Location:/aulas/patio_columnas.php");
    }
    ?>
</body>

</html>