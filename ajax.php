<?php

/**
 * @author Timothy Dunn
 * @copyright 2010
 */

$_POST['options'] = explode("\n", $_POST['options']);
$_POST['optionsCount'] = count($_POST['options']);

if(count($_POST['options']) > 6){
    $tmp = count($_POST['options']) - 6;
    
    $_POST['math'][] = $tmp / 3;
    $tmp = ceil($tmp / 3);
    $_POST['math'][] = $tmp;
    
    $_POST['price'] += $tmp;
}

print_r($_POST);
?>