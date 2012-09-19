<?php
/* 
	Plugin Name: TKH Property Admin
    Plugin URI: http://turnkeyhomes.biz
    Description: This will allow managing property database
    Version: 1.0
    Author: Nadula
    Author URI: http://www.nadula.info
    License: Nil
 */

/*function myFunction ($text) {
	$text = str_replace('Welcome', 'Hello', $text);
	return $text;	
}

add_filter('content', 'myFunction');*/

function tkh_property_admin_page () {
	?>
	<div class="wrap">
    
    <link rel="stylesheet" type="text/css" href="http://www.turnkeyhomes.biz/wp-content/plugins/property-admin/ajaxtabs/ajaxtabs.css" />
    <script type="text/javascript" src="http://www.turnkeyhomes.biz/wp-content/plugins/property-admin/ajaxtabs/ajaxtabs.js"></script>
    <link rel="stylesheet" rev="stylesheet" href="http://www.turnkeyhomes.biz/wp-content/plugins/property-admin/styles.css" media="screen" /> 
    
    <!--<h1>Welcome <?php echo $login_session; ?></h1>-->
    <h1>TKH Property Admin</h1><br />
    
    
    <ul id="countrytabs" class="shadetabs">
    <!--<li><a href="#" rel="#default" class="selected">Home</a></li>-->
    <li><a href="http://www.turnkeyhomes.biz/wp-content/plugins/property-admin/property.php?action=featured" rel="#iframe">Featured Property</a></li>    
    <li><a href="http://www.turnkeyhomes.biz/wp-content/plugins/property-admin/property.php?action=add" rel="#iframe">Add Profile</a></li>
    <li><a href="http://www.turnkeyhomes.biz/wp-content/plugins/property-admin/property.php?action=edit" rel="#iframe">Edit Profile</a></li>
    <li><a href="http://www.turnkeyhomes.biz/wp-content/plugins/property-admin/property.php?action=delete_stock" rel="#iframe">Delete Stock</a></li>    
    <li><a href="http://www.turnkeyhomes.biz/wp-content/plugins/property-admin/property.php?action=delete_profile" rel="#iframe">Delete Profile</a></li>        
    <!--<li><a href="external4.htm" rel="#iframe">Tab 4</a></li>
    <li><a href="statistics.php" rel="countrycontainer">Statistics</a></li>-->
    <li><a href="http://www.turnkeyhomes.biz/wp-content/plugins/property-admin/logout.html" rel="countrycontainer">Logout</a></li>
    </ul>
    
    <div id="countrydivcontainer" style="border:1px solid gray; width:730px; min-height: 100px; margin-bottom: 1em; padding: 10px">
    <p>This is some default tab content, embedded directly inside this space and not via Ajax. It can be shown when no tabs are automatically selected, or associated with a certain tab, in this case, the first tab.</p>
    </div>
    
    <script type="text/javascript">
    
    var countries=new ddajaxtabs("countrytabs", "countrydivcontainer")
    countries.setpersist(true)
    countries.setselectedClassTarget("link") //"link" or "linkparent"
    countries.init()
    
    </script>    
    </div>
    
	<?php
}

function tkh_property_admin_menu () {
	$icon = "http://www.turnkeyhomes.biz/wp-content/plugins/property-admin/home_v1.png";
	add_menu_page('Property Admin','Property Admin','read','tkh_property_admin', tkh_property_admin_page, $icon);
}

add_action('admin_menu','tkh_property_admin_menu');

?>