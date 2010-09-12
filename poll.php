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
    
    $sql = "SELECT count(*) as count FROM `pollResults` WHERE pollID = ". $_GET['ID'];
    $count = $database->query($sql);
    $count = $count['count'];
    
    foreach($pollResults as $index => $value){       
        $results[$value['answers']] = $results[$value['answers']] + 1;
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
$poll['options'] = unserialize($poll['options']);
print_r($poll['options']);

    print('
        <script type="text/javascript">
            $(document).ready(function(){
    ');
foreach($results as $index => $value){
    print('
            $("#progressbar_'.$index.'").progressbar({
                value: '.(($value / $count) * 100).'
            });
            
    ');
}

    print('
            });
        </script>
    ');
?>

    
    <table class="resultsTable" cellpadding="0" cellspacing="0" width="100%">
        <thead>
            <tr>
                <th colspan="4"> Poll Results </th>
            </tr>
            <tr>
                <td colspan="3">View | Delete | Edit | Invite Friends to Vote </td>
                <td id="votes" class="votes"> Total Votes: XX </td>
            </tr>
        </thead>
        <tbody>
            <? foreach($results as $index => $value){
                print('
                    <tr>
                        <td> $index
                        </td>
                        <td style="width: 200px;"><div id="progressbar_'.$index.'" style="height: 16px;"></div> 
                        </td>
                        <td>
                        '.(($value / $count) * 100).'%
                        </td>
                        <td>
                            ('.$value.') Votes
                        </td>
                    </tr>
                ');
            }
            ?>
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
    
