<?php

/**
 * @author Timothy Dunn
 * @copyright 2010
 */

include("header.php");

$uid = $facebook->getUser();

$sql = "INSERT INTO accessLog VALUES (null, '".$_SESSION['id']."', '".$_SERVER['PHP_SELF']."', '".$_SERVER['HTTP_REFERER']."', '".$_SERVER['REMOTE_ADDR']."', '".$_SERVER['HTTP_USER_AGENT']."', null)";
$database->Execuite($sql);



$accessToken = $facebook->getAccessToken();

    $url = "https://graph.facebook.com/me/accounts?access_token=" . $accessToken;
    $tmpJson = @file_get_contents($url); 
    $jsonDecode = json_decode($tmpJson);
    $accounts = objectToArray($jsonDecode);  
            

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
    
    
    <table width="100%" border="0" class="pollHead">
        <thead>
            <tr>
                <th> Create a Poll </th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>
                    
                    <table width="100%" border="0" class="poll">
                        <tbody>
                            <tr>
                                <td>Post to page/group('s)</td>
                                <td>
                                
                                    <select size="5" name="to" id="To" style="width: 290px;" multiple="multiple">
                                        <option value="wall">Post to my Wall</option>
                                        <?
                                            foreach($accounts['data'] as $index => $value){
                                                print('<option value="'.$value['id'].'">'.$value['name'].'</option>');
                                            }
                                        ?>
                                    </select>
                                
                                </td>
                            </tr>
                            <tr>
                                <td>Poll Question</td>
                                <td><input type="text" name="question" size="75"></td>
                            </tr>
                            <tr>
                                <td>Poll Options</td>
                                <td>
                                    <textarea rows="6" name="options" cols="50"></textarea><br />momothpr
                                    (NOTE: Only the first 6 Options will count, ($1) more for every 3 options after that.)
                                </td>
                            </tr>
                            <tr>
                                <td>Button Caption</td>
                                <td><input type="text" name="buttons" size="75"></td>
                            </tr>
                            <tr>
                                <td>Poll Settings</td>
                                <td>                                    
                                    <input type="checkbox" name="paidOptions" value="postPoll" /> Post this poll on page's wall. <br />
                                    <input type="checkbox" name="paidOptions" value="showFriends" /> Show who voted to everyone. <br />
                                </td>
                            </tr>
                            <tr>
                                <td>paid options here</td>
                                <td>
                                    <input type="checkbox" name="paidOptions" value="pollOpen" /> Make my poll open to anyone, even none facebook people. ($10) <br />
                                    <input type="checkbox" name="paidOptions" value="noAds" /> Don't show ad's on my poll page ($5) <br />
                                    <input type="checkbox" name="paidOptions" value="anyComment" /> Let none facebook people post comments. ($2) <br />
                                    <input type="checkbox" name="paidOptions" value="morePolls" /> Let me run more than one poll at a time. ($2)<br />
                                    (NOTE: You can only run one poll at a time, if you wish to run more than one poll it will be ($2)) <br />
                                    <input type="checkbox" name="paidOptions" value="differentTime" /> Let my poll run different length of time than the defaultc. ($2)<br />
                                    (NOTE: The default time is 1 week, in other to change this time to make your poll run shorter or longer there is a ($2) fee.) <br />
                                    <input type="checkbox" name="paidOptions" value="all" /> Full Package ($18) savings of ($7) dollars. <br />
                                </td>
                            </tr>
                            <tr>
                                <td></td>
                                <td> <button> Submit </button></td>
                            </tr>
                        </tbody>
                    </table>
                        
                        
                </td>
            </tr>
        </tbody>
    </table>

 
<?
include("footer.php");
?>
    
