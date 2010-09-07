<?php

/**
 * @author Timothy Dunn
 * @copyright 2010
 */

include("header.php");

$uid = $facebook->getUser();
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
                        <td><img src="https://graph.facebook.com/'.$value['id'].'/picture">'.$value['name'].'</td>
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
    
