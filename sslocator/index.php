<!DOCTYPE html>
<html>
<head>
<title>Aus Suburb Database / Aus Postcode Locator Pro combo example</title>
<link rel="stylesheet" rev="stylesheet" href="/sslocator/styles.css" media="screen" />
<? if(isset($_POST['suburb_postcode'])){ ?>
<script type="text/javascript" src="http://maps.googleapis.com/maps/api/js?sensor=false"></script>
</head>
<body onload="initialize()">
<? } else { echo "</head><body>"; } ?>
	<p id="title">Find Your Local Swim School</p>
    
<?php 
//include ('functions/DB.php');
require('config.php');
$country = "Australia"; 
if(isset($_POST['country'])) { $country = $_POST['country']; }
$sql = "SELECT country FROM `school_list` GROUP BY country ORDER BY country LIMIT 0 , 30";	
$result = mysql_query($sql);
?>
    
      <form id="suburb_postcode_form" name="suburb_postcode_form"  method="post">               

Country: &nbsp; <select id="country" name="country" onchange="document.getElementById('suburb_postcode').value = ''; suburb_postcode_form.submit();">
	
<?php while($countrys = mysql_fetch_array($result)) {
	if( isset($_POST['country']) && $_POST['country'] == $countrys[0] ) { echo "<option value='$countrys[0]' selected='selected'>$countrys[0]</option>"; } else { echo "<option value='$countrys[0]'>$countrys[0]</option>"; }
	//echo "<option value='$countrys[0]'>$countrys[0]</option>";
}
?>
</select>
      
      <!-- this is your search text input field - either a postcode or suburb can be typed in here: -->
		<?php 
		if(isset($_POST['country'])) {
			//if( $_POST['country'] == "Australia" ) { $searchMessage = "Postcode or Suburb:"; } else { $searchMessage = "Postcode:"; }
			if( $_POST['country'] == "Australia" ) { $searchMessage = "Postcode:"; } else { $searchMessage = "Postcode:"; }
		/*} else { $searchMessage = "Postcode or Suburb:"; }*/
		} else { $searchMessage = "Postcode:"; }
		?>      	
          &nbsp;&nbsp;<span id="search_msg"><?php echo $searchMessage; ?></span> &nbsp; <input id="suburb_postcode" name="suburb_postcode" type="text" style="width:232px;" value="<? if(isset($_POST['suburb_postcode'])){ echo $_POST['suburb_postcode']; } ?>" />  <input type="image" src="/sslocator/images/btn_search.jpg" align="top" />

        <!-- this is a 'loading' image, only displayed while results are being requested: -->
          <span id="indicator" style="display: none;"><img src="/sslocator/scriptaculous/indicator_arrows.gif" /></span>
          
       <!-- this is a placeholder that scriptaculous will use to build the results listing within: -->
        <div class="auto_complete" id="suburb_auto_complete"></div>
      </form>
      
     
      <?php if( $country == "Australia" ) { ?>
      <!-- this code loads in the libraries that enable the auto-complete field: -->
      <script src="/sslocator/scriptaculous/prototype.js" type="text/javascript"></script>
      <script src="/sslocator/scriptaculous/scriptaculous.js" type="text/javascript"></script>
        
      <!-- this code enables the suburb_postcode text field for auto-completion. From 3 characters onwards, the contents of this field are sent to 'suburb_auto_complete.php' which returns an unordered list to display: -->
      <script type="text/javascript">
            var suburb_postcode_auto_completer = new Ajax.Autocompleter('suburb_postcode', 'suburb_auto_complete', 'suburb_auto_complete.php', {paramName: "suburb_postcode", minChars: "3", indicator: "indicator"})
      </script>
      <?php } ?>
    <br />
        
<!-- this is the code that looks up the locations based on the supplied postcode or suburb: -->
<?php  

