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
    
    
    <table width="100%" cellpadding="0" cellspacing="0" class="poll font10">
        <thead>
            <tr>
                <td class="font12b"> Total: <div class="total"> Free </div> </td>
                <th class="font16b"> Create a Poll </th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td class="title"><br /><br />Post to page/group('s)</td>
                <td>
                <br /><br />
                    <select size="5" name="postTo" class="postTo" id="postTo" multiple="multiple">
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
                <td class="title">Poll Question</td>
                <td><input type="text" name="question"class="question"></td>
            </tr>
            <tr>
                <td class="title">Poll Options</td>
                <td>
                    <textarea rows="5" name="options" class="options" cols="50"></textarea><br />
                    <div class="note font10i">NOTE: Only the first 6 Options will count, ($1) more for every 3 options after that.</div>
                </td>
            </tr>
            <tr>
                <td class="title">Button Caption</td>
                <td><input type="text" name="buttons" class="buttons"></td>
            </tr>
            <tr>
                <td class="title">Poll Settings</td>
                <td>                                    
                    <input type="checkbox" name="paidOptions" value="postPoll" /> Post this poll on page's wall. <br />
                    <input type="checkbox" name="paidOptions" value="showFriends" /> Show who voted to everyone. <br /><br /><br />
                </td>
            </tr>
            <tr>
                <td class="title">Paid features</td>
                <td>
                    <input type="checkbox" name="paidOptions" value="pollOpen" /> Make my poll open to anyone, even none facebook people. ($10) <br />
                    <input type="checkbox" name="paidOptions" value="noAds" /> Don't show ad's on my poll page ($5) <br />
                    <input type="checkbox" name="paidOptions" value="anyComment" /> Let none facebook people post comments. ($2) <br />
                    <input type="checkbox" name="paidOptions" value="morePolls" /> Let me run more than one poll at a time. ($2)<br />
                    <div class="note font10i">NOTE: You can only run one poll at a time, if you wish to run more than one poll it will be ($2)</div> <br />
                    <input type="checkbox" name="paidOptions" value="differentTime" /> Let my poll run different length of time than the defaultc. ($2)</div><br />
                    <div class="note font10i">NOTE: The default time is 5 days, to make your poll run shorter or longer there is a ($2) fee.</div> <br />
                    <input type="checkbox" name="paidOptions" value="all" /> Full Package ($18) savings of ($7) dollars. <br />
                </td>
            </tr>
            <tr>
                <td class="title"></td>
                <td> <button class="PollSubmit"> Submit </button></td>
            </tr>
        </tbody>
    </table>

 
<?
include("footer.php");
?>
    
