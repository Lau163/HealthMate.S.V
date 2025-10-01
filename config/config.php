<?php
// Configuración de la base de datos
define("HOST", "localhost");//Servidor donde se aloja la base de datos
define("DB", "health_mate");//Nombre de la base de datos
define("USER", "root");//Usuario de la base de datos
define("PASSWORD", "");//Contraseña de usuario de la base de datos
define("CHARSET", "utf8");//Codificación de caracteres.

// Configuración de la aplicación
define("BASE_URL", "/" . basename(dirname(__DIR__)) . "/"); // Ruta base de la aplicación
define("URL", "http://" . $_SERVER['HTTP_HOST'] . "/" . basename(dirname(__DIR__)) . "/"); // URL completa

// Configuración de sesión
ini_set('session.cookie_httponly', 1);
ini_set('session.use_only_cookies', 1);
ini_set('session.cookie_secure', 0); // Cambiar a 1 si usas HTTPS
ini_set('session.cookie_samesite', 'Lax');
ini_set('session.gc_maxlifetime', 1800); // 30 minutos
ini_set('session.cookie_lifetime', 0); // La cookie de sesión expirará al cerrar el navegador

// Iniciar la sesión si no está iniciada
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// Función para establecer mensajes flash
function setFlashMessage($type, $message) {
    if (session_status() === PHP_SESSION_NONE) {
        session_start();
    }
    
    // Inicializar el array de mensajes flash si no existe
    if (!isset($_SESSION['flash_messages'])) {
        $_SESSION['flash_messages'] = [];
    }
    
    // Agregar el mensaje al array
    $_SESSION['flash_messages'][] = [
        'type' => $type,
        'message' => $message,
        'timestamp' => time()
    ];
    
    // Mantener solo los mensajes de los últimos 5 minutos (para limpieza)
    $current_time = time();
    foreach ($_SESSION['flash_messages'] as $key => $msg) {
        if (($current_time - $msg['timestamp']) > 300) { // 5 minutos
            unset($_SESSION['flash_messages'][$key]);
        }
    }
    
    // Reindexar el array
    $_SESSION['flash_messages'] = array_values($_SESSION['flash_messages']);
}

// Función para obtener mensajes flash
function getFlashMessage() {
    if (session_status() === PHP_SESSION_NONE) {
        session_start();
    }
    
    if (!empty($_SESSION['flash_messages'])) {
        // Obtener el primer mensaje
        $flash = array_shift($_SESSION['flash_messages']);
        
        // Reindexar el array
        $_SESSION['flash_messages'] = array_values($_SESSION['flash_messages']);
        
        return $flash;
    }
    
    return null;
}

// Función para obtener todos los mensajes flash
function getAllFlashMessages() {
    if (session_status() === PHP_SESSION_NONE) {
        session_start();
    }
    
    if (!empty($_SESSION['flash_messages'])) {
        $messages = $_SESSION['flash_messages'];
        $_SESSION['flash_messages'] = [];
        return $messages;
    }
    
    return [];
}
