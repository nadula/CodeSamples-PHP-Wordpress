<?php include('config.php'); ?>
<link rel="stylesheet" rev="stylesheet" href="/wp-content/plugins/property-admin/styles.css" media="screen" /> 
<?php 
unset($_SESSION['PROCESS_ERROR']);

//echo print_r($_POST) . "<br/>";
$stock_number_array = $_POST['stock_number'];
$lot_number_array = $_POST['lot_number'];
$display_home = $_POST['display_home'];
$land_price_array = $_POST['land_price'];
$house_price_array = $_POST['house_price'];
$package_price_array = $_POST['package_price'];
$rent_range_from_array = $_POST['rent_range_from'];
$rent_range_to_array = $_POST['rent_range_to'];
$rent_return_from_array = $_POST['rent_return_from'];
$rent_return_to_array = $_POST['rent_return_to'];

$profile_number = mysql_real_escape_string($_POST['profile_number']);
$suburb = mysql_real_escape_string($_POST['suburb']);
$surrounding_area = mysql_real_escape_string($_POST['surrounding_area']);
$services = $_POST['services'];
$lot_type = $_POST['lot_type'];
$topography = mysql_real_escape_string($_POST['topography']);
$lots_in_development = mysql_real_escape_string($_POST['lots_in_dev']);
$council_rates = mysql_real_escape_string($_POST['council_rates']);

$distance_from_cbd = $_POST['distance_from_cbd'];
$dev_features = $_POST['dev_features'];
$local_facility_schools = $_POST['local_schools'];
$local_facility_public_transport = $_POST['local_transport'];
$local_facility_shopping = $_POST['local_shopping'];
$local_facility_medical = $_POST['local_medical'];
$local_facility_sports = $_POST['local_sports'];

$construction = mysql_real_escape_string($_POST['construction']);
$bedrooms = mysql_real_escape_string($_POST['bedrooms']);
$bathrooms = mysql_real_escape_string($_POST['bathrooms']);
$garage = mysql_real_escape_string($_POST['garage']);
$roof_cladding = mysql_real_escape_string($_POST['roof_cladding']);
$title_release = mysql_real_escape_string($_POST['title_release_date']);
$start_date = mysql_real_escape_string($_POST['start_date']);
$completion_date = mysql_real_escape_string($_POST['finish_date']);

$pre_construction = $_POST['pre_construction'];
$external_fittings = $_POST['external_fittings'];
$outdoor_living = $_POST['outdoor_living'];
$garage_construction = $_POST['garage_construction'];
$energy_efficiency = $_POST['energy_efficiency'];
$internal_finishes = $_POST['internal_fixtures'];
$kitchen_fittings = $_POST['kitchen_fittings'];
$bathrooms_laundry = $_POST['bathroom_laundry'];
$electrical = $_POST['electrical'];
$internal_services = $_POST['internal_services'];
$tiling_carpet = $_POST['tiling_carpet'];
$landscaping = $_POST['external_landscaping'];
$general = $_POST['general'];


