<?php
// Este archivo se creó para evitar hacer una mayor configuración en el aplicativo una vez lo subamos al dominio

// Configuración global del proyecto

// Detectar Protocolo
$protocol = isset($_SERVER['HTTPS']) ? 'https://' : 'http://';

// Nombre de la carpeta del proyecto en local
$baseFolder = '/siademy';

// Host actual
$host = $_SERVER['HTTP_HOST'];

// URL base dinámica (funciona en local y hosting)
define('BASE_URL', $protocol . $host . $baseFolder);

// Ruta base del proyecto (para require o include)
define('BASE_PATH', dirname(__DIR__));


?>
