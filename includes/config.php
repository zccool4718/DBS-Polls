<?php

/**
 * @author Timothy Dunn
 * @copyright 2010
 */

session_start();

function getDBinfo(){
    $db["host"]     = "localhost";
    $db["username"] = "Oastage";
    $db["password"] = "Qazxsw2!";
    $db["database"] = "oastage_Facebook";
    return $db;
}

function getFacebookInfo(){    
    $fbConfig['api_key'] = "d7dda33b7b3e753a20fe7f1664d62911";
    $fbConfig['app_ID'] = "149980235024093";
    $fbConfig['app_secret'] = "a8e382ed34c3b0180b551b0a50a1c3ff";
    $fbConfig['app_url'] = "http://apps.facebook.com/oastage/";
    return $fbConfig;
}
?>