if(isset($_POST['suburb_postcode']) && ($_POST['suburb_postcode'] != "") ){ // && ($_POST['suburb_postcode'] != "")
	### load in the database connection details:
	//require('config.php');
	
	##Get the latitude and longitude for the supplied postcode/suburb:
	$schoolArr = array();
	if( $_POST['country'] == "Australia" ) {
	
		##Check if this is a postcode (a number):
		if(is_numeric($_POST['suburb_postcode'])){
			##look up lat/lon using supplied postcode:
			$ref = mysql_query("SELECT `lat`,`lon` FROM `$table` WHERE `postcode` = '{$_POST['suburb_postcode']}'");
			$res = mysql_fetch_assoc($ref);
			$lat = $res['lat'];
			$lon = $res['lon'];
			
		}else{
			##it's not a number/postcode.
			
			##get rid of the STATE value from the end of the supplied suburb string (suburb will come in looking like this- 'The Rocks, Sydney NSW', this strips off ' NSW'):
			$suburb_postcode = $_POST['suburb_postcode'];
			
			$match_array = array('NSW','ACT','VIC','WA','SA','TAS','NT','QLD');
			$state = '';
			for($x=0;$x<=7;$x++){
				$len = (1+strlen($match_array[$x]));
				if(substr($suburb_postcode,-$len,$len) == " {$match_array[$x]}"){
					$suburb_postcode = substr($suburb_postcode,0,strlen($suburb_postcode)-$len);
					$state = $match_array[$x];
				}
			}
			
			##look up the suburb lat/lon using supplied text:
			$ref = mysql_query("SELECT `lat`,`lon` FROM `$table` WHERE `suburb` = '{$suburb_postcode}' AND `state` = '{$state}'");
			$res = mysql_fetch_assoc($ref);
			$lat = $res['lat'];
			$lon = $res['lon'];
		}
		
		//echo $suburb_postcode."2";
		##use the supplied latitude/longitude to look up locations:
		if(empty($lat) && empty($lon)){ 
			##what to display when no lat/lon was found:
			//echo("<b>No suburb or postcode was found using the search term &quot;{$_POST['suburb_postcode']}&quot;. Please try again.</b>");
			
		}else{
			
			include_once("ausSuburbDatabase.php");
			$ausSuburbDatabase = new ausSuburbDatabase;
			
			function subval_sort($a,$subkey) {
				foreach($a as $k=>$v) {
					$b[$k] = strtolower($v[$subkey]);
				}
				asort($b);
				foreach($b as $key=>$val) {
					$c[] = $a[$key];
				}
				return $c;
			}
			
	/*		$searchLat    = '-37.754973';
			$searchLon   = '144.917407';*/
			$searchLat    = $lat;
			$searchLon   = $lon;		
			$unit   = 'Kilometers';
		
			$sql = "SELECT * FROM `school_list`";
			$result_arr = mysql_query($sql);
			$schoolArr = array();
			$i = 0;
	
			while($row = mysql_fetch_array($result_arr)) { 
				//only displayes valid addresses
				if( $row['lat'] != "" ) {			
					$distance = $ausSuburbDatabase->distance($searchLat,$searchLon,$row['lat'],$row['lon'],$unit);				
					$row['distance'] = round($distance, 2);
					$schoolArr[$i] = $row;
					$i+=1;
				}
			}
			
			$schoolArr = subval_sort($schoolArr, 'distance');		
			//foreach ($schoolArr as $value) { print_r($value); echo "<br /><br />"; }
		} //if(empty($lat) && empty($lon)){ 
		
	} else { //if( $_POST['country'] != "Australia" ) {
		//echo "not australia";
		if( trim($_POST['suburb_postcode']) != "" ) { 
			$result_arr = mysql_query("SELECT * FROM `school_list` WHERE `postcode` = '{$_POST['suburb_postcode']}'"); 
			//$result_arr = mysql_query("SELECT * FROM `school_list` WHERE `country` = '{$_POST['country']}'");
			//$result_arr = mysql_query("SELECT * FROM `school_list` WHERE `country` = 'USA'");
	
			$schoolArr = array();
			$i = 0;
	
			while($row = mysql_fetch_array($result_arr)) { 
				//only displayes valid addresses
				if( $row['lat'] != "" ) {			
					$schoolArr[$i] = $row;
					$i+=1;
				}
			}
		}
		
	} //if( $_POST['country'] != "Australia" ) {
		
	$schoolArrCount = count($schoolArr);
	if( $schoolArrCount == 0 ) { echo("<br/><b>No suburb or postcode was found using the search term &quot;{$_POST['suburb_postcode']}&quot;. Please try again.</b>"); }	
	if( $schoolArrCount > 0 )	{		
		$perline = 2;
		$line = 0;
		$tableWidth = 650;
		if( $schoolArrCount > 4 ) { $schoolArrCount = 4; }
 		echo "<p id='message'>Your closest swim schools are...</p>";
		echo '<table width="650" border="0" cellspacing="10" cellpadding="10"  style="border-collapse:collapse"><tr>';
		for($i=0; $i<$schoolArrCount; $i++) { //echo $schoolArr[$i]['name']; echo "<br /><br />"; }
			if($line==2) { echo "</tr><tr>"; $line = 0; } ?>			
            
            <td><div id="school_box">
            <table width="300" border="0" cellspacing="0" cellpadding="3">
              <tr>
                <!--<td colspan="2" id="school_name"><img id="school_index_img" src="images/Map-Locator-<? echo $i+1; ?>.png" /><? echo $schoolArr[$i]['name']; ?> <span id="viewmaplink"><? echo $schoolArr[$i]['distance']; ?> Km</span></td>-->
                <td colspan="2" >
                    <table width="100%" border="0" cellspacing="0" cellpadding="0">
                      <tr>
                        <td align="left"><img id="school_index_img" src="<? if( trim($_POST['country']) == "Australia" ) { $j=$i+1; echo "/sslocator/images/Map-Locator-".$j; } else { echo "/sslocator/images/marker-map"; } ?>.png" style="width:35px;" /></td>
                        <td id="school_name"><? echo $schoolArr[$i]['name']; ?></td>
                        <td id="distance"><?php if( $_POST['country'] == "Australia" ) { echo $schoolArr[$i]['distance']."Km"; } ?></td>
                      </tr>
                    </table>
                    <hr/>                
                </td>
              </tr>
              <tr>
                <td width="100">Address:</td>
                <td><? echo $schoolArr[$i]['address1']; ?></td>
              </tr>
              <tr>
                <td>Suburb:</td>
                <td><? echo $schoolArr[$i]['suburb']; ?></td>
              </tr>
              <tr>
                <td>State:</td>
                <td><? echo $schoolArr[$i]['state']; ?></td>
              </tr>
              <?php if($schoolArr[$i]['phone']!="" && $schoolArr[$i]['phone'] != "0") { ?>
              <tr>
                <td>Office Phone:</td>
                <td><? echo $schoolArr[$i]['phone']; ?></td>
              </tr>
              <?php } if($schoolArr[$i]['mobile']!="" && $schoolArr[$i]['mobile'] != "0") { ?>
              <tr>
                <td>Mobile:</td>
                <td><? echo $schoolArr[$i]['mobile']; } ?></td>
              </tr>
              
              <tr>                
                <?php //if($schoolArr[$i]['website']!="" && $schoolArr[$i]['website'] != "0") { echo "<td>Website:</td><td><a href='http://".$schoolArr[$i]['website']."' target='_blank'>".$schoolArr[$i]['website']."</a></td>"; } else { echo "<td colspan='2'><br /></td>"; }
				if($schoolArr[$i]['website']!="" && $schoolArr[$i]['website'] != "0") { echo "<td>Website:</td><td><a href='http://".$schoolArr[$i]['website']."' target='_blank'>".$schoolArr[$i]['website']."</a></td>"; } else { echo "<td>Website:</td><td><a href='http://swimaust-test.waxsonit.com.au/school/".$schoolArr[$i]['externalid']."' target='_blank'>View School Profile</a></td>"; }  ?>
              </tr>
              
              <tr>
                <td colspan="2">
                	<?php if($schoolArr[$i]['email']!="" && $schoolArr[$i]['email'] != "0") { ?>
                    <a href="mailto:<? echo $schoolArr[$i]['email']; ?>">Email this swim School</a>
                    <?php } else { echo "<br />"; } ?>              
                    </td>
              </tr>
              
              <tr>
              
                <td colspan="2" align="right">
                <?php if($schoolArr[$i]['banner']!="" && $schoolArr[$i]['banner'] != "0") { ?><a id="acc_logo" class="thumbnail" href="#thumb"><img src="/sslocator/images/logos/thumbnails/<? echo $schoolArr[$i]['banner']; ?>" /><span><img src="/sslocator/images/logos/<? echo $schoolArr[$i]['banner']; ?>" /></span></a><?php }  ?>
                <?php if($schoolArr[$i]['accredited']=="yes") { ?><img id="acc_logo" src="/sslocator/images/accredited.jpg" title="Accedited Swim School" /><?php } else {  ?>Not Accredited by<br/> Swim Australia<?php }  ?>                 
                 </td>
              </tr>              
              
              <!--<tr><td colspan="2"><span id="viewmaplink"><a href="">View Map</a></span></td></tr>-->
            </table></div>
            </td>            
            
			<?php
			 $line+=1;
		} //for
		
		echo '</tr><tr><td colspan="2">'; ?>

		<script type="text/javascript">
        
            function initialize() {
              var myOptions = {
                zoom: 12,
                center: new google.maps.LatLng(<? echo $schoolArr[0]['lat'].", ".$schoolArr[0]['lon']; ?>),
                mapTypeId: google.maps.MapTypeId.ROADMAP
              }
              var map = new google.maps.Map(document.getElementById("map_canvas"),myOptions);
            
              setMarkers(map, schools);
            

			
			}
        
            /**
             * Data for the markers consisting of a name, a LatLng and a zIndex for
             * the order in which these markers should display on top of each
             * other.
             */		
            <? 
            for($j=0; $j<$schoolArrCount; $j++) {
                $jsString = "['".$schoolArr[$j]['name']."', ".$schoolArr[$j]['lat'].", ".$schoolArr[$j]['lon'].", ".$j."]";
                $jsStringArr[$j] = $jsString;
            }
            echo $jsString = "var schools = [".$jsStringArr[0].",".$jsStringArr[1].",".$jsStringArr[2].",".$jsStringArr[3]."];";
            ?>
                    
            function setMarkers(map, locations) {
            
              for (var i = 0; i < locations.length; i++) {
            
				  imageNumber = i+1;
				  <?php if( $_POST['country'] == "Australia" ) { echo 'var image = new google.maps.MarkerImage("/sslocator/images/Map-Locator-"+imageNumber+".png",'; } else { echo 'var image = new google.maps.MarkerImage("/sslocator/images/marker-map.png",'; } ?>
					  new google.maps.Size(42, 33),
					  new google.maps.Point(0,0),
					  new google.maps.Point(0, 33));
				
					var school = locations[i];
					var myLatLng = new google.maps.LatLng(school[1], school[2]);
					var marker = new google.maps.Marker({
						position: myLatLng,
						map: map,
						//shadow: shadow,
						icon: image,
						//shape: shape,
						//title: beach[0],
						title: school[0]
						//zIndex: beach[3]
					});
				  
				  //google.maps.event.addListener(marker, 'click', function() {
					//map.setZoom(15);
				  //});			  
				  			  
			  }
            }
        </script>	
		
		<?
		echo '<div id="map_canvas" style="width:670px; height:300px;float:left;"></div></td></tr></table>';

	} //if( count($schoolArr) > 0 )	{
	//} ////if( $_POST['suburb_postcode'] != "Australia" ) {	
} //if(isset($_POST['suburb_postcode'])){ 

?>



</body>
</html>
