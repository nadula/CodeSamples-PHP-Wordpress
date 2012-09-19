<?php
//include('lock.php');
?> 
<link rel="stylesheet" rev="stylesheet" href="../styles.css" media="screen" /> 
<?php
if($_GET['action']=="search") { 

	if(isset($_POST['externalid']) && ($_POST['externalid'] != "") ){ 
		//echo "external id-".$_POST['externalid'];
		$sql = "SELECT * FROM `school_list` WHERE `externalid` = '".$_POST['externalid']."'";
		//echo "sql".$sql;
		$result = mysql_query($sql);
		$schoolArray = mysql_fetch_assoc($result);
		//print_r($schoolArray);
		//echo "exid=".$schoolArray['externalid'];
		
	}else if(isset($_POST['admin_search']) && ($_POST['admin_search'] != "") ){
		//echo "admin search";

		$schoolName = $_POST['admin_search'];
		//echo $schoolName;
		$match_array = array('NSW','ACT','VIC','WA','SA','TAS','NT','QLD');
		$state = '';
		for($x=0;$x<=7;$x++){
			$len = (1+strlen($match_array[$x]));
			if(substr($schoolName,-$len,$len) == " {$match_array[$x]}"){
				$schoolName = substr($schoolName,0,strlen($schoolName)-$len);
				$state = $match_array[$x];
			}
		}
		//echo $schoolName;
		$sql = "SELECT * FROM `school_list` WHERE `name` = '{$schoolName}'";
		$result = mysql_query($sql);
		$schoolArray = mysql_fetch_assoc($result);		
	}

	include('admin_search.inc.php');

	if( !isset($_POST['externalid']) ) { echo "<br /><p id='search_msg'>Enter 'External ID' or 'School Name' then click 'Find Swim School' button to search.</p>"; } else {
		if( mysql_num_rows($result) > 0 ) {
			include('admin_display.inc.php');
			echo "<br/><p>Use respective tab pages to manage this school information.</p>";
		} else { echo '<br/><br/><br/><div align="center"><img src="../images/error.jpg" /><br/>No records found!</div>'; }
	}
	
	//if( $_POST['externalid'] != "" || $_POST['admin_search'] != "" ) { echo "<p>buttons goes here</p>"; }
?>

<?	
} else if($_GET['action']=="add") { 
	if( isset($_SESSION['addMSG']) ) { echo $_SESSION['addMSG']; unset($_SESSION['addMSG']); } else {
		$_SESSION['action'] = "add";
		unset($_SESSION['banner']);
		echo "<div align='center'><h2>Use following form to add  a new school</h2></div>";
		//if(isset($_POST['externalid'])) { echo '<form id="add_school_form" name="add_school_form" method="post" action="admin_add_school.php">'; }
		echo '<form id="add_school_form" name="add_school_form" method="post" action="admin_process_school.php">'; 
		include('admin_display.inc.php');	
		echo '<br /><br /><div align="center"><input type="reset" class="btn_style" />&nbsp;&nbsp;<input type="submit" value="Add School" class="btn_style" /></form></div>';
	}

} else if($_GET['action']=="edit") { 
	
	if( isset($_SESSION['addMSG']) ) { echo $_SESSION['addMSG']; unset($_SESSION['addMSG']); } else {
		
		if(isset($_POST['externalid']) && ($_POST['externalid'] != "") ){ 
			//echo "external id-".$_POST['externalid'];
			$sql = "SELECT * FROM `school_list` WHERE `externalid` = '".$_POST['externalid']."'";
			//echo "sql".$sql;
			$result = mysql_query($sql);
			$schoolArray = mysql_fetch_assoc($result);
			//print_r($schoolArray);
			//echo "exid=".$schoolArray['externalid'];
			
		}else if(isset($_POST['admin_search']) && ($_POST['admin_search'] != "") ){
			//echo "admin search";
	
			$schoolName = $_POST['admin_search'];
			//echo $schoolName;
			$match_array = array('NSW','ACT','VIC','WA','SA','TAS','NT','QLD');
			$state = '';
			for($x=0;$x<=7;$x++){
				$len = (1+strlen($match_array[$x]));
				if(substr($schoolName,-$len,$len) == " {$match_array[$x]}"){
					$schoolName = substr($schoolName,0,strlen($schoolName)-$len);
					$state = $match_array[$x];
				}
			}
			//echo $schoolName;
			$sql = "SELECT * FROM `school_list` WHERE `name` = '{$schoolName}'";
			$result = mysql_query($sql);
			$schoolArray = mysql_fetch_assoc($result);		
		}
	
		$_SESSION['action'] = "edit";
		$_SESSION['state'] = $schoolArray['state'];	
		if( trim($schoolArray['banner']) != "" ) { $_SESSION['banner'] = $schoolArray['banner']; } else { unset($_SESSION['banner']); }
		include('admin_search.inc.php');
	
		if( !isset($_POST['externalid']) ) { echo "<br /><p id='search_msg'>Enter 'External ID' or 'School Name' then click 'Find Swim School' button to search.</p>"; } else {
			if( mysql_num_rows($result) > 0 ) {
				echo '<form id="edit_school_form" name="edit_school_form" method="post" action="admin_process_school.php">'; 
				include('admin_display.inc.php');
				echo '<br /><br /><div align="center"><input type="submit" value="Update School" class="btn_style" /></form></div>';
			} else { echo '<br/><br/><br/><div align="center"><img src="../images/error.jpg" /><br/>No records found!</div>'; }
		}
	
	}//addMSG

} else if($_GET['action']=="delete") { 

	if( isset($_SESSION['addMSG']) ) { echo $_SESSION['addMSG']; unset($_SESSION['addMSG']); } else {

		if(isset($_POST['externalid']) && ($_POST['externalid'] != "") ){ 
			//echo "external id-".$_POST['externalid'];
			$sql = "SELECT * FROM `school_list` WHERE `externalid` = '".$_POST['externalid']."'";
			//echo "sql".$sql;
			$result = mysql_query($sql);
			$schoolArray = mysql_fetch_assoc($result);
			//print_r($schoolArray);
			//echo "exid=".$schoolArray['externalid'];
			
		}else if(isset($_POST['admin_search']) && ($_POST['admin_search'] != "") ){
			//echo "admin search";
	
			$schoolName = $_POST['admin_search'];
			//echo $schoolName;
			$match_array = array('NSW','ACT','VIC','WA','SA','TAS','NT','QLD');
			$state = '';
			for($x=0;$x<=7;$x++){
				$len = (1+strlen($match_array[$x]));
				if(substr($schoolName,-$len,$len) == " {$match_array[$x]}"){
					$schoolName = substr($schoolName,0,strlen($schoolName)-$len);
					$state = $match_array[$x];
				}
			}
			//echo $schoolName;
			$sql = mysql_query("SELECT * FROM `school_list` WHERE `name` = '{$schoolName}'");
			$schoolArray = mysql_fetch_assoc($sql);		
		}

		$_SESSION['action'] = "delete";
		include('admin_search.inc.php');	
		if( !isset($_POST['externalid']) ) { echo "<br /><p id='search_msg'>Enter 'External ID' or 'School Name' then click 'Find Swim School' button to search.</p>"; } else {
			if( mysql_num_rows($result) > 0 ) {
				echo '<form id="delete_school_form" name="delete_school_form" method="post" action="admin_process_school.php">'; 
				include('admin_display.inc.php');
				echo '<br /><br /><div align="center"><input type="submit" value="Delete School" class="btn_style" /></form></div>';	
			} else { echo '<br/><br/><br/><div align="center"><img src="../images/error.jpg" /><br/>No records found!</div>'; }
		}
	}
}
?>

	



