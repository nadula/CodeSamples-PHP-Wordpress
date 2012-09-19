<?php session_start(); ?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<script type="text/javascript" src="ajaxupload.js"></script>
<link rel="stylesheet" rev="stylesheet" href="styles.css" media="screen" />
<head>
    <title>class.upload.php test forms</title>

    <style>
        fieldset {
            width: 100%;
            /*margin: 15px 0px 25px 0px;*/
            padding: 15px;
        }
        legend {
            font-weight: bold;
        }
        .button {
            text-align: right;
        }
        .button input {
            font-weight: bold;
        }
		body { border:0px; margin:0px; padding:0px; }
		.upload_area { float:right; }
		form { float:left; }
		#red { color:#E00; }
		/*.file { border: 1px solid black; background-color: red; }*/
    </style>

<script type="text/javascript">
function loadXMLDoc(file, removeDiv)
{
	//alert(removeDiv);
	var xmlhttp;
	if (window.XMLHttpRequest)
	  {// code for IE7+, Firefox, Chrome, Opera, Safari
	  xmlhttp=new XMLHttpRequest();
	  }
	else
	  {// code for IE6, IE5
	  xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
	  }
	xmlhttp.onreadystatechange=function()
	  {
	  if (xmlhttp.readyState==4 && xmlhttp.status==200)
		{
		document.getElementById(removeDiv).innerHTML=xmlhttp.responseText;
		}
	  }
	xmlhttp.open("GET","remove.php?file="+file,true);
	xmlhttp.send();
}
</script>

</head>

<body>


<table width="585" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td> 
    <fieldset>
        <legend>Main image (file name example: profilenumber_1.jpg / 1443126_1.jpg)</legend>       
        <form name="form1" enctype="multipart/form-data" method="post" action="upload/upload.php" />
            <input class="file" type="file" name="my_field_1" onchange="ajaxUpload(this.form,'upload/upload.php?removeDiv=upload_area_1','upload_area_1','File Uploading Please Wait...&lt;br /&gt;&lt;img src=\'/format/functions/ajaxupload/images/loader_light_blue.gif\' width=\'128\' height=\'15\' border=\'0\' /&gt;','&lt;img src=\'/format/functions/ajaxupload/images/error.gif\' width=\'16\' height=\'16\' border=\'0\' /&gt; Error in Upload, check settings and path info in source code.'); return false;" />
        </form>
    	<div id="upload_area_1" class="upload_area"></div>
    </fieldset>    
    </td>
  </tr>
  <tr><td><br/></td></tr>
  <tr>
    <td>   
    <fieldset>
        <legend>Side image 1 - Floor plan image (file name example: 1443126_2.jpg)</legend>      
        <form name="form2" enctype="multipart/form-data" method="post" action="upload/upload.php" />
            <input type="file" name="my_field_2" onchange="ajaxUpload(this.form,'upload/upload.php?removeDiv=upload_area_2','upload_area_2','File Uploading Please Wait...&lt;br /&gt;&lt;img src=\'/format/functions/ajaxupload/images/loader_light_blue.gif\' width=\'128\' height=\'15\' border=\'0\' /&gt;','&lt;img src=\'/format/functions/ajaxupload/images/error.gif\' width=\'16\' height=\'16\' border=\'0\' /&gt; Error in Upload, check settings and path info in source code.'); return false;" />
        </form>     
    	<div id="upload_area_2" class="upload_area"></div>
    </fieldset>
    </td>
  </tr>  
  <tr><td><br/></td></tr>
  <tr>
    <td>   
    <fieldset>
        <legend>Side image 2 (file name example: 1443126_3.jpg)</legend>      
        <form name="form3" enctype="multipart/form-data" method="post" action="upload/upload.php" />
            <input type="file" name="my_field_2" onchange="ajaxUpload(this.form,'upload/upload.php?removeDiv=upload_area_3','upload_area_3','File Uploading Please Wait...&lt;br /&gt;&lt;img src=\'/format/functions/ajaxupload/images/loader_light_blue.gif\' width=\'128\' height=\'15\' border=\'0\' /&gt;','&lt;img src=\'/format/functions/ajaxupload/images/error.gif\' width=\'16\' height=\'16\' border=\'0\' /&gt; Error in Upload, check settings and path info in source code.'); return false;" />
        </form>     
    	<div id="upload_area_3" class="upload_area"></div>
    </fieldset>
    </td>
  </tr>
  <tr><td><br/></td></tr>
  <tr>
    <td>   
    <fieldset>
        <legend>Side image 3 (file name example: 1443126_4.jpg)</legend>      
        <form name="form4" enctype="multipart/form-data" method="post" action="upload/upload.php" />
            <input type="file" name="my_field_2" onchange="ajaxUpload(this.form,'upload/upload.php?removeDiv=upload_area_4','upload_area_4','File Uploading Please Wait...&lt;br /&gt;&lt;img src=\'/format/functions/ajaxupload/images/loader_light_blue.gif\' width=\'128\' height=\'15\' border=\'0\' /&gt;','&lt;img src=\'/format/functions/ajaxupload/images/error.gif\' width=\'16\' height=\'16\' border=\'0\' /&gt; Error in Upload, check settings and path info in source code.'); return false;" />
        </form>     
    	<div id="upload_area_4" class="upload_area"></div>
    </fieldset>
    </td>
  </tr>
  <tr><td><br/></td></tr>
  <tr>
    <td>   
    <fieldset>
        <legend>Side image 4 (file name example: 1443126_5.jpg)</legend>      
        <form name="form5" enctype="multipart/form-data" method="post" action="upload/upload.php" />
            <input type="file" name="my_field_2" onchange="ajaxUpload(this.form,'upload/upload.php?removeDiv=upload_area_5','upload_area_5','File Uploading Please Wait...&lt;br /&gt;&lt;img src=\'/format/functions/ajaxupload/images/loader_light_blue.gif\' width=\'128\' height=\'15\' border=\'0\' /&gt;','&lt;img src=\'/format/functions/ajaxupload/images/error.gif\' width=\'16\' height=\'16\' border=\'0\' /&gt; Error in Upload, check settings and path info in source code.'); return false;" />
        </form>     
    	<div id="upload_area_5" class="upload_area"></div>
    </fieldset>
    </td>
  </tr> 
  <tr><td id="red"><br/><hr/><br/>Upload Full Profile in PDF file format.</td></tr>
  <tr>
    <td><br/>
    <fieldset>
        <legend>Full Profile file (file name example: 1443126.pdf)</legend>      
        <form name="form6" enctype="multipart/form-data" method="post" action="upload/upload.php" />
            <input type="file" name="my_field_2" onchange="ajaxUpload(this.form,'upload/upload.php?removeDiv=upload_area_6','upload_area_6','File Uploading Please Wait...&lt;br /&gt;&lt;img src=\'/format/functions/ajaxupload/images/loader_light_blue.gif\' width=\'128\' height=\'15\' border=\'0\' /&gt;','&lt;img src=\'/format/functions/ajaxupload/images/error.gif\' width=\'16\' height=\'16\' border=\'0\' /&gt; Error in Upload, check settings and path info in source code.'); return false;" />
        </form>     
    	<div id="upload_area_6" class="upload_area"></div>
    </fieldset>
    </td>
  </tr> 
         
</table>








</body>

</html>
