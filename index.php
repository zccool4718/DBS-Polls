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

    $url = "https://graph.facebook.com/me/friends?access_token=" . $accessToken;
    $tmpJson = @file_get_contents($url); 
    $jsonDecode = json_decode($tmpJson);
    $friends = objectToArray($jsonDecode);  
            

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
                                <td>  insert multi select statement here  </td>
                            </tr>
                            <tr>
                                <td>poll type</td>
                                <td>  insert poll type here  </td>
                            </tr>
                            <tr>
                                <td>Question</td>
                                <td>  insert question field here based on poll type </td>
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
    
    
    
    
    <br />
    <br />
    <br />
    <br />
    <br />
    <hr />
    <br />
    <br />
    
    
    
 <table width="100%" border="0" class="display dataTable mediaTable">
        <thead style="height: 19px;">
            <tr style="white-space: nowrap;">
                <th> ID </th>
                <th> Name </th>
            </tr>
        </thead>
        <tbody>
            
            <?
            $friends;
            
            foreach($friends['data'] as $index  => $value){
                print('                    
                    <tr>
                        <td>'.$value['id'].'</td>
                        <td><img src="https://graph.facebook.com/'.$value['id'].'/picture" style="width: 16px; height: 16px;">'.$value['name'].'</td>
                    </tr>          
                ');
            }
            ?>
        </tbody>
        <tfoot>
            <tr >
                <th> ID </th>
                <th> Name </th>
            </tr>
        </tfoot>
    </table>
 
 
<?
include("footer.php");
?>
    
