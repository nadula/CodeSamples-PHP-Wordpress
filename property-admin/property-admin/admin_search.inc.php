

<div style="padding-top:20px;" align="center">
<form id="admin_property_form" name="admin_property_form" method="post"> 
<div>
	<span style="padding-right:5px;">Stock Number:</span><input id="stock_number" name="stock_number" type="text" style="width:100px;" onClick="document.getElementById('stock_number').value='';" value="<? if(isset($_POST['stock_number'])){ echo $_POST['stock_number']; } ?>" /><span style="padding-left:15px;"><input type="submit" value="Find Property" src="btn_search.jpg" align="top"  /></span>
</div>
</form>
</div>
<hr/>