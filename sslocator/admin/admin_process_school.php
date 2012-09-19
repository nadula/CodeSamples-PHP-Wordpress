<?php 
include('lock.php');
unset($_SESSION['addERROR']);
unset($_SESSION['addOK']);

$externalid = mysql_real_escape_string($_POST['externalid']);
$name = mysql_real_escape_string($_POST['name']);
$location = mysql_real_escape_string($_POST['location']);
$address1 = mysql_real_escape_string($_POST['address1']);
$address2 = mysql_real_escape_string($_POST['address2']);
$suburb = mysql_real_escape_string($_POST['suburb']);
$state = mysql_real_escape_string($_POST['state']);
$postcode = mysql_real_escape_string($_POST['postcode']);
$country = mysql_real_escape_string($_POST['country']);
$phone = mysql_real_escape_string($_POST['phone']);
$fax = mysql_real_escape_string($_POST['fax']);
$mobile = mysql_real_escape_string($_POST['mobile']);
$email = mysql_real_escape_string($_POST['email']);
$website = mysql_real_escape_string($_POST['website']);
$accredited = mysql_real_escape_string($_POST['accredited']);
$banner = mysql_real_escape_string($_POST['banner']);
//$lat = mysql_real_escape_string($_POST['lat']);
//$lon = mysql_real_escape_string($_POST['lon']);

if( isset($_SESSION['new_school_banner'])) { $banner = $_SESSION['new_school_banner']; }
if ($_POST['accredited'] == "on") { $accredited = "yes"; } else { $accredited = "no"; }
if( isset($_SESSION['lat'])) { $lat = $_SESSION['lat']; }
if( isset($_SESSION['lng'])) { $lng = $_SESSION['lng']; }

if( $_SESSION['action'] == "add") { 

	$sqlAdd = "INSERT INTO school_list (school_id, externalid, name, location, address1, address2, suburb, state, postcode, country, phone, fax, mobile, email, website, accredited, banner, lat, lon)
	VALUES (NULL, $externalid, '$name', '$location', '$address1', '$address2', '$suburb', '$state', '$postcode', '$country', '$phone', '$fax', '$mobile', '$email', '$website', '$accredited', '$banner', '$lat', '$lng')";
	//echo $sqlAdd;
	if(!mysql_query($sqlAdd)) { $_SESSION['addMSG'] = /*$sqlAdd.'<br/><br/>Error: ' . mysql_error();*/ "<p><br/><br/><br/><div align='center'><img src='../images/error.jpg' /><br/><br/><span class='error_msg'>School ".$name." ADD failed!</span></div></p>"; /*die('Error: ' . mysql_error());*/ } 
	else { $_SESSION['addMSG'] = "<p><br/><br/><br/><div align='center'><img src='../images/check.png' /><br/><br/><span class='ok_msg'>School ".$name." successfully added to the system</span></div></p>"; }
	header('Location: school.php?action=add');

} else if( $_SESSION['action'] == "edit") {
	$sqlEdit = "UPDATE school_list 
	SET externalid=".$externalid.", name='".$name."', location='".$location."', address1='".$address1."', address2='".$address2."', suburb='".$suburb."', state='".$state."', postcode='".$postcode."', country='".$country."', phone='".$phone."', fax='".$fax."', mobile='".$mobile."', email='".$email."', website='".$website."', accredited='".$accredited."', banner='".$banner."', lat='".$lat."', lon='".$lng."'
	WHERE externalid = ".$externalid;
	
	if(isset($_SESSION['new_school_banner'])) { 
		if(isset($_SESSION['lat'])) {
			$sqlEdit = "UPDATE school_list 
			SET externalid=".$externalid.", name='".$name."', location='".$location."', address1='".$address1."', address2='".$address2."', suburb='".$suburb."', state='".$state."', postcode='".$postcode."', country='".$country."', phone='".$phone."', fax='".$fax."', mobile='".$mobile."', email='".$email."', website='".$website."', accredited='".$accredited."', banner='".$banner."', lat='".$lat."', lon='".$lng."'
			WHERE externalid = ".$externalid;	
		} else {
			$sqlEdit = "UPDATE school_list 
			SET externalid=".$externalid.", name='".$name."', location='".$location."', address1='".$address1."', address2='".$address2."', suburb='".$suburb."', state='".$state."', postcode='".$postcode."', country='".$country."', phone='".$phone."', fax='".$fax."', mobile='".$mobile."', email='".$email."', website='".$website."', accredited='".$accredited."', banner='".$banner."'
			WHERE externalid = ".$externalid;	
		}
	} else {
		if(isset($_SESSION['lat'])) {
			$sqlEdit = "UPDATE school_list 
			SET externalid=".$externalid.", name='".$name."', location='".$location."', address1='".$address1."', address2='".$address2."', suburb='".$suburb."', state='".$state."', postcode='".$postcode."', country='".$country."', phone='".$phone."', fax='".$fax."', mobile='".$mobile."', email='".$email."', website='".$website."', accredited='".$accredited."', lat='".$lat."', lon='".$lng."'
			WHERE externalid = ".$externalid;	
		} else {
			$sqlEdit = "UPDATE school_list 
			SET externalid=".$externalid.", name='".$name."', location='".$location."', address1='".$address1."', address2='".$address2."', suburb='".$suburb."', state='".$state."', postcode='".$postcode."', country='".$country."', phone='".$phone."', fax='".$fax."', mobile='".$mobile."', email='".$email."', website='".$website."', accredited='".$accredited."'
			WHERE externalid = ".$externalid;	
		}
	} 		
	
	//echo "edit";
	if(!mysql_query($sqlEdit)) { $_SESSION['addMSG'] = /*$sqlAdd.'<br/><br/>Error: ' . mysql_error();*/ "<p><br/><br/><br/><div align='center'><img src='../images/error.jpg' /><br/><br/><span class='error_msg'>School ".$name." UPDATE failed!</span></div></p>"; /*die('Error: ' . mysql_error());*/ } 
	else { $_SESSION['addMSG'] = "<p><br/><br/><br/><div align='center'><img src='../images/check.png' /><br/><br/><span class='ok_msg'>School ".$name." successfully updated on the system</span></div></p>"; }
	header('Location: school.php?action=edit');
		
} else if($_SESSION['action'] == "delete") {
	//echo "delete - ".$externalid;
	$sqlDelete = "DELETE FROM school_list WHERE externalid = ".$externalid;
	if(!mysql_query($sqlDelete)) { $_SESSION['addMSG'] = /*$sqlAdd.'<br/><br/>Error: ' . mysql_error();*/ "<p><br/><br/><br/><div align='center'><img src='../images/error.jpg' /><br/><br/><span class='error_msg'>School ".$name." DELETE failed!</span></div></p>"; /*die('Error: ' . mysql_error());*/ } 
	else { $_SESSION['addMSG'] = "<p><br/><br/><br/><div align='center'><img src='../images/check.png' /><br/><br/><span class='ok_msg'>School ".$name." successfully deleted from the system</span></div></p>"; }
	header('Location: school.php?action=delete');	
	
}


unset($_SESSION['action']);
unset($_SESSION['lat']);
unset($_SESSION['lng']);
unset($_SESSION['new_school_banner']);

?>