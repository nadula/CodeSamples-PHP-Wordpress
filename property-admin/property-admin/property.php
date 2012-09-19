<?php
include('config.php');
?> 
<link rel="stylesheet" rev="stylesheet" href="/wp-content/plugins/property-admin/styles.css" media="screen" /> 
<script type="text/javascript">
function addStockNumbers(num)
{
	//alert(num);
	var xmlhttp;
	if (window.XMLHttpRequest)
	  {// code for IE7+, Firefox, Chrome, Opera, Safari
	  xmlhttp=new XMLHttpRequest();
	  }
	else
	  {// code for IE6, IE5
	  xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
	  }
	xmlhttp.onreadystatechange=function()
	  {
	  if (xmlhttp.readyState==4 && xmlhttp.status==200)
		{
		document.getElementById('stockNumDiv').innerHTML=xmlhttp.responseText;
		}
	  }
	//if(IsNaN(num)) {
		xmlhttp.open("GET","addstocknumbers.php?num="+num,true);
		xmlhttp.send();
	//} else { alert("Please enter a numeric value"); }
}

function updateFeatured(stockNumber)
{
	//alert(num);
	var xmlhttp;
	if (window.XMLHttpRequest)
	  {// code for IE7+, Firefox, Chrome, Opera, Safari
	  xmlhttp=new XMLHttpRequest();
	  }
	else
	  {// code for IE6, IE5
	  xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
	  }
	xmlhttp.onreadystatechange=function()
	  {
	  if (xmlhttp.readyState==4 && xmlhttp.status==200)
		{
		document.getElementById('updateFeaturedDiv').innerHTML=xmlhttp.responseText;
		}
	  }
	xmlhttp.open("GET","updateFeatured.php?num="+stockNumber,true);
	xmlhttp.send();
}
</script>
<?php
if($_GET['action']=="featured") { 

	$_SESSION['action'] = "featured"; ?>

    <div style="padding-top:20px;" align="center">
    <form id="admin_school_form" name="admin_school_form" method="post"> 
    <div>
        <span style="padding-right:5px;">Stock Number:</span><input id="stock_number" name="stock_number" type="text" style="width:100px;" onClick="document.getElementById('stock_number').value='';" value="<? if(isset($_POST['stock_number'])){ echo $_POST['stock_number']; } ?>" /><span style="padding-left:15px;"><input class="btn_style" type="button" onClick="updateFeatured(document.getElementById('stock_number').value);" value="Make Featured Property"  /></span>
    </div>
    </form>
    </div>
    <br />
    <hr/>
    <br />

	<?
	echo "<div id='updateFeaturedDiv' align='center'></div>";

	
?>

<?	
} else if($_GET['action']=="add") { 

	$_SESSION['action'] = "add";
	echo '<form id="add_property_form" name="add_property_form" method="post" action="admin_process_property.php">'; 
	include('admin_display.inc.php');	

} else if($_GET['action']=="edit") { 
	
	$_SESSION['action'] = "edit";
	?>	
    <div style="padding-top:20px;" align="center">       
        <form id="edit_profile_form" name="edit_stock_form" method="post" action="admin_edit_stock.php">
        Enter Profile Number to EDIT: &nbsp;&nbsp;  <input type="text" id="profile_number" name="profile_number" size="10" /> &nbsp;&nbsp; 
        <input type="submit" value="Edit" class="btn_style" /></form>
    </div> 		
	<?php

/*	if( isset($_SESSION['addMSG']) ) { echo $_SESSION['addMSG']; unset($_SESSION['addMSG']); } else {
			
		if(isset($_POST['stock_number'])){ 
			$sql_profile = "SELECT * FROM `profile` WHERE profile_number.profile = profile_number.profilestocks AND stock_number.profilestocks = ".$_POST['stock_number']."'";
			$result_profile = mysql_query($sql_profile);
			$profileArray = mysql_fetch_assoc($result_profile);
			
			$sql_stocks = "SELECT * FROM `stocks` WHERE stock_number.stocks = stock_number.profilestocks AND profile_number.profilestocks = ".$profileArray['profile_number']."'";
			$result_stock = mysql_query($sql_stocks);
			$stockArray = mysql_fetch_assoc($result_stock);					
		}
	
		include('admin_search.inc.php');
	
		if( !isset($_POST['stock_number']) ) { echo "<br /><p id='search_msg'>Enter 'Stock Number' and click 'Find Property' button to search.</p>"; } else {
			if( mysql_num_rows($result) > 0 ) {
				echo '<form id="edit_property_form" name="edit_proprty_form" method="post" action="admin_process_property.php">'; 
				include('admin_display.inc.php');
				echo '<br /><br /><div align="center"><input type="submit" value="Update Property" class="btn_style" /></form></div>';
			} else { echo '<br/><br/><br/><div align="center"><img src="../images/error.jpg" /><br/>No records found!</div>'; }
		}
	
	}//addMSG*/

} else if($_GET['action']=="delete_stock") { 
	$_SESSION['action'] = "delete_stock";
?>
    <div style="padding-top:20px;" align="center">       
        <form id="delete_stock_form" name="delete_stock_form" method="post" action="admin_process_property.php">
        Enter Stock Number to DELETE: &nbsp;&nbsp;  <input type="text" id="stock_number_2b_deleted" name="stock_number_2b_deleted" size="10" /> &nbsp;&nbsp; 
        <input type="submit" value="Delete Stock" class="btn_style" /></form>
    </div> 
<?

} else if($_GET['action']=="delete_profile") { 	
	$_SESSION['action'] = "delete_profile";
?>
    <div style="padding-top:20px;" align="center">       
        <form id="delete_profile_form" name="delete_profile_form" method="post" action="admin_process_property.php">
        Enter Profile Number to DELETE: &nbsp;&nbsp;  <input type="text" id="profile_number_2b_deleted" name="profile_number_2b_deleted" size="10" /> &nbsp;&nbsp; 
        <input type="submit" value="Delete Profile" class="btn_style" /></form>
    </div> 
<?
}
?>

	



