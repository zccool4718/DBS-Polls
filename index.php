<?php

/**
 * @author Timothy Dunn
 * @copyright 2010
 */

include("header.php");

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
    
