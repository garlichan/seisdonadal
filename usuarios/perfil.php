<?php
include '../database.php';
session_start();
if (!isset($_SESSION['rol'])) {
    header('location: ../../login.php');
}
if (isset($_POST['cerrar_sesion'])) {
    session_unset();
    session_destroy();
    header('location: ../index.php');
}

$rol = $_SESSION['rol'];
$pdo = new Database();
$connection = $pdo->connect();
$query = $connection->prepare("SELECT nombre FROM roles WHERE id_rol=:rol");
$query->bindParam("rol", $rol, PDO::PARAM_STR);
$query->execute();
$result = $query->fetch(PDO::FETCH_ASSOC);
$nombre_rol = $result['nombre'];


//aulas
if ($_SESSION['rol'] == 1) {
    $query2 = $connection->prepare("SELECT * FROM reservas_aula_profesor");
} else {
    $query2 = $connection->prepare("SELECT * FROM reservas_aula_profesor WHERE id_profesor=:id_profesor");
}
$query2->bindParam("id_profesor", $_SESSION['id_usuario'], PDO::PARAM_STR);
$query2->execute();
$result2 = $query2->fetchAll(PDO::FETCH_ASSOC);
//
for ($i = 0; $i < count($result2); $i++) {
    //profes
    $sql = $connection->prepare("SELECT nombre FROM aulas WHERE id_aula=:id_aula");
    $sql->bindParam("id_aula", $result2[$i]['id_aula'], PDO::PARAM_STR);
    $sql->execute();
    $resultado = $sql->fetch(PDO::FETCH_ASSOC);
    $nombre_aula = $resultado['nombre'];
    $result2[$i]['nombre_aula'] = $nombre_aula;
    //solo para admin
    $sql2 = $connection->prepare("SELECT nombre,correo FROM usuarios WHERE id_usuario=:id_usuario");
    $sql2->bindParam("id_usuario", $result2[$i]['id_profesor'], PDO::PARAM_STR);
    $sql2->execute();
    $resultado2 = $sql2->fetch(PDO::FETCH_ASSOC);
    $nombre_profesor = $resultado2['nombre'];
    $correo_profesor = $resultado2['correo'];
    $result2[$i]['nombre_profesor'] = $nombre_profesor;
    $result2[$i]['correo_profesor'] = $correo_profesor;
}
//actividades
if ($_SESSION['rol'] == 1) {
    $query3 = $connection->prepare("SELECT * FROM reservas_actividad_padre");
} else {
    $query3 = $connection->prepare("SELECT * FROM reservas_actividad_padre WHERE id_padre=:id_padre");
}
$query3->bindParam("id_padre", $_SESSION['id_usuario'], PDO::PARAM_STR);
$query3->execute();
$result3 = $query3->fetchAll(PDO::FETCH_ASSOC);
//
for ($i = 0; $i < count($result3); $i++) {
    $sql = $connection->prepare("SELECT * FROM actividades_extraescolares WHERE id_actividad=:id_actividad");
    $sql->bindParam("id_actividad", $result3[$i]['id_actividad'], PDO::PARAM_STR);
    $sql->execute();
    $resultado = $sql->fetch(PDO::FETCH_ASSOC);
    $nombre_actividad = $resultado['nombre'];
    $horario_actividad = $resultado['horario'];
    $precio_actividad = $resultado['precio'];
    $result3[$i]['nombre_actividad'] = $nombre_actividad;
    $result3[$i]['horario_actividad'] = $horario_actividad;
    $result3[$i]['precio_actividad'] = $precio_actividad;
    //
    $sql2 = $connection->prepare("SELECT nombre,correo FROM usuarios WHERE id_usuario=:id_usuario");
    $sql2->bindParam("id_usuario", $result3[$i]['id_padre'], PDO::PARAM_STR);
    $sql2->execute();
    $resultado2 = $sql2->fetch(PDO::FETCH_ASSOC);
    $nombre_padre = $resultado2['nombre'];
    $correo_padre= $resultado2['correo'];
    $result3[$i]['nombre_padre'] = $nombre_padre;
    $result3[$i]['correo_padre'] = $correo_padre;
}


