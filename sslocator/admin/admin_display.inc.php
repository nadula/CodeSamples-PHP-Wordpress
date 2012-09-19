
    <?php //}

	$sql = "SELECT * FROM `country_list`";
	$result_country = mysql_query($sql);
	$countryArr = array();
	$i = 0;

/*	while($row = mysql_fetch_array($result_arr)) { 
		$countryArr[$i] = $row;
		$i+=1;
	}*/
	if(isset($_POST['country'])) {
		$sql = "SELECT * FROM province_list, country_list WHERE country_list.CountryCode = province_list.CountryCode AND country_list.CountryCode = '".$_POST['country']."'";
		echo $sql;
		$result_province = mysql_query($sql);
		echo "mysql_num_rows=".mysql_num_rows($result_province);
/*		$provinceArr = array();
		$j = 0;	
	
		while($row = mysql_fetch_array($result_arr)) { 
			$provinceArr[$j] = $row;
			$j+=1;
		}	*/
	}

	$bgc1 = "E9F0F6"; 
	$bgc2 = "F6F6F6";
	$banner_btn_display = "";
	if( $_GET['action'] == "search" || $_GET['action'] == "delete" ) { $style = 'style="background:none; border:none; width:400px; padding:3px;" readonly="readonly" '; $getGeocode = 'style="visibility:hidden"'; $banner_btn_display = 0; } 
	if( $_GET['action'] == "add" || $_GET['action'] == "edit" ) { $style = 'style="border:1px solid #ccc; width:400px; padding:3px;"'; unset($getGeocode); $banner_btn_display = 1; }
	if( isset($schoolArray['lat']) ) { $latlon = $schoolArray['lat'].",".$schoolArray['lon']; } else { $latlon = ""; }
