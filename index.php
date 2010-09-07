<?php

/**
 * @author Timothy Dunn
 * @copyright 2010
 */

include("header.php");

$uid = $facebook->getUser();
$accessToken = $facebook->getAccessToken();

$url = "https://graph.facebook.com/me/friends?access_token=".$accessToken;

            $tmpJson = file_get_contents($url); 
            $jsonDecode = json_decode($tmpJson);
            print_r($jsonDecode);
            
            

print($uid);

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
                <th> testing </th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td> Testing jquery with in facebook 0</td>
            </tr>
            <tr>
                <td> Testing jquery with  facebook 1</td>
            </tr>
            <tr>
                <td> Testing  with in facebook 2</td>
            </tr>
            <tr>
                <td> Testing jquery with in  3</td>
            </tr>
        </tbody>
        <tfoot>
            <tr >
                <th> testing </th>
            </tr>
        </tfoot>
    </table>
 
 
<?
include("footer.php");
?>
    
