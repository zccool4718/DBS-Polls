<?php

/**
 * @author Timothy Dunn
 * @copyright 2010
 */

session_start();

function getDBinfo(){
    $db["host"]     = "localhost";
    $db["username"] = "pollsystem";
    $db["password"] = "Qazxsw2!";
    $db["database"] = "pollsystem_Facebookc";
    return $db;
}

function getFacebookInfo(){    
    $fbConfig['api_key'] = "f6150475525e7dc0ed54fa64b13adc38";
    $fbConfig['app_ID'] = "156907777659800";
    $fbConfig['app_secret'] = "a94589c94c8b5f547d5d53211254e496";
    $fbConfig['app_url'] = "http://apps.facebook.com/dbspolls/";
    return $fbConfig;
}
?>