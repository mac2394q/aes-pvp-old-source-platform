<?php
define('DEVELOPMENT_ENVIRONMENT', true);

// define('DB_NAME', 'aesorg_pvp');
// define('DB_USER', 'aesorg_pvp');
// define('DB_PASSWORD', 'pvp2012*@');
// define('DB_HOST', 'localhost');
define('DB_NAME', 'portalxn_aesorg_pvp');
define('DB_USER', 'portalxn_admin');
define('DB_PASSWORD', 'f11235813');
define('DB_HOST', '192.185.128.14');

// define('SITE_URL', 'http://pvp.aes.org.co/');  // Diagonal al final
define('SITE_URL', 'http://portalx.net/pvp_old/');
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
define('NA', 3);

//Roles
define('SA', 0);
define('ADMIN', 1);
define('COORDINADOR', 2);
define('AUDITOR', 3);
define('CLIENTE', 4);
define('PROVEEDOR', 5);

//Javascript controlled timeout in minutes
define('TIMEOUT', 30);
define('TIMEWARN', 2);
