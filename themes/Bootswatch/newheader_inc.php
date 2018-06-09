<?php
/**
 * header_inc.php provides the initial HTML and left panel for our site files 
 *
 * An include file named meta_inc.php includes all meta data, title tag and a place to 
 * install JS via a variable named $loadHead
 *
 * @package news_aggregator
 * @author Lori, John, Calvin and Gabby
 * @version 1 2018/6/6
 * @link YOUR LINK HERE 
 * @license https://www.apache.org/licenses/LICENSE-2.0
 * @see meta_inc.php
 * @see footer_inc.php 
 * @todo none
 */
echo "<?xml version=\"1.0\" encoding=\"iso-8859-1\"?".">\n"; //xml uses ?, so we escape it
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<?php include INCLUDE_PATH . 'meta_inc.php'; ?>
	<link href="<?php echo VIRTUAL_PATH; ?>themes/Bootswatch/css/cosmo.css" rel="stylesheet" type="text/css" />
	<style type="text/css">
	 .somethingcouldgohere {}
	</style>
</head>
<body>
<table width="100%" cellpadding="5" cellspacing="0" margin="0">
      <!-- change header color here -->
	<tr>
		<td colspan="3">
	  		 <h1 align="center"><?php echo $config->banner;?></h1>
		</td>
  	</tr>
	<tr>
	      <!-- change left panel color here -->
      	<td width="175" valign="top">
			<p align="center"><? echo $config->sidebar1; ?></p>
			<?php
				echo makeLinks($config->nav1,'<p align="center">','</p>'); #link arrays are created in config_inc.php file
			?>
		</td>
            <!-- change guts/identity area color here -->
		<td valign="top">
		<?=showFeedback();?>
		<!-- end of header include file -->