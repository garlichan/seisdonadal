<?php
include '../database.php';
session_start();
if (!isset($_SESSION['rol'])) {
    header('location: ../../login.php');
} else if ($_SESSION['rol'] == 2) {
    header('location: ../../login.php');
} else {
}
if (isset($_POST['boton_reservar_actividad'])) {
    $id_usuario = $_POST['id_usuario'];
    $id_actividad = $_POST['id_actividad'];
    //
    $pdo = new Database();
    $connection = $pdo->connect();
    $query = $connection->prepare("INSERT INTO reservas_actividad_padre (id_actividad,id_padre) VALUES (:id_actividad,:id_padre)");
    $query->bindParam("id_actividad", $id_actividad, PDO::PARAM_STR);
    $query->bindParam("id_padre", $id_usuario, PDO::PARAM_STR);
    $query->execute();
    header('Location: ../usuarios/perfil.php');
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
    <link rel="icon" href="../imagenes/logo/logo002.png">
    <title>CEIP Plurilingüe Seis do Nadal</title>
    <link href="/styles/reservar_actividades_extraescolares.css" rel="stylesheet" type="text/css">
    <script src="actividades.js"></script>
</head>

<body>
    <header class="header">
        <div class="logo">
            <a href="../index.php"><img src="../imagenes/logo/logo001.png" ></a>
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
    <div class="contenedor_reservar_actividad">
        <div class="informacion_actividad">
            <div class="imagenes">
                <img id="arrow1" src=/imagenes/previous.png>
                <img id="imagen" src="/imagenes/actividades/ingles_pictograma.png" />
                <img id="arrow2" src=/imagenes/next.png>
            </div>
            <div id="texto">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Phasellus scelerisque metus libero, non lacinia mauris viverra lacinia. Sed risus felis, dignissim nec sem non, varius cursus mi. Curabitur vitae convallis massa. Suspendisse ac laoreet justo. Nam non pulvinar lorem.</div>
        </div>
        <form action="" method="POST">
            <input type="hidden" name="id_usuario" value="<?php echo $_SESSION['id_usuario'] ?>">
            <input type="hidden" name="id_actividad" value="10">
            <input type="submit" id="boton_reservar_actividad" name="boton_reservar_actividad" value="¡Apuntarme!">
        </form>
    </div>
    <?php
    ?>
</body>

</html>