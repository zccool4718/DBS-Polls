<?php

/**
 * @author Timothy Dunn
 * @copyright 2010
 */

session_start();

function getDBinfo(){
    $db["host"]     = "localhost";
    $db["username"] = "pollsystem";
    $db["password"] = " !";
    $db["database"] = "pollsystem_Facebook";
    return $db;
}

function getFacebookInfo(){    
    $fbConfig['api_key'] = " ";
    $fbConfig['app_ID'] = " ";
    $fbConfig['app_secret'] = " ";
    $fbConfig['app_url'] = "http://apps.facebook.com/dbspolls/";
    return $fbConfig;
}
?>
