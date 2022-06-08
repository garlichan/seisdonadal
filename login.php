<?php
include('database.php');
session_start();

//registro usuario
if (isset($_POST['register'])) {
    $nombre = $_POST['nombre'];
    $correo = $_POST['correo'];
    $password = $_POST['password'];
    $password_hash = password_hash($password, PASSWORD_BCRYPT);
    $pdo = new Database();
    $connection = $pdo->connect();
    $query = $connection->prepare("SELECT * FROM usuarios WHERE correo=:correo");
    $query->bindParam("correo", $correo, PDO::PARAM_STR);
    $query->execute();
    if ($query->rowCount() > 0) {
        $correo_existe = "El correo ya existe";
    } else {
    }
    if ($query->rowCount() == 0) {
        $registro_exito = "Usuario registrado con éxito";
        $query = $connection->prepare("INSERT INTO usuarios (nombre,correo,password,rol) VALUES (:nombre,:correo,:password_hash,3)");
        $query->bindParam("nombre", $nombre, PDO::PARAM_STR);
        $query->bindParam("correo", $correo, PDO::PARAM_STR);
        $query->bindParam("password_hash", $password_hash, PDO::PARAM_STR);
        $result = $query->execute();
    }
}
//inicio sesion usuario
if (isset($_POST['login'])) {
    $correo = $_POST['correo'];
    $password = $_POST['password'];
    $pdo = new Database();
    $connection = $pdo->connect();
    $query = $connection->prepare("SELECT * FROM usuarios WHERE correo=:correo");
    $query->bindParam("correo", $correo, PDO::PARAM_STR);
    $query->execute();
    $result = $query->fetch(PDO::FETCH_ASSOC);

    if (!$result) {
    } else {
        if (password_verify($password, $result['password'])) {
            $_SESSION['id_usuario'] = $result['id_usuario'];
            $_SESSION['rol'] = $result['rol'];
            $_SESSION['nombre'] = $result['nombre'];
            $_SESSION['correo'] = $result['correo'];
            $_SESSION['apellidos'] = $result['apellidos'];
            $_SESSION['direccion'] = $result['direccion'];
            $_SESSION['ultima_modificacion'] = $result['ultima_modificacion'];
            header('Location: usuarios/perfil.php');
        }
    }
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
    <link href="/styles/login.css" rel="stylesheet" type="text/css">
</head>

<body>
    <header class="header">
        <div class="logo">
            <a href="index.php"><img src="imagenes/logo/logo001.png" /></a>
        </div>
        <h3>CEIP Plurilingüe Seis do Nadal</h3>
        <nav class="enlaces">
            <?php
            if (isset($_SESSION['correo'])) { ?>
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
        <div class="login">
            <div class="tipo_formulario">
                <h1>Formulario de inicio de sesión</h1>
            </div>
            <form name="formulario_login" method="post" action="">
                <label>Email:</label>
                <input type="email" name="correo">
                <label>Contraseña:</label>
                <input type="password" name="password">
                <input type="submit" name="login" value="Iniciar sesión">
            </form>
        </div>
        <div class="registro">
            <div class="tipo_formulario">
                <h1>Formulario de registro</h1>
            </div>
            <form name="formulario_registro" method="post" action="">
                <label>Nombre</label>
                <input type="text" name="nombre">
                <label>Email:</label>
                <input type="email" name="correo">
                <?php
                if (isset($correo_existe)) {
                ?><p style="color:red; font-size:20px; margin:0; margin-left:30%"><?php
                                                                                    echo $correo_existe;
                                                                                    ?></p><?php } ?>
                <label>Contraseña:</label>
                <input type="password" name="password">
                <input type="submit" name="register" value="Registrarse">
                <?php
                if (isset($registro_exito)) {
                ?><p style="color:green; font-size:20px; margin:0; margin-left:20%"><?php
                                                                                    echo $registro_exito;
                                                                                    ?></p><?php } ?>
            </form>
        </div>
    </div>
</body>

</html>