//crear carpeta usuario
$id_usuario = $_SESSION['id_usuario'];
$nombre_carpeta = "../usuarios/" . $nombre_rol . "/" . $id_usuario . "";
if (!is_dir($nombre_carpeta)) {
    mkdir($nombre_carpeta, 0700);
}
//
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
    <title><?php echo $_SESSION['nombre'] ?></title>
    <link href="/styles/perfil.css" rel="stylesheet" type="text/css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.0/css/all.min.css" />
</head>

<body>
    <header class="header">
        <div class="logo">
            <a href="../index.php"><img src="../imagenes/logo/logo001.png" /></a>
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
                <a href="../login.php">Inicio Sesión</a>
            <?php } ?>
            <a href="../contacto.php">Contacto</a>
        </nav>
    </header>

    <div class="container">
        <!--Perfil de usuario-->
        <div class="perfil">
            <div class="carpeta_usuario">
                <a href="ficheros.php"><img id="carpeta" src="../imagenes/carpeta usuario.png"></a>
            </div>
            <img id="icono" src="../imagenes/avatar.png">
            <h2><?php

                echo "Rol: " . $nombre_rol;

                ?></h2>
            <div class="info_usuario">
                <h2>Información del usuario</h2>
                <p><?php echo "Nombre: " . $_SESSION['nombre'] ?></p>
                <p><?php echo "Correo: " . $_SESSION['correo'] ?></p>
                <p><?php echo "Apellidos: " . $_SESSION['apellidos'] ?></p>
                <p><?php echo "Direccion: " . $_SESSION['direccion'] ?></p>
                <p id="ultima_modificacion"><?php echo "Última modificación: " . $_SESSION['ultima_modificacion'] ?></p>
                <?php
                if (isset($_POST['guardar_perfil'])) {
                    $correo = $_SESSION['correo'];
                    $apellidos = $_POST['apellidos'];
                    $direccion = $_POST['direccion'];
                    $ultima_modificacion = date('d-m-Y');
                    //
                    $pdo = new Database();
                    $connection = $pdo->connect();
                    $query = $connection->prepare("UPDATE usuarios SET apellidos=:apellidos , direccion=:direccion, ultima_modificacion=:ultima_modificacion WHERE correo=:correo");
                    $query->bindParam("correo", $correo, PDO::PARAM_STR);
                    $query->bindParam("apellidos", $apellidos, PDO::PARAM_STR);
                    $query->bindParam("direccion", $direccion, PDO::PARAM_STR);
                    $query->bindParam("ultima_modificacion", $ultima_modificacion, PDO::PARAM_STR);
                    $query->execute();
                    $_SESSION['apellidos'] = $apellidos;
                    $_SESSION['direccion'] = $direccion;
                    $_SESSION['ultima_modificacion'] = $ultima_modificacion;
                    header('Location: perfil.php');
                ?>

                <?php
                }
                ?>
            </div>
            <form name="formulario" method="post" id="botones">
                <?php
                if (isset($_POST['modificar_perfil'])) {
                ?>
                    <p><?php echo "Apellidos: " ?><input type="text" name="apellidos" id="input_datos"></p>
                    <p><?php echo "Dirección: " ?><input type="text" name="direccion" id="input_datos"></p>

                    <input type="submit" name="guardar_perfil" id="guardar_perfil" value="Guardar cambios">
                <?php
                } else {

                ?>
                    <input type="submit" name="modificar_perfil" id="modificar_perfil" value="Modificar perfil">
                <?php
                }
                ?>

                <input type="submit" name="cerrar_sesion" id="cerrar_sesion" value="Cerrar sesión">

            </form>
        </div>
        <div class="reservas">
            <h1>Reservas:</h1>
            <div class="info_reservas">
                <?php
                if ($_SESSION['rol'] == 2 || $_SESSION['rol'] == 1) {
                ?>
                    <table class="tabla_reservas">
                        <tr>
                            <?php if ($_SESSION['rol'] == 1) { ?>
                                <th>Profesor/a</th><?php } ?>
                            <th>Aula</th>
                            <th>Fecha</th>
                            <th>Hora</th>
                            <?php if ($_SESSION['rol'] == 1) { ?>
                                <th>Acción</th><?php } ?>
                        </tr>
                        <?php
                        for ($i = 0; $i < count($result2); $i++) {
                        ?> <tr>
                                <?php if ($_SESSION['rol'] == 1) { ?>
                                    <td><?php echo $result2[$i]['nombre_profesor'] ?></td><?php } ?>
                                <td>
                                    <?php
                                    echo $result2[$i]['nombre_aula'];
                                    ?>
                                </td>
                                <td>
                                    <?php
                                    echo $result2[$i]['fecha'];
                                    ?>
                                </td>
                                <td>
                                    <?php
                                    echo $result2[$i]['hora'];
                                    ?>
                                </td>
                                <?php if ($_SESSION['rol'] == 1) { ?>
                                    <td>
                                        <form method="post" action="/correo/aceptar_reserva.php">
                                            <input type="hidden" name="reserva_aula" value="<?php echo $result2[$i]['nombre_aula']; ?>">
                                            <input type="hidden" name="correo_profesor" value="<?php echo $result2[$i]['correo_profesor']; ?>">
                                            <input type="hidden" name="id_reserva_aula" value="<?php echo $result2[$i]['id_reserva']; ?>">
                                            <input type="submit" name="boton_aceptar_aula" id="boton_aceptar_aula" value="🗸">
                                            
                                        </form>
                                        <form method="post" action="/correo/aceptar_reserva.php">
                                        <input type="hidden" name="reserva_aula" value="<?php echo $result2[$i]['nombre_aula']; ?>">
                                            <input type="hidden" name="correo_profesor" value="<?php echo $result2[$i]['correo_profesor']; ?>">
                                            <input type="hidden" name="id_reserva_aula" value="<?php echo $result2[$i]['id_reserva']; ?>">
                                            <input type="submit" name="boton_borrar_aula" id="boton_borrar_aula" value="x">
                                        </form>
                                    </td><?php } ?>
                            </tr>
                        <?php
                        }


                        ?>

                    </table>
                <?php }
