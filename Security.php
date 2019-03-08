<?php
namespace mcanan;

class Security extends \mcanan\framework\BasicSecurity
{
    function isAuthorized($url, $controller, $action, $parameters)
    {
        if ($controller=='login'){
			return true;
        }
        
        if (!isset($_SESSION)){
            session_start();
        }
        if (isset($_SESSION[self::VARIABLE_NAME])){
            return true;
        } else {
            return false;
        }
    }

    function getAccessDeniedUrl()
    {
        return "/login";
    }
}