if( $_SESSION['action'] == "add") { 

	$sqlProfile = "INSERT INTO profile (profile_number, suburb, distance_from_cbd, surrounding_area, services, lot_type, topography, lots_in_development, council_rates, dev_features, local_facility_schools, "; 
	$sqlProfile .= "local_facility_public_transport, local_facility_shopping, local_facility_medical, local_facility_sports, construction, bedrooms, bathrooms, garage, roof_cladding, title_release, ";
	$sqlProfile .= "start_date, completion_date, pre_construction, external_fittings, outdoor_living, garage_construction, energy_efficiency, internal_finishes, kitchen_fittings, bathrooms_laundry, electrical, ";
	$sqlProfile .= "internal_services, tiling_carpet, landscaping, general) ";

	$sqlProfile .= "VALUES ({$profile_number}, '{$suburb}', '{$distance_from_cbd}', '{$surrounding_area}', '{$services}', '{$lot_type}', '{$topography}', '{$lots_in_development}', '{$council_rates}', '{$dev_features}', '{$local_facility_schools}', "; 
	$sqlProfile .= "'{$local_facility_public_transport}', '{$local_facility_shopping}', '{$local_facility_medical}', '{$local_facility_sports}', '{$construction}', {$bedrooms}, {$bathrooms}, {$garage}, ";
	$sqlProfile .= "'{$roof_cladding}', '{$title_release}', '{$start_date}', '{$completion_date}', '{$pre_construction}', '{$external_fittings}', '{$outdoor_living}', '{$garage_construction}', '{$energy_efficiency}', ";
	$sqlProfile .= "'{$internal_finishes}', '{$kitchen_fittings}', '{$bathrooms_laundry}', '{$electrical}', '{$internal_services}', '{$tiling_carpet}', '{$landscaping}', '{$general}')";
	
	//echo $sqlProfile;

	if(!mysql_query($sqlProfile)) { $_SESSION['PROCESS_ERROR'] = "yes"; }
	else { 
		for($i=0; $i<count($stock_number_array); $i++) {
			//echo $display_home[$i];
			$sqlStock = "INSERT INTO stocks (stock_number, lot_number, display_home, land_price, house_price, package_price, rent_range_from, rent_range_to, rent_return_from, rent_return_to)"; 
			$sqlStock .= " VALUES ({$stock_number_array[$i]}, {$lot_number_array[$i]}, '{$display_home[$i]}', '{$land_price_array[$i]}', '{$house_price_array[$i]}', '{$package_price_array[$i]}', '{$rent_range_from_array[$i]}', '{$rent_range_to_array[$i]}', '{$rent_return_from_array[$i]}', '{$rent_return_to_array[$i]}')";
			
			if(!mysql_query($sqlStock)) { $_SESSION['PROCESS_ERROR'] = "yes"; } else { $_SESSION['PROCESS_ERROR'] = "no"; }
		
			$sqlProfileStock = "INSERT INTO profilestocks (stock_number, profile_number) VALUES ({$stock_number_array[$i]}, {$profile_number})";
			if(!mysql_query($sqlProfileStock)) { $_SESSION['PROCESS_ERROR'] = "yes"; } else { $_SESSION['PROCESS_ERROR'] = "no"; }
					
		}//for
	}//if	

} else if( $_SESSION['action'] == "edit") {
	
	$sqlProfileUpdate = "UPDATE profile SET suburb='{$suburb}', distance_from_cbd='{$distance_from_cbd}', surrounding_area='{$surrounding_area}', services='{$services}', lot_type='{$lot_type}', topography='{$topography}', lots_in_development='{$lots_in_development}', council_rates='{$council_rates}', dev_features='{$dev_features}', local_facility_schools='{$local_facility_schools}', local_facility_public_transport='{$local_facility_public_transport}', local_facility_shopping='{$local_facility_shopping}', local_facility_medical='{$local_facility_medical}', local_facility_sports='{$local_facility_sports}', construction='{$construction}', bedrooms={$bedrooms}, bathrooms={$bathrooms}, garage={$garage}, roof_cladding='{$roof_cladding}', title_release='{$title_release}', start_date='{$start_date}', completion_date='{$completion_date}', pre_construction='{$pre_construction}', external_fittings='{$external_fittings}', outdoor_living='{$outdoor_living}', garage_construction='{$garage_construction}', energy_efficiency='{$energy_efficiency}', internal_finishes='{$internal_finishes}', kitchen_fittings='{$kitchen_fittings}', bathrooms_laundry='{$bathrooms_laundry}', electrical='{$electrical}', internal_services='{$internal_services}', tiling_carpet='{$tiling_carpet}', landscaping='{$landscaping}', general='{$general}' WHERE profile_number={$profile_number} ";
	
	//echo $sqlProfileUpdate;
	if(!mysql_query($sqlProfileUpdate)) { $_SESSION['PROCESS_ERROR'] = "yes"; /*echo '<br/><br/>Error: ' . mysql_error();*/ 
	} else { //$_SESSION['PROCESS_ERROR'] = "no"; }	
		for($i=0; $i<count($stock_number_array); $i++) {
			
			$sqlStockUpdate = "UPDATE stocks SET lot_number={$lot_number_array[$i]}, display_home='{$display_home[$i]}', land_price='{$land_price_array[$i]}', house_price='{$house_price_array[$i]}', package_price='{$package_price_array[$i]}', rent_range_from='{$rent_range_from_array[$i]}', rent_range_to='{$rent_range_to_array[$i]}', rent_return_from='{$rent_return_from_array[$i]}', rent_return_to='{$rent_return_to_array[$i]}' WHERE stock_number={$stock_number_array[$i]}";
			
			//echo $sqlStockUpdate;
			if(!mysql_query($sqlStockUpdate)) { $_SESSION['PROCESS_ERROR'] = "yes"; /*echo '<br/><br/>Error: ' . mysql_error();*/ } else { $_SESSION['PROCESS_ERROR'] = "no"; }
		
			//$sqlProfileStock = "INSERT INTO profilestocks (stock_number, profile_number) VALUES ({$stock_number_array[$i]}, {$profile_number})";
			//if(!mysql_query($sqlProfileStock)) { $_SESSION['PROCESS_ERROR'] = "yes"; } else { $_SESSION['PROCESS_ERROR'] = "no"; }
					
		}//for	
	}
		
} else if($_SESSION['action'] == "delete_stock") {
	$sqlDeleteStockNum = "DELETE FROM stocks WHERE stock_number = ".$_POST['stock_number_2b_deleted'];
	if(!mysql_query($sqlDeleteStockNum)) { $_SESSION['PROCESS_ERROR'] = "yes"; } else { $_SESSION['PROCESS_ERROR'] = "no"; }		

} else if($_SESSION['action'] == "delete_profile") {
	$sqlDeleteProfileNum = "DELETE FROM profile WHERE profile_number = ".$_POST['profile_number_2b_deleted'];
	if(!mysql_query($sqlDeleteProfileNum)) { $_SESSION['PROCESS_ERROR'] = "yes"; } else { $_SESSION['PROCESS_ERROR'] = "no"; }		
}

//displaying error message
if($_SESSION['PROCESS_ERROR'] == "yes") {
	echo "<p><br/><br/><br/><div align='center'><img src='/wp-content/plugins/property-admin/error.jpg' /><br/><br/><span class='error_msg'>Failed!</span></div></p>";  
} else if($_SESSION['PROCESS_ERROR'] == "no") {
	echo "<p><br/><br/><br/><div align='center'><img src='/wp-content/plugins/property-admin/check.png' /><br/><br/><span class='ok_msg'>Successful!</span></div></p>";
}



?>