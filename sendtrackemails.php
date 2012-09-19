<?php
/* 

This script sending out an email to all the members with links to pre selected tracks.

*/

include_once "../../wp-blog-header.php"; 

	function showlist($directory) { // this function can display sorted list of dirs and files
	
		if ($handle = opendir($directory)) {
			$countfile="0";
			while (false !== ($file = readdir($handle))) {
				$ext = strrchr($file, ".");
				if (($ext == ".csv")||($ext == ".CSV")) {
					$filename[$countfile]=$file;$countfile++; //}
				}
			}
			closedir($handle);
		}

		if ($countfile != "0") { 
			sort($filename);
			createEmail($filename, $countfile);
		}		
	}

	function getRaceDateText($trackfilename) {   
		$year = "12"; 
		$month = substr($trackfilename, 1, 2);
		$day = substr($trackfilename, 3, 2);
		$dayText = @date("l", mktime(0, 0, 0, $month, $day, $year));
		$monthText = @date("F", mktime(0, 0, 0, $month, $day, $year));
		$fullday = $dayText." ".$day." ".$monthText." 20".$year;		
		return $fullday;
	}

	function getTrackName($code) {
		$dbh = mysql_connect(DB_HOST, DB_USER, DB_PASSWORD);   
		mysql_select_db(DB_NAME, $dbh); 	
		$sql = "SELECT `trackname` FROM `tracks` WHERE `trackcode` = '".$code."'";	
		$result = mysql_query($sql, $dbh);
		$row = mysql_fetch_array($result);
		return($row[0]);
	}
		
	function createEmail($fileArr, $filecount) {
		
		$dbh = mysql_connect(DB_HOST, DB_USER, DB_PASSWORD);   
		mysql_select_db(DB_NAME, $dbh); 
		$sql = "SELECT ID, user_email FROM wp_users";	
		$result = mysql_query($sql, $dbh);
		
		while($IDs = mysql_fetch_array($result)) {

			$mgm_member  = mgm_get_member($IDs[0]); 
			
			if($mgm_member->status == 'Active') {
			
				$s2_custom_fields = get_user_option('s2member_custom_fields', $IDs[0] );
				$tracks2email = $s2_custom_fields['tracks2email'];
				
				if( $tracks2email != "" ) {
					
					$tracks2emailArr = explode(",", $tracks2email); // gives an array of selected tracks of this user
		
					$user_info = get_userdata( $IDs[0] );
					$email = $user_info->user_email;	
					$first_name = $user_info->first_name;			
					
					$string = "";
					foreach ( $tracks2emailArr as $trackCode ) {
						foreach ($fileArr as $trackFile) {
							if( substr($trackFile, 0, 3) == $trackCode ) { 
								$string .= getTrackName($trackCode)." - ".getRaceDateText(substr($trackFile, 3, 6)).'<a target="_blank" href="http://hotdogs.com.au/format/functions/createpdf.php?file='.$trackFile.'" class="trackdownload" > Download </a><br />';

								
							}
						}	 
					}
					
					if( $string != "" ) { sendTrackEmail($email,$first_name,$string); }
					echo $email."<br/>"; //}
				}
			}//if active memeber
		}		
	}
	
	function sendTrackEmail($userEmail, $userName,$trackString) {
		$emailString = "Hi ".$userName.",<br /><br /> Here is your GuideDog tracks for today. (Click to download)<br /><br />"
		.$trackString.
		"<br /><br />Access full Guide Dogs Tracks list from <a href='http://www.hotdogs.com.au/guide-dogs' target='_blank'>here</a>".
		"<br /><br />Thank you<br /><br />John Pearson<br /><a href='http://hotdogs.com.au' target='_blank'>Hotdogs.com.au</a>";
		
		//change this to your email.
		$to = $userEmail;
		$from = "info@hotdogs.com.au";
		$subject = "Daily Tracks from Hotdogs.com.au";
		
		//begin of HTML message
		$message = '
		<html>
		<body bgcolor="#DCEEFC" style="font-family:Verdana, Verdana, Geneva, sans-serif; font-size:12px;">'
		.$emailString.
		'</body>
		</html>';
		
		//end of message
		$headers  = "From: $from\r\n";
		$headers .= "Content-type: text/html\r\n";
		
		//options to send to cc+bcc
		//$headers .= "Cc: [email]maa@p-i-s.cXom[/email]";
		//$headers .= "Bcc: [email]email@maaking.cXom[/email]";
		
		// now lets send the email.
		//mail($to, $subject, $message, $headers);
		
		//echo "Message has been sent....!<br />";
		
		
	}
	
	$dirpath = "/uploads/guidedogs/"; 
	$fpath = $_SERVER['DOCUMENT_ROOT'].$dirpath; ///home/hotdogsc/public_html/uploads/puntersclub/HotDogSMSTHU.csv
	showlist($fpath);
	
?> 
