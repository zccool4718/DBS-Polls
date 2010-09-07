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
    
    
    <table width="100%" border="0">
        <thead>
            <tr>
                <th> Create a Poll </th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>
                    
                    <table width="100%" border="0">
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
                                <td>poll type</td>
                                <td>
                                    <input type="radio" name="pollType" value="a" /> Text Poll  <br />
                                    <input type="radio" name="pollType" value="b" /> Image Poll <br />
                                    <input type="radio" name="pollType" value="c" /> Video Poll <br />
                                    <input type="radio" name="pollType" value="d" /> Custom Poll<br />
                                    
                                </td>
                            </tr>
                            <tr>
                                <td>Question</td>
                                <td><input type="text" name="question" size="100"></td>
                            </tr>
                            <tr>
                                <td>options</td>
                                <td>  insert options field here based on poll type </td>
                            </tr>
                            <tr>
                                <td>buttons</td>
                                <td>  insert different options for buttons </td>
                            </tr>
                            <tr>
                                <td>post options</td>
                                <td>  add posting options </td>
                            </tr>
                            <tr>
                                <td>paid options here</td>
                                <td>  add posting options </td>
                            </tr>
                            <tr>
                                <td></td>
                                <td> submit options here </td>
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
    
