<?php
// Configuración de la base de datos
define("HOST", "localhost");//Servidor donde se aloja la base de datos
define("DB", "health_mate");//Nombre de la base de datos
define("USER", "root");//Usuario de la base de datos
define("PASSWORD", "");//Contraseña de usuario de la base de datos
define("CHARSET", "utf8");//Codificación de caracteres.

// Configuración de la aplicación
define("BASE_URL", "/" . basename(dirname(__DIR__)) . "/"); // Ruta base de la aplicación
