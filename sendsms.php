<?php

/* 

This script sending out SMS (using SMSGlobal API) to all the members with betting tips to their pre selected tracks.

*/

include_once "../../wp-blog-header.php"; 

	//check system date to identify date
	//SMS sent out only on THU, FRI and SAT (can run 1AM)
	
	$dateNow = date("l");
	if($dateNow == "Thursday") { $todayFile = "HotDogSMSTHU.csv"; }
	else if($dateNow == "Friday") { $todayFile = "HotDogSMSFRI.csv"; }
	else if($dateNow == "Saturday") { $todayFile = "HotDogSMSSAT.csv"; }


	$dirpath = "/uploads/puntersclub";
	$fpath = $_SERVER['DOCUMENT_ROOT'].$dirpath."/".$todayFile; ///home/hotdogsc/public_html/uploads/puntersclub/HotDogSMSTHU.csv
	$handle = fopen($fpath , "r");	
	$data = fgetcsv($handle, 500, ",");	//reading a line to create header 
	$smsString_header = "(".$data[0]."-".$data[2]."-".$data[3]."-".$data[4].")"."\r\n"; 
	$smsString_hotdogs = "";
	$smsString_sausagedogs = "";

	$data = fgetcsv($handle, 500, ","); //reading a line for loop
	if(trim($data[0])!="") {
		do {
			if($data[5]=="H") { $smsString_hotdogs .= $data[0]." ".$data[2]." ".$data[3]." ".$data[4]."\r\n"; }
			if($data[5]=="S") { $smsString_sausagedogs .= $data[0]." ".$data[2]." ".$data[3]." ".$data[4]."\r\n"; }
			
			$data = fgetcsv($handle, 500, ",");
		} while((trim($data[0])!=""));
		
		if(trim($smsString_hotdogs)=="") { $smsString = $smsString_header."SAUSAGE DOGS"."\r\n".$smsString_sausagedogs; }
		else if(trim($smsString_sausagedogs)=="") { $smsString = $smsString_header."HOTDOGS"."\r\n".$smsString_hotdogs; }
		else { $smsString = $smsString_header."HOTDOGS"."\r\n".$smsString_hotdogs."SAUSAGE DOGS"."\r\n".$smsString_sausagedogs; }
		
	} // file empty NO SMS sent
	


	$dbh = mysql_connect(DB_HOST, DB_USER, DB_PASSWORD);   
	mysql_select_db(DB_NAME, $dbh); 
	$sql = "SELECT ID FROM wp_users";	
	$result = mysql_query($sql, $dbh);
	
	while($IDs = mysql_fetch_array($result)) {
		
	$mgm_custom_fields = mgm_get_member_custom_fields($IDs[0]);


		if(is_numeric($mgm_custom_fields->mobile)) { 
			$mobile = $mgm_custom_fields->mobile; 

			//get user first name only from the users with mobile number listed
			$user_info = get_userdata( $IDs[0] );
			$first_name = $user_info->first_name;
			
			$smsString_final = "Hey ".$first_name."\r\n".$smsString;
			
			$username = 'hotdogs';
			$password = '47075761';
			$destination = $mobile;
			$source    = 'HOTDOGS';
			$text = $smsString_final;
				
			$content =  'action=sendsms'.
						'&user='.rawurlencode($username).
						'&password='.rawurlencode($password).
						'&to='.rawurlencode($destination).
						'&from='.rawurlencode($source).
						'&maxsplit=2'.
						'&text='.rawurlencode($text);	
			
			sendSMS($content);					

/*			$smsglobal_response = sendSMS($content);
			
			//Sample Response
			//OK: 0; Sent queued message ID: 04b4a8d4a5a02176 SMSGlobalMsgID:6613115713715266 
			
			$explode_response = explode('SMSGlobalMsgID:', $smsglobal_response);
			
			if(count($explode_response) == 2) { //Message Success
				$smsglobal_message_id = $explode_response[1];
				
				//SMSGlobal Message ID
				echo $smsglobal_message_id;
			} else { //Message Failed
				echo 'Message Failed'.'<br />';
				
				//SMSGlobal Response
				echo $smsglobal_response;    
			}*/
	
		}


		
	}
	
    function sendSMS($content) {
        $ch = curl_init('http://www.smsglobal.com.au/http-api.php');
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $content);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $output = curl_exec ($ch);
        curl_close ($ch);
        return $output;    
    }


    

?> 