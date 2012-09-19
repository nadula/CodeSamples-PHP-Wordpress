<?php
include('lock.php');
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml2/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en">

<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<link rel="stylesheet" type="text/css" href="ajaxtabs/ajaxtabs.css" />
<script type="text/javascript" src="ajaxtabs/ajaxtabs.js"></script>
<link rel="stylesheet" rev="stylesheet" href="../styles.css" media="screen" /> 
</head>

<body>
<!--<h1>Welcome <?php echo $login_session; ?></h1>-->
<h1>Swim School Locator Admin</h1><br />


<ul id="countrytabs" class="shadetabs">
<!--<li><a href="#" rel="#default" class="selected">Home</a></li>-->
<li><a href="school.php?action=search" rel="#iframe">View School</a></li>
<li><a href="school.php?action=add" rel="#iframe">Add School</a></li>
<li><a href="school.php?action=edit" rel="#iframe">Edit School</a></li>
<li><a href="school.php?action=delete" rel="#iframe">Delete School</a></li>
<!--<li><a href="external4.htm" rel="#iframe">Tab 4</a></li>
<li><a href="statistics.php" rel="countrycontainer">Statistics</a></li>-->
<li><a href="logout.html" rel="countrycontainer">Logout</a></li>
</ul>

<div id="countrydivcontainer" style="border:1px solid gray; width:650px; min-height: 100px; margin-bottom: 1em; padding: 10px">
<p>This is some default tab content, embedded directly inside this space and not via Ajax. It can be shown when no tabs are automatically selected, or associated with a certain tab, in this case, the first tab.</p>
</div>

<script type="text/javascript">

var countries=new ddajaxtabs("countrytabs", "countrydivcontainer")
countries.setpersist(true)
countries.setselectedClassTarget("link") //"link" or "linkparent"
countries.init()

</script>

</body>
</html>

