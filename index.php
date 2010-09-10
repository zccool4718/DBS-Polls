<?php

/**
 * @author Timothy Dunn
 * @copyright 2010
 */

include("header.php");

$uid = $facebook->getUser();

$sql = "INSERT INTO accessLog VALUES (null, '".$_SESSION['id']."', '".$_SERVER['PHP_SELF']."', '".$_SERVER['HTTP_REFERER']."', '".$_SERVER['REMOTE_ADDR']."', '".$_SERVER['HTTP_USER_AGENT']."', null)";
$database->Execuite($sql);



//$accessToken = $facebook->getAccessToken();
//    $friends = array();
//    $friends['data'] = array();
//    $url = "https://graph.facebook.com/me/friends?access_token=" . $accessToken;
//    $tmpJson = @file_get_contents($url); 
//    $jsonDecode = json_decode($tmpJson);
//    $friends = objectToArray($jsonDecode);  
            

/**
		$facebook->api('/'.$uid.'/feed', 'post', array(
				'message' => ' <input type="radio" name="checkGroup" class="inpt" value="a" />  Was the caller live transferred to alternate campus? <br />
		    <input type="radio" name="checkGroup" class="inpt" value="b" />  Was the caller transferred to alternate campus?
                                ',
				'name' => 'The name',
				'description' => 'The description',
				'caption' => 'The caption',
				'picture' => 'http://i.imgur.com/yx3q2.png',
				'link' => $fbconfig['app_url']
			));
                
*/

                

?>
    <script type="text/javascript">
        $(document).ready(function(){
            $('.dataTable').dataTable({			
                "sPaginationType": "full_numbers",					
                "bJQueryUI": true,          
            });   
        });
    </script>
    
    
 <table width="100%" border="0" class="display dataTable mediaTable">
        <thead style="height: 19px;">
            <tr style="white-space: nowrap;">
                <th> ID </th>
                <th> Poll Question </th>
                <th> Poll Answers </th>
                <th> Running Until </th>
            </tr>
        </thead>
        <tbody>
            
            <?
            $sql = "SELECT * FROM `poll` WHERE userID = '" . $uid . "'";
            $polls = $database->query($sql);


            foreach($polls as $index  => $value){
                $answers = unserialize($value['options']);
                $answers = implode(", ", $answers);
                print('                    
                    <tr>
                        <td>'.$value['id'].'</td>
                        <td>'.$value['questions'].'</td>
                        <td>'.$answers.'</td>
                        <td>'.$value['runUntil'].'</td>
                    </tr>          
                ');
            }
            ?>
        </tbody>
        <tfoot>
            <tr >
                <th> ID </th>
                <th> Poll Question </th>
                <th> Poll Answers </th>
                <th> Running Until </th>
            </tr>
        </tfoot>
    </table>
 
 
<?
include("footer.php");
?>
    
