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
            
            //FB.ui({
            //    method: 'stream.publish',
            //    message: 'I just made a new pool at DBS Polls, why don\'t you take it.',
            //    action_links: [
            //        { text: 'Take Poll', href: 'http://pollsystem.dbscode.com/newPoll.php' },
            //        { text: 'Make your Own poll', href: 'http://pollsystem.dbscode.com/newPoll.php' }
            //    ],
            //    attachment: {                       
            //        user_message_prompt: 'Share your poll',
            //        caption: '<b> What one do you pick? </b>',
            //        properties: { 
            //            '1': { 'text': 'Answer 1 ', 'href': 'http://apps.facebook.com/dbspolls/poll.php?ID=1231423'}, 
            //            '2': { 'text': 'Answer 2 ', 'href': 'http://apps.facebook.com/dbspolls/poll.php?ID=1231423'}, 
            //            '3': { 'text': 'Answer 3 ', 'href': 'http://apps.facebook.com/dbspolls/poll.php?ID=1231423'}, 
            //            '4': { 'text': 'Answer 4 ', 'href': 'http://apps.facebook.com/dbspolls/poll.php?ID=1231423'}, 
            //            '5': { 'text': 'Answer 5 ', 'href': 'http://apps.facebook.com/dbspolls/poll.php?ID=1231423'},
            //            '6': { 'text': 'Answer 6 ', 'href': 'http://apps.facebook.com/dbspolls/poll.php?ID=1231423'}
            //        }
            //    }
            //    },
            //    function(response) {
            //        if (response && response.post_id) {
            //            alert('Post was published.');
            //        } else {
            //            alert('Post was not published.');
            //        }
            //    }
            //);            
            
            $('#PollSubmit').bind('click', function(){
                var price = 0;                
                var params = {};
                
                $('#paidOptions').find(':input').each(function(){
                    if($(this).is(':checked')){
                        if(parseFloat($(this).attr("alt") > 10){                            
                            price = parseFloat($(this).attr("alt"));
                        } else {
                            price = price + parseFloat($(this).attr("alt"));
                        }
                    }
                });
                
                if(price != 0){
                    $('#total').val("$"+price);                    
                } else {
                    $('#total').val("Free"); 
                }    
		
		//params['toggleID'] = $(this).attr("alt");
		//params['userID'] = '<?=$_SESSION['UserID']?>';
		//params['action'] = "undeleteToggle";
		//return $.ajax({
		//    type: "POST",
		//    url: "toggle_ajax.php",
		//    data: params,
		//    async: false,
		//    dataType: 'html',
		//    success: function(output){
		//	window.location.reload( false );
		//    }
		//});  
                
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
    
