<?php

/**
 * @author Timothy Dunn
 * @copyright 2010
 */

require("includes/config.php");
require("includes/common.php");

timer();
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html>
<head>
    <meta http-equiv="content-type" content="text/html; charset=iso-8859-1">
    <meta name="author" content="Timothy Dunn">
    <title> Index - Template</title>
    
    <style>
        @import "css/default/style.css";
        @import "css/custom-theme/jquery-ui-1.8.2.custom.css";
        @import "css/demo_table_jui.css";        
        @import "css/media.css";        
        
        
    </style>
    
    <!-- jquery + jquery UI includes -->
    <script type="text/javascript" src="js/jquery-1.4.2.min.js"></script>
    <script type="text/javascript" src="js/jquery-ui-1.8.4.custom.min.js"></script>
    <script type="text/javascript" language="javascript" src="js/jquery.dataTables.js"></script>
    

    <!-- jquery + jquery UI includes Plugins-->
    <script type="text/javascript" language="javascript" src="js/jquery-ui.dialog.js"></script>
    
    <!-- Javascript -->
    <script type="text/javascript">
        $(document).ready(function(){
            $("#dialog").dialog("destroy");
                      
            $('.dataTable').dataTable({			
                "sPaginationType": "full_numbers",					
                "bJQueryUI": true,          
            });   
        });
        

</script>
    
</head>
<body>
    
    <table class="mainTable">
        <thead>
        <tr>
            <th class="mainMenu left font12">
                <ul>
                    <li class="mainMenuSelected">Home</li>
                    <li><a href="">Links</a></li>
                    <li><a href="">Admin</a></li>
                </ul>
            </th>
        </tr>   
        </thead>
        <tbody>
            <td colspan="2" class="mainBody font14"> This is body
            
            
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
            
            
            
            
            
            
            
            
            
                
            </td>
        </tbody>
        <tfoot>
            <td colspan="2" class="mainFoot center font10">
            <?    
                $pageGenTime = timer(true);    
                $kbps=measure_kbps($pageGenTime);
                $mbps=$kbps / 1024;
                print("Page generated in " . $pageGenTime . " seconds");
                
                
            
            ?>
            </td>
        </tfoot>
    </table>
    
</body>
</html>