//admin
                if ($_SESSION['rol'] == 3 || $_SESSION['rol'] == 1) {
                ?>
                    <table class="tabla_reservas">
                        <tr>
                            <?php if ($_SESSION['rol'] == 1) { ?>
                                <th>Padre</th><?php } ?>
                            <th>Actividades</th>
                            <th>Horario</th>
                            <th>Precio</th>
                            <?php if ($_SESSION['rol'] == 1) { ?>
                                <th>Acción</th><?php } ?>
                        </tr>
                        <?php
                        for ($i = 0; $i < count($result3); $i++) {
                        ?> <tr>
                                <?php if ($_SESSION['rol'] == 1) { ?>
                                    <td><?php echo $result3[$i]['nombre_padre'] ?></td><?php } ?>
                                <td>
                                    <?php
                                    echo $result3[$i]['nombre_actividad'];
                                    ?>
                                </td>
                                <td>
                                    <?php
                                    echo $result3[$i]['horario_actividad'];
                                    ?>
                                </td>
                                <td>
                                    <?php
                                    echo $result3[$i]['precio_actividad'] . "€";
                                    ?>
                                </td>
                                <?php if ($_SESSION['rol'] == 1) { ?>
                                    <td>
                                        <form method="post" action="/correo/aceptar_reserva.php">
                                            <input type="hidden" name="reserva_actividad" value="<?php echo $result3[$i]['nombre_actividad']; ?>">
                                            <input type="hidden" name="enviar_correo_padre" value="<?php echo $result3[$i]['correo_padre']; ?>">
                                            <input type="hidden" name="id_reserva_actividad" value="<?php echo $result3[$i]['id_reserva_actividad']; ?>">
                                            <input type="submit" name="boton_aceptar_actividad" id="boton_aceptar_actividad" value="🗸">
                                        </form>
                                        <form method="post" action="/correo/aceptar_reserva.php">
                                        <input type="hidden" name="reserva_actividad" value="<?php echo $result3[$i]['nombre_actividad']; ?>">
                                            <input type="hidden" name="enviar_correo_padre" value="<?php echo $result3[$i]['correo_padre']; ?>">
                                            <input type="hidden" name="id_reserva_actividad" value="<?php echo $result3[$i]['id_reserva_actividad']; ?>">
                                            <input type="submit" name="boton_borrar_actividad" id="boton_borrar_actividad" value="x">
                                        </form>
                                    </td><?php } ?>
                            </tr>
                        <?php
                        }

                        ?>

                    </table>
                <?php } ?>
            </div>
        </div>
    </div>
    <?php
    ?>

</body>
<script>

</script>

</html>