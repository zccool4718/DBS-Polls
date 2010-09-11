<?php

/**
 * @author Timothy Dunn
 * @copyright 2010
 */

include("header.php");

$uid = $facebook->getUser();
if(isset($uid) && !empty($uid)){
  

$sql = "INSERT INTO accessLog VALUES (null, '".$_SESSION['id']."', '".$_SERVER['PHP_SELF']."', '".$_SERVER['HTTP_REFERER']."', '".$_SERVER['REMOTE_ADDR']."', '".$_SERVER['HTTP_USER_AGENT']."', null)";
$database->Execuite($sql);

if(!isset($_GET['ID'])){
    print(' <script type="text/javascript">
                top.location.href = "http://apps.facebook.com/dbspolls/";
            </script>');
} elseif($_GET['ID'] > 0){
    $sql = "SELECT *, count(*) FROM `poll` WHERE id = '" . $_GET['ID'] . "'";
    $poll = $database->query($sql);
    
    if(count($poll) > 0){
        if(isset($_GET['answer'])){
            $sql = "INSERT INTO pollResults values (null, " . $_GET['ID'] . ", '".$uid."', '".$_GET['answer']."', null, '".$_SERVER['REMOTE_ADDR']."', '".$_SERVER['HTTP_REFERER']."')";
            $database->Execuite($sql);
            print("Thank you for your vote.");
        }
    } else {
        print(' <script type="text/javascript">
                    top.location.href = "http://apps.facebook.com/dbspolls/";
                </script>');
    }

} else {
    print(' <script type="text/javascript">
                top.location.href = "http://apps.facebook.com/dbspolls/";
            </script>');
    
}

?>
        <link type="text/css" rel="stylesheet" href="css/default/style.css" />
    <table class="resultsTable" cellpadding="0" cellspacing="0" width="100%">
        <thead>
            <tr>
                <th colspan="2"> Poll Results </th>
            </tr>
            <tr>
                <td>View | Delete | Edit | Invite Friends to Vote </td>
                <td id="votes" class="votes"> Votes: </td>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>1
                </td>
                <td>2
                </td>
            </tr>
        </tbody>
    </table>
    
    



 
 
<?

  
} else {
    print(' <script type="text/javascript">
                top.location.href = "http://apps.facebook.com/dbspolls/";
            </script>');
    
}


include("footer.php");
?>
    
