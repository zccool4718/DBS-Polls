<?php

/**
 * @author Timothy Dunn
 * @copyright 2010
 */

?>
    </td>
        </tbody>
        <tfoot>
            <td colspan="2" class="mainFoot center font10">
            <?    
                $pageGenTime = timer(true);    
                $kbps=measure_kbps($pageGenTime);
                $mbps=$kbps / 1024;
                print("Copyrighted Dreambox Services 2010 - 2020 - Page generated in " . $pageGenTime . " seconds");
            
            ?>
            </td>
        </tfoot>
    </table>
</body>
</html>
