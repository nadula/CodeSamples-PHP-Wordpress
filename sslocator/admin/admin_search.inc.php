
    <br />
    <form id="admin_school_form" name="admin_school_form" method="post">               
      
    &nbsp;&nbsp;External ID: &nbsp; <input id="externalid" name="externalid" type="text" style="width:50px;" onClick="document.getElementById('admin_search').value='';" value="<? if(isset($_POST['externalid'])){ echo $_POST['externalid']; } ?>" />
    <!-- this is your search text input field - either a postcode or suburb can be typed in here: -->    	
	&nbsp;&nbsp;School Name: &nbsp; <input id="admin_search" name="admin_search" type="text" style="width:245px;" onClick="document.getElementById('externalid').value='';" value="<? if(isset($_POST['admin_search'])){ echo $_POST['admin_search']; } ?>" />
    &nbsp;&nbsp;&nbsp;&nbsp;<input type="image" src="../images/btn_search.v1.jpg" align="top"  />
    
    <!-- this is a 'loading' image, only displayed while results are being requested: -->
      <span id="indicator" style="display: none;"><img src="../scriptaculous/indicator_arrows.gif" /></span>
      
    <!-- this is a placeholder that scriptaculous will use to build the results listing within: -->
    <div class="auto_complete" id="suburb_auto_complete"></div>
    </form>
        
    <!-- this code loads in the libraries that enable the auto-complete field: -->
    <script src="../scriptaculous/prototype.js" type="text/javascript"></script>
    <script src="../scriptaculous/scriptaculous.js" type="text/javascript"></script>
    
    <!-- this code enables the suburb_postcode text field for auto-completion. From 3 characters onwards, the contents of this field are sent to 'suburb_auto_complete.php' which returns an unordered list to display: -->
    <script type="text/javascript">
        var suburb_postcode_auto_completer = new Ajax.Autocompleter('admin_search', 'suburb_auto_complete', 'suburb_auto_complete.php', {paramName: "admin_search", minChars: "3", indicator: "indicator"})
    </script>