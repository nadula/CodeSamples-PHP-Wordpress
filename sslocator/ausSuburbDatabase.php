<?php

// ausSuburbDatabase
// copyright 2008 Shannon Murdoch
// www.dreamscapemedia.com.au
//


class ausSuburbDatabase {

    function deg_to_rad($deg){
        return($deg*(pi()/180.0));
    }
	
	function getLocationsNearLonLat($lon,$lat,$radius,$unit='miles'){
		if(strtolower($unit)!='miles'){ $radius = $radius*0.621371192; } //assume unit is kilometers if it isn't miles/default. convert kilometers to miles before calculations occur

		$ref= mysql_query("SELECT * FROM `postcode_db` WHERE (POW((69.1*(`lon`-\"$lon\")*cos($lat/57.3)),\"2\")+POW((69.1*(`lat`-\"$lat\")),\"2\"))<($radius*$radius)");
		$locationsArray=array();
		if(mysql_num_rows($ref)){
			$i=0;
			while($res=mysql_fetch_assoc($ref)){
				$locationsArray[$i] = $res;
				$i++;
			}
		}
		return $locationsArray;
	}


	function distance($lat1,$lon1,$lat2,$lon2,$unit='miles'){
		   $lat1 = $this->deg_to_rad($lat1);
		   $lon1 = $this->deg_to_rad($lon1);
		   $lat2 = $this->deg_to_rad($lat2);
		   $lon2 = $this->deg_to_rad($lon2);
	
		   $delta_lat = $lat2 - $lat1;
		   $delta_lon = $lon2 - $lon1;
	
		   $temp = pow(sin($delta_lat/2.0),2) + cos($lat1) * cos($lat2) * pow(sin($delta_lon/2.0),2);
	
		   $earth_radius = 3956;
		   $distance = $earth_radius * 2 * atan2(sqrt($temp),sqrt(1-$temp));
		   
		   if(strtolower($unit)!='miles'){ $distance = $distance*1.609344; } //assume unit is kilometers if it isn't miles/default
	 
		   return $distance;
	}

}

?>