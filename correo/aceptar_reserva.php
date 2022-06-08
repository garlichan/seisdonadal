<?php
include '../database.php';
$pdo = new Database();
$connection = $pdo->connect();
//profesores
if (isset($_POST['boton_aceptar_aula'])) {
    $nombre_reserva_aula = $_POST['reserva_aula'];
    $correo=$_POST['correo_profesor'];
    $subjet= "Reserva del aula";
    $text="Se ha aceptado la reserva del aula: ".$nombre_reserva_aula;
    $name="Profesor";
    $query_aula = $connection->prepare("DELETE FROM reservas_aula_profesor WHERE id_reserva=:id_reserva");
    $query_aula->bindParam("id_reserva", $_POST['id_reserva_aula'], PDO::PARAM_STR);
    $query_aula->execute();
}
if (isset($_POST['boton_borrar_aula'])) {
    $nombre_reserva_aula = $_POST['reserva_aula'];
    $correo=$_POST['correo_profesor'];
    $subjet= "Reserva del aula";
    $text="Se ha cancelado la reserva del aula: ".$nombre_reserva_aula;
    $name="Profesor";
    $query_aula = $connection->prepare("DELETE FROM reservas_aula_profesor WHERE id_reserva=:id_reserva");
    $query_aula->bindParam("id_reserva", $_POST['id_reserva_aula'], PDO::PARAM_STR);
    $query_aula->execute();
}

//padres
if (isset($_POST['boton_aceptar_actividad'])) {
    $nombre_reserva_actividad = $_POST['reserva_actividad'];
    $correo=$_POST['enviar_correo_padre'];
    $subjet= "Reserva de actividad extraescolar";
    $text="Se ha aceptado la reserva de la actividad: ".$nombre_reserva_actividad;
    $name="Padre";
    $query_actividad = $connection->prepare("DELETE FROM reservas_actividad_padre WHERE id_reserva_actividad=:id_reserva");
    $query_actividad->bindParam("id_reserva", $_POST['id_reserva_actividad'], PDO::PARAM_STR);
    $query_actividad->execute();
}
if (isset($_POST['boton_borrar_actividad'])) {
    $nombre_reserva_actividad = $_POST['reserva_actividad'];
    $correo=$_POST['enviar_correo_padre'];
    $subjet= "Reserva de actividad extraescolar";
    $text="Se ha cancelado la reserva de la actividad: ".$nombre_reserva_actividad;
    $name="Padre";
    $query_actividad = $connection->prepare("DELETE FROM reservas_actividad_padre WHERE id_reserva_actividad=:id_reserva");
    $query_actividad->bindParam("id_reserva", $_POST['id_reserva_actividad'], PDO::PARAM_STR);
    $query_actividad->execute();
}


use PHPMailer\PHPMailer\PHPMailer;

require "../correo/vendor/autoload.php";

$mail = new PHPMailer();

$mail->IsSMTP();
// cambiar a 0 para no ver mensajes de error
$mail->SMTPDebug = 0;
//	Establece la autentificación SMTP. Por defecto a False
$mail->SMTPAuth = true;
$mail->SMTPSecure = "tls";
//	Establece el servidor SMTP. Pueden ser varios separados por ;
$mail->Host = "smtp.gmail.com";
$mail->Port = 587;

// Introducir usuario de google
$mail->Username = "correoejemplo.carmen@gmail.com";
// Introducir clave
$mail->Password = "SAFEpassword";
$mail->SetFrom("correoejemplo.carmen@gmail.com", "CEIP Seis do Nadal");

/*
 * Para especificar el asunto. Utilizamos la función utf8_decode para que muestre
 * correctamente los acentos.
 */
$mail->Subject = utf8_decode($subjet);

// cuerpo
$mail->MsgHTML($text);
/*
 * bool AddAttachment ( $path, $name, [$encoding = "base64"], [$type = "application/octet-stream"] )	
 * Añade un fichero adjunto al mensaje. Retorna false si el fichero no pudo ser encontrado.
 * $path, es la ruta del archivo puede ser relativa al script php (no a la clase PHPMailer) 
 * o una ruta absoluta. Se aconseja usar rutas relativas
 * $name, nombre del fichero
 * $encoding, tipo de codificación. Se aconseja dejar la predeterminada
 * $type, el valor por defecto funciona con cualquier clase de archivo. Se puede 
 * usar un tipo específico como por ejemplo image/jpeg
 */
//$mail->addAttachment("pollito.jpg");

// destinatario
$address = $correo;
/*
 * AddAddress	void AddAddress ( $address, $name )	
 * Añade una dirección de destino del mensaje. El parámetro $name es opcional
 */
$mail->AddAddress($address, "Empresa");

/*
 * bool Send ( )	
 * Envía el mensaje, devuelve false si ha habido algún problema. 
 * Consultando la propiedad ErrorInfo se puede saber cuál ha sido el problema
 */
$resul = $mail->Send();

if (!$resul) {
    echo "Error" . $mail->ErrorInfo;
} else {
    header('Location: ../usuarios/perfil.php');
}
