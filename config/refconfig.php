<?php
define('DEVELOPMENT_ENVIRONMENT', true);

define('DB_NAME', 'aesorg_pvp2');
define('DB_USER', 'aesorg_pvp2');
define('DB_PASSWORD', 'O^KEXc4$6?5v');
define('DB_HOST', 'localhost');

define('SITE_URL', 'http://pvp5.aes.org.co/' );  // Diagonal al final
define('JS_LOCATION', 'js/'); // Diagonal al final
define('CSS_LOCATION', 'css/');
define('IMG_LOCATION', 'images/');
define('FLA_LOCATION', 'flash/');
define('PUBLIC_DIR', '');  // Diagonal al final

define('DEFAULT_CONTROLLER', 'auth');
define('DEFAULT_ACTION', 'main');


//Requirements Conformity
define('ND', 0);
define('NC', 1);
define('OK', 2);

//Roles
define('SA', 0);
define('ADMIN', 1);
define('COORDINADOR', 2);
define('AUDITOR', 3);
define('CLIENTE', 4);
define('PROVEEDOR', 5);

//Javascript controlled timeout in minutes
define('TIMEOUT', 20);
define('TIMEWARN', 2);
