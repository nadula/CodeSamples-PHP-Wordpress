<?php
include('config.php');
unset($_SESSION['PROCESS_ERROR']);
unset($_SESSION['PROCESS_ERROR_MSG']);

	//echo $_POST['profile_number'];
	if(isset($_POST['profile_number'])){ 
		$sql_profile = "SELECT * FROM `profile` WHERE profile_number = {$_POST['profile_number']}";
		if(!$result_profile = mysql_query($sql_profile)) { $_SESSION['PROCESS_ERROR'] = "yes"; $_SESSION['PROCESS_ERROR_MSG'] = "Profile number should be a number!";
		} else { //$_SESSION['PROCESS_ERROR'] = "no"; }
			if(!mysql_num_rows($result_profile)  > 0) {
				$_SESSION['PROCESS_ERROR'] = "yes"; $_SESSION['PROCESS_ERROR_MSG'] = "Profile number could not be found!";
			} else {
				$profileArray = mysql_fetch_assoc($result_profile);
		
				$sql_stocks = "SELECT stocks.* FROM stocks, profilestocks WHERE stocks.stock_number = profilestocks.stock_number AND profilestocks.profile_number = {$profileArray['profile_number']}";
				$result_stock = mysql_query($sql_stocks);
				$stockCount = mysql_num_rows($result_stock);
				//$stockArray = mysql_fetch_assoc($result_stock);	
				
				include('admin_edit_stock_display.php');				
			}
		}
	}

//displaying error message
if($_SESSION['PROCESS_ERROR'] == "yes") {
	echo "<p><br/><br/><br/><div align='center'><img src='/wp-content/plugins/property-admin/error.jpg' /><br/><br/><span class='error_msg'>{$_SESSION['PROCESS_ERROR_MSG']}</span></div></p>";  
} else if($_SESSION['PROCESS_ERROR'] == "no") {
	echo "<p><br/><br/><br/><div align='center'><img src='/wp-content/plugins/property-admin/check.png' /><br/><br/><span class='ok_msg'>Successful!</span></div></p>";
}
?>
