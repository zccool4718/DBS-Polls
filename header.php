<?php

/**
 * @author Timothy Dunn
 * @copyright 2010
 */


require("includes/facebook.php");
require("includes/config.php");
require("includes/common.php");
require("classes/class.database.php");


timer();

$fbconfig = getFacebookInfo();

$database = new database(getDBinfo());
$facebook = new Facebook(array(
        'appId'  => $fbconfig['app_ID'],
        'secret' => $fbconfig['app_secret'],
	'cookie' => true
));

$session = $facebook->getSession();

if(!empty($session)) {
	try{
            $uid = $facebook->getUser();
            $user = $facebook->api('/me');
	} catch (Exception $e){
            
        }
	if($user['id'] && $user['name']){
            $sql = "SELECT * FROM users WHERE oauth_provider = 'facebook' AND oauth_uid = ". $user['id'];
            $result = $database->query($sql);
	    
            if(count($result) == 0){
                $sql = "INSERT INTO users (oauth_provider, oauth_uid, username, active, timeStamp) VALUES ('facebook', {$user['id']}, '{$user['name']}', 1, null)";
               // print_r($sql);
                $database->Execuite($sql);
                $sql = "SELECT * FROM users WHERE id = " . mysql_insert_id();
                $result = $database->query($sql);
            }
            
            if($results['active'] == 0){
                $sql = "UPDATE users SET active = 1 WHERE oauth_uid = '" . $user['id'] . "'";
                $database->Execuite($sql);
            }
            
            $_SESSION['id'] = $result['id'];
            $_SESSION['oauth_uid'] = $result['oauth_uid'];
            $_SESSION['oauth_provider'] = $result['oauth_provider'];
            $_SESSION['username'] = $result['username'];
	} else {
		echo "something is wrong.";
        }
} else {
     $login_url = $facebook->getLoginUrl(array('canvas' => 1,
                                          'fbconnect' => 0,
                                          'req_perms' => 'publish_stream',
                                          'next' => $fbconfig['app_url'] . 'index.php',
                                          'cancel_url' => $fbconfig['app_url'] ));
     echo "<script type='text/javascript'>top.location.href = '$login_url';</script>";
}

?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html>
<head>
    <meta http-equiv="content-type" content="text/html; charset=iso-8859-1">
    <meta name="author" content="Timothy Dunn">
    <title> Index - Template</title>
    
    <style>
        @import "css/default/style.css";
        @import "css/custom-theme/jquery-ui-1.8.2.custom.css";
        @import "css/demo_table_jui.css";        
        @import "css/media.css";        
    </style>
    
    <!-- jquery + jquery UI includes -->
    <script type="text/javascript" language="javascript" src="js/jquery-1.4.2.min.js"></script>
    <script type="text/javascript" language="javascript" src="js/jquery-ui-1.8.4.custom.min.js"></script>  

    <!-- jquery + jquery UI includes Plugins-->  
    <script type="text/javascript" language="javascript" src="js/jquery.dataTables.js"></script>
    <script type="text/javascript" language="javascript" src="js/jquery-ui.dialog.js"></script>
    
    
</head>
<body>
    
    <table class="mainTable">
    <thead>
    <tr>
        <th class="menu left font12">
		<a href="index.php"> Home </a> | <a href="newPoll.php"> Start a new Poll </a> | <a href=""> Current Polls </a> | <a href=""> Buy Upgrades </a> 
        </th>
    </tr>   
    </thead>
    <tbody>
        <td colspan="2" class="mainBody font14"> 