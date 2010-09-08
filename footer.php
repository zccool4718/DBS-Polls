<?php

/**
 * @author Timothy Dunn
 * @copyright 2010
 */

?>

    <table with="100%" class="footer" cellpadding="0" cellspacing="0">
        <tbody>
            <td class="mainFoot center font10">
            <?    
                $pageGenTime = timer(true);    
                
                $sql = "INSERT INTO pageLoadTimes VALUES (null, '".$_SERVER['PHP_SELF']."', '".$pageGenTime."', null)";
                $database->Execuite($sql);
                
                print("Copyrighted Dreambox Services 2010 - 2020 - Page generated in " . $pageGenTime . " seconds");
            
            ?>
            </td>
        </tbody>
    </table>
</body>
</html>
