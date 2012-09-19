<ul>
<?php

require('/sslocator/config.php');

if(is_numeric($_POST['suburb_postcode'])){ 
	$ref = mysql_query("SELECT * FROM `$table` WHERE `postcode` LIKE '{$_POST['suburb_postcode']}%' ORDER BY `suburb` ASC LIMIT 0,10");
	while($res = mysql_fetch_assoc($ref)){
		echo("<li>{$res['suburb']} {$res['state']}</li>\n");
	}
} else if(!is_numeric($_POST['suburb_postcode'])){ 
	$ref = mysql_query("SELECT * FROM `$table` WHERE `suburb` LIKE '{$_POST['suburb_postcode']}%' ORDER BY `suburb` ASC LIMIT 0,10");
	while($res = mysql_fetch_assoc($ref)){
		echo("<li>{$res['suburb']} {$res['state']}</li>\n");
	}
}

?>
</ul>