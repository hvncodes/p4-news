<?php
/**
 * footer_inc.php provides the right panel and footer for our site pages 
 *
 * Includes dynamic copyright data 
 *
 * @package nmCommon
 * @author Bill Newman <williamnewman@gmail.com>
 * @version 2.091 2011/06/17
 * @link http://www.newmanix.com/  
 * @license https://www.apache.org/licenses/LICENSE-2.0
 * @see template.php
 * @see header_inc.php 
 * @todo none
 */
?>
	  <!-- footer include starts here -->
	  </td>
	  <!-- right panel starts here -->	
	  <!-- change right panel color here -->
      	<td width="175" valign="top">
		<? echo $config->sidebar2; ?>
        </td>
	</tr>
      <!-- change footer color here -->
	<tr>
		<td colspan="3">
			<p align="center">Always include some sort of copyright notice, for example:</p>
	        <p align="center"><em>&copy; Team Awesome, 2018 - <?php echo date("Y");?></em></p>
	        <div>Icons made by <a href="http://www.freepik.com" title="Freepik">Freepik</a> from <a href="https://www.flaticon.com/" title="Flaticon">www.flaticon.com</a> is licensed by <a href="http://creativecommons.org/licenses/by/3.0/" title="Creative Commons BY 3.0" target="_blank">CC 3.0 BY</a></div>
		</td>
  </tr>
</table>
</body>
</html>