?>
<style>
body, #tbl_result td {
	font-size:12px; 
	font-family:Arial, Helvetica, sans-serif;
}
.btn_style { border:1px solid #ccc; padding:3px; }
</style>

<style type="text/css">

.thumbnail{
position: relative;
z-index: 0;
}

.thumbnail:hover{
background-color: transparent;
z-index: 50;
}

.thumbnail span{ /*CSS for enlarged image*/
position: absolute;
/*background-color: lightyellow;
padding: 5px;*/
left: -1000px;
border: 1px thin gray #777 outset;
visibility: hidden;
color: black;
text-decoration: none;
}

.thumbnail span img{ /*CSS for enlarged image*/
border-width: 0;
/*padding: 2px;*/

}

.thumbnail:hover span{ /*CSS for enlarged image on hover*/
visibility: visible;
top: -140px;
left: 60px; /*position where enlarged image should offset horizontally */

}

</style>


<script type="text/javascript">
function loadStates() {
	var xmlhttp;
	if (window.XMLHttpRequest) {// code for IE7+, Firefox, Chrome, Opera, Safari
		xmlhttp=new XMLHttpRequest();
	} else {// code for IE6, IE5
		xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
	}
	xmlhttp.onreadystatechange=function() {
		if (xmlhttp.readyState==4 && xmlhttp.status==200) {
			//alert(xmlhttp.responseText);
			document.getElementById("selectState").innerHTML=xmlhttp.responseText;
		}
	}
	var country = document.getElementById("country").value;
	//var state = document.getElementById("state").value;
	//xmlhttp.open("GET","process_state.php?country="+country+"&state="+state,true);
	xmlhttp.open("GET","process_state.php?country="+country,true);
	xmlhttp.send();
}

function loadGeocode() {
	var xmlhttp;
	if (window.XMLHttpRequest) {// code for IE7+, Firefox, Chrome, Opera, Safari
		xmlhttp=new XMLHttpRequest();
	} else {// code for IE6, IE5
		xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
	}
	
	xmlhttp.onreadystatechange=function() {
		if (xmlhttp.readyState==4 && xmlhttp.status==200) {
			document.getElementById("latlon").value=xmlhttp.responseText;
		}
	}
	
	if(document.getElementById("address1").value != '') {
		if(document.getElementById("address2").value != '') {
			var address = document.getElementById("address1").value;
			address = address + ', ' + document.getElementById("address2").value;
			address = address + ', ' + document.getElementById("suburb").value.replace(/^\s+|\s+$/g, '');
			address = address + ', ' + document.getElementById("state").value.replace(/^\s+|\s+$/g, '');
			address = address + ', ' + document.getElementById("postcode").value;
			var countryName = getSelectedText('country');
			address = address + ', ' + countryName;		
		} else {
			var address = document.getElementById("address1").value;
			address = address + ', ' + document.getElementById("suburb").value.replace(/^\s+|\s+$/g, '');
			address = address + ', ' + document.getElementById("state").value.replace(/^\s+|\s+$/g, '');
			address = address + ', ' + document.getElementById("postcode").value;
			var countryName = getSelectedText('country');
			address = address + ', ' + countryName;	
		}

		//alert(address);
		
		var country = document.getElementById("country").value;
		var state = document.getElementById("state").value;
		xmlhttp.open("GET","updategeocode.php?address="+address,true);
		xmlhttp.send();


	} else { alert('Please enter a proper address to get Geo Location!'); }
	
	function getSelectedText(elementId) {
		var elt = document.getElementById(elementId);	
		if (elt.selectedIndex == -1)
			return null;	
		return elt.options[elt.selectedIndex].text;
	}

}
</script>

<table width="100%" border="0" cellspacing="0" cellpadding="5" id="tbl_result" style="bor">
  <tr bgcolor='#<? echo $bgc1; ?>'>
    <td width="200px"><strong>External ID:</strong></td>
    <td><input type="text" value="<?php echo $schoolArray['externalid']; ?>" name="externalid" id="externalid" <? echo $style; ?>  /></td>
  </tr>
  <tr bgcolor='#<? echo $bgc2; ?>'>
    <td><strong>School Name:</strong></td>
    <td><input type="text" value="<?php echo $schoolArray['name']; ?>" name="name" id="name" <? echo $style; ?>  /></td>
  </tr>
  <tr bgcolor='#<? echo $bgc1; ?>'>
    <td>Location:</td>
    <td><input type="text" value="<?php echo $schoolArray['location']; ?>" name="location" id="location" <? echo $style; ?>  /></td>
  </tr>
  <tr bgcolor='#<? echo $bgc2; ?>'>
    <td>Address Line 1:</td>
    <td><input type="text" value="<?php echo $schoolArray['address1']; ?>" name="address1" id="address1" <? echo $style; ?>  /></td>
  </tr>
  <tr bgcolor='#<? echo $bgc1; ?>'>
    <td>Address Line 2</td>
    <td><input type="text" value="<?php echo $schoolArray['address2']; ?>" name="address2" id="address2" <? echo $style; ?>  /></td>
  </tr>
  <tr bgcolor='#<? echo $bgc2; ?>'>
    <td>Suburb:</td>
    <td><input type="text" value="<?php echo $schoolArray['suburb']; ?>" name="suburb" id="suburb" <? echo $style; ?>  /></td>
  </tr>
  <tr bgcolor='#<? echo $bgc1; ?>'>
    <td>Postcode:</td>
    <td><input type="text" value="<?php echo $schoolArray['postcode']; ?>" name="postcode" id="postcode" <? echo $style; ?>  /></td>
  </tr>
  <tr bgcolor='#<? echo $bgc2; ?>'>
    <td>State:</td>
    <td><!--<input type="text" value="<?php echo $schoolArray['state']; ?>" name="state" id="state" <? echo $style; ?>  />-->
	<?php 
	if( $_GET['action']=="search" || $_GET['action']=="delete" ) { echo "&nbsp;".$schoolArray['state']; } 
	else if( $_GET['action']=="edit" ) { 		
		$sql = "SELECT * FROM province_list, country_list WHERE country_list.CountryCode = province_list.CountryCode AND country_list.CountryName = '".$schoolArray['country']."'";
		//echo $sql;
		$result_province = mysql_query($sql);

		echo '<div id="selectState"><select id="state" name="state"><option value="" >Select State</option>';
		while($provinces = mysql_fetch_array($result_province)) {
			$state = substr($provinces[2], 3, 3);
			if( $state == $schoolArray['state'] ) { echo "<option value='$state' selected='selected'>$provinces[1]</option>"; /*unset($php_flag session.bug_compat_warn off['state']);*/ } else { echo "<option value='$state'>$provinces[1]</option>"; }
		}
		echo '</select></div>';
     
	} else if( $_GET['action']=="add" ) { 		
		$sql = "SELECT * FROM province_list, country_list WHERE country_list.CountryCode = province_list.CountryCode AND country_list.CountryName = 'Australia'";
		//echo $sql;
		$result_province = mysql_query($sql);

		echo '<div id="selectState"><select id="state" name="state"><option value="" >Select State</option>';
		while($provinces = mysql_fetch_array($result_province)) {
			$state = substr($provinces[2], 3, 3);
			echo "<option value='$state'>$provinces[1]</option>"; 
		}
		echo '</select></div>';      		 
	    	
	} else { echo '<div id="selectState"><select id="state" name="state"><option value="" >Select country first</option></select></div>'; } ?>
    </td>
  </tr>
  <tr bgcolor='#<? echo $bgc1; ?>'>
    <td>Country:</td>
    <td><!--<input type="text" value="<?php echo $schoolArray['country']; ?>" name="country" id="country" <? echo $style; ?>  />--> 

        <select id="country" name="country" onchange='loadStates();' <? echo $style; ?>>       
        <?php 
		if( $_GET['action']!="add" ) { $country = $schoolArray['country']; } else { $country = "Australia"; } 
		while($countries = mysql_fetch_array($result_country)) { //echo "countrys=".$countrys[1];
            if( $country == $countries[1] ) { echo "<option value='$countries[1]' selected='selected'>$countries[1]</option>"; } else { echo "<option value='$countries[1]'>$countries[1]</option>"; }
        }
        ?>
        </select>    

    </td>
  </tr>
  <tr bgcolor='#<? echo $bgc2; ?>'>
    <td>Phone:</td>
    <td><input type="text" value="<?php echo $schoolArray['phone']; ?>" name="phone" id="phone" <? echo $style; ?>  /></td>
  </tr>
  <tr bgcolor='#<? echo $bgc1; ?>'>
    <td>Fax:</td>
    <td><input type="text" value="<?php echo $schoolArray['fax']; ?>" name="fax" id="fax" <? echo $style; ?>  /></td>
  </tr>
  <tr bgcolor='#<? echo $bgc2; ?>'>
    <td>Mobile:</td>
    <td><input type="text" value="<?php echo $schoolArray['mobile']; ?>" name="mobile" id="mobile" <? echo $style; ?>  /></td>
  </tr>
  <tr bgcolor='#<? echo $bgc1; ?>'>
    <td>Email:</td>
    <td><input type="text" value="<?php echo $schoolArray['email']; ?>" name="email" id="email" <? echo $style; ?>  /></td>
  </tr>
  <tr bgcolor='#<? echo $bgc2; ?>'>
    <td>Website: (Without 'http://')</td>
    <td><input type="text" value="<?php echo $schoolArray['website']; ?>" name="website" id="website" <? echo $style; ?>  /></td>
  </tr>
  <tr bgcolor='#<? echo $bgc1; ?>'>
    <td>Accredited:</td>
    <td><?php if( $_GET['action']=="search" || $_GET['action']=="delete" ) { if($schoolArray['accredited']=="yes") { echo "&nbsp;YES"; } else { echo "&nbsp;NO"; } } 
	else { ?>
    <input type="checkbox" name="accredited" id="accredited" <?php if($schoolArray['accredited']=="yes") { echo 'checked="checked"'; } else  ?>  /> (Ticked = Yes)
    <?php } ?>
    </td>
  </tr>
  <tr bgcolor='#<? echo $bgc2; ?>'>
    <td>Banner:</td>
    <td>
    <?php
	if( $_GET['action']=="search" || $_GET['action']=="delete" ) { if( trim($schoolArray['banner']) != "" ) { echo '<a class="thumbnail" href="#thumb">View Banner<span><img src="../images/logos/'.$schoolArray['banner'].'" border="0" height="140" /></span></a>'; } }
	else if( $_GET['action']=="add" || $_GET['action']=="edit") { echo '<iframe src="uploadhtml.php" scrolling="no" width="450" height="40" frameborder="0" border="0" cellspacing="0" ><p>Your browser does not support iframes.</p></iframe>'; } 
	?>        
    </td>
  </tr>
  <tr bgcolor='#<? echo $bgc1; ?>'>
    <td>Latitude and Longitude:</td>
    <td><input type="text" value="<?php echo $latlon; ?>" name="latlon" id="latlon" style="background:none; border:none; width:170px; padding:3px; float:left" readonly="readonly" />
    &nbsp;&nbsp;<input <? echo $getGeocode; ?> onClick='loadGeocode();' type="button" name="btn_getlatlon" id="btn_getlatlon" value="[ Click here to update Geo Location ]" style="background:none;border:0;color:#00F;" /></td>
  </tr>
</table>
<?php //} //$_GET['action'] is set? ?>
