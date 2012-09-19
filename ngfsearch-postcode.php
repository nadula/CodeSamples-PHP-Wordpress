<?php

/* 

Search news agencies

*/

include_once "../../wp-blog-header.php"; 

$postcode = $_GET['postcode'];
$dbh = mysql_connect(DB_HOST, DB_USER, DB_PASSWORD);   
mysql_select_db(DB_NAME, $dbh); 
$sql = "SELECT * FROM newsagents WHERE sell_status = 1 AND postcode = '".$postcode."'";	
$result = mysql_query($sql, $dbh);

if(mysql_num_rows($result) > 0) {
	while($row = mysql_fetch_array($result)) {
	  echo $row['bus_name'] . " " . $row['add1'] . " " . $row['add2'] . " " . $row['suburb'] . " " . $row['phone'];    
	  echo "<br />";
	}
} else { echo "Sorry! no results found."; }

?>