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
    $sql = "SELECT * FROM `poll` WHERE id = '" . $_GET['ID'] . "'";
    $poll = $database->query($sql);
    
    $sql = "SELECT * FROM `pollResults` WHERE pollID = ". $_GET['ID'];
    $pollResults = $database->query($sql);

    foreach($pollResults as $index => $value){       
        $results[$value['answers']] = $value['id'];
    }
    
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

print_r($results);

?>

    
    <table class="resultsTable" cellpadding="0" cellspacing="0" width="100%">
        <thead>
            <tr>
                <th colspan="3"> Poll Results </th>
            </tr>
            <tr>
                <td>View | Delete | Edit | Invite Friends to Vote </td>
                <td></td>
                <td id="votes" class="votes"> Votes: </td>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>1
                </td>
                <td><div id="progressbar"></div>

                </td>
                <td>XX votes
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
    
