<?php
include '../database.php';
session_start();
if (!isset($_SESSION['rol'])) {
    header('location: ../../login.php');
}

if (isset($_POST['borrar'])) {
    unlink($_POST["archivo"]);
    header('location: ficheros.php');
}


$rol = $_SESSION['rol'];
$pdo = new Database();
$connection = $pdo->connect();
$query = $connection->prepare("SELECT nombre FROM roles WHERE id_rol=:rol");
$query->bindParam("rol", $rol, PDO::PARAM_STR);
$query->execute();
$result = $query->fetch(PDO::FETCH_ASSOC);
$nombre_rol = $result['nombre'];
$id_usuario = $_SESSION['id_usuario'];
$ubicacion = "" . $nombre_rol . "/" . $id_usuario;
//admin
$ruta_padres = "padre";
$ruta_profesores = "profesor";
//padres
$sql = $connection->prepare("SELECT id_usuario, correo FROM usuarios WHERE rol=3");
$sql->execute();
$resultado = $sql->fetchAll(PDO::FETCH_ASSOC);
for ($i = 0; $i < count($resultado); $i++) {
    $sql2 = $connection->prepare("SELECT id_usuario, correo FROM usuarios WHERE id_usuario=:id_padre");
    $sql2->bindParam("id_padre", $resultado[$i]['id_usuario'], PDO::PARAM_STR);
    $sql2->execute();
    $resultado2 = $sql2->fetch(PDO::FETCH_ASSOC);
    $correo_padre = $resultado2['correo'];
    $id_padre = $resultado2['id_usuario'];
    $resultado[$i]['correo_padre'] = $correo_padre;
    $resultado[$i]['id_padre'] = $id_padre;
}
//profesores
$sql3 = $connection->prepare("SELECT id_usuario, correo FROM usuarios WHERE rol=2");
$sql3->execute();
$resultado3 = $sql3->fetchAll(PDO::FETCH_ASSOC);
for ($i = 0; $i < count($resultado3); $i++) {
    $sql4 = $connection->prepare("SELECT id_usuario, correo FROM usuarios WHERE id_usuario=:id_profesor");
    $sql4->bindParam("id_profesor", $resultado3[$i]['id_usuario'], PDO::PARAM_STR);
    $sql4->execute();
    $resultado4 = $sql4->fetch(PDO::FETCH_ASSOC);
    $correo_profesor = $resultado4['correo'];
    $id_profesor = $resultado4['id_usuario'];
    $resultado3[$i]['correo_profesor'] = $correo_profesor;
    $resultado3[$i]['id_profesor'] = $id_profesor;
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
    <title><?php echo $_SESSION['nombre'] ?></title>
    <link href="../styles/ficheros.css" rel="stylesheet" type="text/css">
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
        <div class="subida_ficheros">
            <form action="" method="POST" enctype="multipart/form-data">
                <input type="file" name="fichero" />
                <input type="submit" value="Subir" />
            </form>
        </div>
        <div class="ficheros">
            <?php
            if (isset($_FILES['fichero'])) {
                $fichero = $_FILES['fichero'];
                $nombre_fichero_tmp = $fichero['tmp_name'];
                $nombre_fichero = $fichero['name'];
                move_uploaded_file($nombre_fichero_tmp, "$ubicacion/$nombre_fichero");
            }
            ?>
            <!--imagenes-->
            <div class="imagenes">
                <?php
                $galeria = dir($ubicacion);
                while (($archivo = $galeria->read()) !== false) {
                    $separacion = explode(".", $archivo);
                    $formato = $separacion[1];
                    if ($formato == "jpg" || $formato == "png" || $formato == "gif" || $formato == "jpeg") {
                ?>
                        <form class="contenedor_archivo" method="post" action="">
                            <?php
                            echo '<img src="' . $ubicacion . "/" . $archivo . '">';
                            ?>
                            <input type="submit" id="borrar" name="borrar" value="x">
                            <input type="hidden" name="archivo" value="<?php echo  $ubicacion . "/" . $archivo; ?>">
                        </form>
                <?php

                    }
                }
                $galeria->close();

                ?>
            </div>
            <div class="documentos">
                <h2>Descargas disponibles</h2>
                <?php

                $documentos = scandir($ubicacion);
                ?>
                <table>
                    <?php
                    for ($i = 2; $i < count($documentos); $i++) {
                        $formato = explode(".", $documentos[$i]);
                        if ($formato[1] == "jpg" || $formato[1] == "png" || $formato[1] == "gif" || $formato[1] == "jpeg") {
                        } else {
                    ?>
                            <tr>
                                <td><?php echo $documentos[$i]; ?></td>
                                <td id="descargas"><a href="<?php echo $ubicacion . "/" . $documentos[$i]; ?>" download=""><img src="../imagenes/descargas.png"></a></td>
                                <td>
                                    <form method="post" action="">
                                        <input type="submit" id="borrar" name="borrar" value="x">
                                        <input type="hidden" name="archivo" value="<?php echo  $ubicacion . "/" . $documentos[$i]; ?>">
                                    </form>
                                </td>
                            </tr>
                    <?php
                        }
                    }

                    ?>
                </table>
            </div>
        </div>
        <!--admin-->
        <?php if ($_SESSION['rol'] == 1) {
        ?>
            <div class="container_usuarios">
                <div class="container_padres">
                    <h1>Carpetas de los padres</h1>
                    <div class="carpetas_padres">
                        <?php
                        $documentos = scandir($ruta_padres);

                        ?>
                        <?php
                        for ($i = 2; $i < count($documentos); $i++) {

                        ?>
                            <form class="formulario_carpetas" method="post" action="archivos_usuarios.php">
                                <input type="submit" id="carpeta" value="<?php

                                                                            for ($j = 0; $j < count($resultado); $j++) {
                                                                                if ($documentos[$i] == $resultado[$j]['id_padre']) {
                                                                                    echo $resultado[$j]['correo_padre'];
                                                                                }
                                                                            }
                                                                            ?>">
                                <input type="hidden" name="carpeta_seleccionada" value="<?php echo  $ruta_padres . "/" . $documentos[$i]; ?>">
                            </form>
                        <?php
                        }
                        ?>
                    </div>

                </div>
                <div class="container_profesores">
                    <h1>Carpetas de los profesores</h1>
                    <div class="carpetas_padres">
                        <?php
                        $documentos = scandir($ruta_profesores);
                        ?>
                        <?php
                        for ($i = 2; $i < count($documentos); $i++) {

                        ?>
                            <form class="formulario_carpetas" method="post" action="archivos_usuarios.php">
                                <input type="submit" id="carpeta" value="<?php

                                                                            for ($j = 0; $j < count($resultado3); $j++) {
                                                                                if ($documentos[$i] == $resultado3[$j]['id_profesor']) {
                                                                                    echo $resultado3[$j]['correo_profesor'];
                                                                                }
                                                                            }
                                                                            ?>">
                                <input type="hidden" name="carpeta_seleccionada" value="<?php echo  $ruta_profesores . "/" . $documentos[$i]; ?>">
                            </form>
                        <?php
                        }
                        ?>
                    </div>
                </div>
            </div>
        <?php
        } ?>
    </div>
</body>

</html>