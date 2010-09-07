<?php

/**
 * @author Timothy Dunn
 * @copyright 2010
 */

require("includes/facebook.php");
require("includes/config.php");
require("classes/class.database.php");

$fbconfig = getFacebookInfo();

$database = new database(getDBinfo());
$facebook = new Facebook(array(
        'appId'  => $fbconfig['app_ID'],
        'secret' => $fbconfig['app_secret'],
	'cookie' => true
));


if(isset($_REQUEST['fb_sig_user'])){
    $user['user_id'] = $_REQUEST['fb_sig_user'];
} else {    
    $user = parseSignedRequest($_REQUEST['signed_request'], $fbconfig['app_secret']);
}

$sql = "UPDATE `users` SET `active` = '0' WHERE `oauth_uid` = '" . $user['user_id'] . "';";
$database->Execuite($sql);

function base64UrlDecode($input) {
    return base64_decode(strtr($input, '-_', '+/'));
}

function parseSignedRequest($signed_request, $app_secret) {
    list($encoded_sig, $payload) = explode('.', $signed_request, 2);

    // decode the data
    $sig = base64UrlDecode($encoded_sig);
    $data = json_decode(base64UrlDecode($payload), true);

    if (strtoupper($data['algorithm']) !== 'HMAC-SHA256') {
    //  self::errorLog('Unknown algorithm. Expected HMAC-SHA256');
      return null;
    }

    // check sig
    $expected_sig = hash_hmac('sha256', $payload, $app_secret, $raw = true);
    if ($sig !== $expected_sig) {
   //   self::errorLog('Bad Signed JSON signature!');
      return null;
    }

    return $data;
}
unset($_SESSION);
unset($_COOKIE);

?>