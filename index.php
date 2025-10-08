<?php
error_reporting(E_ALL);
ini_set('display_errors', '1');
date_default_timezone_set('America/Mexico_City');

// Definir constantes de rutas
if (!defined('DS')) {
    define('DS', DIRECTORY_SEPARATOR);
}

define('ROOT', dirname(__DIR__) . DS);
define('APP', ROOT . 'app' . DS);

// Cargar todas las clases y configuraciones base
require_once "config/config.php";
require_once "app/database.php";
require_once "app/model.base.php";
require_once "app/view.base.php";
require_once "app/controller.base.php";

// Iniciar sesión si no está iniciada
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// Configurar encabezados de seguridad
header('X-Frame-Options: DENY');
header('X-Content-Type-Options: nosniff');
header('X-XSS-Protection: 1; mode=block');
header('Strict-Transport-Security: max-age=31536000; includeSubDomains');
header('Referrer-Policy: strict-origin-when-cross-origin');
header('Permissions-Policy: geolocation=(), microphone=(), camera=()');

// Configurar encabezados para evitar caché
header('Cache-Control: no-store, no-cache, must-revalidate, max-age=0');
header('Cache-Control: post-check=0, pre-check=0', false);
header('Pragma: no-cache');
header('Expires: Thu, 19 Nov 1981 08:52:00 GMT');

// Cargar el middleware de autenticación
require_once "middleware/AuthMiddleware.php";

// Inicializar y ejecutar el middleware de autenticación
$authMiddleware = new AuthMiddleware();
$authMiddleware->handle();

// Cargar el enrutador principal
require_once "app/app.php";

// Inicializar la aplicación
$app = new App();
?>
