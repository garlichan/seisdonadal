<?php
include '../database.php';
session_start();

if (!isset($_SESSION['rol'])) {
    header('location: ../../login.php');
} else if ($_SESSION['rol'] == 3) {
    header('location: ../../login.php');
} else {
}
if (isset($_POST['boton_reservar_aula'])) {
    $fecha = $_POST['fecha'];
    $hora = $_POST['hora'];
    $id_usuario = $_POST['id_usuario'];
    $id_aula = $_POST['id_aula'];
    $pdo = new Database();
    $connection = $pdo->connect();
    $sql = $connection->prepare("SELECT * FROM reservas_aula_profesor WHERE id_aula=:id_aula AND fecha=:fecha AND hora=:hora");
    $sql->bindParam("id_aula", $id_aula, PDO::PARAM_STR);
    $sql->bindParam("fecha", $fecha, PDO::PARAM_STR);
    $sql->bindParam("hora", $hora, PDO::PARAM_STR);
    $sql->execute();
    if ($sql->rowCount() > 0) {
        $reserva_existe = "El aula no está disponiible esta hora";
    } else {
        $query = $connection->prepare("INSERT INTO reservas_aula_profesor (id_aula,id_profesor,fecha,hora) VALUES (:id_aula,:id_profesor,:fecha,:hora)");
        $query->bindParam("id_aula", $id_aula, PDO::PARAM_STR);
        $query->bindParam("id_profesor", $id_usuario, PDO::PARAM_STR);
        $query->bindParam("fecha", $fecha, PDO::PARAM_STR);
        $query->bindParam("hora", $hora, PDO::PARAM_STR);
        $query->execute();
    }
}
?>
<!DOCTYPE html>
<html lang="en">

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
    <link href="/styles/reservar_aulas.css" rel="stylesheet" type="text/css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.0/css/all.min.css" />
</head>

<body>
    <header class="header">
        <div class="logo">
            <a href="../index.php"><img src="../imagenes/logo/logo001.png"></a>        </div>
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
    <div class="contenedor_reservar_aula">
        <div class="informacion_aula">
            <h1>Bibliolab</h1>
            <div class="slide">
                <div class="slide-inner">
                    <input class="slide-open" type="radio" id="slide-1" name="slide" aria-hidden="true" hidden="" checked="checked">
                    <div class="slide-item">
                        <img src="../imagenes/aulas/reserva_bibliolab_01.jpeg">
                    </div>
                    <input class="slide-open" type="radio" id="slide-2" name="slide" aria-hidden="true" hidden="">
                    <div class="slide-item">
                        <img src="../imagenes/aulas/reserva_bibliolab_02.jpeg">
                    </div>
                    <input class="slide-open" type="radio" id="slide-3" name="slide" aria-hidden="true" hidden="">
                    <div class="slide-item">
                        <img src="../imagenes/aulas/reserva_bibliolab_03.jpeg">
                    </div>
                    <label for="slide-3" class="slide-control prev control-1">‹</label>
                    <label for="slide-2" class="slide-control next control-1">›</label>
                    <label for="slide-1" class="slide-control prev control-2">‹</label>
                    <label for="slide-3" class="slide-control next control-2">›</label>
                    <label for="slide-2" class="slide-control prev control-3">‹</label>
                    <label for="slide-1" class="slide-control next control-3">›</label>
                    <ol class="slide-indicador">
                        <li>
                            <label for="slide-1" class="slide-circulo">•</label>
                        </li>
                        <li>
                            <label for="slide-2" class="slide-circulo">•</label>
                        </li>
                        <li>
                            <label for="slide-3" class="slide-circulo">•</label>
                        </li>
                    </ol>
                </div>
            </div>
            <div id="texto">Non lacinia mauris viverra lacinia. Sed risus felis, dignissim nec sem non, varius cursus mi. Curabitur vitae convallis massa. Suspendisse ac laoreet justo. Nam non pulvinar lorem.</div>
        </div>

        <div class="informacion_reserva">
            <div class="contenedor_calendario">
                <div class="real_calendar">
                    <div class="calendar">
                        <div class="month">
                            <i class="fas fa-angle-left prevCalendar"></i>
                            <div class="date">
                                <h1></h1>
                            </div>
                            <i class="fas fa-angle-right nextCalendar"></i>
                        </div>
                        <div class="weekdays">
                            <div>Lun</div>
                            <div>Mar</div>
                            <div>Mié</div>
                            <div>Jue</div>
                            <div>Vie</div>
                            <div>Sáb</div>
                            <div>Dom</div>
                        </div>
                        <div class="days">
                        </div>
                    </div>
                </div>
            </div>
            <form action="" method="post">
                <div class="horario">
                    <h2>Horario:</h2>
                    <div id="primeras_horas">
                        <input type="radio" value="09:00-09:50" id="1" name="hora" /> 09:00-09:50
                        <input type="radio" value="09:50-10:40" id="2" name="hora" /> 09:50-10:40
                        <input type="radio" value="10:40-11:30" id="3" name="hora" /> 10:40-11:30
                    </div>
                    <p>Recreo</p>
                    <p>Hora de lectura</p>
                    <div class="ultimas_horas">
                        <input type="radio" value="12:20-13:10" id="4" name="hora" /> 12:20-13:10
                        <input type="radio" value="13:10-14:00" id="5" name="hora" /> 13:10-14:00
                    </div>
                    <input type="hidden" name="id_usuario" value="<?php echo $_SESSION['id_usuario'] ?>">
                    <input type="hidden" name="id_aula" value="4">
                    <input type="hidden" name="fecha" id="fecha_reserva_aula">
                    <input type="submit" id="boton_reservar_aula" name="boton_reservar_aula" value="Reservar">
                </div>
            </form>
            <?php
            if (isset($reserva_existe)) {
            ?><p style="color:red; font-size:20px; margin:0; margin-left:10%; margin-top:1%"><?php
                                                                                    echo $reserva_existe;
                                                                                    ?></p><?php } ?>
        </div>
    </div>
    </div>
    </div>
    <?php

    ?>
    <script src="calendario.js"></script>

</body>

</html>