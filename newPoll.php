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
            
            
            $('#pollOpen').bind('change', function(){
                alert(this.val());
            })
        });
    </script>
    
    
    <table width="100%" cellpadding="0" cellspacing="0" class="poll font10">
        <thead>
            <tr>
                <td class="font12b">
                    Total: <input type="text" name="total" class="total" value="Free" disabled="disabled">
                        <div class="promo"> One random person who buys a full monthy package will win a full yearly package. END's Nov 14, 2010. </div>
                </td>
                <th class="font16b"> Create a Poll </th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td class="title"><br /><br />Post to Page('s) / Group('s)</td>
                <td>
                <br /><br />
                    <table class="postToTable">
                        <tr>
                            <td class="postToList">
                                <select size="5" name="postTo" class="postTo" id="postTo" multiple="multiple">
                                    <option value="wall">Post to my Wall</option>
                                    <?
                                        foreach($accounts['data'] as $index => $value){
                                            print('<option value="'.$value['id'].'">'.$value['name'].'</option>');
                                        }
                                    ?>
                                </select>
                            </td>
                            <td class="postToQuestion font10bi">                            
                                <input type="checkbox" name="postPoll" value="postPoll" /> Post this poll on page's wall. <br />
                                <input type="checkbox" name="showFriends" value="showFriends" /> Show who voted to everyone. <br />
                                <hr />                                
                                <div class="note font10bi"> Get your poll notice and post on your wall.</div>
                            </td>
                        </tr>
                    </table>
                
                </td>
            </tr>
            <tr>
                <td class="title">Poll Question</td>
                <td><input type="text" name="question"class="question"></td>
            </tr>
            <tr>
                <td class="title">Poll Options<br />
                    <div class="note font10i">(one per line).</div>
                
                </td>
                <td>
                    <textarea rows="5" name="options" class="options" cols="50"></textarea><br />
                    <div class="note font10i">NOTE: Only the first 6 Options are free, ($1) for every 3 options after that.</div>
                </td>
            </tr>
            <tr>
                <td class="title">Button Caption</td>
                <td><input type="text" name="buttons" class="buttons"></td>
            </tr>
            <tr>
                <td class="title">Paid Features</td>
                <td>
                    <input type="checkbox" name="pollOpen" value="pollOpen" /> Open this poll to non Facebook users. ($10) <br />
                    <input type="checkbox" name="noAds" value="noAds" /> Don't show ad's on my poll page. ($5) <br />
                    <input type="checkbox" name="anyComment value="anyComment" /> Let non facebook people post comments. ($2) <br />
                    <input type="checkbox" name="manyVotes" value="manyVotes" /> Let users vote as many times as they wish. ($2)</div><br />
                    <input type="checkbox" name="differentTime" value="differentTime" /> Let my poll run different length of time than the default. ($2)</div><br />
                    <div class="note font10i">NOTE: The default time is 5 days.</div> <br />
                    <input type="checkbox" name="all" value="all" /> Full Package ($15) savings of ($6) dollars. <br />
                    <input type="checkbox" name="allMonth" value="allMonth" /> Monthy Full Package. ($50) <br />
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
    
