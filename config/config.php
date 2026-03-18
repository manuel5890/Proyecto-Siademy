<?php
// ESTE ARCHIVO SE CREO PARA EVITAR MAYOR CONFIGURACION EN EL HOSTING

    // CONFIGURACION GLOBAL DEL PROYECTO

    // DETECTAR PROTOCOLO (http o https)
    $isHttps = (
        (!empty($_SERVER['HTTPS']) && strtolower((string) $_SERVER['HTTPS']) !== 'off') ||
        (isset($_SERVER['SERVER_PORT']) && (int) $_SERVER['SERVER_PORT'] === 443) ||
        (isset($_SERVER['HTTP_X_FORWARDED_PROTO']) && $_SERVER['HTTP_X_FORWARDED_PROTO'] === 'https')
    );
    $protocol = $isHttps ? 'https://' : 'http://';

    // HOST ACTUAL
    $host = $_SERVER['HTTP_HOST'] ?? 'localhost';

    // DETECTAR SUBCARPETA DE EJECUCION (ej: /siademy o /)
    $scriptName = $_SERVER['SCRIPT_NAME'] ?? '';
    $scriptDir = str_replace('\\', '/', dirname($scriptName));
    if ($scriptDir === '/' || $scriptDir === '.' || $scriptDir === '\\') {
        $scriptDir = '';
    }

    define('APP_BASE_PATH', rtrim($scriptDir, '/'));

    // URL BASE DINAMICA (FUNCIONA EN LOCAL Y HOSTING)
    define('BASE_URL', $protocol . $host . APP_BASE_PATH);

    // RUTA DE LA BASE DEL PROYECTO (PARA REQUIRE O INCLUDE)
    define('BASE_PATH', dirname(__DIR__));

    // Helper central para construir URLs sin hardcodear /siademy.
    if (!function_exists('app_url')) {
        function app_url($path = '') {
            $path = (string) $path;

            if ($path === '') {
                return BASE_URL;
            }

            if (preg_match('#^https?://#i', $path) === 1) {
                return $path;
            }

            // Compatibilidad con rutas legacy escritas como /siademy/...
            if ($path === '/siademy') {
                $path = '/';
            } elseif (strpos($path, '/siademy/') === 0) {
                $path = substr($path, strlen('/siademy'));
            }

            if ($path[0] !== '/') {
                $path = '/' . $path;
            }

            return rtrim(BASE_URL, '/') . $path;
        }
    }

?>