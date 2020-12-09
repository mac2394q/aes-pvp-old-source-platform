<?php


class ApplicationController
{
        static public function process($defaultcontroller)
        {
                $params = array_merge($_GET, $_POST);

                // If there is no controller, assume default controller. If 
                // there is no action, assume index action
                if(!array_key_exists('controller', $params))
                                $params['controller'] = $defaultcontroller;
                if(!array_key_exists('action', $params))
                                $params['action'] = 'index';

                $controller = $params['controller'];
                $action = $params['action'];

                $classname =  $controller . "Controller";
                $filename = "controllers/" . $classname . ".php";
                if(!file_exists($filename))
                                die('No such controller');

                require_once($filename);

                $c = new ReflectionClass($classname);

                try
                {
                        $m = $c->getMethod($action);
                }
                catch(Exception $e)
                {
                        die('No such method');                                                  
                }

                $obj = new $classname();
                if($obj->wantsRawData($action))
                {
                        unset($_GET['controller']);
                        unset($_GET['action']);
                        $obj->setRawData($params, $_GET, $_POST);

                        unset($_GET);
                        unset($_POST);

                        call_user_func_array(array($obj, $action), array());
                }
                else
                {
                        // Send data as parameters
                        $callparams = array();
                        foreach($m->getParameters() as $reflparam)
                        {
                                        if(!array_key_exists($reflparam->getName(), $params))
                                                        die('Parameter that is\'t there is required');
                                        array_push($callparams, $params[$reflparam->getName()]);
                        }

                        unset($_GET);
                        unset($_POST);

                        call_user_func_array(array($obj, $action), $callparams);
                }
        }


        static function buildAbsUrl($controller, $action, $params = array())
        {
                require('config/config.php');
                $url = $_CONFIG['absurl'] . 
                                "index.php?controller={$controller}" .
                                "&action={$action}";

                // TODO: URL encoding...
                foreach($params as $key => $val)
                {
                                $url .= "&{$key}={$val}";
                }

                return $url;
        }
}


?>