<?php session_start(); ?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<script type="text/javascript" src="ajaxupload.js"></script>
<link rel="stylesheet" rev="stylesheet" href="styles.css" media="screen" />
<head>
    <title>class.upload.php test forms</title>

    <style>
        fieldset {
            width: 50%;
            margin: 15px 0px 25px 0px;
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
    </style>

</head>

<body>


        <form name="form2" enctype="multipart/form-data" method="post" action="upload/upload.php" />
                   
            <p><input type="file" name="my_field" onchange="ajaxUpload(this.form,'upload/upload.php','upload_area','File Uploading Please Wait...&lt;br /&gt;&lt;img src=\'/format/functions/ajaxupload/images/loader_light_blue.gif\' width=\'128\' height=\'15\' border=\'0\' /&gt;','&lt;img src=\'/format/functions/ajaxupload/images/error.gif\' width=\'16\' height=\'16\' border=\'0\' /&gt; Error in Upload, check settings and path info in source code.'); return false;" /></p>
        
        </form>
<div id="upload_area"></div>
<span id='ajaxDiv'></span>
</body>

</html>
