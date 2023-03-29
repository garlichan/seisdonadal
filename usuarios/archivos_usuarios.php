<?php
session_start();
include '../database.php';
if (!isset($_SESSION['rol'])) {
    header('location: ../../login.php');
} else if ($_SESSION['rol'] != 1) {
    header('location: ../../login.php');
} else {
}


if(isset($_POST['carpeta_seleccionada'])){
$ubicacion=$_POST['carpeta_seleccionada'];
$_SESSION['carpeta_seleccionada']=$_POST['carpeta_seleccionada'];
}else{
    $ubicacion=$_SESSION['carpeta_seleccionada'];
}

if (isset($_POST['borrar'])) {
    unlink($_POST["archivo"]);
    header('location: archivos_usuarios.php');
}

$separar = explode("/", $ubicacion);
$identificador = $separar[1];
$pdo = new Database();
$connection = $pdo->connect();
$query = $connection->prepare("SELECT correo FROM usuarios WHERE id_usuario=:identificador");
$query->bindParam("identificador", $identificador, PDO::PARAM_STR);
$query->execute();
$result = $query->fetch(PDO::FETCH_ASSOC);
$correo_usuario = $result['correo'];

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
    <link href="../styles/archivos_usuarios.css" rel="stylesheet" type="text/css">
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
        <div class="datos_usuario">
            <h1>Carpeta de: <?php
                            echo $correo_usuario;
                            ?></h1>

        </div>
        <div class="archivos">
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
    </div>
</body>

</html>