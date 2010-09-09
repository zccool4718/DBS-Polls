<?php

/**
 * @author Timothy Dunn
 * @copyright 2010
 */

require("includes/facebook.php");
require("includes/config.php");
require("includes/common.php");
require("classes/class.database.php");

$database = new database(getDBinfo());

$_POST['options'] = explode("\n", $_POST['options']);
$_POST['optionsCount'] = count($_POST['options']);

if(count($_POST['options']) > 6){
    $tmp = count($_POST['options']) - 6;
    
    $_POST['math'][] = $tmp / 3;
    $tmp = ceil($tmp / 3);
    $_POST['math'][] = $tmp;
    
    $_POST['price'] += $tmp;
}
// now() + 5days - run to
$sql = "INSERT INTO poll values(null, '".$_POST['userID']."',
                                      '".serialize($_POST['postTo'])."',
                                      '".$_POST['type']."',
                                      '".$_POST['question']."',
                                      '".serialize($_POST['options'])."',
                                      '".$_POST['buttons']."'
                                      'now()',
                                      '".serialize($_POST['id'])."', null)";
$database->Execuite($sql);

print_r($sql);
?>