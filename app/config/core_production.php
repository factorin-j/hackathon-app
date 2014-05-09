<?php

define('ENV_PRODUCTION', true);
define('APP_HOST', $_SERVER['HTTP_HOST']);
define('APP_BASE_PATH', '/');
define('APP_URL', 'http://' . APP_HOST . '/');
define('AUTH_DIR', __DIR__ . '/auth/');

ini_set('display_errors', 'Off');
error_reporting(E_ALL | E_STRICT);
ini_set('error_log', LOGS_DIR . 'php.log');
ini_set('session.auto_start', 0);

$db_auth = explode(':', trim(file_get_contents(AUTH_DIR . 'mysql')));
define('DB_DSN', 'mysql:host=' . $db_auth[0] . ';dbname=' . $db_auth[1]);
define('DB_USERNAME', $db_auth[2]);
define('DB_PASSWORD', $db_auth[3]);
define('DB_ATTR_TIMEOUT', 3);
