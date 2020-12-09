<?php

/** Check if environment is development and display errors **/

function setReporting() {
	if (DEVELOPMENT_ENVIRONMENT == true) {
		error_reporting(E_ALL);
		ini_set('display_errors','On');
	} else {
		error_reporting(E_ALL);
		ini_set('display_errors','Off');
		ini_set('log_errors', 'On');
		ini_set('error_log', ROOT.DS.'tmp'.DS.'logs'.DS.'error.log');
	}
}

/** Check for Magic Quotes and remove them **/
function stripSlashesDeep($value) {
	$value = is_array($value) ? array_map('stripSlashesDeep', $value) : stripslashes($value);
	return $value;
}

function removeMagicQuotes() {
if ( get_magic_quotes_gpc() ) {
	$_GET    = stripSlashesDeep($_GET   );
	$_POST   = stripSlashesDeep($_POST  );
	$_COOKIE = stripSlashesDeep($_COOKIE);
}
}

/** Check register globals and remove them **/
function unregisterGlobals() {
    if (ini_get('register_globals')) {
        $array = array('_SESSION', '_POST', '_GET', '_COOKIE', '_REQUEST', '_SERVER', '_ENV', '_FILES');
        foreach ($array as $value) {
            foreach ($GLOBALS[$value] as $key => $var) {
                if ($var == $GLOBALS[$key]) {
                    unset($GLOBALS[$key]);
                }
            }
        }
    }
}

/** Main Call Function **/
function callHook() {
	global $url;

	$urlArray = array();
	$urlArray = explode("/", $url);

	if(count($urlArray) >= 1 && $urlArray[0] != "") {
		$controller = $urlArray[0];
		array_shift($urlArray);

		if(count($urlArray) == 0 || $urlArray[0] == ""){ 
			$action = DEFAULT_ACTION;
			$queryString = array();
		} elseif (strstr($urlArray[0], ".html")){
			$action = "html";
			$queryId = array("id" => str_replace(".html", "", $urlArray[0]));
			array_shift($urlArray);
			$queryString = array_merge($queryId, $urlArray);
		} else {
			$action = $urlArray[0];
			array_shift($urlArray);
			$queryString = $urlArray;
		}
	} else {
		$controller = DEFAULT_CONTROLLER;
		$action = DEFAULT_ACTION;
		$queryString = array();
	}

	$controllerName = $controller;
	$controller = ucwords($controller);
	//$model = rtrim($controller, 's');
	$model = $controller;
	$controller .= 'Controller';

	#Control de archivos
	if(file_exists(ROOT . DS . 'application' . DS . 'controllers' . DS . strtolower($controller) . '.php')){
		require_once(ROOT . DS . 'application' . DS . 'controllers' . DS . strtolower($controller) . '.php');
	}
	if(file_exists(ROOT . DS . 'application' . DS . 'models' . DS . strtolower($model) . '.php')){
		require_once(ROOT . DS . 'application' . DS . 'models' . DS . strtolower($model) . '.php');
	}
        if(file_exists(ROOT . DS . 'application' . DS . 'lang' . DS . 'es' . DS . strtolower($model) . DS . strtolower($action) . '.php')){
		require_once(ROOT . DS . 'application' . DS . 'lang' . DS . 'es' . DS . strtolower($model) . DS . strtolower($action) . '.php');
        }
	
	//$dispatch = new $controller($model, $controllerName, $action);
	
	//if ((int)method_exists($controller, $action)) {
	if (class_exists($controller) && (int)method_exists($controller, $action)) {
		$dispatch = new $controller($model, $controllerName, $action);
		call_user_func_array(array($dispatch, $action), $queryString);
	} else {
		/* Error Generation Code Here */
	}
}

/** Autoload any classes that are required **/
function __autoload($className) {
	if (file_exists(ROOT . DS . 'library' . DS . strtolower($className) . '.class.php')) {
		require_once(ROOT . DS . 'library' . DS . strtolower($className) . '.class.php');
	} else if (file_exists(ROOT . DS . 'application' . DS . 'controllers' . DS . strtolower($className) . '.php')) {
		require_once(ROOT . DS . 'application' . DS . 'controllers' . DS . strtolower($className) . '.php');
	} else if (file_exists(ROOT . DS . 'application' . DS . 'models' . DS . strtolower($className) . '.php')) {
		require_once(ROOT . DS . 'application' . DS . 'models' . DS . strtolower($className) . '.php');
	} else {
		/* Error Generation Code Here */
	}
}

setReporting();
removeMagicQuotes();
// unregisterGlobals();
callHook();
