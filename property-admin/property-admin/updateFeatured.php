<?php
include('config.php');
	if(isset($_GET['num'])){ 		 
		$sql = "UPDATE featured SET featuredStockNumber = ".$_GET['num']." WHERE id = 1";
		if ($result = mysql_query($sql)) { echo "<p><br/><br/><br/><div align='center'><img src='/wp-content/plugins/property-admin/check.png' /><br/><br/><span class='ok_msg'>Making property {$_GET['num']} the featured property successfull!</span></div></p>"; } else { echo "<p><br/><br/><br/><div align='center'><img src='/wp-content/plugins/property-admin/error.jpg' /><br/><br/><span class='error_msg'>Making property {$_GET['num']} the featured property failed!</span></span></div><br/></p>"; }
	}
?>