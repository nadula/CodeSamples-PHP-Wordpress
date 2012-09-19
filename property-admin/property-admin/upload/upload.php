<?php
session_start();
include('class.upload.php');
echo '<link rel="stylesheet" rev="stylesheet" href="styles.css" media="screen" /> ';
		
    // ---------- IMAGE UPLOAD ----------

    // we create an instance of the class, giving as argument the PHP object
    // corresponding to the file field from the form
    // All the uploads are accessible from the PHP object $_FILES
	
	if(isset($_FILES['my_field_1']))
		$handle = new Upload($_FILES['my_field_1']);
	else if(isset($_FILES['my_field_2']))
		$handle = new Upload($_FILES['my_field_2']);
	else if(isset($_FILES['my_field_3']))
		$handle = new Upload($_FILES['my_field_3']);
	else if(isset($_FILES['my_field_4']))
		$handle = new Upload($_FILES['my_field_4']);
	else if(isset($_FILES['my_field_5']))
		$handle = new Upload($_FILES['my_field_5']);						
	
	$removeDiv = $_GET['removeDiv'];
	//echo $removeDiv;
	
    $ext = strtoupper(trim($handle->file_src_name_ext));
	//echo "ext=".$ext;
	if( $ext != "JPG" && $ext != "PNG" && $ext != "GIF" && $ext != "BMP" ) { 
	
		if( $ext == "PDF" || $ext == "DOC" || $ext == "DOCX" ) {
			$handle->file_overwrite	= true;
			$dir_dest_profile = getenv("DOCUMENT_ROOT")."/format/images/properties/profiles/";
			$handle->Process($dir_dest_profile);
			// we check if everything went OK
			if ($handle->processed) {
				// everything was fine !
				echo '<span style="float:right;">'.$handle->file_dst_name.'<br /> File upload success.</span>';
			} else {
				// one error occured
				echo "<span class='error_msg'>Error uploading file!</span>";
			}						
		} else {
			echo "<span class='error_msg'>Invalid file type! (Only JPEG, BMP, PNG and GIF files allowed)</span> <br /> [ <a href='uploadhtml.php?reupload=yes' >Re upload</a> ] &nbsp;&nbsp; [ <a href='uploadhtml.php' >Cancel</a> ]"; 
		}
		
	} else {
		if( $handle->file_src_size > 2097152 ) { echo "<span class='error_msg'>File size should be less than 2MB!</span> &nbsp;&nbsp; [ <a href='../uploadhtml.php?reupload=yes' >Re upload</a> ] &nbsp;&nbsp; [ <a href='../uploadhtml.php' >Cancel</a> ]"; } else {
				
			// then we check if the file has been uploaded properly
			// in its *temporary* location in the server (often, it is /tmp)
			if ($handle->uploaded) {
		
				// yes, the file is on the server
				// below are some example settings which can be used if the uploaded file is an image.
				//$handle->file_auto_rename        = true;
				//$handle->file_new_name_body      = 'image_resized';
				$handle->image_resize   = true;
				$handle->image_x        = 93;
				$handle->image_y        = 62;
				//$handle->image_ratio_x  = true;
				$handle->file_overwrite	= true;
		
				// now, we start the upload 'process'. That is, to copy the uploaded file
				// from its temporary location to the wanted location
				// It could be something like $handle->Process('/home/www/my_uploads/');
				//$dir_dest = "../../images/logos";
				$dir_dest = getenv("DOCUMENT_ROOT")."/format/images/properties/93x62/";
				//echo $dir_dest;
				//$docRoot = getenv("DOCUMENT_ROOT");
				$handle->Process($dir_dest);
		
				// we check if everything went OK
				if ($handle->processed) {
					// everything was fine !
					//$_SESSION['new_school_banner'] = $handle->file_src_name;
					$_SESSION['new_school_banner'] = $handle->file_dst_name;
					echo '<img src="/format/images/properties/93x62/'.$_SESSION['new_school_banner'].'" />  
					&nbsp;&nbsp; <span style="float:right;">'.$_SESSION['new_school_banner'].'<br /> File upload success. <img src="upload/icon_tick.png" border="0" /> &nbsp;&nbsp; 
					<br /><br />[ <a onclick="loadXMLDoc(\''.$_SESSION['new_school_banner'].'\',\''.$removeDiv.'\')" style="cursor:pointer" >Remove</a> ]</span>';
				} else {
					// one error occured
					echo "<span class='error_msg'>Error uploading file!</span> &nbsp;&nbsp; [ <a href='uploadhtml.php' >Retry</a> ] ";
				}
				
		//////////////////////////////////////////////////////////////////////////////////////////////////		
				// we now process the image a second time, with some other settings
				$handle->image_resize   = true;
				$handle->image_x        = 390;
				$handle->image_y        = 260;
				$handle->file_overwrite	= true;
		
				$dir_dest = getenv("DOCUMENT_ROOT")."/format/images/properties/390x260/";
				$handle->Process($dir_dest);
		
				// we check if everything went OK
				if ($handle->processed) {
					// everything was fine !
		
				} else {
					// one error occured
		
				}		
		//////////////////////////////////////////////////////////////////////////////////////////////////
				// we now process the image a second time, with some other settings
				$handle->image_resize   = true;
				$handle->image_x        = 800;
				$handle->image_y        = 534;
				$handle->file_overwrite	= true;
		
				$dir_dest = getenv("DOCUMENT_ROOT")."/format/images/properties/800x534/";
				$handle->Process($dir_dest);
		
				// we check if everything went OK
				if ($handle->processed) {
					// everything was fine !
		
				} else {
					// one error occured
		
				}		
		//////////////////////////////////////////////////////////////////////////////////////////////////		
		
				// we delete the temporary files
				$handle-> Clean();
		
			} else {
				echo "<span class='error_msg'>Error uploading file!</span> &nbsp;&nbsp; [ <a href='uploadhtml.php' >Retry</a> ]";
			}
		} //invalid file size
	} // valid file type
?>
