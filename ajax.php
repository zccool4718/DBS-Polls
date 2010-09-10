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
                                      DATE_ADD(CURDATE(), INTERVAL 5 DAY),
                                      '".serialize($_POST['features'])."',
                                      ".$_POST['price'].",
                                      null)";

$pollID = $database->Execuite($sql);
?>

    <script type="text/javascript">
   FB.ui({
        method: 'stream.publish',
        message: 'I just made a new pool at DBS Polls, got time to answer a question?',
        action_links: [
            { text: 'Make your Own poll', href: 'http://pollsystem.dbscode.com/newPoll.php' }
        ],
        attachment: {                       
            user_message_prompt: 'Share your poll',
            caption: '<?=$_POST['question']?>',
            properties: {
                
                <?
                    foreach($_POST['options'] as $index => $value){
                        $output .= "'".($index -1)."': { 'text': '".$value."', 'href': 'http://apps.facebook.com/dbspolls/poll.php?ID=".$pollID."&answer=".($index -1)."'},";
                    }
                    $output = substr($output, 0, -1);
                    print($output);
                ?>
            }
        }
    );
    </script>
<?






?>