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

         
    $sql = "SELECT * FROM pollPaidOptions";
    $paidOptions = $database->query($sql);       

?>
    <script type="text/javascript">
        window.fbAsyncInit = function() {
            FB.init({appId: '<?=$fbconfig['app_ID']?>', status: true, cookie: true,
            xfbml: true});
        };
        
        $(document).ready(function(){            
            $('.dataTable').dataTable({			
                "sPaginationType": "full_numbers",					
                "bJQueryUI": true,          
            });            

            $('#PollSubmit').bind('click', function(){
                var price = 0;                
                var params = {};
                params['features'] = {};
                var count = 0;
                $('#paidOptions').find(':input').each(function(){
                    if($(this).is(':checked')){
                        params['features'][count] = $(this).val();
                        count++;
                        if(parseFloat($(this).attr("alt")) > 10){                            
                            price = parseFloat($(this).attr("alt"));
                        } else {
                            price = price + parseFloat($(this).attr("alt"));
                        }
                    }
                });
                
                if(price != 0){
                    $('#total').val("$"+price);                    
                    params['price'] = price;
                } else {
                    $('#total').val("Free");                
                    params['price'] = 0;
                }    
		
                var options;
                var optionsPrint = "";
                if($('#question').val() != "" && $('#options').val() != "" && $('#options').val().lenght != 0){
                    params['userID'] = '<?=$uid?>';
                    params['question'] = $('#question').val();
                    params['postTo'] = $('#postTo').val();
                    if($('#postPoll').is(':checked')){
                        params['postPoll'] = $('#postPoll').val();
                    }
                    params['options'] = $('#options').val();
                    options = $('#options').val().split("\n")
                    
                
                    
                    var pollID = 0;
                    return $.ajax({
                        type: "POST",
                        url: "ajax.php",
                        data: params,
                        dataType: 'html',
                        success: function(output){
                            alert(output);
                                for(var i in options){
                                    optionsPrint = optionsPrint + "'" + i + "': { 'text': '" + options[i] + "', 'href': 'http://apps.facebook.com/dbspolls/poll.php?ID=" + output + "&answer=" + i +"'},";
                                }
                                
                                optionsPrint = optionsPrint.substring(0, optionsPrint.length-1);
                                alert(optionsPrint);
                             FB.ui({
                                method: 'stream.publish',
                                message: 'I just made a new pool at DBS Polls, got time to answer a question?',
                                action_links: [
                                    { text: 'Make your Own poll', href: 'http://pollsystem.dbscode.com/newPoll.php' }
                                ],
                                attachment: {                       
                                    user_message_prompt: 'Share your poll',
                                    caption: $('#question').val(),
                                    properties: { optionsPrint }
                                }
                             });
                            
                        }
                    });  
                } else {
                    alert("All fields are requited");
                }
                
                
		
                
            });
        });
    </script>
    <div id="fb-root"></div>


    <table width="100%" cellpadding="0" cellspacing="0" class="poll font10">
        <thead>
            <tr>
                <td class="font12b">
                    Total: <input type="text" id="total" name="total" class="total" value="Free" style="width: 60px;">
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
                                    <?
                                        foreach($accounts['data'] as $index => $value){
                                            print('<option value="'.$value['id'].'">'.$value['name'].'</option>');
                                        }
                                    ?>
                                </select>
                            </td>
                            <td class="postToQuestion font10bi">                            
                                <input type="checkbox" id="postPoll" value="postPoll" /> Post this poll on page's wall. <br />
                                <hr />                                
                                <div class="note font10bi"> Get your poll notice and post on your wall.</div>
                            </td>
                        </tr>
                    </table>
                
                </td>
            </tr>
            <tr>
                <td class="title">Poll Question</td>
                <td><input type="text" id="question"class="question"></td>
            </tr>
            <tr>
                <td class="title">Poll Options<br />
                    <div class="note font10i">(one per line).</div>
                
                </td>
                <td>
                    <textarea rows="5" id="options" class="options" cols="50"></textarea><br />
                    <div class="note font10i">NOTE: Only the first 6 Options are free, ($1) for every 3 options after that.</div>
                </td>
            </tr>
            <tr>
                <td class="title">Paid Features</td>
                <td ID="paidOptions" class="paidOptions">
                    <?                        
                        foreach($paidOptions as $index => $value){
                            print('<input type="checkbox" ID="'.$value['id'].'" value="'.$value['id'].'" alt="'.$value['price'].'" /> '.$value['text'].' ($'.$value['price'].') <br />');
                            if(!empty($value['note'])){
                                print('<div class="note font10i">NOTE: '.$value['note'].'</div> <br />');
                            }
                        }
                    ?>
                </td>
            </tr>
            <tr>
                <td class="title"></td>
                <td> <button class="PollSubmit" ID="PollSubmit"> Submit </button></td>
            </tr>
        </tbody>
    </table>

 
<?
include("footer.php");
?>
    
