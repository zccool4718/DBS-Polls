<?php

/**
 * @author Timothy Dunn
 * @copyright 2010
 */

include("header.php");

$uid = $facebook->getUser();

print($uid);
		$facebook->api('/'.$uid.'/feed', 'post', array(
				'message' => 'The message',
				'name' => 'The name',
				'description' => 'The description',
				'caption' => 'The caption',
				'picture' => 'http://i.imgur.com/yx3q2.png',
				'link' => $fbconfig['app_url']
			));
			echo 'Posted!';
		# let's check if the user has granted access to posting in the wall
		$api_call = array(
			'method' => 'users.hasAppPermission',
			'uid' => $uid,
			'ext_perm' => 'publish_stream'
		);
		$can_post = $facebook->api($api_call);
                
                print_r($can_post);
		if($can_post){
			# post it!
			# $facebook->api('/'.$uid.'/feed', 'post', array('message' => 'Saying hello from my Facebook app!'));
			
			# using all the arguments
			$facebook->api('/'.$uid.'/feed', 'post', array(
				'message' => 'The message',
				'name' => 'The name',
				'description' => 'The description',
				'caption' => 'The caption',
				'picture' => 'http://i.imgur.com/yx3q2.png',
				'link' => $fbconfig['app_url']
			));
			echo 'Posted!';
		} else {
			die('Permissions required!');
		}

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
    
