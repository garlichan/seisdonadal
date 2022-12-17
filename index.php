<?php
include 'database.php';
session_start();

if (isset($_POST['cerrar_sesion'])) {
    session_unset();
    session_destroy();
    header('location: ../index.php');
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
    <link rel="stylesheet" href="styles/style.css">
    <script src="/js/search.js"></script>
    <script src="jquery-3.6.0.min.js"></script>
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
            <input type="search" id="input-search" placeholder=" 🔍︎  Buscar aqui">
        </nav>
    </header>
    <div class="contenedor">
        <div id="resultado_busqueda"></div>
        <div class="carrusel">
            <div class="slide">
                <div class="slide-inner">
                    <input class="slide-open" type="radio" id="slide-1" name="slide" aria-hidden="true" hidden="" checked="checked">
                    <div class="slide-item">
                        <img src="imagenes/carrusel/seisdonadal.jpg">
                    </div>
                    <input class="slide-open" type="radio" id="slide-2" name="slide" aria-hidden="true" hidden="">
                    <div class="slide-item">
                        <img src="imagenes/carrusel/pichines.jpg">
                    </div>
                    <input class="slide-open" type="radio" id="slide-3" name="slide" aria-hidden="true" hidden="">
                    <div class="slide-item">
                        <img src="imagenes/carrusel/clase_infantil.jpg">
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
        </div>
        <div class="noticias">
            <div class="noticia_destacada">
                <?php
                if (isset($_SESSION['rol']) && $_SESSION['rol'] == 1) {
                ?>
                <?php
                }
                ?>
                <h3>08/03/2022</h3>
                <h1>DIA DA MULLER 8 DE MARZO DE 2022...</h1>
                <img src="imagenes/noticias/dia_da_muller.png">

                <div id="texto">O tema do Día Internacional da Muller do vindeiro 8 de marzo de 2022 é: “Igualdade de xénero hoxe para un mañá sostible”, recoñecendo a contribución de mulleres e nenas de todo o mundo que están liderando os esforzos de respostas, mitigación e adaptación ao cambio climático, para construir un futuro máis sostible para todas as persoas.</div>
                <nav class="url">
                    <ul>
                        <li><a href="http://atlasdossonhos.blogspot.com/2022/03/8m-dia-internacional-da-muller.html">Atlas dos soños</a></li>
                    </ul>
                </nav>
            </div>
            <div class="noticia_destacada">
                <h3>15/02/2022</h3>
                <h1>XORNADAS DE PORTAS ABERTAS!!!!!!!</h1>
                <img src="imagenes/noticias/xornadas_portas_abertas.png" width="30%">

                <div id="texto"> Portas abertas 8 e 15 de marzo (de mañá de 9.15 a 10.15 e de tarde de 16.15 a 17.15)para as Nais e Pais do Centro e para aquelas familias que non puideron asistir nas dúas xornadas anteriores. Animádevos a vir !!!!!! Non volo perdades!!!!!!!</div>
                <nav class="url">
                    <ul>
                        <li><a href="https://anpaseisdonadal.wordpress.com/2022/02/14/benvids-a-este-pequeno-ecosistema-noso-que-e-o-seis-do-nadal/">Anpa CEIP Seis do Nadal Vigo</a></li>
                    </ul>
                </nav>
            </div>
            <div class="noticia_destacada">
                <h3>30/01/2022</h3>
                <h1>A NOSA CANCIÓN PARA CONMEMORAR O DÍA DA PAZ!!!!!!</h1>
                <img src="imagenes/noticias/paz.png">

                <div id="texto">Este curso traballamos a canción «XA CHEGOU O DÍA DA PAZ» de Pablo Díaz con xestos no retrouso. Celebramos o acto o 31 de Xaneiro no exterior do cole vestidos de blanco. Disfrutade do resultado.</div>
                <nav class="url">
                    <ul>
                        <li><a href="https://youtu.be/eM_biyXL9BU">Vídeo " Os Camiños para a Paz"</a></li>
                        <li><a href="https://opentagramamaxico.wordpress.com/2022/01/19/xa-chegou-o-dia-da-paz-2022/">Pentagrama máxico</a></li>
                        <li><a href="http://atlasdossonhos.blogspot.com/2022/02/contacontos-pola-paz.html">Atlas dos soños</a></li>
                    </ul>
                </nav>
            </div>
        </div>
    </div>
    <footer><p>© CEIP Plurilingüe Seis do Nadal 2022 |</p>
    <form method="post" action="">
    <input type="submit" name="cerrar_sesion" id="cerrar_sesion" value="Cerrar sesión">
    </form>    
</footer>
    <?php

    ?>
</body>

</html>